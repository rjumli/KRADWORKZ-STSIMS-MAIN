<?php

namespace App\Providers;

use App\Actions\Fortify\CreateNewUser;
use App\Actions\Fortify\ResetUserPassword;
use App\Actions\Fortify\UpdateUserPassword;
use App\Actions\Fortify\UpdateUserProfileInformation;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Str;
use Laravel\Fortify\Fortify;
use Illuminate\Validation\ValidationException;
use App\Models\Log;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class FortifyServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Fortify::createUsersUsing(CreateNewUser::class);
        Fortify::updateUserProfileInformationUsing(UpdateUserProfileInformation::class);
        Fortify::updateUserPasswordsUsing(UpdateUserPassword::class);
        Fortify::resetUserPasswordsUsing(ResetUserPassword::class);

        RateLimiter::for('login', function (Request $request) {
            $throttleKey = Str::transliterate(Str::lower($request->input(Fortify::username())).'|'.$request->ip());
            $limit = Limit::perMinute(5)->by($throttleKey);
            
            if (RateLimiter::tooManyAttempts($throttleKey, 5)) {
                if (!Cache::has('logged_user_' . $throttleKey)) {
                    $user = User::where('email', $request->input(Fortify::username()))->select('id')->first();
                    if($user){
                        $log = Log::create([
                            'authenticatable_type' => 'App\Models\User',
                            'authenticatable_id' => $user->id,
                            'ip_address' => $request->ip(),
                            'user_agent' => $request->userAgent(),
                            'login_at' => now(),
                            'login_successful' => false,
                            'location' => config('authentication-log.notifications.new-device.location') ? optional(geoip()->getLocation($request->ip()))->toArray() : null,
                        ]);
                    }
                    Cache::put('logged_user_' . $throttleKey, true, now()->addMinutes(1)); // Or any desired duration
                }
                throw ValidationException::withMessages([
                    Fortify::username() => 'Too many login attempts. Please try again later.',
                ]);
    
            }
        
            return $limit;
        });

        RateLimiter::for('two-factor', function (Request $request) {
            return Limit::perMinute(5)->by($request->session()->get('login.id'));
        });
    }
}
