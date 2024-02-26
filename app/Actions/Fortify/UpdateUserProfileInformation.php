<?php

namespace App\Actions\Fortify;

use App\Models\User;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Laravel\Fortify\Contracts\UpdatesUserProfileInformation;

class UpdateUserProfileInformation implements UpdatesUserProfileInformation
{
    /**
     * Validate and update the given user's profile information.
     *
     * @param  array<string, string>  $input
     */
    public function update(User $user, array $input): void
    {
        Validator::make($input, [
            'username' => ['sometimes','required', 'string', 'max:255', Rule::unique('users')->ignore($user->id)],
            'email' => ['sometimes','required', 'email', 'max:255', Rule::unique('users')->ignore($user->id)],
            'firstname' => ['sometimes','required'],
            'middlename' => ['sometimes','required'],
            'lastname' => ['sometimes','required'],
            'suffix' => ['sometimes','nullable'],
            'mobile' => ['sometimes','required'],
            'gender' => ['sometimes','required'],
            'is_active' => ['sometimes','required'],
            'photo' => ['nullable', 'mimes:jpg,jpeg,png', 'max:1024'],
        ])->validateWithBag('updateProfileInformation');
        
        if (isset($input['photo'])) {
            $user->updateProfilePhoto($input['photo']);
        }

        if (isset($input['is_active'])) {
            $user->forceFill([
                'is_active' => $input['is_active'],
            ])->save();
        }

        if (isset($input['username']) && isset($input['username'])) {
            if ($input['email'] !== $user->email &&
                $user instanceof MustVerifyEmail) {
                $this->updateVerifiedUser($user, $input);
            } else {
                $user->forceFill([
                    'username' => $input['username'],
                    'email' => $input['email']
                ])->save();

                $user->profile->forceFill([
                    'firstname' => $input['firstname'],
                    'middlename' => $input['middlename'],
                    'lastname' => $input['lastname'],
                    'suffix' => $input['suffix'],
                    'mobile' => $input['mobile'],
                    'gender' => $input['gender'],
                ])->save();
            }
        }
    }

    /**
     * Update the given verified user's profile information.
     *
     * @param  array<string, string>  $input
     */
    protected function updateVerifiedUser(User $user, array $input): void
    {
        $user->forceFill([
            'username' => $input['username'],
            'email' => $input['email'],
            'email_verified_at' => null,
        ])->save();

        $user->sendEmailVerificationNotification();
    }
}
