<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pedido;

class PedidoItem extends Model
{
    use HasFactory;

    protected $table = 'PEDIDO_ITEM';
    protected $fillable = ['PEDIDO_ID', 'PRODUTO_ID', 'ITEM_QTD', 'ITEM_PRECO'];
    public $incrementing = true;
    public $timestamps = false;

    public function pedido()
    {
        return $this->belongsTo(Pedido::class);
    }
}
