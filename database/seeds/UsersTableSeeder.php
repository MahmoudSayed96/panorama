<?php

use App\User;
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
        $user = User::create([
            'name' => 'Super Admin',
            'email' => 'super_admin@app.com',
            'password' => bcrypt('admin@123456'),
            'photo' => NULL
        ]);
        $user->attachRole('super_admin');
    }
}
