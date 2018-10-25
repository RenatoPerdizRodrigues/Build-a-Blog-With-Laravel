<?php

use Illuminate\Database\Seeder;
use App\Post;

class PostsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 0; $i <= 10; $i++){
            Post::insert([
                'title' => simplexml_load_file('http://www.lipsum.com/feed/xml?amount=1&what=words&start=0')->lipsum,
                'body' => file_get_contents('http://loripsum.net/api/3/medium/plaintext'),
                'slug' => str_random(3).'-'.str_random(5).'-'.str_random(3)
            ]);
        }
    }
}