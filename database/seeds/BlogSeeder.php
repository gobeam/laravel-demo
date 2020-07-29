<?php


use Faker\Factory as Faker;
use Illuminate\Database\Seeder;

class BlogSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker::create();
        foreach (range(1,100) as $index) {
            DB::table('blogs')->insert([
                'title' => $faker->sentence($nbWords = 1, $variableNbWords = true),
                'user_id' => $faker->numberBetween($min = 1, $max = 2),
                'description' => $faker->paragraph($nbSentences = 1, $variableNbSentences = true) ,
                'body' => $faker->text($maxNbChars = 1500) ,
                'status' => $faker->boolean,
                'category_id' => $faker->numberBetween($min = 1, $max = 9),
                'created_at' => $faker->dateTimeBetween($startDate = '-1 years', $endDate = 'now')
            ]);
        }


//        $blogs = [
//            ["title" => "What is Lorem Ipsum?", "description" => "Lorem Ipsum is simply dummy text of the printing", "body" => "Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.", "user_id" => $user->id, "status" => true, "category_id" => 1]
//        ];
//        DB::table('blogs')->insert($blogs);
    }
}
