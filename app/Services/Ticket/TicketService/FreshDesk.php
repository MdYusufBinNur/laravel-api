<?php


namespace App\Services\Ticket\TicketService;


use App\Services\Ticket\Ticket;

class FreshDesk extends Base implements Ticket
{
    /**
     * @inheritDoc
     */
    public function index(array $options = [])
    {
        return $this->requestToAPI('GET', '/tickets', $options);
    }


    /**
     * @inheritDoc
     */
    public function store(array $data = [])
    {
        $ticket_payload = [
            'email' => 'test@example.com',
            'subject' => 'test',
            'description' => 'testing description content',
            'priority' => 2,
            'status' => 2,
//            'attachments[]' =>  curl_file_create("data/x.png", "image/png", "x.png")
        ];
        return $this->requestToAPI('POST', '/tickets',  $ticket_payload);
    }

    /**
     * @inheritDoc
     */
    public function show($id, array $options = [])
    {
        return $this->requestToAPI('GET', '/tickets/'.$id, $options);
    }

    /**
     * @inheritDoc
     */
    public function update($id, array $data)
    {
        $ticket_payload = [
            'email' => 'test@example.com',
            'subject' => 'test',
            'description' => 'testing description content',
            'priority' => 2,
            'status' => 2,
//            'attachments[]' =>  curl_file_create("data/x.png", "image/png", "x.png")
        ];
        return $this->requestToAPI('PUT', '/tickets/'.$id,  $ticket_payload);
    }

    /**
     * @inheritDoc
     */
    public function delete($id)
    {
        return $this->requestToAPI('DELETE', '/tickets'.$id);
    }

}
