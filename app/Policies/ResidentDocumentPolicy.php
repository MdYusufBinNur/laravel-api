<?php

namespace App\Policies;

use App\DbModels\Resident;
use App\DbModels\ResidentDocument;
use App\DbModels\User;
use App\Repositories\Contracts\ResidentRepository;
use Illuminate\Auth\Access\HandlesAuthorization;

class ResidentDocumentPolicy
{
    use HandlesAuthorization;

    /**
     * @var ResidentRepository
     */
    private $residentRepository;

    /**
     * MessagePostPolicy constructor.
     * @param ResidentRepository $residentRepository
     */
    public function __construct(ResidentRepository $residentRepository)
    {
        $this->residentRepository = $residentRepository;
    }

    /**
     * Intercept checks
     *
     * @param User $currentUser
     * @return bool
     */
    public function before(User $currentUser)
    {
        if ($currentUser->isAdmin()) {
            return true;
        }
    }

    /**
     * Determine if a given user has permission to list
     *
     * @param User $currentUser
     * @param int $residentId
     * @return bool
     */
    public function list(User $currentUser, int $residentId)
    {
        $resident = $this->residentRepository->findOne($residentId);

        if ($resident instanceof Resident) {
            if ($currentUser->upToStandardStaffOfTheProperty($resident->propertyId)) {
                return true;
            }

            return $currentUser->id === $resident->userId;
        }

        return false;
    }

    /**
     * Determine if a given user has permission to store
     *
     * @param User $currentUser
     * @param int $residentId
     * @return bool
     */
    public function store(User $currentUser, int $residentId)
    {
        $resident = $this->residentRepository->findOne($residentId);

        if ($resident instanceof Resident) {
            if ($currentUser->upToStandardStaffOfTheProperty($resident->propertyId)) {
                return true;
            }

            return $currentUser->id === $resident->userId;
        }

        return false;

    }

    /**
     * Determine if a given user has permission to show
     *
     * @param User $currentUser
     * @param ResidentDocument $residentDocument
     * @return bool
     */
    public function show(User $currentUser,  ResidentDocument $residentDocument)
    {
        $resident= $residentDocument->resident;
        $propertyId = $resident->propertyId;

        if ($currentUser->upToStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        return $currentUser->id === $resident->userId;
    }

    /**
     * Determine if a given user can update
     *
     * @param User $currentUser
     * @param ResidentDocument $residentDocument
     * @return bool
     */
    public function update(User $currentUser, ResidentDocument $residentDocument)
    {
        $resident= $residentDocument->resident;
        $propertyId = $resident->propertyId;

        if ($currentUser->upToStandardStaffOfTheProperty($propertyId)) {
            return true;
        }
        
        return false;

        //return $currentUser->id === $resident->userId;
    }

    /**
     * Determine if a given user can delete
     *
     * @param User $currentUser
     * @param ResidentDocument $residentDocument
     * @return bool
     */
    public function destroy(User $currentUser, ResidentDocument $residentDocument)
    {
        $resident= $residentDocument->resident;
        $propertyId = $resident->propertyId;

        if ($currentUser->upToStandardStaffOfTheProperty($propertyId)) {
            return true;
        }

        return false;
        //return $currentUser->id === $resident->userId;
    }
}
