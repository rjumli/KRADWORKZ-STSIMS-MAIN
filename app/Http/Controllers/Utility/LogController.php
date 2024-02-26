<?php

namespace App\Http\Controllers\Utility;

use App\Services\Utility\LogService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class LogController extends Controller
{
    public function __construct(LogService $log){
        $this->log = $log;
    }

    public function authentication(Request $request){
        $option = $request->option;
        switch($option){
            case 'lists':
               return $this->log->authentication($request);
            break;
            case 'statistics':
                return $this->log->statistics(\Auth::user()->id);
             break;
            default : 
            return inertia('Modules/Utility/Logs/Authentications/Index',[
                'statistics' => $this->log->statistics()
            ]);
        }
    }

    public function activity(Request $request){
        $option = $request->option;
        switch($option){
            case 'lists':
               return $this->log->activity($request);
            break;
            default : 
            return inertia('Modules/Utility/Logs/Activities/Index');
        }
    }
}
