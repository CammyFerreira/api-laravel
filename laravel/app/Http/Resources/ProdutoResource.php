<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdutoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->PRODUTO_ID,
            'nome' => $this->PRODUTO_NOME,
            'descrição' => $this->PRODUTO_DESC,
            'preço' => $this->PRODUTO_PRECO,
            'desconto' => $this->PRODUTO_DESCONTO,
            'produto ativo' => $this->PRODUTO_ATIVO
        ];
    }
}
