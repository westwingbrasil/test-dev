<?

namespace App\Repositories;

class TicketRepository //implements CreateRepositoryInterface
{
    /**
     * Create a ticket.
     *
     * @param array
     */
    public function create(ClientRepository $client, OrderRepository $order, \Illuminate\Http\Request $request): int
    {
        $client_id = $client->create(
            array('email' => $request->get('email_client')),
            array('name' => $request->get('name_client'))
        );

        $order_id = $order->create(
            array('code' => $request->get('code'), 'client_id' => $client_id),
            array()
        );

        $ticket = App\Ticket::updateOrCreate(
            ['client_id' => $client_id, 'order_id' => $order_id],
            ['title' => $request->get('title'), 'content' => $request->get('content')]
        );

        return $ticket;
    }
}