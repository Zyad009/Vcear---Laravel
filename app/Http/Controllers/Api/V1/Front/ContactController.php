<?php

namespace App\Http\Controllers\Api\V1\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\Front\ContactRequest;
use App\Http\Resources\ContactResource;
use App\Models\Message;
use Illuminate\Http\Request;

class ContactController extends Controller
{

    public function index(){
        $data = Message::all();
        return ContactResource::collection($data);
    }

    public function show($id){
        $data = Message::findOrFail($id);
        return new ContactResource ($data);
    }

    public function create(ContactRequest $request){

        $data = $request->all();
        $message = Message::create($data);
        
        return response()->json([
            'message' => $message
        ]);
    }
    
    public function delete($id){
        $message = Message::find($id);
        if (!$message) {
            return response()->json(["message" => "Error: Message not found"], 404);
        }
        $message->delete();
        return response()->json(["message" => "Message has been deleted successfully"]);
    }

}