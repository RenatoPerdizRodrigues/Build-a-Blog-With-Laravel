<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $categories = array(
            array('name' => 'Learning'),
            array('name' => 'Reminder'),
            array('name' => 'Personal')
        );
        Category::insert($categories);        
    }
}
