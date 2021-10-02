<?php

namespace Database\Factories;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Product::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
          $category_id = Category::pluck('id')->all();
        return [
            'name'=> $this->faker->word(),
            'category_id' => $this->faker->randomElement($category_id),
             'description' => $this->faker->paragraph,
             'price'=> rand(1000,9999)
        ];
    
    }
}
