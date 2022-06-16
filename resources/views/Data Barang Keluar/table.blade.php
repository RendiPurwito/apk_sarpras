@extends('layout.main')
@section('title', 'Table Data Barang Keluar')
@section('content')

@if (session('status'))
<div class="alert alert-warning alert-dismissible fade show" role="alert">
    {{ session('status') }}
   
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
  </div>
@endif

<section class="section p-5">
    <a href="/tambahbarangkeluar" type="button" class="btn btn-success mb-3">Tambah +</a>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tanggal</th>
                    <th scope="col">Nama Peminjam</th>
                    <th scope="col">Jumlah Barang</th>
                    <th scope="col">Foto</th>
                    <th scope="col">Operator</th>
                    <th scope="col">Keterangan</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
                @foreach($data as $index => $row)
                <tr>
                    <th scope="row">{{ $index + $data->firstItem() }}</th>
                    <td>{{ $row->tanggal_keluar }}</td>
                    <td>{{ $row->nama_peminjam }}</td>
                    <td>{{ $row->jumlah_barang }}</td>
                    <td><img src="{{asset('images/'.$row->foto)}}" style="height: 10vh"></td>
                    <td>{{ $row->name }}</td>
                    <td>{{ $row->keterangan}}</td>
                    <td>
                        <a href="/editbarangkeluar/{{$row->id_barang}}" class="text-warning">
                            <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" fill="currentColor"
                                class="bi bi-pencil-square" viewBox="0 0 16 16">
                                <path
                                    d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                <path fill-rule="evenodd"
                                    d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                            </svg>
                        </a>

                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</section>
@endsection
