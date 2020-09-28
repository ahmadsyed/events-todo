<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
//use App\Http\Models\{Event,Participant};
use App\Http\Models\Event;
use App\Http\Models\Participant;
use Response;
use Validator;


class EventController extends Controller
{
    //add new event 
    public function addEvent(Request $request){
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'participants'=>"required|array|min:1"
        ]);
        if($validator->passes()){
            try{
                $event = Event::create($request->all());
                $participant_email = $request->input('participants');
                $participant_id = [];
                foreach($participant_email as $email){
                    $participant_id [] = Participant::create($email)->id;
                }
                $event->participants()->attach($participant_id); //record many to many relation
                return response()->json(['status' => '200', 'msg' => 'success']);
            }catch(\Exception $e){
                //todo:Rollback DB here
                //dd($e);
                return response()->json(['status' => '500', 'msg' => 'somthing went wrong']);
            }
        }else{
            return Response::json(['error' => $validator->messages()->toArray()],400);
        }
        
    }

    //get Event
    public function getEvent(Request $request){
        $validator = Validator::make($request->all(),[
            'id' => 'required|exists:events|min:1'
        ]);
        if($validator->passes()){
        try{
            return Event::find($request->input('id'));
        }catch(\Exception $e){
            //todo:Rollback db here
            return response()->json(['status' => '500', 'msg' => 'somthing went wrong']);
        }
        }
        else{
            return Response::json(['error' => $validator->messages()->toArray()],400);
        }

    }

    //update Event 
    public function updateEvent(Request $request){
        //Todo:: validate if new name is not assigned any where else
        $validator = Validator::make($request->all(),[
            'name' => 'required|max:255',
            'id' => 'required|exists:events|min:1'
        ]);
        if($validator->passes()){
        try{
            return Event::where('id',$request->input('id'))->update(['name'=>$request->input('name')]);
        }catch(\Exception $e){
            dd($e);
            return response()->json(['status' => '500', 'msg' => 'somthing went wrong']);
        }
    }else{
        return Response::json(['error' => $validator->messages()->toArray()],400);
    }
    }

    //softdelete Event
    public function deleteEvent(Request $request){
        try{
            return Event::where('id',$request->input('id'))->delete(); //soft delete is implimented in the model , so will update deleted_at 
        }catch(\Exception $e){
            return response()->json(['status' => '500', 'msg' => 'somthing went wrong']);
        }
    }
}
