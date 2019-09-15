<?php

namespace App\Console\Commands;

use App\DbModels\Fdi;
use App\Repositories\Contracts\FdiRepository;
use Carbon\Carbon;
use Illuminate\Console\Command;

class FdIValidationCheck extends Command
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
        $fdis = $this->fdiRepository->getModel()->whereDate('endDate', '<=', Carbon::now())
            ->where('permanent', '<>', 1)
            ->where('status', Fdi::STATUS_ACTIVE)
            ->get();

        foreach ($fdis as $fdi) {
            $this->fdiRepository->update($fdi, ['status' => Fdi::STATUS_EXPIRED]);
        }

    }
}
