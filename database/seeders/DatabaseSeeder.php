<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;
use App\Models\Category_product;
class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        Category_product::factory()->count(4)->create();
        Product::factory()->count(10)->create();
        // try {
        //     // do something here
        // } catch (\Exception $e) {
        //     error_log($e->getMessage());
        //     dd($e);
        //     var_dump($e);
        // }
    }
}
