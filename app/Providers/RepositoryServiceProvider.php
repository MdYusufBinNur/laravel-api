<?php

namespace App\Providers;

use App\DbModels\Company;
use App\DbModels\Property;
use App\DbModels\Resident;
use App\DbModels\Role;
use App\DbModels\Tower;
use App\DbModels\Unit;
use App\Repositories\Contracts\CompanyRepository;
use App\Repositories\Contracts\EloquentUnitRepository;
use App\Repositories\Contracts\PropertyRepository;
use App\Repositories\Contracts\ResidentRepository;
use App\Repositories\Contracts\RoleRepository;
use App\Repositories\Contracts\TowerRepository;
use App\Repositories\Contracts\UnitRepository;
use App\Repositories\EloquentCompanyRepository;
use App\Repositories\EloquentPropertyRepository;
use App\Repositories\EloquentResidentRepository;
use App\Repositories\EloquentRoleRepository;
use App\Repositories\EloquentTowerRepository;
use Illuminate\Support\ServiceProvider;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Bootstrap the application services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }

    /**
     * Register the application services.
     *
     * @return void
     */
    public function register()
    {
        // bind CompanyRepository
        $this->app->bind(CompanyRepository::class, function() {
            return new EloquentCompanyRepository(new Company());
        });

        // bind PropertyRepository
        $this->app->bind(PropertyRepository::class, function() {
            return new EloquentPropertyRepository(new Property());
        });

        // bind TowerRepository
        $this->app->bind(TowerRepository::class, function() {
            return new EloquentTowerRepository(new Tower());
        });

    }
}
