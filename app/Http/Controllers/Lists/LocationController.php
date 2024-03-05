<?php

namespace App\Http\Controllers\Lists;

use App\Services\Lists\LocationService;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Requests\LocationRequest;

class LocationController extends Controller
{
    public function __construct(LocationService $location){
        $this->location = $location;
    }

    public function index(Request $request){
        $options = $request->option;
        switch($options){
            case 'regions':
                return $this->location->regions($request);
            break;
            case 'provinces':
                return $this->location->provinces($request);
            break;
            case 'municipalities':
                return $this->location->municipalities($request);
            break;
            case 'barangays':
                return $this->location->barangays($request);
            break;
            case 'list_province':
                return $this->location->list_province($request->code);
            break;
            case 'list_municipality':
                return $this->location->list_municipality($request->code);
            break;
            case 'list_barangay':
                return $this->location->list_barangay($request->code);
            break;
            default : 
            return inertia('Modules/Lists/Locations/Index');
        }
    }

    public function store(LocationRequest $request){
        switch($request->type){
            case 'region':
                $this->location->store_region($request);
            break;
            case 'province':
                $this->location->store_province($request);
            break;
        }
    }

    public function show($option){
        switch($option){
            case 'regions':
                return inertia('Modules/Lists/Locations/Region');
            break;
            case 'provinces':
                return inertia('Modules/Lists/Locations/Province',[
                    'regions' => $this->location->list_region()
                ]);
            break;
            case 'municipalities':
                return inertia('Modules/Lists/Locations/Municipality',[
                    'regions' => $this->location->list_region()
                ]);
            break;
            case 'barangays':
                return inertia('Modules/Lists/Locations/Barangay',[
                    'regions' => $this->location->list_region()
                ]);
            break;
        }
    }
}
