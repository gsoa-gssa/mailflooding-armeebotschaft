<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;
use App\Models\Faction;
use App\Models\Canton;
use App\Models\Politician;

class PoliticianFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Politician::class;

    /**
     * Define the model's default state.
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'email' => $this->faker->safeEmail(),
            'image' => $this->faker->word(),
            'canton_id' => Canton::factory(),
            'faction_id' => Faction::factory(),
            'council_id' => Faction::factory(),
        ];
    }
}
