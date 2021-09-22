<?php

namespace App\Console\Commands;

use App\Http\Controllers\api\MovieController;
use App\Models\Movie;
use App\Models\Setting;
use Illuminate\Console\Command;

class movieSeeder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:movieSeeder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

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
     * @return mixed
     */
    public function handle()
    {
        $movieSeeding = new MovieController;
        $movieSeeding->index();
        echo 'Seeding Done\n';
    }
}
