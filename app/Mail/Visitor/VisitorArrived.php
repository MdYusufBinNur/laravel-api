<?php

namespace App\Mail\Visitor;

use App\DbModels\Visitor;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class VisitorArrived extends Mailable
{
    use SerializesModels;

    /**
     * @var Visitor
     */
    public $visitor;

    /**
     * Create a new message instance.
     *
     * @param Visitor $visitor
     * @return void
     */
    public function __construct(Visitor $visitor)
    {
        $this->visitor = $visitor;
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {

        $visitor= $this->visitor;
        $property = $visitor->property;
        $unit = $visitor->unit;

        return $this->subject("You've Got A Visitor!")->view('visitor.created.index')
            ->with(['visitor' => $visitor, 'property' => $property, 'unit' => $unit]);
    }
}
