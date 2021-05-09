<?php

namespace App\Console\Commands;

use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Hash;

class SetupProject extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'project:setup';

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
     * @return int
     */
    public function handle()
    {
        $this->call("key:generate");
        $this->call("passport:install");
        $this->call("migrate:fresh", ["--seed"]);
        $this->call("storage:link");
        $user = new User(["email" => "serkanerip@gmail.com", "password" => Hash::make("testuser"), "name" => "Serkan Erip"]);
        $user->save();
        return 0;
    }
}
