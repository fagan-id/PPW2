<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    {{-- Script for local bootstrap --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Script for Datepicker --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">

    {{-- CDN JQuery for Bootstrap --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
    <title>Document</title>
</head>

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

</html>
