<?php

use Illuminate\Database\Seeder;
use App\Comment;

class CommentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++){
            //Decide comment quantity
            $howmany = rand(1, 5);
            $which = array(
                'Cool!',
                'Nice article.',
                'Thanks for your help!',
                'Interesting...',
                'I managed to make it work, thanks!',
                'Nice tutorial.',
                'Laravel is pretty interesting, huh.',
                'Can you help me with something?',
                'I finally got around to learning this!'
            );
            $comments = array();

            for ($h = 1; $h <= $howmany; $h++){
                $new = array(
                    'name' => 'User',
                    'email' => time() . '@gmail.com',
                    'comment' => $which[rand(0, 8)],
                    'approved' => true,
                    'post_id' => $i,
                    'created_at' => date('Y-m-d H:i:s')
                );

                if (!in_array($new['comment'], $comments)){
                    array_push($comments, $new);
                }
            }

            Comment::insert($comments);
        }
    }
}
