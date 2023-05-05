<?php

namespace App\Http\Controllers;
use Exception;
use Illuminate\Http\Request;
use Validator;
use App\Models\Pessoa;

class PessoaController extends Controller
{
    protected $model;

    public function __construct()
    {
        $this->model = new Pessoa();
    }

 /**
 * @OA\Get(
 *     path="/api/pessoa/listar",
 *     tags={"Pessoas"},
 *     summary="Retorna todas as pessoas cadastradas",
 *     description="Retorna todas as pessoas cadastradas",
 *     @OA\Response(
 *         response=200,
 *         description="Lista de pessoas encontradas",
 *         @OA\JsonContent(
 *             type="array",
 *             @OA\Items(ref="#/components/schemas/Pessoa")
 *         )
 *     )
 * )
 * 
 * @OA\Get(
 *     path="/api/pessoa/listar/{id}",
 *     tags={"Pessoas"},
 *     summary="Retorna uma pessoa específica",
 *     description="Retorna uma pessoa específica pelo ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID da pessoa a ser buscada",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Pessoa encontrada",
 *         @OA\JsonContent(ref="#/components/schemas/Pessoa")
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Pessoa não encontrada"
 *     )
 * )
 */
    public function listar(Request $request, $id = 'all')
    {
        
        if (strtolower($id) != 'all') {
            $result = $this->model->find($id);
        } else {
            $result = $this->model->get();
        }
        
        return response()->json($result);
    }

/**
 * @OA\Post(
 *     path="/api/pessoa/cadastrar",
 *     tags={"Pessoas"},
 *     summary="Cadastra uma nova pessoa",
 *     description="Cadastra uma nova pessoa",
 *     @OA\RequestBody(
 *         required=true,
 *         description="Dados da pessoa a ser cadastrada",
 *         @OA\JsonContent(
 *             @OA\Property(property="nome", type="string", example="João da Silva"),
 *             @OA\Property(property="cpf_cnpj", type="string", example="12345678900"),
 *             @OA\Property(property="endereco", type="string", example="Rua A, 123"),
 *             @OA\Property(property="latitude", type="number", example="-23.550520"),
 *             @OA\Property(property="longitude", type="number", example="-46.633309"),
 *             @OA\Property(property="tipo", type="string", example="F"),
 *             @OA\Property(property="email", type="string", example="joao.silva@gmail.com"),
 *             @OA\Property(property="data_nascimento", type="string", format="date", example="1990-01-01")
 *         )
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Pessoa cadastrada com sucesso",
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Erro de validação dos campos",
 *     ),
 *     @OA\Response(
 *         response=500,
 *         description="Erro interno no servidor",
 *     )
 * )
 */

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

 /**
 * @OA\Put(
 *     path="/api/pessoa/editar/{id}",
 *     tags={"Pessoas"},
 *     summary="Edita uma pessoa",
 *     description="Edita uma pessoa existente pelo ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID da pessoa a ser editada",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\RequestBody(
 *         required=true,
 *         description="Dados da pessoa a ser editada",
 *         @OA\JsonContent(ref="#/components/schemas/Pessoa")
 *     ),
 *     @OA\Response(
 *         response=201,
 *         description="Pessoa editada com sucesso"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Pessoa não encontrada"
 *     ),
 *     @OA\Response(
 *         response=422,
 *         description="Erro de validação dos dados"
 *     )
 * )
 */
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

/**
 * @OA\Delete(
 *     path="/api/pessoa/deletar/{id}",
 *     tags={"Pessoas"},
 *     summary="Deleta uma pessoa",
 *     description="Deleta uma pessoa pelo ID",
 *     @OA\Parameter(
 *         name="id",
 *         in="path",
 *         description="ID da pessoa a ser deletada",
 *         required=true,
 *         @OA\Schema(
 *             type="integer"
 *         )
 *     ),
 *     @OA\Response(
 *         response=200,
 *         description="Pessoa deletada com sucesso"
 *     ),
 *     @OA\Response(
 *         response=404,
 *         description="Pessoa não encontrada"
 *     )
 * )
 */

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
