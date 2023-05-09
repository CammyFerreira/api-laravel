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
    protected $fillable = ['PRODUTO_ID', 'ITEM_QTD'];
    public $incrementing = true;
    public $timestamps = false;

    public function produto()
    {
        return $this->belongsTo('App\Models\Produto');
    }
}
