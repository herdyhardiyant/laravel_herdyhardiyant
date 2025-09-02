
@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Pasien</h2>

    <form action="{{ route('patients.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label>Nama Pasien</label>
            <input type="text" name="nama_pasien" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>No Telpon</label>
            <input type="text" name="telepon" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Rumah Sakit</label>
            <select name="hospital_id" class="form-control" required>
                @foreach ($hospitals as $hospital)
                    <option value="{{ $hospital->id }}">{{ $hospital->nama_rumah_sakit }}</option>
                @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
