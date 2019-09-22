<?php

namespace App\Console\Commands;

use App\DbModels\Fdi;
use App\Repositories\Contracts\FdiRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FdiValidationCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pms:fdi-validation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Check and update expired FDI';

    /**
     * @var FdiRepository
     */
    private $fdiRepository;

    /**
     * Create a new command instance.
     *
     * @param FdiRepository $fdiRepository
     * @return void
     */
    public function __construct(FdiRepository $fdiRepository)
    {
        $this->fdiRepository = $fdiRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $fdis = $this->fdiRepository->getModel()->whereDate('endDate', '<', Carbon::now())
            ->where('permanent', '<>', 1)
            ->where('status', Fdi::STATUS_ACTIVE)
            ->get();

        $affectedFdis = [];
        foreach ($fdis as $index => $fdi) {
            $this->fdiRepository->update($fdi, ['status' => Fdi::STATUS_EXPIRED]);

            //only for output, sequence is important
            $affectedFdis[$index]['fdiId'] = $fdi->id;
            $affectedFdis[$index]['propertyId'] = $fdi->propertyId;
            $affectedFdis[$index]['type'] = $fdi->type;
            $affectedFdis[$index]['startDate'] = $fdi->startDate;
            $affectedFdis[$index]['endDate'] = $fdi->endDate;
        }

        $this->table(['fdiId', 'propertyId', 'type', 'startDate', 'endDate'], $affectedFdis);
    }
}
