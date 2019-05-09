<?

namespace App\Repositories;

use App\Repositories\ClientRepository;
use App\Repositories\OrderRepository;

class TicketRepository //implements CreateRepositoryInterface
{
    /**
     * Create a ticket.
     *
     * @param array
     */
    public function create(\Illuminate\Http\Request $request): int
    {
        $client_id = (new ClientRepository)->create($request);

        $order_id = (new OrderRepository)->create($request);

        $ticket = App\Ticket::updateOrCreate(
            ['client_id' => $client_id, 'order_id' => $order_id],
            ['title' => $request->get('title'), 'content' => $request->get('content')]
        );

        return $ticket;
    }
}