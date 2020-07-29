<?php

use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,20) as $index) {
            DB::table('categories')->insert([
                'title' => $faker->word,
                'status' => $faker->boolean,
                'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
            ]);
        }

    }
}
