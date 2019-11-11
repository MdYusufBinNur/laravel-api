<?php


namespace App\Repositories;


use App\DbModels\PasswordReset;
use App\Events\PasswordReset\PasswordResetEvent;
use App\Repositories\Contracts\PasswordResetRepository;
use App\Repositories\Contracts\UserRepository;
use Ramsey\Uuid\Uuid;

class EloquentPasswordResetRepository extends EloquentBaseRepository implements PasswordResetRepository
{
    /**
     * @inheritDoc
     */
    public function save(array $data): \ArrayAccess
    {
        if (isset($data['emailOrPhone']))  {
            if (strpos($data['emailOrPhone'], '@') !== false) {
                $data['email'] = $data['emailOrPhone'];
            } else {
                $data['phone'] = $data['emailOrPhone'];
            }
            unset($data['emailOrPhone']);
        }

        $data['token'] = Uuid::uuid1();
        $passwordReset = parent::save($data);

        event(new PasswordResetEvent($passwordReset, []));

        return $passwordReset;
    }

    /**
     * @inheritDoc
     */
    public function resetPassword(array $data)
    {
        $passwordReset = $this->findOne($data['token']);

        if ($passwordReset instanceof PasswordReset) {
            $userRepository = app(UserRepository::class);
            $emailOrPhone = $passwordReset->email ?? $passwordReset->phone;
            $user = $userRepository->findUserByEmailPhone($emailOrPhone);

            $userRepository->updateUser($user, ['password' => $data['password']]);

            return $passwordReset->delete();
        }

        return false;
    }

}
