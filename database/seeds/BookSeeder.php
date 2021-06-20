<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class BookSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         DB::table('books')->insert([
            'name' => 'One Last Stop',
            'content' => 'From the New York Times bestselling',
            'price' => 100000,
            'publisher'=>'NXB Giáo Dục',
            'penname'=>'Tác Giả',
        	]);
        factory(App\Book::class, 50)->create();
    }
}
