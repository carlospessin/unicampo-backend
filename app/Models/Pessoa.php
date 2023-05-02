<?php

namespace App\Models;

use App\Utils\Rules;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Notifications\Notifiable;

class Pessoa extends Model
{
    use HasFactory, Notifiable, SoftDeletes;

    protected $table = "pessoas";

    protected $fillable = [
        'nome',
        'data_nascimento',
        'tipo',
        'cpf_cnpj',
        'email',
        'endereco',
        'latitude',
        'longitude'
    ];

    public function rules($form)
    {
        $tipo = $form['tipo'];
        $arrayValidacao = ['required', 'string', new Rules($tipo)];
        $validacao = (is_null($tipo)) ? $arrayValidacao[0] : $arrayValidacao;

        return [
            'nome'   => 'required|string|max:255',
            'data_nascimento' => 'required|date',
            'tipo'            => 'required|size:1|in:F,J',
            'cpf_cnpj'        => $validacao,
            'email'           => 'required|string|regex:/(.+)@(.+)\.(.+)/i',
            'endereco'        => 'required|string|max:255',
            'latitude'        => 'required|numeric',
            'longitude'       => 'required|numeric',
        ];
    }

    protected $hidden = [
        "created_at",
        "updated_at",
        "deleted_at"
    ];
}
