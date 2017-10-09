<?php

use App\Applink;
use Illuminate\Database\Seeder;

class ApplinksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(Applink::class,5)->create();
    }
}
