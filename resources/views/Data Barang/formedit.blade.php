@extends('layout.main')

@section('title', 'Edit Data Barang')

@section('content')
<div class="card m-5">
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Edit Barang</h6>
            <form class="form" action="/updatebarang/{{ $data->id }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" name="nama_barang" value="{{ $data->nama_barang }}">
                    @error('nama_barang')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Stok Barang</label>
                    <input type="number" class="form-control" name="stok_barang" value="{{ $data->stok_barang }}">
                    @error('stok_barang')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
    
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Jenis Barang</label>
                    <input type="text" class="form-control" name="jenis_barang" value="{{ $data->jenis_barang }}">
                    @error('jenis_barang')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
    
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Foto Barang</label>
                    <div class="form-group">
                        <img src="{{asset('images/'.$data->foto)}}" style="width: 100px">
                    </div>
                    <div class="form-group mt-3">
                        <input type="file" class="form-control" name="foto">
                    </div>
                    @error('foto')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
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