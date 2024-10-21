@extends ('layouts')

@section('content')
    {{-- Flash --}}
    @if ($message = Session::get('success'))
        <div class="alert alert-success">
            {{ $message }}
        </div>
    @else
        <div class="alert alert-success">
            You are logged in!
        </div>
    @endif

    <div class="row justify-content-center mt-5">
        <div class="card">
            <div class="card-header">Data Buku</div>
            <table class="display table table-striped" id="table_buku">
                <thead class="thead-dark">
                    <tr>
                        <th>ID</th>
                        <th>Judul Buku</th>
                        <th>Penulis</th>
                        <th>Harga</th>
                        <th>Tanggal Terbit</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data_buku as $buku)
                        <tr>
                            <td>{{ $buku->id }}</td>
                            <td>{{ $buku->judul }}</td>
                            <td>{{ $buku->penulis }}</td>
                            <td>{{ 'Rp. ' . number_format($buku->harga, 2, ',', '.') }}</td>
                            <td>{{ $buku->tgl_terbit->format('d/m/Y') }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
            <div>{{$data_buku->links()}}</div>
        </div>
    </div>
@endsection
