<?php

namespace App\Http\Controllers;

use Validator;
use App\Contact;
use App\Mail\Enquiry;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\Http\Resources\ContactResource;

class ContactController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        return view('cms.contact.contactindex',['contact'=>Contact::all()]);
        $query = Contact::query();
        if ($request->has('name')) {
            $query->where('name', 'like', '%' . $request->name . '%');
        }
        if ($request->has('message')) {
            $query->where('message','like', '%' . $request->message . '%');
        }
        if ($request->has('subject')) {
            $query->where('subject','like', '%' . $request->subject . '%');
        }
        $query->orderByDesc('created_at');
        return ContactResource::collection($query->paginate($request->input('limit')));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $user = Auth::user();

        if ($user->hasRole(['admin','super_admin'])) {
            $validation = Validator::make($request->all(), [
                'name' => 'required',
                'email' => 'required|email',
                'message' => 'required',
                'subject' => 'required|min:3'
            ]);

            if ($validation->fails()) {
                return response()->json($validation->errors(), 422);
            }

            $contact = Contact::create($request->all());
            /*sending mail*/
            if(env('EMAIL_DISABLE',0) == 0) {
                Mail::to (env('MAIL_EMAIL'))->send(new Enquiry($request->all()));
            }

            return new  ContactResource($contact);

        } else {
            $return = ["status" => "error",
                "error" => [
                    "code" => 403,
                    "errors" => 'Forbidden'
                ]];
            return response()->json($return, 403);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return new ContactResource(Contact::findorfail($id));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function edit(Contact $contact)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Contact $contact)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Contact  $contact
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $user = Auth::user();

        if ($user->hasRole(['admin','super_admin'])) {
            Contact::whereId($id)->delete();
            $return = ["status" => "Success"];
            return redirect('/contact');

        } else {
            $return = ["status" => "error",
                "error" => [
                    "code" => 403,
                    "errors" => 'Forbidden'
                ]];
            return response()->json($return, 403);
        }
    }
}
