<?php

use Illuminate\Database\Seeder;

class ApplesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Apple::class, 786)
            ->create();
    }
}
