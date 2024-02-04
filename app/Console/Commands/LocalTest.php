<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class LocalTest extends Command
{
    protected $signature   = "localTest";
    protected $description = "Ignore This!";
    public function handle()
    {
        $res = \App\Models\Role::all()->except(\App\Models\Role::whereName('superadmin')->first()->id);
        dump($res);
        return Command::SUCCESS;
    }
}
