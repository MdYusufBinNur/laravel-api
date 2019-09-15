<?php

namespace App\Events\Fdi;

use App\DbModels\Fdi;
use Illuminate\Queue\SerializesModels;

class FdiUpdatedEvent
{
    use SerializesModels;

    /**
     * @var Fdi
     */
    public $fdi;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param Fdi $fdi
     * @param array $options
     * @return void
     */
    public function __construct(Fdi $fdi, array $options = [])
    {
        $this->fdi = $fdi;
        $this->options = $options;
    }
}
