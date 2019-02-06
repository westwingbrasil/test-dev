<?php
namespace App;

use App\Interfaces\TicketInterface;
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
        $ticket->setCreatedAt(date('d/m/Y H:i:s'));

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
        $ticket->setUpdatedAt(date('d/m/Y H:i:s'));

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