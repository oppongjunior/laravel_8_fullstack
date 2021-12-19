<?php

namespace App\Http\Controllers;

use App\Models\ContactMessages;
use App\Models\Notification;
use Illuminate\Http\Request;


class ContactController extends Controller
{
    public function index(){
        $messages = ContactMessages::paginate(15);
        return view("admin.contactmessage.contactmessage",['messages'=>$messages]);
    }

    public function store(Request $request){

        $validate = $request->validate([
            'name' => 'required|max:256',
            'email' => 'required|max:256|email',
            'subject' => 'required|max:256',
            'message' => 'required|max:1000',
        ]);

        //insert
        $contact = new ContactMessages();
        $contact->name = $request->input('name');
        $contact->email = $request->input('email');
        $contact->subject = $request->input('subject');
        $contact->message = $request->input('message');
        $contact->save();

        //add notification
        $notification = new Notification();
        $notification->type = "message";
        $notification->message = "You have received a new message";
        $notification->read = 0;

        $notification->save();

        return redirect()->back()->with("success", "Contact sent successfully");
    }

    //delete messages
    public function destroy($id){
        ContactMessages::find($id)->delete();

        return redirect("contact/messages")->with('success',"messaged deleted successfully");
    }
}
