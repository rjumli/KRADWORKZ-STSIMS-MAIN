<?php

namespace App\Services\Lists;

use App\Models\LocationRegion;
use App\Models\LocationProvince;
use App\Models\LocationMunicipality;
use App\Models\LocationBarangay;
use App\Http\Resources\Lists\LocationResource;

class LocationService
{
    public function regions($request){
        $data = LocationRegion::paginate($request->count);
        return LocationResource::collection($data);
    }

    public function provinces($request){
        $data = LocationProvince::with('region')->paginate($request->count);
        return LocationResource::collection($data);
    }

    public function municipalities($request){
        $data = LocationMunicipality::with('province')->paginate($request->count);
        return LocationResource::collection($data);
    }

    public function barangays($request){
        $data = LocationBarangay::with('municipality')->paginate($request->count);
        return LocationResource::collection($data);
    }

    public function store_region($request){
      
    }

    public function store_province($request){
     
    }

    public function store_municipality($request){
       
    }

    public function store_barangay($request){
       
    }

    public function list_region(){
        $data = LocationRegion::all()->map(function ($item) {
            return [
                'value' => $item->code,
                'name' => $item->region
            ];
        });
        return $data;
    }

    public function list_province($code){
        $data = LocationProvince::where('region_code',$code)->get()->map(function ($item) {
            return [
                'value' => $item->code,
                'name' => $item->name
            ];
        });
        return $data;
    }

    public function list_municipality($code){
        $data = LocationMunicipality::where('province_code',$code)->get()->map(function ($item) {
            return [
                'value' => $item->code,
                'name' => $item->name
            ];
        });
        return $data;
    }

    public function list_barangay($code){
        $data = LocationBarangay::where('municipality_code',$code)->get()->map(function ($item) {
            return [
                'value' => $item->code,
                'name' => $item->name
            ];
        });
        return $data;
    }
}
