<?php

namespace App\Http\Controllers;
use Validator;
use App\Bookingrequest;

use Illuminate\Http\Request;

class MapController extends Controller
{
    //
     // validation for booking request form
     public function bookingrequestValidation()
     {
         return view('firststep');
     }
 
     /**
      * Display a listing of the myformPost.
      *
      * @return \Illuminate\Http\Response
      */
     public function bookingrequestValidationStore(Request $request)
     {
         // validate request
         $validator = Validator::make($request->all(), [
             'from_location' => 'required',
             'to_location'   => 'required',
             'request_time'  => 'required',
             'services'      => 'required',
             'user_id'       => 'required',
             'status'       => 'required'
         ]);
 
         if ($validator->passes()) {
             
             $user = Bookingrequest::create($request->all());
             return response()->json(['success'=>'Request submitted successfully,kindly check your email for further updates']);
             
         }
         return response()->json(['error'=>$validator->errors()]);   
     }    
 
}
