<?php

use Illuminate\Database\Seeder;
use App\Tag;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $tags = array(
            array('name' => 'Tutorials'),
            array('name' => 'News'),
            array('name' => 'PHP'),
            array('name' => 'Laravel')
        );
        
        Tag::insert($tags);
    }
}
