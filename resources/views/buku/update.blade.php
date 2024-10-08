<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    <form action="{{route('buku.update', $buku->id)}}" method="POST">
        @csrf
        <div>Judul<input type="text" name="judul" value="{{$buku->judul}}"></div>
        <div>Penulis<input type="text" name="penulis" value="{{$buku->penulis}}"></div>
        <div>Harga<input type="text" name="harga" value="{{$buku->harga}}"></div>
        <div>Tanggal<input type="date" name="tgl_terbit" value="{{$buku->tgl_terbit}}"></div>
        <button type="submit">Simpan</button>
        <a href="{{'/buku'}}">Kembali</a>
    </form>
</body>
</html>

