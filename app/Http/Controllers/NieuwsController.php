<?php

namespace App\Http\Controllers;

use App\Models\Nieuws;
use App\Models\Onderwerp;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NieuwsController extends Controller
{
    public function index()
    {
        $nieuws = Nieuws::latest('publication_date')->get();

        return view('nieuws.index', compact('nieuws'));
    }

    public function adminIndex()
    {
        $nieuws = Nieuws::latest()->get();

        return view('admin.nieuws.index', compact('nieuws'));
    }

    public function show(Nieuws $nieuws)
    {
        return view('nieuws.show', compact('nieuws'));
    }

    public function create()
    {
        $onderwerpen = Onderwerp::all();

        return view('admin.nieuws.create', compact('onderwerpen'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'publication_date' => 'required|date',
            'image' => 'required|image',
            'onderwerpen' => 'nullable|array'
        ]);

        $data['image'] = $request->file('image')->store('nieuws', 'public');

        $nieuws = Nieuws::create($data);

        $nieuws->onderwerpen()->sync($request->onderwerpen ?? []);

        return redirect()->route('admin.nieuws.index');
    }

    public function edit(Nieuws $nieuws)
    {
        $onderwerpen = Onderwerp::all();
//        dd($onderwerpen);

        return view('admin.nieuws.edit', compact('nieuws', 'onderwerpen'));
    }

    public function update(Request $request, Nieuws $nieuws)
    {
        $data = $request->validate([
            'title' => 'required',
            'content' => 'required',
            'publication_date' => 'required|date',
            'image' => 'nullable|image',
            'onderwerpen' => 'nullable|array'
        ]);

        if ($request->hasFile('image')) {
            if ($nieuws->image) {
                Storage::disk('public')->delete($nieuws->image);
            }

            $data['image'] = $request->file('image')->store('nieuws', 'public');
        }

        $nieuws->update($data);

        $nieuws->onderwerpen()->sync($request->onderwerpen ?? []);

        return redirect()->route('admin.nieuws.index');
    }

    public function destroy(Nieuws $nieuws)
    {
        if ($nieuws->image) {
            Storage::disk('public')->delete($nieuws->image);
        }

        $nieuws->delete();

        return redirect()->route('admin.nieuws.index');
    }
}
