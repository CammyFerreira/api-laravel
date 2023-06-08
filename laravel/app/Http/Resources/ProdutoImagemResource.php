<?php 

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class ProdutoImagemResource extends JsonResource
{
    public function toArray($request)
    {
        return [
            'id_imagem' => $this->IMAGEM_ID,
            'imagem_ordem' => $this->IMAGEM_ORDEM,
            'produto_id' => $this->PRODUTO_ID,
            'imagem_url' => $this->IMAGEM_URL,
        ];
    }
}