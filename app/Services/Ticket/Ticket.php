<?php


namespace App\Services\Ticket;


interface Ticket
{
    /**
     * get all the tickets resources
     * @param array $options
     * @return mixed
     */
    public function index(array $options = []);


    /**
     * save a ticket resource
     *
     * @param array $options
     * @return \ArrayAccess
     */
    public function store(array $options = []);

    /**
     * find a ticket resource by id
     *
     * @param mixed $id
     * @return \ArrayAccess|null
     */
    public function show($id);

    /**
     * update a ticket resource
     *
     * @param \ArrayAccess $model
     * @param array $data
     * @return \ArrayAccess
     */
    public function update(\ArrayAccess $model, array $data);

    /**
     * delete a ticket resource by id
     *
     * @param $id
     * @return bool
     */
    public function delete($id);
}
