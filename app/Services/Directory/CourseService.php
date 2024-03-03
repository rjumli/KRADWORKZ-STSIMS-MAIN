<?php

namespace App\Services\Directory;

use App\Models\ListCourse;
use App\Http\Resources\Directory\CourseResource;

class CourseService
{
    public function lists($request){
        $data = CourseResource::collection(
            ListCourse::query()
            ->when($request->keyword, function ($query, $keyword) {
                $query->where('name', 'LIKE', "%{$keyword}%")->orWhere('shortcut', 'LIKE', "%{$keyword}%");
            })
            ->paginate($request->count)
        );
        return $data;
    }

    public function save($request){
        $data = ListCourse::create($request->all());
        $data = ListCourse::findOrFail($data->id);
        return [
            'data' => new CourseResource($data),
            'message' => 'Course creation was successful!', 
            'info' => "You've successfully created a new course."
        ];
    }

    public function update($request){
        $data = ListCourse::findOrFail($request->id)->update($request->all());
        $updated = ListCourse::findOrFail($request->id);
        
        activity()
        ->performedOn($updated)
        ->causedBy(\Auth::user())
        ->withProperties(['is_active' => $request->is_active])
        ->event('updated')
        ->log('updated the course');

        return [
            'data' => new CourseResource($updated),
            'message' => 'Course update was successful!', 
            'info' => "You've successfully updated the selected course."
        ];
    }

    public function list_courses($request){
        $keyword = $request->keyword;
        if(!empty($keyword)){
            $data = ListCourse::where('name', 'LIKE', '%'.$keyword.'%')
            ->orWhere('shortcut', 'LIKE', '%'.$keyword.'%')->get()->map(function ($item) {
                return [
                    'value' => $item->id,
                    'name' => ($item->name) ? $item->name : $item->shortcut
                ];
            });
        }else{
            $data = [];
        }
        return $data;
    }
}
