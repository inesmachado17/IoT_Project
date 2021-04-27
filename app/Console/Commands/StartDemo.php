<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StartDemo extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'start:demo';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Start aplication for demo purposes';

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
        $this->info('Refresh database...');
        $this->call('migrate:refresh');

        $this->info('Seed database...');
        $this->call('db:seed');





        return 0;
    }
}
