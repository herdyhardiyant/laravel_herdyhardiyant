@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Tambah Rumah Sakit</h2>

    <form method="POST" action="{{ route('hospitals.store') }}">
        @csrf
        <div class="mb-3">
            <label>Nama Rumah Sakit</label>
            <input type="text" name="nama_rumah_sakit" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Alamat</label>
            <input type="text" name="alamat" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" required>
        </div>
        <div class="mb-3">
            <label>Telepon</label>
            <input type="text" name="telepon" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-success">Simpan</button>
    </form>
</div>
@endsection
