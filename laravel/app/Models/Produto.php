<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produto extends Model
{
    use HasFactory;

    protected $table = 'PRODUTO';
    protected $primaryKey = 'PRODUTO_ID';
    protected $fillable = ['PRODUTO_NOME', 'PRODUTO_DESC', 'PRODUTO_PRECO', 'PRODUTO_DESCONTO', 'PRODUTO_ATIVO'];
    public $incrementing = true;
    public $timestamps = false;
}
