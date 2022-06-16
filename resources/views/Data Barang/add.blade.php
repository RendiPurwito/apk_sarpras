@extends('layout.main')

@section('title', 'Tambah Data Barang')

@section('content')
<div class="card m-5">
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Tambah Barang</h6>
            <form class="form" action="/insertbarang" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                    <input type="text" class="form-control" name="nama_barang">
                    @error('nama_barang')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
    
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Jenis Barang</label>
                    <input type="text" class="form-control" name="jenis_barang">
                    @error('jenis_barang')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
    
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Foto Barang</label>
                    <input type="file" class="form-control" name="foto">
                    @error('foto')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
    
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Keterangan</label>
                    <input type="text" class="form-control" name="keterangan">
                </div>
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection