<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pedido;

class PedidoStatus extends Model
{
    use HasFactory;

    protected $table = 'PEDIDO_STATUS';
    protected $primaryKey = 'STATUS_ID';
    public $timestamps = false;

    protected $fillable = ['STATUS_DESC'];

    public function pedidos()
    {
        return $this->hasMany(Pedido::class, 'STATUS_ID');
    }
}
