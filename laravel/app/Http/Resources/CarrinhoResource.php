<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CarrinhoResource extends JsonResource
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
            //'id_usuario' => $this->USUARIO_ID,
            'produto_id' => $this->PRODUTO_ID,
            'item_qtd' => $this->ITEM_QTD
        ];
    }
}
