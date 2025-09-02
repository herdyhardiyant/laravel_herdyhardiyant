@extends('layouts.app')

@section('content')

 <div class="container">
    <h2>Edit Rumah Sakit</h2>

    <form method="POST" action="{{ route('hospitals.update', $hospital->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nama Rumah Sakit</label>
            <input type="text" name="nama_rumah_sakit" class="form-control" value="{{ old('nama_rumah_sakit', $hospital->nama_rumah_sakit) }}" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control"  value="{{ old('alamat', $hospital->alamat) }}" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control"  value="{{ old('email', $hospital->email) }}" required>
        </div>
        <div class="mb-3">
            <label>Telepon</label>
            <input type="text" name="telepon" class="form-control"  value="{{ old('telepon', $hospital->telepon) }}" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection