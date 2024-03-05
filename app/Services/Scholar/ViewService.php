<?php

namespace App\Services\Scholar;

use App\Models\Scholar;
use App\Models\ListStatus;
use App\Models\ListProgram;
use App\Models\ListCourse;
use App\Models\ListDropdown;
use App\Models\LocationRegion;
use App\Http\Resources\Scholar\IndexResource;

class ViewService
{
    public function lists($request){
        $keyword = $request->keyword;
        $filter = (!empty(json_decode($request->subfilters))) ? json_decode($request->subfilters) : NULL;

        $data = IndexResource::collection(
            Scholar::with('profile')->with('info')
            ->with('address.region','address.province','address.municipality','address.barangay')
            ->with('program:id,name','subprogram:id,name','category:id,name','status:id,name,type,color,others')
            ->with('education.school.school','education.course','education.level')
            ->whereHas('profile',function ($query) use ($keyword) {
                $query->when($keyword, function ($query, $keyword) {
                    $query->where(\DB::raw('concat(firstname," ",lastname)'), 'LIKE', '%'.$keyword.'%')
                    ->where(\DB::raw('concat(lastname," ",firstname)'), 'LIKE', '%'.$keyword.'%')
                    ->orWhere('spas_id','LIKE','%'.$keyword.'%');
                });
            })
            ->whereHas('address',function ($query) use ($filter) {
                if(!empty($filter)){
                    ($filter->region_code != null) ? $query->where('region_code',$filter->region_code) : '';
                    ($filter->province_code != null) ? $query->where('province_code',$filter->province_code) : '';
                    ($filter->municipality_code != null) ? $query->where('municipality_code',$filter->municipality_code) : '';
                    ($filter->barangay_code != null) ? $query->where('barangay_code',$filter->barangay_code) : '';
                }
            })
            ->whereHas('education',function ($query) use ($filter) {
                if(!empty($filter)){
                    ($filter->school_id != null) ? $query->where('school_id',$filter->school_id) : '';
                    ($filter->course_id != null) ? $query->where('course_id',$filter->course_id) : '';
                    ($filter->level_id != null) ? $query->where('level_id',$filter->level_id) : '';
                }
            })
            ->where(function ($query) use ($filter) {
                if(!empty($filter)){
                    ($filter->program_id == null) ? '' : $query->where('program_id',$filter->program_id);
                    ($filter->subprogram_id == null) ? '' : $query->where('subprogram_id',$filter->subprogram_id);
                }
             })
            ->paginate($request->count)
            ->withQueryString()
        );
        return $data;
    }

    public function dropdowns(){
        return [
            'regions' => LocationRegion::all()->map(function ($item) {
                return [
                    'value' => $item->code,
                    'name' => $item->region
                ];
            }),
            'lists' => ListDropdown::all()->map(function ($item) {
                return [
                    'value' => $item->id,
                    'name' => $item->name,
                    'classification' => $item->classification,
                    'others' => $item->others
                ];
            }),
            'programs' => ListProgram::all()->map(function ($item) {
                return [
                    'value' => $item->id,
                    'name' => $item->name,
                    'is_sub' => $item->is_sub
                ];
            }),
        ];
    }
}
