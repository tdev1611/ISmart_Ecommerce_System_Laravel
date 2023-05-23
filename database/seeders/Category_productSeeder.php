<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category_product;

class Category_productSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        Category_product::factory()->count(4)->create();


    }
}
