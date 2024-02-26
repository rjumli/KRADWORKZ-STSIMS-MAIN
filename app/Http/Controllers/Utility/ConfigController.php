<?php

namespace App\Http\Controllers\Utility;

use App\Services\Utility\ConfigService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\HandlesTransaction;

class ConfigController extends Controller
{
    use HandlesTransaction;

    public function __construct(ConfigService $config){
        $this->config = $config;
    }

    public function index(){
        return inertia('Modules/Utility/Config/Index',[
            'variables' => $this->config->variables(),
            'configuration' =>  $this->config->configuration()
        ]);
    }

    public function store(Request $request){
        $result = $this->handleTransaction(function () use ($request) {
            return $this->config->env($request);
        });

        return back()->with([
            'data' => $result['data'],
            'message' => $result['message'],
            'info' => $result['info'],
            'status' => $result['status'],
        ]);
    }
}
