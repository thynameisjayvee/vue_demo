<?php

use App\User;
use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::Create([
          'name' => 'John Doe',
          'email' => 'demo@demo.com',
          'password' => bcrypt('secret'),
        ]);
    }
}
