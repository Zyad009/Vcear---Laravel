<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Api\V1\Traits\Api;
use App\Http\Controllers\Controller;
use App\Http\Resources\MajorResource;
use App\Models\Major;
use App\Models\User;
use Illuminate\Http\Request;

class MajorController extends Controller
{
    use Api;

    public function index()
    {
        $majors = Major::with('users')->get();
        return MajorResource::collection($majors);
        // return $this->apiResponse($majors);
    }

    public function show($id){
        $major=Major::findOrFail($id);
        return new MajorResource($major);
        // return $this->apiResponse($major);
    }
    
    public function doctors($id){
        $doctors = User::where('role' , 'doctor')->where('major_id' , $id)->get();
        return $this->apiResponse($doctors);
    }
}
