@extends('layouts')
@section('content')
<body>
    @if (count($errors) > 0)
        <ul class="alert alert-danger">
            @foreach ($errors->all() as $error)
                <li class="alert alert-danger">{{ $error }}</li>
            @endforeach
        </ul>
    @endif

    <form action="{{ route('buku.update', $buku->id) }}" method="POST">
        @csrf
        <div>Judul<input type="text" name="judul" value="{{ $buku->judul }}"></div>
        <div>Penulis<input type="text" name="penulis" value="{{ $buku->penulis }}"></div>
        <div>Harga<input type="text" name="harga" value="{{ $buku->harga }}"></div>
        <div>Tanggal<input type="date" name="tgl_terbit" value="{{ $buku->tgl_terbit }}"></div>
        <button type="submit">Simpan</button>
        <a href="{{ '/buku' }}">Kembali</a>
    </form>
</body>
@endsection



