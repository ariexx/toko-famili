<?php

namespace Database\Factories;

use App\Models\UserDetail;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class UserDetailFactory extends Factory
{
    protected $model = UserDetail::class;

    public function definition()
    {
        return [
            'uuid' => $this->faker->uuid(),
            'user_uuid' => $this->faker->uuid(),
            'street_detail' => $this->faker->streetName(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
