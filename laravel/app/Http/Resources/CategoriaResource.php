<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class CategoriaResource extends JsonResource
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
            'id_categoria' => $this->CATEGORIA_ID,
            'nome_categoria' => $this->CATEGORIA_NOME,
            'descricao_categoria' => $this->CATEGORIA_DESC
        ];
    }
}
