@extends('layout.main')

@section('title', 'Edit Data Barang Keluar')

@section('content')
<div class="card m-5">
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Edit Barang Keluar</h6>
            <form class="form" action="/updatebarangkeluar/{{ $data->id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Tanggal Masuk</label>
                    <input type="date" class="form-control" name="tanggal_keluar" value="{{ $data->tanggal_keluar }}">
                    @error('tanggal_keluar')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Nama Peminjam</label>
                    <input type="text" class="form-control" name="nama_peminjam" value="{{ $data->nama_peminjam }}">
                </div>

                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                    <select class="form-select" name="barang_id">
                        @foreach($databarang as $data3)
                        <option value="{{$data3->id}}">{{$data3->nama_barang}}</option>
                        @endforeach
                    </select>
                    @error('barang_id')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Jumlah Barang Keluar</label>
                    <input type="number" class="form-control" name="jumlah_barang" value="{{ $data->jumlah_barang }}">
                    @error('jumlah_barang')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>


                {{-- <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Foto Barang</label>
                    <div class="form-group mb-2">
                        <img src="{{asset('images/'.$data->foto)}}" style="width: 100px">
                    </div>
                    <input type="file" class="form-control" name="foto">
                    @error('foto')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div> --}}

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Operator</label>
                    <select class="form-select" name="user_id">
                        @foreach($datauser as $user)
                        <option value="{{$user->id}}">{{$user->name}}</option>
                        @endforeach
                    </select>
                    
                </div>

                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Keterangan</label>
                    <input type="text" class="form-control" name="keterangan" value="{{ $data->keterangan }}">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection