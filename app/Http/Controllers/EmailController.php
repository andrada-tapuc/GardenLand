<?php

namespace App\Http\Controllers;

use App\Contact_Message;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\SendEmail;

class EmailController extends Controller
{
    function index()
    {
        return view('home');
    }

    function show()
    {
        $inbox = Contact_Message::paginate(20);
        return view('inbox', compact('inbox'));
    }

    function destroy($id)
    {
        $msg = Contact_Message::find($id);
        $msg->delete();
        return redirect('admin/inbox')->with('succes','Mesaj Șters!');
    }

    function send(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
            'message' => 'required'
        ]);

        $data = array(
            'name' => $request->name,
            'message' => $request->message,
            'phone' => $request->phone,
            'email' => $request->email
        );

        $newMessage = new Contact_Message;
        $newMessage->username = $request->get('name');
        $newMessage->phone_number = $request->get('phone');
        $newMessage->email = $request->get('email');
        $newMessage->message = $request->get('message');
        $newMessage->save();


        Mail::to('andradaa.didaa@gmail.com')->send(new SendEmail($data));
        return back()->with('success', 'Mulțumim ca ne-ați contactat!');
    }
}
