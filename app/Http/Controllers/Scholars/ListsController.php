<?php

namespace App\Http\Controllers\Scholars;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Traits\HandlesTransaction;
use App\Services\Scholar\SaveService;
use App\Services\Scholar\ViewService;

class ListsController extends Controller
{
    use HandlesTransaction;

    public function __construct(SaveService $save, ViewService $view){
        $this->save = $save;
        $this->view = $view;
    }

    public function index(Request $request){
        switch($request->option){
            case 'lists':
                return $this->view->lists($request);
            break;
            default :
            return inertia('Modules/Scholars/Lists/Index',[
                'dropdowns' => $this->view->dropdowns()
            ]);
        }
    }

    public function store(Request $request){
        $option = $request->option;
        switch($option){
            case 'preview':
                return $this->save->preview($request);
            break;
            case 'upload':
                return $this->save->upload($request);
            break;
        }
    }
}
