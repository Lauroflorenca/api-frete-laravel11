<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

/**
 * @OA\Schema(
 *     schema="Checkpoint",
 *     type="object",
 *     @OA\Property(property="id", type="integer", format="int64"),
 *     @OA\Property(property="local", type="string"),
 *     @OA\Property(property="ordem", type="integer"),
 *     @OA\Property(property="chegada", type="string", format="date-time"),
 *     @OA\Property(property="observacao", type="string"),
 *     @OA\Property(property="viagem_id", type="integer"),
 *     @OA\Property(property="ativo", type="boolean")
 * )
 */
class CheckpointController extends Controller
{
     /**
     * @OA\Get(
     *     path="/api/checkpoints",
     *     tags={"Checkpoints"},
     *     summary="Listar todos os checkpoints",
     *     @OA\Response(
     *         response=200,
     *         description="Lista de checkpoints"
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function index()
    {
        return response()->json(Checkpoint::where('ativo', true)->get());
    }

     /**
     * @OA\Get(
     *     path="/api/checkpoints/{id}",
     *     tags={"Checkpoints"},
     *     summary="Obter um checkpoint por ID",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Detalhes do checkpoint"
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function show($id)
    {
        $checkpoint = Checkpoint::where('ativo', true)->findOrFail($id);
        return response()->json($checkpoint);
    }

     /**
     * @OA\Post(
     *     path="/api/checkpoints",
     *     tags={"Checkpoints"},
     *     summary="Criar um novo checkpoint",
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Checkpoint")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Checkpoint criado"
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function store(Request $request)
    {
        $checkpoint = Checkpoint::create($request->all());
        return response()->json($checkpoint, 201);
    }

     /**
     * @OA\Put(
     *     path="/api/checkpoints/{id}",
     *     tags={"Checkpoints"},
     *     summary="Atualizar um checkpoint",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/Checkpoint")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Checkpoint atualizado"
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function update(Request $request, $id)
    {
        $checkpoint = Checkpoint::where('ativo', true)->findOrFail($id);
        $checkpoint->update($request->all());
        return response()->json($checkpoint);
    }

     /**
     * @OA\Put(
     *     path="/api/checkpoints/{id}/chegada",
     *     tags={"Checkpoints"},
     *     summary="Atualizar o campo chegada de um checkpoint",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(
     *             @OA\Property(property="chegada", type="string", format="date-time")
     *         )
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Campo chegada atualizado"
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function updateChegada(Request $request, $id)
    {
        $checkpoint = Checkpoint::where('ativo', true)->findOrFail($id);
        $checkpoint->chegada = $request->input('chegada');
        $checkpoint->save();
        return response()->json($checkpoint);
    }

     /**
     * @OA\Delete(
     *     path="/api/checkpoints/{id}",
     *     tags={"Checkpoints"},
     *     summary="Excluir um checkpoint",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(type="integer")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Checkpoint excluído"
     *     ),
     *     security={{"bearerAuth": {}}}
     * )
     */
    public function destroy($id)
    {
        $checkpoint = Checkpoint::where('ativo', true)->findOrFail($id);
        $checkpoint->ativo = false;
        $checkpoint->save();
        return response()->json(['message' => 'Checkpoint excluído']);
    }
}
