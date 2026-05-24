<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\FaqSuggestion;
use Illuminate\Http\Request;

class FaqSuggestionController extends Controller
{
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('faq.suggest', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        FaqSuggestion::create([
            'user_id' => auth()->id(),
            'category_id' => $request->category_id,
            'question' => $request->question,
        ]);

        return redirect()->route('faq.index')
            ->with('success', 'Je voorstel is ingediend en wordt beoordeeld door een admin.');
    }
}
