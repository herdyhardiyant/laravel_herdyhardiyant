@extends('layouts.app')

@section('content')
<div class="container">
    <h2>Daftar Rumah Sakit Saya</h2>
    <a href="{{ route('hospitals.create') }}" class="btn btn-primary mb-3">Tambah Rumah Sakit</a>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Nama Rumah Sakit</th>
                <th>Alamat</th>
                <th>Email</th>
                <th>Telepon</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
        @forelse($hospitals as $hospital)
            <tr>
                <td>{{ $hospital->nama_rumah_sakit }}</td>
                <td>{{ $hospital->alamat }}</td>
                <td>{{ $hospital->email }}</td>
                <td>{{ $hospital->telepon }}</td>
                <td>
                    <a href="{{ route('hospitals.edit', $hospital->id) }}" class="btn btn-sm btn-warning">Edit</a>
                    <form action="{{ route('hospitals.destroy', $hospital->id) }}" method="POST" style="display:inline-block">
                        @csrf @method('DELETE')
                        <button type='button' class="btn btn-sm btn-danger btn-delete" data-id="{{ $hospital->id }}">Hapus</button>
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
                url: '/hospitals/' + id,
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