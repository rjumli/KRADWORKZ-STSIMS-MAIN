<?php

namespace App\Services\Directory\School;

use App\Models\School;
use App\Models\SchoolCampus;
use App\Models\LocationRegion;
use App\Models\ListDropdown;
use App\Http\Resources\Directory\School\IndexResource;
use App\Http\Resources\Directory\School\ListsResource;

class ViewService
{
    public function schools($request){
        $data = School::with('class:id,name')
        ->with('campuses.grading:id,name')
        ->with('campuses.term:id,name','campuses.region','campuses.assigned','campuses.province','campuses.municipality')
        ->when($request->keyword, function ($query, $keyword) {
            $query->where('name', 'LIKE', '%'.$keyword.'%');
        })
        ->orderBy('id','DESC')
        ->paginate($request->count);
        
        return IndexResource::collection($data);
    }

    public function campuses($request){
        $data = SchoolCampus::with(['grading:id,name','term:id,name','region','province','municipality','assigned'])
        ->with('school:id,name,avatar,shortcut,combiner,class_id','school.class:id,name')
        ->when($request->keyword, function ($query, $keyword) {
            $query->whereHas('school',function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%'.$keyword.'%');
            })->orWhere(function ($query) use ($keyword) {
                $query->where('campus', 'LIKE', '%'.$keyword.'%');
            });
        })
        ->paginate($request->count);

        return ListsResource::collection($data);
    }

    public function regions(){
        $data = LocationRegion::all()->map(function ($item) {
            return [
                'value' => $item->code,
                'name' => $item->region
            ];
        });
        return $data;
    }

    public function dropdowns(){
        $terms = ListDropdown::where('classification','Term Type')->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'name' => $item->name
            ];
        });

        $gradings = ListDropdown::where('classification','Grading System')->get()->map(function ($item) {
            return [
                'value' => $item->id,
                'name' => $item->name
            ];
        });
        return [
            'gradings' => $gradings,
            'terms' => $terms
        ];
    }

    public function list_schools($request){
        $keyword = $request->keyword;
        if(!empty($keyword)){
            $data = SchoolCampus::with('school','term')
            ->whereHas('school',function ($query) use ($keyword) {
                $query->where('name', 'LIKE', '%'.$keyword.'%');
            })
            ->orWhere(function ($query) use ($keyword) {
                $query->where('campus',$keyword);
            })->get()->map(function ($item) {
                $campus = ($item->is_alone) ? '' : '-'.$item->campus;
                $name = $item->school->name.$campus;
                return [
                    'value' => $item->id,
                    'name' => $name
                ];
            });
        }else{
            $data = [];
        }

        return $data;
    }

}