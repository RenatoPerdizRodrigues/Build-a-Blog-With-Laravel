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
        for ($i = 1; $i <= 10; $i++){
            $post = Post::create([
                'title' => simplexml_load_file('http://www.lipsum.com/feed/xml?amount=1&what=words&start=0')->lipsum,
                'body' => file_get_contents('http://loripsum.net/api/3/medium'),
                'slug' => str_random(3).'-'.str_random(5).'-'.str_random(3),
                'category_id' => rand(1, 3),
                'image' => $i.'.jpeg'
            ]);
            $post->save();
            
            $tag = array();
            //Populate tags table
            for ($i2 = 0; $i2 <= 3; $i2++){
                $which = rand(0, 4);
                if ($which != 0){
                    array_push($tag, $which);
                }
            }

            //Sync tag_post table
            $post->tags()->sync($tag, false);
        }
    }
}