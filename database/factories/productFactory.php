<?php

namespace Database\Factories;

use App\Models\product;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class productFactory extends Factory
{
    protected $model = product::class;

    public function definition()
    {
        return [
            'category_id' => $this->faker->word(),
            'name' => $this->faker->name(),
            'price' => $this->faker->randomNumber(),
            'description' => $this->faker->text(),
            'quantity' => $this->faker->randomNumber(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
