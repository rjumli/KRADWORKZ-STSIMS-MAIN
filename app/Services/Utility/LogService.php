<?php

namespace App\Services\Utility;

use App\Models\Log;
use Spatie\Activitylog\Models\Activity;
use App\Http\Resources\Utility\LogActivityResource;
use App\Http\Resources\Utility\LogAuthenticationResource;

class LogService
{
    public static function authentication($request){
        $data = Log::lists($request->counts);
        return LogAuthenticationResource::collection($data);
    }

    public static function activity($request){
        $data = Activity::with('causer.profile')->orderBy('created_at','DESC')->paginate($request->count);
        return LogActivityResource::collection($data);
    }

    public function statistics($id = null){
        return [
            [
                'name' => 'Successful Login',
                'icon' => 'ri-checkbox-circle-fill',
                'color' => 'text-success',
                'total' => Log::when($id, function ($query, $id) {
                    $query->where('authenticatable_id',$id);
                })->where('login_successful',1)->count()
            ],
            [
                'name' => 'Suspicious Login',
                'icon' => 'ri-error-warning-fill',
                'color' => 'text-warning',
                'total' => Log::when($id, function ($query, $id) {
                    $query->where('authenticatable_id',$id);
                })->where('login_successful',1)->where('ip_address','!=','::1')->count()
            ],
            [
                'name' => 'Login Attempts',
                'icon' => 'ri-close-circle-fill',
                'color' => 'text-danger',
                'total' => Log::when($id, function ($query, $id) {
                    $query->where('authenticatable_id',$id);
                })->where('login_successful',0)->count(),
            ]
        ];
    }
}
