<?php

namespace App\Http\Controllers;

use App\Models\ItemPedido;
use App\Models\Pedido;
use Illuminate\Http\Request;

class ItemPedidoController extends Controller
{

    public function index(Pedido $pedido)
    {
        return response()->json($pedido->itens);
    }


    public function store(Request $request, Pedido $pedido)
    {
        $validated = $request->validate([
            'produto_id' => 'required|integer',
            'quantidade' => 'required|integer',
            'preco' => 'required|numeric',
        ]);

        $item = $pedido->itens()->create($validated);
        return response()->json($item, 201);
    }

    public function show(ItemPedido $itemPedido)
    {
        return response()->json($itemPedido);
    }

    public function update(Request $request, ItemPedido $itemPedido)
    {
        $validated = $request->validate([
            'quantidade' => 'sometimes|integer',
            'preco' => 'sometimes|numeric',
        ]);

        $itemPedido->update($validated);
        return response()->json($itemPedido);
    }

    public function destroy(ItemPedido $itemPedido)
    {
        $itemPedido->delete();
        return response()->json(null, 204);
    }
}