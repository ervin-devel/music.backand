<?php

namespace App\Observers;

use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Hash;

class UserObserver
{
    protected User $user;

    public function updating(User $user): void
    {
        $this->setEmailVerifiedEmail($user);
        $this->changePassword($user);
    }

    private function changePassword(User $user)
    {

        if (!empty($user->password)) {
            $user->password = Hash::make($user->password);
        } else {
            $user->password = $user->getOriginal('password');
        }
    }

    private function setEmailVerifiedEmail(User $user)
    {
        if (!empty($user->email_verified_at) AND $user->getOriginal('email_verified_at')) {
            return;
        }

        if (empty($user->email_verified_at) AND $user->getOriginal('email_verified_at')) {
            $user->email_verified_at = null;
            return;
        }

        $user->email_verified_at = (!empty($user->email_verified_at) ? Carbon::now() : null);


    }
}
