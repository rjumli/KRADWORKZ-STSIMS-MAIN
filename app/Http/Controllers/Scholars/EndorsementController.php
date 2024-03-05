<?php

namespace App\Http\Controllers\Scholars;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EndorsementController extends Controller
{
    public function index(Request $request){
        switch($request->option){
            case 'lists':
                return $this->course->lists($request);
            break;
            case 'dropdowns':
                return $this->course->list_courses($request);
            break;
            default :
            return inertia('Modules/Scholars/Endorsements/Index');
        }
    }
}
