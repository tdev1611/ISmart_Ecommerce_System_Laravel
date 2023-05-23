<?php

namespace Database\Factories;
use App\Models\Category_product;
use Illuminate\Support\Str;
use Illuminate\Support\Arr;

use Illuminate\Database\Eloquent\Factories\Factory;

class Category_productFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Category_product::class;
    public function definition()
    {
        $categories = ['Electronics', 'Clothing', 'Books', ];
        $name = $this->faker->sentence(5);
        $slug = Str::slug($name);
        return [
            //
            'name' => $name,
            'slug' =>$slug,
            'cat_parent' => Arr::random($categories),
            'status' => $this->faker->randomElement([1, 2]),
            'prioty' => $this->faker->randomElement([1, 2,3,4,5,6,7]),
            'created_at'=> $this->faker->date("Y-m-d H:i:s"),
            'updated_at'=> $this->faker->date("Y-m-d H:i:s")
        ];
    }
}
