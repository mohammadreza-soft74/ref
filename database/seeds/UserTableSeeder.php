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

            $this->registerData();

    }

    private function registerData()
    {
        for ($i = 1; $i <= 10; $i++)
        {
            User::create([
                'name' => "user$i",
                'email' => "user$i@mohammadreza.com",
                'password' => bcrypt('password'),
//            'token' => null
            ]);
        }
    }
}
