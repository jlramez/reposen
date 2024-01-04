<?php

namespace Database\Factories;

use App\Models\Entidade;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class EntidadeFactory extends Factory
{
    protected $model = Entidade::class;

    public function definition()
    {
        return [
			'descripcion' => $this->faker->name,
        ];
    }
}
