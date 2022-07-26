<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Modules\Role\Models\Role;
class RolefactoryFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    protected $model = Role::class;
    public function definition()
    {
        return [
            "name" => $this->faker->name,

        ];
    }
}
