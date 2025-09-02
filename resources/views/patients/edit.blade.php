@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Edit Pasien</h2>

    <form method="POST" action="{{ route('patients.update', $patient->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Pasien</label>
            <input type="text" name="nama_pasien" class="form-control"
                   value="{{ old('nama_pasien', $patient->nama_pasien) }}" required>
        </div>

        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control"
                   value="{{ old('alamat', $patient->alamat) }}" required>
        </div>

        <div class="mb-3">
            <label>Telepon</label>
            <input type="text" name="telepon" class="form-control"
                   value="{{ old('telepon', $patient->telepon) }}" required>
        </div>

        <div class="mb-3">
            <label>Rumah Sakit</label>
            <select name="hospital_id" class="form-control" required>
                @foreach($hospitals as $hospital)
                    <option value="{{ $hospital->id }}"
                        {{ $patient->hospital_id == $hospital->id ? 'selected' : '' }}>
                        {{ $hospital->nama_rumah_sakit }}
                    </option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>

@endsection
