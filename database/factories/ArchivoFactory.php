<?php

namespace Database\Factories;

use App\Models\Archivo;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class ArchivoFactory extends Factory
{
    protected $model = Archivo::class;

    public function definition()
    {
        return [
			'file_name' => $this->faker->name,
			'file_extension' => $this->faker->name,
        ];
    }
}
