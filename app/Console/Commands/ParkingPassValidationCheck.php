<?php

namespace App\Console\Commands;

use App\Repositories\Contracts\ParkingPassRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ParkingPassValidationCheck extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'pms:parking-pass-validation';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Release expired Parking Pass.';

    /**
     * @var ParkingPassRepository
     */
    private $parkingPassRepository;

    /**
     * Create a new command instance.
     *
     * @param ParkingPassRepository $parkingPassRepository
     * @return void
     */
    public function __construct(ParkingPassRepository $parkingPassRepository)
    {
        $this->parkingPassRepository = $parkingPassRepository;
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $parkingPasses = $this->parkingPassRepository->getModel()
            ->whereDate('endAt', '<', Carbon::now())
            ->whereNull('releasedAt')
            ->get();

        $affectedParkingPasses = [];
        foreach ($parkingPasses as $index => $parkingPass) {
            $this->parkingPassRepository->update($parkingPass, ['released' => true]);

            //only for output, sequence is important
            $affectedParkingPasses[$index]['parkingPassId'] = $parkingPass->id;
            $affectedParkingPasses[$index]['propertyId'] = $parkingPass->propertyId;
            $affectedParkingPasses[$index]['licensePlate'] = $parkingPass->licensePlate;
            $affectedParkingPasses[$index]['startAt'] = $parkingPass->startAt;
            $affectedParkingPasses[$index]['endAt'] = $parkingPass->endAt;
        }

        $this->table(['parkingPassId', 'propertyId', 'licensePlate', 'startAt', 'endAt'], $affectedParkingPasses);
    }
}
