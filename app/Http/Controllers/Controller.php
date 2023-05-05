<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;

 /**
 * @OA\Info(
 *     version="1.0",
 *     title="Documentação Api",
 *     description="Documentação da api para teste da vaga de Backend",
 *     @OA\Contact(
 *         name="Carlos Pessin",
 *         email="carlospessin@gmail.com"
 *     ),
 * )
 */

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

}
