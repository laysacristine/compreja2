namespace App\Http\Controllers;

use App\Models\ItemPedido;
use App\Models\Pedido;
use Illuminate\Http\Request;

class ItemPedidoController extends Controller
{
    // READ (Listar itens de um pedido específico)
    public function index(Pedido $pedido)
    {
        return response()->json($pedido->itens);
    }

    // CREATE (Adicionar item a um pedido)
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

    // READ (Ver um item específico)
    public function show(ItemPedido $itemPedido)
    {
        return response()->json($itemPedido);
    }

    // UPDATE (Atualizar quantidade ou preço do item)
    public function update(Request $request, ItemPedido $itemPedido)
    {
        $validated = $request->validate([
            'quantidade' => 'sometimes|integer',
            'preco' => 'sometimes|numeric',
        ]);

        $itemPedido->update($validated);
        return response()->json($itemPedido);
    }

    // DELETE (Remover item do pedido)
    public function destroy(ItemPedido $itemPedido)
    {
        $itemPedido->delete();
        return response()->json(null, 204);
    }
}