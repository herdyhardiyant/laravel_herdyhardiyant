<?php

namespace App\Http\Controllers;

use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class HospitalController extends Controller
{
    /**
     * Display a listing of the resource.
     */

   

    public function index()
    {
        $hospitals = Hospital::where('user_id', Auth::user()->id)->get();
        return view('hospitals.index', compact('hospitals'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('hospitals.create');   
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'nama_rumah_sakit' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:hospitals',
            'telepon' => 'required|string|max:20',
        ]);

        Hospital::create([
            'nama_rumah_sakit' => $request->nama_rumah_sakit,
            'alamat' => $request->alamat,
            'email' => $request->email,
            'telepon' => $request->telepon,
            'user_id' => Auth::user()->id,
        ]);
                
        return redirect()->route('hospitals.index')->with('success', 'Data rumah sakit berhasil ditambahkan.');

    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $hospital = Hospital::where('id', $id)->firstOrFail();
        return view('hospitals.edit', compact('hospital'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $hospital = Hospital::where('id', $id)->firstOrFail();

        $request->validate([
            'nama_rumah_sakit' => 'required|string|max:255',
            'alamat' => 'required|string',
            'email' => 'required|email|unique:hospitals,email,' . $hospital->id,
            'telepon' => 'required|string|max:20',
        ]);

        $hospital->update($request->only('nama_rumah_sakit', 'alamat', 'email', 'telepon'));

        return redirect()->route('hospitals.index')->with('success', 'Data rumah sakit berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $hospital = Hospital::where('id', $id)->firstOrFail();
        $hospital->delete();
    }
}
