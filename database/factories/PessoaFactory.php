<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Pessoa>
 */
class PessoaFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        $nome = $this->faker->firstName() . ' ' . $this->faker->lastName();
        $tipo = $this->faker->randomElement(['F', 'J']);
        $cpfCnpj = $tipo == 'F' ? $this->faker->cpf() : $this->faker->cnpj();

        return [
            "nome" => $nome,
            "data_nascimento" => $this->faker->date(),
            "tipo" => $tipo,
            "cpf_cnpj" => $cpfCnpj,
            "email" => $this->faker->safeEmail(),
            "endereco" => $this->faker->address(),
            "latitude" => $this->faker->latitude(),
            "longitude" => $this->faker->longitude(),
        ];
    }
}
