<?php

namespace App\Http\Controllers;

use App\Models\Pessoa;
use Illuminate\Routing\Controller as BaseController;

class PessoaController extends Controller
{
    public function __construct(Pessoa $model)
    {
        parent::__construct($model);
    }

}
