<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Controller;
use App\Http\Resources\DoctorResource;
use App\Http\Resources\HomeResource;
use App\Http\Resources\HometResource;
use App\Http\Resources\MajorResource;
use App\Models\Major;
use App\Models\User;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $majors = Major::take(5)->get();
        $doctors = User::with('major')->where("role", "doctor")->take(5)->get();
        
        return[
            "major" => MajorResource::collection($majors) ,
            "doctor"=> DoctorResource::collection($doctors)
        ];
    }
}
