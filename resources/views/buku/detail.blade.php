@extends('layouts')

@section('content')
<body>
    <div class="card">
        <div class="card-header">
            Book Details
        </div>
        <div class="card-body">
            <h5 class="card-title">{{ $buku->judul }}</h5>
            <p class="card-text">
                <strong>Penulis:</strong> {{ $buku->penulis }}<br>
                <strong>Harga:</strong> Rp{{ number_format($buku->harga, 0, ',', '.') }}<br>
                <strong>Tanggal Terbit:</strong> {{ $buku->tgl_terbit }}
            </p>
            <img src="{{ asset('public/' . $buku->photo) }}" alt="Book Cover" class="img-fluid">
            <img src="{{ asset('public/resized/' . $buku->photoResized) }}" alt="Book Cover" class="img-fluid">
        </div>
        <div class="card-footer">
            <a href="{{ route('buku.show', $buku->id) }}" class="btn btn-primary">Edit</a>
            <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" class="d-inline">
                @csrf
                @method('DELETE')
                <button type="submit" class="btn btn-danger">Delete</button>
            </form>
            <a href="{{ route('dashboard_admin') }}" class="btn btn-secondary">Back</a>
        </div>
    </div>
</body>
@endsection
