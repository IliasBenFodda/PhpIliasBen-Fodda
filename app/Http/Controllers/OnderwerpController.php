<?php

namespace App\Http\Controllers;

use App\Models\Onderwerp;
use Illuminate\Http\Request;

class OnderwerpController extends Controller
{
    public function index()
    {
        $onderwerpen = Onderwerp::all();

        return view('admin.onderwerpen.index', compact('onderwerpen'));
    }

    public function create()
    {
        return view('admin.onderwerpen.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required'
        ]);

        Onderwerp::create($request->only('name'));

        return redirect()->route('admin.onderwerpen.index');
    }

    public function edit(Onderwerp $onderwerp)
    {
        return view('admin.onderwerpen.edit', compact('onderwerp'));
    }

    public function update(Request $request, Onderwerp $onderwerp)
    {
        $request->validate([
            'name' => 'required'
        ]);

        $onderwerp->update($request->only('name'));

        return redirect()->route('admin.onderwerpen.index');
    }

    public function destroy(Onderwerp $onderwerp)
    {
        $onderwerp->delete();

        return back();
    }
}
