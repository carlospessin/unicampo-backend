<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Validator;

class Controller extends BaseController
{
    use AuthorizesRequests, ValidatesRequests;

    protected $model;

    public function __construct($model)
    {
        $this->model = $model;
    }

    public function listar(Request $request, $id = 'all')
    {
        
        if (strtolower($id) != 'all') {
            $result = $this->model->find($id);
        } else {
            $result = $this->model->get();
        }
        
        return response()->json($result);
    }

    public function cadastrar(Request $request)
    {

        try {
            $form = $request->all();
            $form['data_nascimento'] = date('Y-m-d', strtotime($form['data_nascimento']));
            $validator = Validator::make($form, $this->model->rules($form));
        
            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }
        
            $this->model->create($form);
            return response()->json('Cadastrado com sucesso!', 201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
        
    }

    public function editar(Request $request, $id)
    {
        try {
            $form = $request->all();
            $form['data_nascimento'] = date('Y-m-d', strtotime($form['data_nascimento']));
            $validator = Validator::make($form, $this->model->rules($form));

            if ($validator->fails()) {
                return response()->json($validator->errors(), 422);
            }

            $this->model->updateOrCreate(['id' => $id], $form);
            return response()->json('Editado com sucesso!', 201);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }

    public function deletar($id)
    {
        try {
            $this->model->find($id)->delete();
            return response()->json('Deletado com sucesso!', 200);
        } catch (Exception $e) {
            return response()->json($e->getMessage(), $e->getCode());
        }
    }
}
