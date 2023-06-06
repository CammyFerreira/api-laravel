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
        // 1. Encontra os itens do carrinho do usuário, em que a quantidade não é zero
        $carrinho_itens = CarrinhoItem::where('USUARIO_ID', $user_id)->where('ITEM_QTD', '!=', 0)->get();

        // 2. Se não há itens no carrinho, retorna erro
        if ($carrinho_itens->isEmpty()) {
            return response()->json(['error' => 'Carrinho vazio'], 400);
        }

        // 3. Cria um novo pedido
        $pedido = Pedido::create([
            'USUARIO_ID' => $user_id,
            'STATUS_ID' => 1,
            'PEDIDO_DATA' => today()
        ]);

        // 4. Para cada item de carrinho, ele cria um item de pedido.
        foreach ($carrinho_itens as $carrinho_item) {
            PedidoItem::create([
                'PEDIDO_ID' => $pedido->PEDIDO_ID,
                'PRODUTO_ID' => $carrinho_item->PRODUTO_ID,
                'ITEM_QTD' => $carrinho_item->ITEM_QTD,
                'ITEM_PRECO' => $carrinho_item->produto->PRODUTO_PRECO
            ]);

            // Fechamento, retorna os itens a 0. 
            $carrinho_item->ITEM_QTD = 0;
            $carrinho_item->save();
        }

        // Retorna sucesso
        return response()->json(['message' => 'Pedido fechado com sucesso'], 204);
    }

    public function listarPedidos($user_id)
    {
        // Encontra os pedidos do usuário
        $pedidos = Pedido::where('USUARIO_ID', $user_id)->get();

        // Verifica se o usuário possui pedidos
        if ($pedidos->isEmpty()) {
            return response()->json(['message' => 'Usuário não possui pedidos'], 200);
        }

        // Cria um array para armazenar os detalhes dos pedidos
        $detalhes_pedidos = [];

        // Itera sobre cada pedido do usuário
        foreach ($pedidos as $pedido) {
            // Encontra os itens do pedido
            $itens_pedido = PedidoItem::where('PEDIDO_ID', $pedido->PEDIDO_ID)->get();

            // Cria um array para armazenar os detalhes dos itens do pedido
            $detalhes_itens_pedido = [];

            foreach ($itens_pedido as $item_pedido) {
                // Obtém o nome do produto associado ao item do pedido
                $nome_produto = $item_pedido->produto->PRODUTO_NOME;

                // Obtém a quantidade e o preço do item do pedido
                $quantidade = $item_pedido->ITEM_QTD;
                $preco = $item_pedido->ITEM_PRECO;

                // Adiciona os detalhes do item do pedido ao array
                $detalhes_itens_pedido[] = [
                    'nome_produto' => $nome_produto,
                    'quantidade' => $quantidade,
                    'preco' => $preco
                ];
            }

            // Adiciona os detalhes do pedido ao array
            $detalhes_pedidos[] = [
                'pedido_id' => $pedido->PEDIDO_ID,
                'data_pedido' => $pedido->PEDIDO_DATA,
                'status_id' => $pedido->STATUS_ID,
                'itens_pedido' => $detalhes_itens_pedido
            ];
        }

        // Retorna os detalhes dos pedidos do usuário
        return response()->json($detalhes_pedidos, 200);
    }
}
