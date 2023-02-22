<?php

namespace App\Http\Controllers;

use App\Http\Resources\LojaResource;
use App\Models\Loja;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class LojaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $lojas = Loja::all();

        return LojaResource::collection($lojas);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'nome' => ['required', 'string', 'min:3', 'max:40'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:lojas,email'],
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.string' => 'O campo nome deve ser uma string.',
            'nome.min' => 'O campo nome deve ter no mínimo :min caracteres.',
            'nome.max' => 'O campo nome deve ter no máximo :max caracteres.',
            'email.required' => 'O campo email é obrigatório.',
            'email.string' => 'O campo email deve ser uma string.',
            'email.email' => 'O campo email deve ser um endereço de e-mail válido.',
            'email.max' => 'O campo email deve ter no máximo :max caracteres.',
            'email.unique' => 'O email informado já está em uso.',
        ]);
    
        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], 422);
        }
    
        $loja = Loja::create($request->all());
    
        return new LojaResource($loja);
    }    

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $loja = Loja::find($id);

        if (!$loja) {
            return response()->json(['error' => 'Loja não encontrada'], 404);
        }

        return new LojaResource($loja);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $loja = Loja::find($id);

        if (!$loja) {
            return response()->json(['error' => 'Loja não encontrada'], 404);
        }

        $validator = Validator::make($request->all(),[
            'nome' => "required|min:3|max:40|unique:lojas,nome,{$loja->id}",
            'email' => "required|email|unique:lojas,email,{$loja->id}",
        ], [
            'nome.required' => 'O campo nome é obrigatório.',
            'nome.min' => 'O campo nome deve ter no mínimo :min caracteres.',
            'nome.max' => 'O campo nome deve ter no máximo :max caracteres.',
            'nome.unique' => 'O nome informado já está em uso.',
            'email.required' => 'O campo e-mail é obrigatório.',
            'email.email' => 'O campo e-mail deve conter um endereço de e-mail válido.',
            'email.unique' => 'O e-mail informado já está em uso.',
        ]);

        if ($validator->fails()) {
            return response()->json(['errors' => $validator->errors()], Response::HTTP_BAD_REQUEST);
        }
        
        $loja->update($request->all());

        return new LojaResource($loja);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $loja = Loja::find($id);

        if (!$loja) {
            return response()->json(['message' => 'Loja não encontrada.'], 404);
        }
    
        if ($loja->produtos()->exists()) {
            return response()->json(['message' => 'Não é possível excluir a loja, pois existem produtos associados a ela.'], 422);
        }
    
        $loja->delete();
    
        return new LojaResource($loja);
    }
}
