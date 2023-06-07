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
            'id_produto' => $this->PRODUTO_ID,
            'nome_produto' => $this->PRODUTO_NOME,
            'descricao_produto' => $this->PRODUTO_DESC,
            'preco_produto' => $this->PRODUTO_PRECO,
            'desconto_produto' => $this->PRODUTO_DESCONTO,
            'id_categoria' => $this->CATEGORIA_ID,
            'produto_ativo' => $this->PRODUTO_ATIVO
        ];
    }
}
