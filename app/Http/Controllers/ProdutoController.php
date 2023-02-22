<?php

namespace App\Http\Controllers;

use App\Http\Resources\ProdutoResource;
use App\Models\Produto;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class ProdutoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $produtos = Produto::all();

        return ProdutoResource::collection($produtos);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => 'required|string|min:3|max:60',
            'valor' => 'required|integer|min:2|max:999999',
            'loja_id' => 'required|integer|exists:lojas,id',
            'ativo' => 'required|boolean',
            'estoque' => 'required|integer|min:0|max:99999',
        ], [
            'nome.required' => 'O campo nome é obrigatório',
            'nome.string' => 'O campo nome deve ser uma string',
            'nome.min' => 'O campo nome deve ter no mínimo :min caracteres',
            'nome.max' => 'O campo nome deve ter no máximo :max caracteres',
            'valor.required' => 'O campo valor é obrigatório',
            'valor.integer' => 'O campo valor deve ser um número inteiro',
            'valor.min' => 'O campo valor deve ter no mínimo :min caracteres',
            'valor.max' => 'O campo valor deve ter no máximo :max caracteres',
            'loja_id.required' => 'O campo loja_id é obrigatório',
            'loja_id.integer' => 'O campo loja_id deve ser um número inteiro',
            'loja_id.exists' => 'A loja selecionada não existe',
            'ativo.required' => 'O campo ativo é obrigatório',
            'ativo.boolean' => 'O campo ativo deve ser um booleano',
            'estoque.required' => 'O campo estoque é obrigatório',
            'estoque.integer' => 'O campo estoque deve ser um número inteiro',
            'estoque.min' => 'O campo estoque deve ter no mínimo :min caracteres',
            'estoque.max' => 'O campo estoque deve ter no máximo :max caracteres',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $produto = Produto::create($request->all());

        return new ProdutoResource($produto);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['error' => 'Produto não encontrado'], Response::HTTP_NOT_FOUND);
        }

        return new ProdutoResource($produto);
    }
    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $produto = Produto::find($id);

        if (!$produto) {
            return response()->json(['error' => 'Produto não encontrado'], 404);
        }

        $validator = Validator::make($request->all(),[
            'nome' => 'required|min:3|max:60',
            'valor' => 'required|integer|min:2|max:999999',
            'loja_id' => 'required|exists:lojas,id',
            'ativo' => 'required|boolean',
            'estoque' => 'required|integer',
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.min' => 'O nome deve ter no mínimo 3 caracteres.',
            'nome.max' => 'O nome deve ter no máximo 60 caracteres.',
            'valor.required' => 'O campo valor é obrigatório.',
            'valor.integer' => 'O valor deve ser um número inteiro.',
            'valor.min' => 'O valor deve ser no mínimo 2.',
            'valor.max' => 'O valor deve ser no máximo 999999.',
            'loja_id.required' => 'O campo loja_id é obrigatório.',
            'loja_id.exists' => 'A loja informada não existe.',
            'ativo.required' => 'O campo ativo é obrigatório.',
            'ativo.boolean' => 'O campo ativo deve ser um valor booleano.',
            'estoque.required' => 'O campo estoque é obrigatório.',
            'estoque.integer' => 'O estoque deve ser um número inteiro.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }

        $produto->update($request->all());

        return response()->json(['message' => 'Produto atualizado com sucesso']);
    }

    /**
     * Remove the specified resource from storage.
     */
   
    public function destroy($id)
    {
        $produto = Produto::findOrFail($id);

        if($produto) {
            $produto->delete();
            
            return new ProdutoResource($produto);
        } else {
            return response()->json(['message' => 'Produto não encontrado'], 404);
        }
    }
}
