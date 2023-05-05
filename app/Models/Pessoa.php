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

    /**
 * @OA\Schema(
 *     schema="Pessoa",
 *     required={"id", "nome", "cpf_cnpj", "endereco", "latitude", "longitude", "tipo", "email", "data_nascimento"},
 *     @OA\Property(
 *         property="nome",
 *         type="string",
 *         description="Nome do registro."
 *     ),
 *     @OA\Property(
 *         property="data_nascimento",
 *         type="string",
 *         format="date",
 *         description="Data de nascimento do registro."
 *     ),
 *     @OA\Property(
 *         property="tipo",
 *         type="string",
 *         enum={"F", "J"},
 *         description="Tipo do registro. Pode ser 'F' para pessoa física ou 'J' para pessoa jurídica."
 *     ),
 *     @OA\Property(
 *         property="cpf_cnpj",
 *         type="string",
 *         description="CPF ou CNPJ do registro. Deve seguir o formato correto para o tipo escolhido."
 *     ),
 *     @OA\Property(
 *         property="email",
 *         type="string",
 *         format="email",
 *         description="Endereço de e-mail do registro."
 *     ),
 *     @OA\Property(
 *         property="endereco",
 *         type="string",
 *         description="Endereço do registro."
 *     ),
 *     @OA\Property(
 *         property="latitude",
 *         type="number",
 *         format="float",
 *         description="Latitude do registro."
 *     ),
 *      @OA\Property(
 *          property="longitude",
 *          type="number",
 *          format="float",
 *          description="Longitude do registro."
 *     )
 * )
*/

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
