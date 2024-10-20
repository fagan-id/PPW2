<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

    {{-- Script for local bootstrap --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('css/style.css') }}">

    {{-- Script for Datepicker --}}
    <link rel="stylesheet" href="{{ asset('css/bootstrap-datepicker.css') }}">

    {{-- CDN JQuery for Bootstrap --}}
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>


    {{-- Script for Datepicker and Query --}}
    <link href=
    'https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/themes/ui-lightness/jquery-ui.css'
        rel='stylesheet'>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

    <script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.12.1/jquery-ui.min.js"></script>


    {{-- Data Tables Dependencies --}}
    <link rel="stylesheet" href="https://cdn.datatables.net/2.1.8/css/dataTables.dataTables.css" />

    <script src="https://cdn.datatables.net/2.1.8/js/dataTables.js"></script>

    <title>Buku-Buku</title>
</head>

<body>



    {{-- Heading --}}
    <div>
        <h1>Data Buku</h1>
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
                        </div>
                    </td>
                </tr>
            @endforeach
        </tbody>
    </table>

    {{-- <div>{{ $data_buku->links() }}</div> --}}
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
                    <form method="POST" action="{{ route('buku.store') }}">
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
                            <input type="text" class="form-control" id="tgl_terbit" name="tgl_terbit"
                                class="date form-control" placeholder="yyyy/mm/dd">
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
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"
    integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous">
</script>

</html>
