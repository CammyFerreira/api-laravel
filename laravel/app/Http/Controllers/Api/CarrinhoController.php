<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Produto;
use App\Models\Carrinho;
use App\Http\Resources\CarrinhoResource;

class CarrinhoController extends Controller
{
    public function exibir()
    {
        try {
            $usuarioId = auth()->user()->USUARIO_ID;
            $carrinho = Carrinho::where('USUARIO_ID', $usuarioId)
                ->join('PRODUTO', 'CARRINHO_ITEM.PRODUTO_ID', '=', 'PRODUTO.PRODUTO_ID')
                ->get();

            if (count($carrinho) > 0) {
                return response()->json([
                    'status'    => 200,
                    'mensagem'   => 'Carrinho retornado com sucesso!',
                    'data'      => [
                        'usuario'  => [
                            'id'    => $usuarioId
                        ],
                        'carrinho'      => CarrinhoResource::collection($carrinho)
                    ]
                ], 200);
            } else {
                return response()->json([
                    'status'    => 200,
                    'mensagem'   => 'O carrinho informado não existe',
                    'data'      => null
                ], 200);
            }
        } catch (\Throwable $err) {
            return $this->exceptions($err);
        }
    }

    public function adicionar(CarrinhoRequest $request)
    {
        try {
            $produtoId = round($request['produto']);
            $qtdItem   = round($request['quantidade']);

            $carrinho = Carrinho::where([
                'USUARIO_ID' => auth()->user()->USUARIO_ID,
                'PRODUTO_ID' => $produtoId
            ])->first(); //encontra um produto no carrinho.

            $produto = Produto::ativos()->where('PRODUTO_ID', $produtoId)->get();

            if($carrinho || count($produto) === 0) {
                return response()->json([
                    'status'    => 500,
                    'mensagem'   => 'Não foi possível inserir o produto no carrinho.',
                    'data'      => null
                ], 500);
            }

            $estoque = Produto::ativos()->where('PRODUTO_ID', $produtoId)->first()->estoque->PRODUTO_QTD;

            $carrinho = new Carrinho();

            $carrinho->USUARIO_ID   = auth()->user()->USUARIO_ID;
            $carrinho->PRODUTO_ID   = $produtoId;
            $carrinho->ITEM_QTD     = $qtdItem > $estoque ? $estoque : $qtdItem;

            $carrinho->save();

            return response()->json([
                'status'    => 200,
                'mensagem'   => 'Produto inserido no carrinho com sucesso!',
                'data'      => new CarrinhoResource($carrinho)
            ], 200);
        } catch (\Throwable $err) {
            return $this->exceptions($err);
        }
    }

    public function atualizar(CarrinhoRequest $request)
    {
        try {
            $produtoId = round($request['produto']);
            $qtdItem   = round($request['quantidade']);

            $carrinho = Carrinho::where([
                'USUARIO_ID' => auth()->user()->USUARIO_ID,
                'PRODUTO_ID' => $produtoId
            ])->first();

            if ($carrinho) { //se tiver carrinho
                $estoque = Produto::ativos()->where('PRODUTO_ID', $produtoId)->first()->estoque->PRODUTO_QTD;

                if ($qtdItem > 0) //se o estoque for maior que a soma
                    $carrinho->update(['ITEM_QTD' => $qtdItem > $estoque ? $estoque : $qtdItem]);
                else
                    $carrinho->update(['ITEM_QTD' => 0]);

                return response()->json([
                    'status'    => 200,
                    'mensagem'   => 'Produto atualizado no carrinho com sucesso!',
                    'data'      => new CarrinhoResource($cart)
                ], 200);
            } else {
                return response()->json([
                    'status'    => 200,
                    'mensagem'   => 'O produto informado não existe no carrinho',
                    'data'      => null
                ], 200);
            }
        } catch (\Throwable $err) {
            return $this->exceptions($err);
        }
    }
}
