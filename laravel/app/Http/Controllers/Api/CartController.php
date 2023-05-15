<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarrinhoItem;

class CartController extends Controller
{
    public function listarCarrinho($usuarioId)
    {
        $carrinhoItens = CarrinhoItem::where('usuario_id', $usuarioId)->get();
        return response()->json($carrinhoItens);
    }

    /*
    Esse trecho de código é responsável por adicionar um item no carrinho. Ele verifica se o item já existe no carrinho através do método CarrinhoItem::where('USUARIO_ID', $user_id)->where('PRODUTO_ID', $produto_id)->first(), que retorna um objeto CarrinhoItem caso encontre o item no carrinho, ou null caso contrário.
    Se o item já existe no carrinho, o código adiciona a quantidade informada à quantidade existente do item através do trecho $carrinho_item->item_qtd += $item_qtd;, e salva o objeto no banco de dados com $carrinho_item->save();.
    Se o item não existe no carrinho, o código cria um novo objeto CarrinhoItem com os valores informados ($user_id, $produto_id e $item_qtd), e salva o objeto no banco de dados com $carrinho_item->save();.
    */

    public function adicionar(Request $request, $user_id)
    {
        $produto_id = $request->input('PRODUTO_ID');
        $item_qtd = $request->input('ITEM_QTD');
        $carrinho_item = CarrinhoItem::where('USUARIO_ID', $user_id)->where('PRODUTO_ID', $produto_id)->first();
        if ($carrinho_item) {
            $carrinho_item->ITEM_QTD += $item_qtd;
            $carrinho_item->save();
        } else {
            $carrinho_item = new CarrinhoItem;
            $carrinho_item->usuario_id = $user_id;
            $carrinho_item->produto_id = $produto_id;
            $carrinho_item->ITEM_QTD = $item_qtd;
            $carrinho_item->save();
        }
        return response()->json(['status' => 200, 'mensagem' => 'Produto adicionado ao carrinho'], 201);
    }

    public function atualizar($user_id, Request $request)
    {
        $item_qtd = $request->input('ITEM_QTD');
        $produto_id = $request->input('PRODUTO_ID');
        $carrinho_item = CarrinhoItem::where('USUARIO_ID', $user_id)->where('PRODUTO_ID', $produto_id)->first();
        if ($carrinho_item) {
            $carrinho_item->ITEM_QTD = $item_qtd;
            $carrinho_item->save();
            return response()->json(['status' => 200, 'mensagem' => 'Produto atualizado com sucesso'], 200);
        } else {
            return response()->json(['error' => 'Produto não encontrado no carrinho'], 404);
        }
    }

    public function deletar($user_id, $produto_id)
    {
        $item = CarrinhoItem::where('USUARIO_ID', $user_id)->where('PRODUTO_ID', $produto_id)->firstOrFail();

        $item->ITEM_QTD = 0;
        $item->save();

        return response()->json(['message' => 'Item removido do carrinho com sucesso!'], 200);
    }
}
