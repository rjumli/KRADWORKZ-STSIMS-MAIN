<?php

namespace App\Http\Controllers\Utility;

use App\Models\Log;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\UserRequest;
use App\Services\Utility\UserService;
use App\Traits\HandlesTransaction;
use App\Http\Resources\Utility\LogAuthenticationResource;

class UserController extends Controller
{
    use HandlesTransaction;

    public function __construct(UserService $user){
        $this->user = $user;
    }

    public function index(Request $request){
        $options = $request->option;
        switch($options){
            case 'lists':
                return $this->user->lists($request);
            break;
            case 'logs':
               return $this->logs($request);
            break;
            default : 
            return inertia('Modules/Utility/Users/Index');
        }
    }

    public function store(UserRequest $request){
        $result = $this->handleTransaction(function () use ($request) {
            return $this->user->save($request);
        });

        return back()->with([
            'data' => $result['data'],
            'message' => $result['message'],
            'info' => $result['info'],
            'status' => $result['status'],
        ]);
    }

    public function update(Request $request){
        $result = $this->handleTransaction(function () use ($request) {
            return $this->user->update($request);
        });

        return back()->with([
            'data' => $result['data'],
            'message' => $result['message'],
            'info' => $result['info'],
            'status' => $result['status'],
        ]);
    }

    public function logs($request){
        $id = \Auth::user()->id;
        $logs = Log::where('authenticatable_type', 'App\Models\User')
        ->where('authenticatable_id', $id)
        ->orderBy('id','DESC')
        ->paginate($request->count);
        return LogAuthenticationResource::collection($logs);
    }
}
