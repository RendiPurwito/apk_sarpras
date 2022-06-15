@extends('layout.main')
@section('title', 'Dashboard')
@section('content')
    <div class="container pt-4 px-4">
        <div class="row g-4">
            <div class="col-sm-6 col-xl-6">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-line fa-3x text-primary"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-2">Data Barang</p>
                        <h6 class="mb-0">{{$databarang}} Barang</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-6">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-bar fa-3x text-primary"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-2">Data Barang Masuk</p>
                        <h6 class="mb-0">{{$datamasuk}} Barang</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-6">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-area fa-3x text-primary"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-2">Data Barang Keluar</p>
                        <h6 class="mb-0">{{$datakeluar}} Barang</h6>
                    </div>
                </div>
            </div>
            <div class="col-sm-6 col-xl-6">
                <div class="bg-light rounded d-flex align-items-center justify-content-between p-4">
                    <i class="fa fa-chart-pie fa-3x text-primary"></i>
                    <div class="ms-3 text-end">
                        <p class="mb-2">Data Operator</p>
                        <h6 class="mb-0">{{$datauser}} Data</h6>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection