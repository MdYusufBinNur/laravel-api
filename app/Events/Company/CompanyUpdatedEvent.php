<?php

namespace App\Events\Company;

use App\DbModels\Company;
use Illuminate\Queue\SerializesModels;

class CompanyUpdatedEvent
{
    use SerializesModels;

    /**
     * @var Company
     */
    public $company;

    /**
     * @var array
     */
    public $options;

    /**
     * Create a new event instance.
     *
     * @param Company $company
     * @param array $options
     */
    public function __construct(Company $company, array $options =[])
    {
        $this->company = $company;
        $this->options = $options;
    }
}
