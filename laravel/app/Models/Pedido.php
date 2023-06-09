<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pedido extends Model
{
    use HasFactory;

    protected $table = 'PEDIDO';
    protected $primaryKey = 'PEDIDO_ID';
    protected $fillable = ['PEDIDO_ID', 'USUARIO_ID', 'STATUS_ID', 'PEDIDO_DATA'];
    public $incrementing = true;
    public $timestamps = false;
 
}
