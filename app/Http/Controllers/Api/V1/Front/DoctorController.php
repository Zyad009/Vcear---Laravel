<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Api\V1\Traits\Api;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class DoctorController extends Controller
{
use Api;
    public function index(){
        $doctors = User::where('role' , "doctor")->paginate();
        return $this->apiResponse($doctors);
    }

}
