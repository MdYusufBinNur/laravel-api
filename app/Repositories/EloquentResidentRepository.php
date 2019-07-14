<?php


namespace App\Repositories;


use App\Repositories\Contracts\ResidentRepository;
use App\Repositories\Contracts\UserRepository;
use Illuminate\Support\Facades\DB;

class EloquentResidentRepository extends EloquentBaseRepository implements ResidentRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {

        DB::beginTransaction();

        $userRepository = app(UserRepository::class);
        $user = $userRepository->save(array_merge($data['users'], array('roles' => $data['roles'])));

        $data['userId'] = $user->id;

        $resident = parent::save($data);
        DB::commit();

        return $resident;

    }
}
