<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use Illuminate\Http\Request;

class PedidoController extends Controller
{
    
    public function index()
    {
        return response()->json(Pedido::with('itens')->get());
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'user_id' => 'required|integer',
            'data_pedido' => 'required|date',
            'status' => 'required|string',
        ]);

        $pedido = Pedido::create($validated);
        return response()->json($pedido, 201);
    }


    public function show(Pedido $pedido)
    {
        return response()->json($pedido->load('itens'));
    }


    public function update(Request $request, Pedido $pedido)
    {
        $validated = $request->validate([
            'user_id' => 'sometimes|integer',
            'data_pedido' => 'sometimes|date',
            'status' => 'sometimes|string',
        ]);

        $pedido->update($validated);
        return response()->json($pedido);
    }

    public function destroy(Pedido $pedido)
    {
        $pedido->delete();
        return response()->json(null, 204);
    }
}