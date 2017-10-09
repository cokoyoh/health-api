<?php

use App\Category;
use Illuminate\Database\Seeder;

class CategoriesTableSeeder extends Seeder
{
    protected $fields = ["medicine", "fitness", 'diseases'];
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ($this->fields as $field){
            Category::create([
                "name" => $field
            ]);
        }
    }
}
