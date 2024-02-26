<?php

namespace App\Http\Controllers\Directory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\HandlesTransaction;
use App\Http\Requests\CampusRequest;
use App\Services\Directory\School\ViewService;
use App\Services\Directory\School\SaveService;
use App\Services\Directory\School\UpdateService;

class SchoolController extends Controller
{
    use HandlesTransaction;

    public function __construct(ViewService $view, SaveService $save, UpdateService $update){
        $this->view = $view;
        $this->save = $save;
        $this->update = $update;
    }

    public function index(Request $request){
        switch($request->option){
            case 'schools':
                return $this->view->schools($request);
            break;
            case 'campuses':
                return $this->view->campuses($request);
            break;
            default :
            return inertia('Modules/Directory/Schools/Index');
        }
    }

    public function store(CampusRequest $request){
        $result = $this->handleTransaction(function () use ($request) {
            return $this->course->save($request);
        });

        return back()->with([
            'data' => $result['data'],
            'message' => $result['message'],
            'info' => $result['info'],
            'status' => $result['status'],
        ]);
    }
}
