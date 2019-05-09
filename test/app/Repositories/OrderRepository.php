<?

namespace App\Repositories;

use App\Order;

class OrderRepository implements CreateRepositoryInterface
{

    /**
     * Create a ticket.
     *
     * @param array
     */
    public function create(\Illuminate\Http\Request $request): int
    {
        $order = Order::firstOrCreate(['code' => $request->get('code'), 'client_id' => $request->get('client_id')]);

        return $order->id;
    }
}