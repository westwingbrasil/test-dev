<?php
namespace App;

use App\Interfaces\ClienteInterface;
use App\Models\Cliente;

/**
 * Class WestCliente
 * @package App
 */
class WestCliente implements ClienteInterface
{
    /**
     * Display a listing of the clients.
     *
     * @return \Illuminate\Support\Collection
     */
    public function getAll()
    {
        return Cliente::all();
    }

    /**
     * Display the specified resource by Id.
     *
     * @param  int $id
     * @return \Illuminate\Support\Collection
     */
    public function getById(int $id)
    {
        return Cliente::find($id);
    }

    /**
     * Display the specified resource by email.
     *
     * @param  string $email
     * @return \Illuminate\Support\Collection
     */
    public function getByEmail(string $email)
    {
        return Cliente::where('email', $email)->first();
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
        return Cliente::orderBy($column, $order)->paginate($perPage);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param array $data
     * @return string
     */
    public function storeData(array $data)
    {
        /** Check if email exist */
        if(!Cliente::where('email', $data['email'])->first()) {
            $client = new Cliente();

            $client->nome = strtoupper($data['nome']);
            $client->email = $data['email'];
            $client->setCreatedAt(date('Y-m-d H:i:s'));

            if($client->save()) {
                return 'Cliente ' . $data['nome'] . ' criado com sucesso!';
            } else {
                return 'Erro ao salvar cliente';
            }

        } else {
            return 'Erro: Email inserido já existente! Corrija e tente novamente!';
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
        $client = Cliente::find($data['id']);

        $client->nome = strtoupper($data['nome']);
        $client->setUpdatedAt(date('Y-m-d H:i:s'));

        if($client->save()) {
            return 'Cliente atualizado com sucesso!';
        } else {
            return 'Erro ao atualizar cliente';
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
        if(Cliente::destroy($id)) {
            return 'Cliente deletado com sucesso!';
        } else {
            return 'Erro ao deletar cliente';
        }
    }
}