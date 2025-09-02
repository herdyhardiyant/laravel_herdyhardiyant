@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Pasien Saya</h2>
    <a href="{{ route('patients.create') }}" class="btn btn-primary mb-3">Tambah Pasien</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <form method="GET" action="{{ route('patients.index') }}" class="mb-3">
        <div class="row">
            <div class="col-md-4">
                <select name="hospital_id" class="form-control" onchange="this.form.submit()">
                    <option value="">-- Semua Rumah Sakit --</option>
                    @foreach($hospitals as $hospital)
                        <option value="{{ $hospital->id }}"
                            {{ request('hospital_id') == $hospital->id ? 'selected' : '' }}>
                            {{ $hospital->nama_rumah_sakit }}
                        </option>
                    @endforeach
                </select>
            </div>
        </div>
    </form>


    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Pasien</th>
                <th>Alamat</th>
                <th>Telepon</th>
                <th>Rumah Sakit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($patients as $patient)
            <tr>
                <td>{{ $patient->nama_pasien }}</td>
                <td>{{ $patient->alamat }}</td>
                <td>{{ $patient->telepon}}</td>
                <td>{{ $patient->hospital->nama_rumah_sakit ?? '-'}}</td>
                <td>
                    <a href="{{ route('patients.edit', $patient->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('patients.destroy', $patient->id) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button type='button' class="btn btn-sm btn-danger btn-delete" data-id="{{ $patient->id }}">Hapus</button>
                    </form>
                </td>
            </tr>
        @empty
            <tr><td colspan="5" class="text-center">Belum ada data</td></tr>
        @endforelse
        </tbody>
    </table>
</div>
@endsection

@section('scripts')
<script>
    $(document).ready(function() {
        $('.btn-delete').click(function(e) {
            e.preventDefault();

            let id = $(this).data('id');
            let row = $(this).closest('tr');

            if(!confirm('Yakin hapus data ini?')) return;

            $.ajax({
                url: '/patients/' + id,
                type: 'DELETE',
                data: {
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    row.fadeOut(500, function() {
                        $(this).remove();
                    });
                },
                error: function(xhr) {
                    alert('Gagal menghapus data');
                }
            });
        });
    });
</script>
@endsection