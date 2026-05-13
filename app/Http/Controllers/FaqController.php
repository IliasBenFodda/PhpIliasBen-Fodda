<?php

namespace App\Http\Controllers;

use App\Models\Faq;
use Illuminate\Http\Request;

class FaqController extends Controller
{
    public function index()
    {
        $faqs = Faq::orderBy('question')->get();

        return view('admin.faqs.index', [
            'faqs' => $faqs]);
    }
}
