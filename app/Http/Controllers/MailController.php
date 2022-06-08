<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail;
use Validator;

class MailController extends Controller
{
    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required',
            'subject' => 'required',
            'message'=>'required'
        ]);
        if ($validation->fails()) {
            return response()->json($validation->errors() , 422);
        }
       
        $mail=Mail::create($request->all());
        $mail->save();
        return back()->with('success','Thank you for your message.');
    }
}
