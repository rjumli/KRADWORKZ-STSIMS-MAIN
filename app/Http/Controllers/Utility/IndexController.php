<?php

namespace App\Http\Controllers\Utility;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Utility\LogService;
use App\Services\Utility\ConfigService;

class IndexController extends Controller
{
    public function __construct(ConfigService $config, LogService $log){
        $this->log = $log;
        $this->config = $config;
    }

    public function index($type){
        switch($type){
            case 'overview':
                return inertia('Modules/Utility/Pages/Overview');
            break;
            case 'users':
                return inertia('Modules/Utility/Pages/User');
            break;
            case 'roles':
                return inertia('Modules/Utility/Pages/Role');
            break;
            case 'menus':
                return inertia('Modules/Utility/Pages/Menu');
            break;
            case 'authentications':
                return inertia('Modules/Utility/Pages/Authentication',[
                    'statistics' => $this->log->statistics()
                ]);
            break;
            case 'activities':
                return inertia('Modules/Utility/Pages/Activity');
            break;
            case 'configurations':
                return inertia('Modules/Utility/Pages/System',[
                    'variables' => $this->config->variables(),
                    'configuration' =>  $this->config->configuration()
                ]);
            break;  
            case 'backup':
                return inertia('Modules/Utility/Pages/Backup');
            break;  
        }
    }
}
