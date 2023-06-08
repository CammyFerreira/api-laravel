<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use App\Models\Categoria;
use App\Models\ProdutoImagem;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'PRODUTO';
    protected $primaryKey = 'PRODUTO_ID';
    protected $fillable = ['PRODUTO_NOME', 'PRODUTO_DESC', 'PRODUTO_PRECO', 'PRODUTO_DESCONTO', 'PRODUTO_ATIVO', 'CATEGORIA_ID', 'IMAGEM_URL'];
    public $incrementing = true;
    public $timestamps = false;

    public function categoria()
    {
        return $this->belongsTo(Categoria::class);
    }

    public function pedidoItems()
    {
        return $this->hasMany(PedidoItem::class);
    }

    public function imagens()
    {
        return $this->hasMany(ProdutoImagem::class, 'PRODUTO_ID');
    }
}
