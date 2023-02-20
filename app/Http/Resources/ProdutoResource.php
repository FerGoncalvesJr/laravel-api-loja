<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class ProdutoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @return array<string, mixed>
     */
    public function toArray(Request $request): array
    {
        return [
            'id' => $this->id,
            'nome' => $this->nome,
            'valor' => $this->valor,
            'loja_id' => $this->loja_id,
            'ativo' => $this->ativo,
            'estoque' => $this->estoque,
            'data' => $this->created_at->format('d/m/Y'),
        ];
    }
}
