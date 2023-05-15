<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;
use App\Models\User;

class CarrinhoItem extends Model
{
    use HasFactory;

    protected $table = 'CARRINHO_ITEM';
    protected $fillable = ['USUARIO_ID', 'PRODUTO_ID', 'ITEM_QTD'];
    public $timestamps = false;
    protected $primaryKey = 'USUARIO_ID';

    public function usuario()
    {
        return $this->belongsTo(User::class, 'USUARIO_ID');
    }

    public function produto()
    {
        return $this->belongsTo(Produto::class, 'PRODUTO_ID');
    }
}
