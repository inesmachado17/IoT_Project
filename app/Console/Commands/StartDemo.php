<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\Process\Exception\ProcessFailedException;
use Symfony\Component\Process\Process;

class StartDemo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start:demo {--L|sqlite}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start aplication for demo purposes
                                -L or --sqlite : Use this flag to switch from default mysql database to sqlite on file';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $this->call('cache:clear');

        $useSqlite = $this->option('sqlite');

        if ($useSqlite) {
            config([
                'database.default' => 'sqlite'
            ]);
            config([
                'database.connections.sqlite.database' => database_path('database.sqlite')
            ]);
            //dd(config('database.default'));
        }

        $this->info('Refresh database...');
        $this->call('migrate:refresh');

        $this->info('Seed database...');
        $this->call('db:seed');


        try {
            $process = new Process(['npm', 'run', 'serve']);
            $process->start();
        } catch (ProcessFailedException $exception) {
            echo $exception->getMessage();
        }

        $this->line('');
        foreach ($process as $type => $data) {

            if ($process::OUT === $type) {
                if (str_contains($data, 'JSON Server is running')) {
                    $this->info("Read from 'npm run serve': " . $data);
                    $this->line('');
                    $this->info('Start artisan serve...');
                    $this->call('serve');
                } else {
                    $this->line("Read from 'npm run serve': " . $data);
                }
            } else { // $process::ERR === $type
                $this->error("Read ERROR from 'npm run serve': " . $data);
            }
        }

        return 0;
    }
}
