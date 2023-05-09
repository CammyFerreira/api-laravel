<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Carrinho;
use App\Http\Resources\CarrinhoResource;

class CarrinhoController extends Controller
{

    public function inserir(Request $request)
    {
        $produto_id = $request->input('produto_id');
        $quantidade = $request->input('item_qtd');
    
        $carrinho = Carrinho::where('produto_id', $produto_id)->first();
    
        if (!$carrinho) {
                $carrinho = Carrinho::create([
                'produto_id' => $produto_id,
                'item_qtd' => $quantidade
            ]);
        } else {
            $carrinho->quantidade += $quantidade;
            $carrinho->save();
        }
    
        return response()->json([
            'status' => 200,
            'message' => 'Produto inserido no carrinho'
        ], 200);
    }
}
