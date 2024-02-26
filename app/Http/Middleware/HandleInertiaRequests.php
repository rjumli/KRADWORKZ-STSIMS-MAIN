<?php

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Inertia\Middleware;
use App\Http\Resources\UserResource;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     * @param  \Illuminate\Http\Request  $request
     * @return string|null
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Defines the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function share(Request $request): array
    {
        return array_merge(parent::share($request), [
            'user' => (\Auth::check()) ? new UserResource(\Auth::user()) : '',
            'flash' => [
                'data' => session('data'),
                'message' => session('message'),
                'info' => session('info'),
                'status' => session('status'),
                'type' => session('type')
            ],
            // 'logins' => [
            //     'login_at' =>  (\Auth::check()) ? date('M d, Y g:i a', strtotime(\Auth::user()->previousLoginAt())) : '',
            //     'ip_address' =>  (\Auth::check()) ? \Auth::user()->previousLoginIp() : '',
            //     'password_changed_at' => (\Auth::check()) ?  date('M d, Y g:i a', strtotime(\Auth::user()->password_changed_at)) : ''
            // ]
        ]);
    }
}