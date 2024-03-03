<?php

namespace App\Http\Controllers;

use App\Models\School;
use Illuminate\Http\Request;

class ApiController extends Controller
{
    public function index(Request $request){
        $data = School::with('campuses','campuses.courses','campuses.names')->get();
        return $data;
    }

    public function user(Request $request){
        $bearer = $request->bearerToken();
        $token = PersonalAccessToken::findToken($bearer);
        if($token){
            return response()->json(['status' => true], 200);
        }else{
            return response()->json(['status' => 'Unauthorized'], 401);
        }
    }
}
