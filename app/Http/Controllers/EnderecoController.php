<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class EnderecoController
{
/**
 * @OA\Get(
 *     path="/api/endereco/{cep}",
 *     tags={"Endereço"},
 *     summary="Retorna o endereço a partir do CEP",
 *     description="Retorna o endereço formatado a partir do CEP informado",
 *     @OA\Parameter(
 *         name="cep",
 *         in="path",
 *         description="CEP para busca do endereço (somente números)",
 *         required=true,
 *         @OA\Schema(
 *             type="string",
 *             pattern="[0-9]{8}"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Endereço encontrado",
 *         @OA\JsonContent(
 *             type="object",
 *             @OA\Property(property="endereco", type="string", description="Endereço formatado a partir do CEP")
 *         )
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Endereço não encontrado"
 *     )
 * )
 */

    public function endereco(Request $request, $cep)
    {
        $urlApi = 'https://maps.googleapis.com/maps/api/geocode/json';
        $key = config('app.key_google_api');

        $url = $urlApi . "?components=postal_code:$cep|country:BR&key=$key";
        $response = Http::acceptJson()->get($url);

        $result = $response->collect('results')->first();
        $address = $result['formatted_address'];

        return response()->json($address);
    }
}
