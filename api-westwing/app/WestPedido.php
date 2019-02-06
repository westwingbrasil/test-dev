<?php
namespace App;

use App\Interfaces\PedidoInterface;
use App\Models\Pedido;

/**
 * Class WestPedido
 * @package App
 */
class WestPedido implements PedidoInterface
{
    /**
     * Display a listing of the pedidos.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAll()
    {
        return Pedido::all();
    }

    /**
     * Display the specified resource.
     *
     * @param  int $id
     * @return \Illuminate\Support\Collection
     */
    public function getById(int $id)
    {
        return Pedido::find($id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data
     * @return string
     */
    public function storeData(array $data)
    {
        $pedido = new Pedido();

        $pedido->titulo = strtoupper($data['titulo']);
        $pedido->descricao = $data['descricao'];
        $pedido->setCreatedAt(date('d/m/Y H:i:s'));

        if($pedido->save()) {
            return 'Pedido ' . $data['titulo'] . ' criado com sucesso!';
        } else {
            return 'Erro ao salvar pedido';
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
        $pedido = Pedido::find($data['id']);

        $pedido->titulo = strtoupper($data['titulo']);
        $pedido->descricao = $data['descricao'];
        $pedido->setUpdatedAt(date('d/m/Y H:i:s'));

        if($pedido->save()) {
            return 'Pedido atualizado com sucesso!';
        } else {
            return 'Erro ao atualizar pedido';
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
        if(Pedido::destroy($id)) {
            return 'Pedido deletado com sucesso!';
        } else {
            return 'Erro ao deletar pedido';
        }
    }
}