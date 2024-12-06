@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Sistem Pengambilan Keputusan Pemilihan Program Magang Menggunakan Metode SAW</h1>
    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Tempat Program Magang</th>
                <th>Skor Rekomendasi</th>
                <th>Durasi</th>
                <th>Deskripsi</th>
                <th>Kompensasi</th> <!-- Tambahkan kolom Kompensasi -->
                <th>Hapus Data</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recommendations as $recommendation)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $recommendation['name'] }}</td>
                <td>{{ $recommendation['score'] }}</td>
                <td>{{ $recommendation['duration'] }} bulan</td>
                <td>{{ $recommendation['description'] }}</td>
                <td>${{ $recommendation['compensation'] ?? 'Tidak Tersedia' }}</td> <!-- Tampilkan kompensasi -->
                <td>
                    <!-- Form untuk tombol delete -->
                    <form action="{{ route('recommendations.destroy', $recommendation['id']) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus program ini?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm">Hapus</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
