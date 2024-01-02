@extends('user.main')
@section('Transaksi','active')
@section('container')

<div class="container">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
            <h2 class="pageheader-title">Data Riwayat Transaksi</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item">Beranda</li>
                            <li class="breadcrumb-item">Riwayat Transaksi</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    @if (session()->has('success'))
        <div class="alert alert-success alert-dismissible" role="alert">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fa fa-check me-2" aria-hidden="true"></i>
                    {{ @session('success') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif

    @if (session()->has('error'))
        <div class="alert alert-danger alert-dismissible" role="alert">
            <div class="d-flex justify-content-between align-items-center">
                <div>
                    <i class="fa fa-exclamation-triangle me-2" aria-hidden="true"></i>
                    &nbsp{{ session()->get('error') }}
                </div>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        </div>
    @endif
    <a href="/beranda" onclick="back()"><i class="fa fa-angle-double-left me-2 mb-3" aria-hidden="true"></i>Kembali</a>
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title fs-5 fw-bold mt-2"> Tabel Transaksi 
                        <div class="dropdown float-end me-4">
                        <button class="btn btn-outline-dark bg-white text-dark fw-bold dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-expanded="false" aria-haspopup="true">
                            All
                        </button>
                        <ul class="dropdown-menu dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <li><a class="dropdown-item" href="{{ url('transaksi') }}">All</a></li>
                            <li><a class="dropdown-item" href="{{ url('trans/barangmasuk') }}">Barang Masuk</a></li>
                            <li><a class="dropdown-item" href="{{ url('trans/barangkeluar') }}">Barang Keluar</a></li>
                        </ul>
                    </div>
                </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableBarang" class="table table-bordered text-dark table-sm" style="" border="1">

                                <thead class="table-primary">
                                    <tr>
                                        <th>Kode Trans</th>
                                        <th>Tanggal Transaksi</th>
                                        <th>UP</th>
                                        <th>ULP</th> 
                                        <th>Aksi</th>  
                                    </tr>
                                </thead>
                                <tbody>
                                    @if ($transaksis->isEmpty())
                                        <p>Tidak ada data yang ditemukan.</p>
                                    @else  
                                        @foreach ($transaksis as $transaksi)
                                        <tr>
                                            <td>{{ $transaksi->kode_trans }}</td>
                                            <td>{{ $transaksi->tanggal_trans }}</td>
                                            <td>{{ $transaksi->up->up_nama }}</td>
                                            <td>{{ optional($transaksi->ulp)->ulp_nama }}</td>
                                            <td>
                                                <a href="{{ route('transaksi.detail', $transaksi->id) }}" class="btn btn-primary">Detail Barang</a>
                                            </td>
                                        </tr>
                                        @endforeach
                                    @endif
                                </tbody>
                            </table>
                            {{ $transaksis->onEachSide(0.5)->links('pagination::bootstrap-5') }}
                        </div>
                    </div>
                </div>
@endsection