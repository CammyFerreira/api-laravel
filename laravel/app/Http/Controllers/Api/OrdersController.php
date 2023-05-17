<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarrinhoItem;
use App\Models\Pedido;
use App\Models\PedidoItem;


class OrdersController extends Controller
{
    public function fecharPedido($user_id)
    {
        // 1. Encontra os itens do carrinho do usuário
        $carrinho_itens = CarrinhoItem::where('USUARIO_ID', $user_id)->where('ITEM_QTD', '!=', 0)->get();

        // 2. Se não há itens no carrinho, retorna erro
        if ($carrinho_itens->isEmpty()) {
            return response()->json(['error' => 'Carrinho vazio'], 400);
        }

        // 4. Cria um novo pedido com o status encontrado
        $pedido = Pedido::create([
            'USUARIO_ID' => $user_id,
            'STATUS_ID' => 1,
            'PEDIDO_DATA' => today()
        ]);

        // 5. Cria um novo item de pedido para cada item do carrinho e associa ao pedido criado anteriormente
        foreach ($carrinho_itens as $carrinho_item) {
            PedidoItem::create([
                'PEDIDO_ID' => $pedido->PEDIDO_ID,
                'PRODUTO_ID' => $carrinho_item->PRODUTO_ID,
                'ITEM_QTD' => $carrinho_item->ITEM_QTD,
                'ITEM_PRECO' => $carrinho_item->produto->PRODUTO_PRECO
            ]);

            // Define a quantidade do item do carrinho como zero
            $carrinho_item->ITEM_QTD = 0;
            $carrinho_item->save();
        }

        // Retorna sucesso
        return response()->json(['message' => 'Pedido fechado com sucesso'], 200);
    }
}
