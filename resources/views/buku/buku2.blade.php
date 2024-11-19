@extends('layouts')
@section('content')
<body>

    <div class="mt-4">
        <a href="#" class="btn btn-primary float-end" data-toggle="modal" data-target="#tambahBukuModal">Tambah
            Buku</a>
    </div>
    {{-- Search Bar  --}}
    <form action="{{ route('buku.search') }}" method="get">
        @csrf
        <input type="text" name="kata" id="kata" class="form-control" placeholder="Cari..."
            style="width: 30%;
        display:inline;
        margin-top:10px
        margin-bottom:10px
        float:right;">
    </form>

    {{-- Flash Message --}}
    @if (Session::has('pesan'))
        <div class="alert alert-success">
            {{ Session::get('pesan') }}
        </div>
    @endif


    @if (Session::has('success'))
        <div class="alert alert-success">
            {{ Session::get('success') }}
        </div>
    @endif

    @if (Session::has('deleted'))
        <div class="alert alert-danger">
            {{ Session::get('deleted') }}
        </div>
    @endif

    {{-- Search Bar Flash Message --}}
    @if (count($data_buku))
        <div class="alert alert-success">
            Ditemukan <strong>{{ count($data_buku) }}</strong> data dengan kata
            <strong>{{ $cari }}</strong>
        </div>
    @else
        <div class="alert alert-warning">
            <h4>Data {{ $cari }} tidak ditemukan</h4>
            <a href="/buku" class="btn btn-warnin">Kembali</a>
        </div>
    @endif



    {{-- Table Buku --}}
    <table class="display table table-striped" id="table_buku">
        <thead class="thead-dark">
            <tr>
                <th>ID</th>
                <th>Foto</th>
                <th>Judul Buku</th>
                <th>Penulis</th>
                <th>Harga</th>
                <th>Tanggal Terbit</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($data_buku as $index => $buku)
                <tr>
                    <td>{{ $buku->id }}</td>
                    <td><img src="{{ asset('storage/'.$buku->photo) }}" alt="test" style="width: 150px"></td>
                    <td>{{ $buku->judul }}</td>
                    <td>{{ $buku->penulis }}</td>
                    <td>{{ 'Rp. ' . number_format($buku->harga, 2, ',', '.') }}</td>
                    <td>{{ $buku->tgl_terbit->format('d/m/Y') }}</td>
                    <td>
                        <div class="d-flex">
                            <a href="{{ route('buku.show', $buku->id) }}" class="btn btn-primary">Edit</a>
                            <form action="{{ route('buku.destroy', $buku->id) }}" method="POST" class="mr-2">
                                @csrf
                                @method('DELETE')
                                <button onclick="return confirm('Yakin Ingin Menghapus?')" type="submit"
                                    class="btn btn-danger">Hapus</button>
                            </form>
                            <a href="{{ route('buku.detail',$buku->id) }}" class="btn btn-warning">Detail</a>

                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    <div>{{ $data_buku->links() }}</div>
    <div class="total-info">
        <p>Total Buku: {{ $rowCount }}</p>
        <p>Total Harga: {{ 'Rp. ' . number_format($totalPrice, 2, ',', '.') }}</p>
    </div>


    <!-- Modal -->
    <div class="modal fade" id="tambahBukuModal" tabindex="-1" aria-labelledby="tambahBukuModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="tambahBukuModalLabel">Tambah Buku</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @if (count($errors) > 0)
                    <ul class="alert alert-danger">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                @endif
                <div class="modal-body">
                    <form method="POST" action="{{ route('buku.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="judul">Judul</label>
                            <input type="text" class="form-control" id="judul" name="judul">
                        </div>
                        <div class="form-group">
                            <label for="penulis">Penulis</label>
                            <input type="text" class="form-control" id="penulis" name="penulis">
                        </div>
                        <div class="form-group">
                            <label for="harga">Harga</label>
                            <input type="number" class="form-control" id="harga" name="harga">
                        </div>
                        <div class="form-group">
                            <label for="tgl_terbit">Tanggal Terbit</label>
                            <input type="date" class="form-control" id="tgl_terbit" name="tgl_terbit"
                                class="date form-control" placeholder="yyyy/mm/dd">
                        </div>
                        <div class="col-md-6">
                            <label for="photo">Photo</label>
                            <input type="file" class="form-control @error('photo') is-invalid @enderror" id="photo"
                                name="photo" value="{{ old('photo') }}">
                            @if ($errors->has('photo'))
                                <span class="text-danger">{{ $errors->first('photo') }}</span>
                            @endif
                        </div>
                        <button type="submit" class="btn btn-primary">Simpan</button>
                        <a href="{{ url('/buku') }}" class="btn btn-secondary">Kembali</a>
                    </form>
                </div>
            </div>
        </div>
    </div>

        {{-- Date Picker Script --}}
        <script type="text/javascript">
            $(document).ready(function() {
                $(function() {
                    $("#tgl_terbit").
                    datepicker();
                });
            })
        </script>

        {{-- Script DataTables --}}
        <script>
            $(document).ready(function() {
                $('#table_buku').DataTable({
                    "searching": true, // Enable search
                    "paging": true, // Enable pagination
                    "info": true, // Show info
                    "lengthChange": true, // Allow changing the number of entries shown
                    "pageLength": 10 // Default number of entries shown
                });
            });
        </script>
    <script src="{{ asset('js/bootstrap.min.js') }}"></script>
</body>
@endsection
