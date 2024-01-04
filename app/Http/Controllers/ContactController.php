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
        $title = 'Contact Us';                       
        return view('pages.contact')->with(compact('title'));
    }

    public function sendContactForm(Request $request)
    {
        $request->validate([
            'subject' => 'required|string|max:255',
            'fullName' => 'required|string|max:255',
            'email' => 'required|email',
            'message' => 'required|string',
        ]);

        $subject = $request->subject;
        $fullName = $request->fullName;
        $email = $request->email;
        $message = Purifier::clean($request->message);       

        try {
            Mail::to('contact@patroncastle.com')->send(new ContactFormMail($subject, $fullName, $email, $message));
            
            return response()->json(['success' => true]);
        } catch (\Exception $e) {
            return response()->json(['success' => false, 'error' => $e->getMessage()]);
        }
        
    }
  
}
