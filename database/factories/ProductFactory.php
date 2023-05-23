<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Product;
use App\Models\Category_product;
use Illuminate\Support\Str;

class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Product::class;

    public function definition()
    {
        $category = Category_product::factory()->create();
        $name = $this->faker->text(5);
        $slug = Str::slug($name);
        $code = 'UNI#' . Str::random(6);
        return [
            'name' => $name,
            'slug' => $slug,
            'code' =>  $code,
            'desc' => $this->faker->paragraph,
            'price' => $this->faker->numberBetween(1000, 1000000),
            'category_product_id' => function () {
                return '\App\Models\Category_product'::inRandomOrder()->first()->id;
            },
            'images' => $this->faker->imageUrl($width = 200, $height = 200),
            'detail' => $this->faker->paragraph,
            'status' => $this->faker->randomElement([1, 2]),
            'created_at' => $this->faker->date("Y-m-d H:i:s"),
            'updated_at' => $this->faker->date("Y-m-d H:i:s")
        ];
    }
}
