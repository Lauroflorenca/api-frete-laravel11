<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Viagem;

/**
 * @OA\Schema(
 *     schema="Viagem",
 *     type="object",
 *     @OA\Property(property="id", type="integer", format="int64"),
 *     @OA\Property(property="titulo", type="string"),
 *     @OA\Property(property="descricao", type="string"),
 *     @OA\Property(property="motorista", type="string"),
 *     @OA\Property(property="placa", type="string"),
 *     @OA\Property(property="dt_origem", type="string", format="date-time"),
 *     @OA\Property(property="dt_destino", type="string", format="date-time"),
 *     @OA\Property(property="origem", type="string"),
 *     @OA\Property(property="destino", type="string"),
 *     @OA\Property(property="conteudo", type="string"),
 *     @OA\Property(property="ativo", type="boolean")
 * )
 */
class ViagemController extends Controller
{
    /**
     * @OA\Get(
     *     path="/api/viagens",
     *     tags={"Viagens"},
     *     summary="Listar todas as viagens",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de viagens"
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function index()
    {
        return response()->json(Viagem::where('ativo', true)->get());
    }

    /**
     * @OA\Get(
     *     path="/api/viagens/{id}",
     *     tags={"Viagens"},
     *     summary="Obter uma viagem por ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalhes da viagem"
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function show($id)
    {
        $viagem = Viagem::where('ativo', true)->findOrFail($id);
        return response()->json($viagem);
    }

    /**
     * @OA\Post(
     *     path="/api/viagens",
     *     tags={"Viagens"},
     *     summary="Criar uma nova viagem",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Viagem")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Viagem criada"
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function store(Request $request)
    {
        $viagem = Viagem::create($request->all());
        return response()->json($viagem, 201);
    }

    /**
     * @OA\Put(
     *     path="/api/viagens/{id}",
     *     tags={"Viagens"},
     *     summary="Atualizar uma viagem",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Viagem")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Viagem atualizada"
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function update(Request $request, $id)
    {
        $viagem = Viagem::where('ativo', true)->findOrFail($id);
        $viagem->update($request->all());
        return response()->json($viagem);
    }

    /**
     * @OA\Delete(
     *     path="/api/viagens/{id}",
     *     tags={"Viagens"},
     *     summary="Excluir uma viagem",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Viagem excluída"
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function destroy($id)
    {
        $viagem = Viagem::where('ativo', true)->findOrFail($id);
        $viagem->ativo = false;
        $viagem->save();
        return response()->json(['message' => 'Viagem excluída']);
    }
}
