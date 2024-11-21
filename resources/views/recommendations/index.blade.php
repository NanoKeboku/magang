@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Rekomendasi Program Magang</h1>
    <table class="table">
        <thead>
            <tr>
                <th>Program</th>
                <th>Perusahaan</th>
                <th>Skor</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($recommendations as $recommendation)
            <tr>
                <td>{{ $recommendation['program']->name }}</td>
                <td>{{ $recommendation['program']->company }}</td>
                <td>{{ $recommendation['score'] }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
