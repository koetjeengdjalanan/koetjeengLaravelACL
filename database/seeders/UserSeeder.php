<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\UserDetail;
use Database\Factories\UserDetailFactory;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles    = Role::all()->except(Role::whereName('superadmin')->first()->id);
        $rootUser = \App\Models\User::factory()->create([
            'name'     => 'The Watcher',
            'username' => 'thewatcher',
            'email'    => 'iam@watching.you',
            'password' => bcrypt('testing123'),
        ])->assignRole('superadmin');
        $rootUser->userDetail()->create((new UserDetailFactory)->definition());
        $users = \App\Models\User::factory(64)->create();
        foreach ($users as $key => $user) {
            $user->assignRole($roles->random());
            $user->userDetail()->create((new UserDetailFactory)->definition());
        }
    }
}
