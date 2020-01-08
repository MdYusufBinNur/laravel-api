<?php


namespace App\Services\Ticket;


interface Ticket
{
    /**
     * send a text to a numbers
     *
     * @param mixed $toMobileNumber
     * @param string $text
     * @param array $options
     * @return mixed
     */
    public function send($toMobileNumber, string $text, array $options = []);

    /**
     * send a text to a multiple numbers
     *
     * @param array $toMobileNumbers
     * @param string $text
     * @param array $options
     * @return mixed
     */
    public function bulkSend(array $toMobileNumbers, string $text, array $options = []);

    /**
     * get all the tickets
     * @param array $options
     * @return mixed
     */
    public function index(array $options = []);

    public function store(array $options = []);

    public function show();

    public function update();

    public function delete();
}
