<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Traits\UploadImage;
use App\Models\Appointments;
use App\Models\Major;
use App\Models\User;
use Illuminate\Http\Request;

class MajorController extends Controller
{

    use UploadImage ;

    public function create()
    {
        return view("admin.majors.create");
    }

    public function store()
    {
        request()->validate([
            "name" => "required|string|min:3|max:50",
            "image" => ["required", "image"]
        ]);
        
        $image_name= $this->upload('uploads/majors/');

            Major::create([
                "name"=>request()->name , 
                "image"=>$image_name
            ]);
            
        return back()->with("success" , "data added successfully");

    }

    public function edit(Major $major) {
            return view('admin.majors.edit' , compact('major'));
    }
    
    
    public function update(Request $request, Major $major) {
        
        request()->validate([
            "name" => "required|string|min:3|max:50",
            "image" => ["required", "image"]
        ]);
        
        $image_name= $this->upload('uploads/majors/');
        $major->name = $request->name;
        $major->image = $image_name ;
        
        $major->save();
        
        return back()->with('success' , 'data updated successfully');
    }
    
     public function destroy(Major $major ) {
             $users = User::where("major_id" , $major->id)->get();
            Appointments::whereIn("patient_id", $users->pluck('id'))->delete();
            Appointments::whereIn("doctor_id", $users->pluck('id'))->delete();
            User::where("major_id", $major->id)->delete();
            
            $major->delete();
            
        return back()->with("success" , "deleted has been successfully");
   }
}
