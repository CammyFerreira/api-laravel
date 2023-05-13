<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\CarrinhoItem;
use App\Models\Pedido;
use App\Models\PedidoItem;
use App\Models\PedidoStatus;

class OrdersController extends Controller
{
    public function fecharPedido($user_id)
    {
        // 1. Encontra os itens do carrinho do usuário
        $carrinho_itens = CarrinhoItem::where('USUARIO_ID', $user_id)->get();

        // 2. Se não há itens no carrinho, retorna erro
        if ($carrinho_itens->isEmpty()) {
            return response()->json(['error' => 'Carrinho vazio'], 400);
        }

        // 3. Encontra o status do pedido na tabela PEDIDO_STATUS
        $status = PedidoStatus::where('status_desc', 'aberto')->first();

        // 4. Cria um novo pedido com o status encontrado
        $pedido = Pedido::create([
            'USUARIO_ID' => $user_id,
            'STATUS_ID' => $status->ID
        ]);

        // 5. Cria um novo item de pedido para cada item do carrinho e associa ao pedido criado anteriormente
        foreach ($carrinho_itens as $carrinho_item) {
            PedidoItem::create([
                'PEDIDO_ID' => $pedido->ID,
                'PRODUTO_ID' => $carrinho_item->PRODUTO_ID,
                'QUANTIDADE' => $carrinho_item->ITEM_QTD
            ]);
        }

        // 6. Deleta todos os itens do carrinho do usuário
        CarrinhoItem::where('USUARIO_ID', $user_id)->delete();

        // Retorna sucesso
        return response()->json(['message' => 'Pedido fechado com sucesso'], 200);
    }
}
