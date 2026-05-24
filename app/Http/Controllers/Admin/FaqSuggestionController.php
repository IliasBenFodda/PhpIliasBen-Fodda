<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Faq;
use App\Models\FaqSuggestion;
use Illuminate\Http\Request;

class FaqSuggestionController extends Controller
{
    public function index()
    {
        $suggestions = FaqSuggestion::with(['user', 'category'])
            ->orderByRaw("CASE status WHEN 'pending' THEN 0 WHEN 'approved' THEN 1 WHEN 'rejected' THEN 2 ELSE 3 END")
            ->latest()
            ->paginate(20);

        return view('admin.faq.suggestions', compact('suggestions'));
    }

    public function approve(Request $request, FaqSuggestion $suggestion)
    {
        $request->validate([
            'answer' => 'required|string|min:5',
        ]);

        Faq::create([
            'question' => $suggestion->question,
            'answer' => $request->answer,
            'category_id' => $suggestion->category_id,
        ]);

        $suggestion->update(['status' => 'approved']);

        return back()->with('success', 'Voorstel goedgekeurd en toegevoegd aan de FAQ.');
    }

    public function reject(FaqSuggestion $suggestion)
    {
        $suggestion->update(['status' => 'rejected']);

        return back()->with('success', 'Voorstel afgewezen.');
    }
}
