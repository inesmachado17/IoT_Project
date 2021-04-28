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
        if (file_exists('.env.backup')) {
            copy('.env.backup', '.env');
        }

        $this->call('cache:clear');

        $useSqlite = $this->option('sqlite');
        if ($useSqlite) {
            copy('.env', '.env.backup');
            $fileArray = file('.env');
            $fileArray = array_map(function ($value) {
                return rtrim($value, PHP_EOL);
            }, $fileArray);

            $dbConnectionKey = $this->searchOnArray('DB_CONNECTION', $fileArray);
            $dbDatabasekey = $this->searchOnArray('DB_DATABASE', $fileArray);
            $fileArray[$dbConnectionKey] = 'DB_CONNECTION=sqlite';
            $fileArray[$dbDatabasekey] = 'DB_DATABASE=' . database_path('database.sqlite');

            $fileEnv = implode(PHP_EOL, $fileArray);
            file_put_contents('.env', $fileEnv);
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
            } else {
                $this->error("Read ERROR from 'npm run serve': " . $data);
            }
        }

        return 0;
    }

    private function searchOnArray($keyword, $array)
    {
        foreach ($array as $key => $item) {
            if (str_contains($item, $keyword)) {
                return $key;
            }
        }
    }
}
