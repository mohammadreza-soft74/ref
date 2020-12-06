<?php

use Illuminate\Database\Seeder;

class ArticleTableSeeder extends Seeder
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
            for ($j = 1; $j <= 2; $j++ )
            {
                $faker = \Faker\Factory::create();
                \App\Articles::create([
                    'user_id' => "$i",
                    'title' => $faker->title,
                    'body' => $faker->paragraph,

                ]);
            }
        }
    }
}
