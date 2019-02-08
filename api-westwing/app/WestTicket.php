<?php
namespace App;

use App\Interfaces\TicketInterface;
use App\Models\Pedido;
use App\Models\Ticket;

/**
 * Class WestTicket
 * @package App
 */
class WestTicket implements TicketInterface
{
    /**
     * Display a listing of the tickets.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAll()
    {
        return Ticket::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Support\Collection
     */
    public function getById(int $id)
    {
        return Ticket::find($id);
    }

    /**
     * Get data by filler
     * @param string $filler
     * @param string $value
     * @return mixed
     */
    public function getByFiller(string $filler, string $value)
    {
        return Ticket::where($filler, $value)->first();
    }

    /**
     * Get data by column order by
     * @param string $column
     * @param string $order
     * @param int $perPage
     * @return mixed
     */
    public function getForDataTable(string $column, string $order, int $perPage)
    {
        $tickets = Pedido::join('ticket', 'pedido.id', '=', 'ticket.pedido_id')
            ->join('cliente', 'cliente.id', '=', 'pedido.cliente_id')
            ->select('ticket.id AS numero_do_ticket',
                     'pedido.id AS numero_do_pedido',
                     'pedido.titulo AS titulo_do_pedido',
                     'cliente.email AS email_do_cliente',
                     'ticket.created_at AS data_criacao_ticket'
           )->orderBy('ticket.'.$column, $order)
            ->paginate($perPage);

        return $tickets;
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data
     * @return string
     */
    public function storeData(array $data)
    {
        $ticket = new Ticket();

        $ticket->pedido_id = $data['pedido_id'];
        $ticket->titulo = strtoupper($data['titulo']);
        $ticket->descricao = $data['descricao'];
        $ticket->setCreatedAt(date('Y-m-d H:i:s'));

        if($ticket->save()) {
            return 'Ticket ' . $data['titulo'] . ' criado com sucesso!';
        } else {
            return 'Erro ao salvar ticket';
        }
    }


    /**
     * Update the specified resource in storage.
     *
     * @param array $data
     * @return string
     */
    public function updateData(array $data)
    {
        $ticket = Ticket::find($data['id']);

        $ticket->titulo = strtoupper($data['titulo']);
        $ticket->descricao = $data['descricao'];
        $ticket->setUpdatedAt(date('Y-m-d H:i:s'));

        if($ticket->save()) {
            return 'Ticket atualizado com sucesso!';
        } else {
            return 'Erro ao atualizar ticket';
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return string
     */
    public function destroyById(int $id)
    {
        if(Ticket::destroy($id)) {
            return 'Ticket deletado com sucesso!';
        } else {
            return 'Erro ao deletar ticket';
        }
    }
}