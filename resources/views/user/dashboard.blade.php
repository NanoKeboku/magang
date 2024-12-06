@extends('layouts.users')

@section('content')
<div class="container mt-4">
    <h1 class="mb-4">Sistem Pengambilan Keputusan Pemilihan Program Magang Menggunakan Metode SAW</h1>
    <!-- Form Pencarian -->
    <form action="{{ route('user.dashboard') }}" method="GET" class="mb-4">
        <div class="row">
            <div class="col-md-6">
                <input 
                    type="text" 
                    name="search" 
                    class="form-control" 
                    placeholder="Cari program berdasarkan nama atau deskripsi..." 
                    value="{{ request('search') }}">
            </div>
            <div class="col-md-3">
                <button type="submit" class="btn btn-primary">Cari</button>
            </div>
        </div>
    </form>

    <table class="table table-striped table-hover">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>Nama Program</th>
                <th>Skor Rekomendasi</th>
                <th>Deskripsi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recommendations as $recommendation)
            <tr>
                <td>{{ $loop->iteration }}</td>
                <td>{{ $recommendation['name'] }}</td>
                <td>{{ $recommendation['score'] }}</td>
                <td>{{ $recommendation['description'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
