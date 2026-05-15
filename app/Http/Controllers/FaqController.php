<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Faq;
use Illuminate\Http\Request;


class FaqController extends Controller
{
    public function index()
    {
        $categories = Category::with('faqs')->get();
        return view('faq.index', compact('categories'));
    }

    public function create()
    {
        $categories = Category::all();
        return view('admin.faq.create', compact('categories'));
    }

    /**
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $request->validate([
            'question' => 'required|string|max:255',
            'answer' => 'nullable|string',
            'category_id' => 'nullable|exists:categories,id',
        ]);

        Faq::create($request->only('question', 'answer', 'category_id'));

        return redirect()->route('faq.index');
    }

    public function destroy(Faq $faq)
    {
        $faq->delete();
        return redirect()->route('faq.index');
    }
}
