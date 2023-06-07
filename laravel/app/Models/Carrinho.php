<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;

class Carrinho extends Model
{
    use HasFactory;

    protected $table = 'CARRINHO_ITEM';
    //protected $primaryKey = 'USUARIO_ID';
    protected $fillable = ['USUARIO_ID', 'PRODUTO_ID', 'ITEM_QTD'];
    public $timestamps = false;

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'PRODUTO_ID')->where('PRODUTO_ATIVO', TRUE);
    }

    //função pra quando a tabela não possui primary key, apenas chaves estrangeiras
    protected function setKeysForSaveQuery($query) //seleciona as foreign keys
    {
        $query->where('USUARIO_ID', '=', $this->getAttribute('USUARIO_ID'))
            ->where('PRODUTO_ID', '=', $this->getAttribute('PRODUTO_ID'));

        return $query;
    }
}
