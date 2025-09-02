<?php

namespace App\Http\Controllers;

use App\Models\Patient;
use App\Models\Hospital;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatientController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $userId = Auth::user()->id;

        $query = Patient::whereHas('hospital', function ($query) use ($userId) {
                $query->where('user_id', $userId);
            });

        if ($request->has('hospital_id') && $request->hospital_id != '') {
            $query->where('hospital_id', $request->hospital_id);
        }

        $patients = $query->get();

        $hospitals = Hospital::where('user_id', $userId)->get();
        return view('patients.index', compact('patients', 'hospitals'));    
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $hospitals = Hospital::where('user_id', Auth::user()->id)->get();
        return view('patients.create', compact('hospitals'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
        'nama_pasien' => 'required|string|max:255',
        'alamat' => 'required|string',
        'telepon' => 'required|string|max:20',
        'hospital_id' => 'required|exists:hospitals,id',
        ]);

        Patient::create($request->all());

        return redirect()->route('patients.index')->with('success', 'Data pasien berhasil ditambahkan.');
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
        $patient = Patient::findOrFail($id);
        $hospitals = Hospital::where('user_id', Auth::user()->id)->get(); // hanya hospital milik user
        return view('patients.edit', compact('patient', 'hospitals'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $patient = Patient::findOrFail($id);

        $request->validate([
            'nama_pasien' => 'required|string|max:255',
            'alamat' => 'required|string',
            'telepon' => 'required|string|max:20',
            'hospital_id' => 'required|exists:hospitals,id',
        ]);

        $patient->update($request->only('nama_pasien', 'alamat', 'telepon', 'hospital_id'));

        return redirect()->route('patients.index')->with('success', 'Data pasien berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $patient = Patient::findOrFail($id);
        $patient->delete();
        
    }
}
