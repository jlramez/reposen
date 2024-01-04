<?php

namespace Database\Factories;

use App\Models\Sentencia;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class SentenciaFactory extends Factory
{
    protected $model = Sentencia::class;

    public function definition()
    {
        return [
			'nombre' => $this->faker->name,
			'archivos_id' => $this->faker->name,
			'users_id' => $this->faker->name,
        ];
    }
}
