<?php

namespace App\Utils;

use Illuminate\Contracts\Validation\Rule;

class Rules implements Rule
{
    public $tipoPessoa;
    /**
     * Create a new rule instance.
     *
     * @return void
     */
    public function __construct($tipo)
    {
        $this->tipoPessoa = $tipo;

    }

    /**
     * Determine if the validation rule passes.
     *
     * @param  string  $attribute
     * @param  mixed  $value
     * @return bool
     */
    public function passes($attribute, $value)
    {
        if(!isset($this->tipoPessoa)) return false;
        $cpfCnpj = preg_replace('/\D/', '', $value);

        return (strtoupper($this->tipoPessoa) == 'F') ? $this->validateCpf($cpfCnpj) : $this->validateCnpj($cpfCnpj);
    }

    private function validateCpf($cpf) : bool
    {
        if(!is_string($cpf) || strlen($cpf) != 11) return false;
        $cpfArr = str_split($cpf);
        if(count(array_unique($cpfArr)) == 1) return false;

        $soma = 0;
        $resto = 0;

        for($i = 1; $i <= 9; $i++) {
            $soma = $soma + intval(substr($cpf, $i - 1, 1)) * (11 - $i);
        }

        $resto = ($soma * 10) % 11;
        if($resto == 10 || $resto == 11) $resto = 0;
        if($resto != intval(substr($cpf, 9, 1))) {
            return false;
        }
        $soma = 0;

        for($i = 1; $i <= 10; $i++) {
            $soma = $soma + intval(substr($cpf, $i - 1, 1)) * (12 - $i);
        }

        $resto = ($soma * 10) % 11;
        if($resto == 10 || $resto == 11) $resto = 0;
        if($resto != intval(substr($cpf, 10, 1))) {
            return false;
        }

        return true;
    }

    private function validateCnpj($cnpj) : bool
    {
        if(!is_string($cnpj) || strlen($cnpj) != 14) return false;
        $cnpjArr = str_split($cnpj);
        if(count(array_unique($cnpjArr)) == 1) return false;

        $soma = 0;
        $resto = 0;
        $cont = 5;

        for($i = 1; $i <= 12; $i++) {
            $soma = $soma + intval(substr($cnpj, $i - 1, 1)) * ($cont);
            $cont = $cont - 1;
            if($cont == 1) $cont = 9;
        }

        $resto = $soma % 11;
        ($resto < 2) ? $resto = 0 : $resto = 11 - $resto;
        if($resto != intval(substr($cnpj, 12, 1))) {
            return false;
        }
        
        $soma = 0;
        $cont = 6;

        for($i = 1; $i <= 13; $i++) {
            $soma = $soma + intval(substr($cnpj, $i - 1, 1)) * ($cont);
            $cont = $cont - 1;
            if($cont == 1) $cont = 9;
        }

        $resto = $soma % 11;
        ($resto < 2) ? $resto = 0 : $resto = 11 - $resto;
        if($resto != intval(substr($cnpj, 13, 1))) {
            return false;
        }

        return true;
    }

    /**
     * Get the validation error message.
     *
     * @return string
     */
    public function message()
    {
        return 'Formato do CPF/CNPJ inválido.';
    }
}
