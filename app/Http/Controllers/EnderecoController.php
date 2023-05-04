<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;


class EnderecoController
{
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
