<?php

use Illuminate\Database\Seeder;
use App\Models\Book;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $this->call('BooksSeeder');
    }
}

class BooksSeeder extends Seeder
{
    public function run()
    {
        DB::table('book')->delete();
        DB::table('book')->insert([
            'title'=>'Rider without head',
            'author'=>'Mayne Reid',
            'year'=>1865,
            'isbn'=>'9785170756926'
        ]);
        
        DB::table('book')->insert([
            'title'=>'The 7 Habits of Highly Effective People',
            'author'=>'Stephen R. Covey',
            'year'=>1989,
            'isbn'=>'978-5-9614-1681-7'
        ]);
        
        DB::table('book')->insert([
            'title'=>'Білий Бім Чорне вухо',
            'author'=>'Гаврїл Троєпольський',
            'year'=>1968,
            'isbn'=>'9874563214567'
        ]);
    }
}
