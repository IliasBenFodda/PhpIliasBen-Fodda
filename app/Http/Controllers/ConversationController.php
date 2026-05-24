<?php

namespace App\Http\Controllers;

use App\Models\Conversation;
use App\Models\Message;
use App\Models\User;
use Illuminate\Http\Request;

class ConversationController extends Controller
{
    public function index()
    {
        $conversations = auth()->user()
            ->conversations()
            ->with(['users', 'latestMessage'])
            ->orderByDesc('updated_at')
            ->get();

        return view('conversations.index', compact('conversations'));
    }

    public function create()
    {
        $users = User::where('id', '!=', auth()->id())->orderBy('name')->get();
        return view('conversations.create', compact('users'));
    }

    public function store(Request $request)
    {
        $request->validate(['user_id' => 'required|exists:users,id|different:' . auth()->id()]);

        $otherUser = User::findOrFail($request->user_id);

        // Check if conversation already exists between these two users
        $existing = auth()->user()->conversations()
            ->whereHas('users', fn($q) => $q->where('users.id', $otherUser->id))
            ->first();

        if ($existing) {
            return redirect()->route('conversations.show', $existing);
        }

        $conversation = Conversation::create();
        $conversation->users()->attach([auth()->id(), $otherUser->id]);

        return redirect()->route('conversations.show', $conversation);
    }

    public function show(Conversation $conversation)
    {
        abort_unless($conversation->users->contains(auth()->id()), 403);

        $conversation->load(['messages.user', 'users']);

        return view('conversations.show', compact('conversation'));
    }

    public function sendMessage(Request $request, Conversation $conversation)
    {
        abort_unless($conversation->users->contains(auth()->id()), 403);

        $request->validate(['body' => 'required|string|max:2000']);

        Message::create([
            'conversation_id' => $conversation->id,
            'user_id' => auth()->id(),
            'body' => $request->body,
        ]);

        $conversation->touch();

        return redirect()->route('conversations.show', $conversation);
    }
}
