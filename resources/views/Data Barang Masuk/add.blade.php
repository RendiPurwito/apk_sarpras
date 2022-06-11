@extends('layout.main')

@section('title', 'Tambah Data Barang')

@section('content')
<div class="card m-5">
    <div class="col-12">
        <div class="bg-light rounded h-100 p-4">
            <h6 class="mb-4">Tambah Barang Masuk</h6>
            <form class="form" action="/insertbarangmasuk" method="post" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="exampleInputEmail1" class="form-label">Nama Barang</label>
                    <select class="form-select" name="barang_id">
                        <option selected>Select Barang</option>
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
                    <label for="exampleInputPassword1" class="form-label">Jumlah Barang Masuk</label>
                    <input type="number" class="form-control" name="stok_masuk">
                    @error('stok_masuk')
                    <div class="text-danger">
                        {{ $message }}
                    </div>
                    @enderror
                </div>
                
                <div class="mb-3">
                    <label for="exampleInputPassword1" class="form-label">Tanggal Masuk</label>
                    <input type="date" class="form-control" name="tanggal_masuk">
                    @error('tanggal_masuk')
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
                <button type="submit" class="btn btn-primary">Submit</button>
            </form>
        </div>
    </div>
</div>
@endsection