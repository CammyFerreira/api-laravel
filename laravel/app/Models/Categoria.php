<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Produto;

class Categoria extends Model
{
    use HasFactory;

    protected $table = 'CATEGORIA';
    protected $primaryKey = 'CATEGORIA_ID';
    protected $fillable = ['CATEGORIA_NOME', 'CATEGORIA_DESC'];
    public $incrementing = true;
    public $timestamps = false;
}
