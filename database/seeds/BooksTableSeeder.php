<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BooksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Faker\Factory::create();

        $limit = 80;

        for ($i = 0; $i < $limit; $i++) {
            DB::table('books')->insert([ //,
                'title' => $faker->sentence($nbWords = 6, $variableNbWords = true),
                'author' => $faker->numberBetween($min = 1, $max = 20),
                'year' => $faker->year,
                'isbn' => $faker->isbn10,
            ]);
        }
    }
}
