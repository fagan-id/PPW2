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

    <form action="{{ route('buku.update', $buku->id) }}" method="POST" enctype="multipart/form-data">
        @csrf
        <div class="form-group">
            <label for="judul">Judul</label>
            <input type="text" class="form-control" id="judul" name="judul" value="{{ $buku->judul }}">
        </div>
        <div class="form-group">
            <label for="penulis">Penulis</label>
            <input type="text" class="form-control" id="penulis" name="penulis" value="{{ $buku->penulis }}">
        </div>
        <div class="form-group">
            <label for="harga">Harga</label>
            <input type="number" class="form-control" id="harga" name="harga" value="{{ $buku->harga }}">
        </div>
        <div class="form-group">
            <label for="tgl_terbit">Tanggal Terbit</label>
            <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit" value="{{ $buku->tgl_terbit }}"
                class="date form-control" placeholder="yyyy/mm/dd">
        </div>
        <div class="col-md-6">
            <label for="photo" >Photo</label>
            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo"
                name="photo" value="{{ old('photo') }}">
            @if ($errors->has('photo'))
                <span class="text-danger">{{ $errors->first('photo') }}</span>
            @endif
        </div>
        {{-- <div>Judul<input type="text" name="judul" value="{{ $buku->judul }}"></div>
        <div>Penulis<input type="text" name="penulis" value="{{ $buku->penulis }}"></div>
        <div>Harga<input type="text" name="harga" value="{{ $buku->harga }}"></div>
        <div>Tanggal<input type="date" name="tgl_terbit" value="{{ $buku->tgl_terbit }}"></div> --}}
        <button type="submit">Simpan</button>
        <a href="{{ '/buku' }}">Kembali</a>
    </form>
</body>
@endsection



