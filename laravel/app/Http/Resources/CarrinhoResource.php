<?php

namespace App\Http\Resources;

use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;

class CarrinhoResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request): array
    {
        if($this->PRODUTO_NOME && $this->PRODUTO_DESC && $this->PRODUTO_PRECO && $this->PRODUTO_DESCONTO) {
            return [
                'id_produto' => $this->PRODUTO_ID,
                'nome_produto' => $this->PRODUTO_NOME,
                'descricao_produto' => $this->PRODUTO_DESC,
                'preco_produto' => $this->PRODUTO_PRECO,
                'desconto_produto' => $this->PRODUTO_DESCONTO,
                'produto_ativo' => $this->PRODUTO_ATIVO
            ];
        } else {
            return [
                'id_produto' => $this->PRODUTO_ID,
                'item_qtd' => $this->ITEM_QTD,
            ];
        }
    }
}
