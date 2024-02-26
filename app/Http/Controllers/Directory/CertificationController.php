<?php

namespace App\Http\Controllers\Directory;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class CertificationController extends Controller
{
    public function index(Request $request){
        switch($request->option){
            case 'lists':
                return $this->school->lists($request);
            break;
            default :
            return inertia('Modules/Directory/Certifications/Index');
        }
    }
}
