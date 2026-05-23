<?php

namespace App\Http\Controllers;

use App\Mail\ContactFormMail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;

class ContactController extends Controller
{
    public function index()
    {
        return view('contact.index');
    }

    public function send(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required|email',
            'message' => 'required',
        ]);

        $data = $request->only('name', 'email', 'message');

        Mail::to(config('mail.admin_address', 'admin@ehb.be'))->send(new ContactFormMail($data));

        return back()->with('success', 'Bericht verzonden!');
    }
}
