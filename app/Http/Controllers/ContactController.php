<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\ContactFormMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Validator;
use Purifier;
use Alert;

class ContactController extends Controller
{
    public function viewContactPage()
    {
        $title = 'Contact Us!';                       
        return view('pages.contact')->with(compact('title'));
    }

    public function sendContactForm(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $subject = $request->subject;
        $email = $request->email;
        $message = Purifier::clean($request->message);

        Mail::to('contact@patcom.com')->send(new ContactFormMail($subject, $email, $message));

        $alerted = Alert::error('Message Sent', 'Your message has been sent.');
        return redirect()->back()->with('alerted');
    }
  
}
