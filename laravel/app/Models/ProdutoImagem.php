<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\RelationNotFoundException;
use App\Models\Produto;

class ProdutoImagem extends Model
{
    use HasFactory;

    protected $table = 'PRODUTO_IMAGEM';
    protected $primaryKey = 'IMAGEM_ID';
    protected $fillable = ['IMAGEM_ID', 'IMAGEM_ORDEM', 'PRODUTO_ID', 'IMAGEM_URL'];
    public $incrementing = true;
    public $timestamps = false;

    public function produto()
    {
        return $this->belongsTo(Produto::class);
    }
}