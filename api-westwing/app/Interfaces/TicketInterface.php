<?php
namespace App\Interfaces;

/**
 * Interface TicketInterface
 * @package App\Interface
 */
interface TicketInterface
{
    /**
     * Get all data from model
     * @param mixed
     * @return mixed
     */
    public function getAll();

    /**
     * Get data by Id
     * @param int $id
     * @return mixed
     */
    public function getById(int $id);

    /**
     * Insert a new recover to model
     * @param array $data
     * @return mixed
     */
    public function storeData(array $data);

    /**
     * Update a data from model by Id
     * @param array $data
     * @return mixed
     */
    public function updateData(array $data);

    /**
     * Destroy data from model by Id
     * @param  int $id
     * @return mixed
     */
    public function destroyById(int $id);
}