<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\ContactMessage;

class ContactController extends Controller
{
    public function index()
    {
        $messages = ContactMessage::latest()->paginate(20);

        return view('admin.contact.index', compact('messages'));
    }

    public function markRead(ContactMessage $message)
    {
        $message->update(['read' => true]);

        return back()->with('success', 'Bericht gemarkeerd als gelezen.');
    }

    public function destroy(ContactMessage $message)
    {
        $message->delete();

        return back()->with('success', 'Bericht verwijderd.');
    }
}
