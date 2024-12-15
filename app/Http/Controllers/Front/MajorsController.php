<?php

namespace App\Http\Controllers\Front;
use App\Models\Major;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;

class MajorsController extends Controller
{
    public function index(){
        $majors =Major::orderBy('id' , "DESC") ->paginate(14);
        return view("front.majors.index" , [ "majors"=>$majors]);
    }

    public function doctors(Major $major){
        $doctors = User::with('major')
        ->where("role", "doctor")
        ->where("major_id" , $major->id)
        ->paginate(14);
        return view("front.doctors.index", compact("doctors"));
    }
}
