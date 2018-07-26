<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(App\User::class)->make([
            'name' => 'Jake Causier',
            'email' => 'jake@purplemountmedia.com',
            'password' => bcrypt('password'),
            'remember_token' => '',
        ]);

        $user->save();

        factory(App\User::class, 10)->create();
    }
}
