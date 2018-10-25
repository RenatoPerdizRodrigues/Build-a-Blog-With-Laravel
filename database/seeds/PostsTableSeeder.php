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
        /** Code used for plain Lorem Ipsum posts
        for ($i = 0; $i <= 10; $i++){
            Post::insert([
                'title' => simplexml_load_file('http://www.lipsum.com/feed/xml?amount=1&what=words&start=0')->lipsum,
                'body' => file_get_contents('http://loripsum.net/api/3/medium/plaintext'),
                'slug' => str_random(3).'-'.str_random(5).'-'.str_random(3)
            ]);
        }
        */

        //Code used for Hipster Ipsum formatted to PHP
        for ($i = 0; $i <= 10; $i++){
            $title = file_get_contents('http://hipsterjesus.com/api?paras=3&type=hipster-centric&html=false');
            substr($title, 0, 10);
            $title = explode(" ", $title);
            $title[0] = explode("{\"text\":\"", $title[0]);

            $text = file_get_contents('http://hipsterjesus.com/api?paras=3&type=hipster-centric&html=false');
            substr($text, 9, 1000);
            $text = explode("\",\"error", $text);
            $text[0] = explode("{\"text\":\"", $text[0]);

            Post::insert([
                'title' => ucfirst($title[0][1]),
                'body' => ucfirst($text[0][1].'.'),
                'slug' => str_random(3).'-'.str_random(5).'-'.str_random(3)
            ]);
        }
    }
}