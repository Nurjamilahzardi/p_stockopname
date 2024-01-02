@extends('layouts.main')
@section('BarangUnit', 'active')
@section('container')

<div class="container">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
            <h2 class="pageheader-title ">Data Barang {{Auth::user()->up->up_nama}}</h2>
                <div class="page-breadcrumb">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item active" aria-current="page">Data Barang Unit</li>
                        </ol>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-xl-12">
            <div class="card custom-card">
                <div class="card-header">
                    <div class="card-title fs-5 fw-bold mt-2"> Tabel Barang </div>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tableBarang" class="table table-bordered text-dark table-sm" style="" border="1">
                            <div class="mb-3">
                                
                                <div class="col-sm-2 float-end mb-2">
                                    <form action="/barang-unit" method="get" class="form-inline" onsubmit="">
                                        <input class="form-control form-control-sm" type="text" name="search" placeholder="Search" value="{{request('search')}}">
                                    </form>
                                <div>
                            </div>
                            <thead class="table-primary">
                                <tr>
                                    <th>Kode Barang</th>
                                    <th>Nama Barang</th>
                                    <th>Merk Barang</th>
                                    <th>Jenis Barang</th>
                                    <th>Tipe Barang</th>
                                    <th>Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                                @if ($Details->isEmpty())
                                    <p>Tidak ada data yang ditemukan.</p>
                                @else
                                    @foreach ($Details as $detail)
                                        <tr>
                                            <td>{{ $detail->barang_code }}</td>
                                            <td>{{ $detail->barang_nama }}</td>
                                            <td>{{ $detail->barang_merk }}</td>
                                            <td>{{ $detail->barang_jenis }}</td>
                                            <td>{{ $detail->barang_tipe }}</td>
                                            <td>{{ $detail->barang_satuan }}</td>
                                        </tr>
                                    @endforeach
                                @endif
                            </tbody>
                        </table>
                        {{ $Details->onEachSide(0.5)->links('pagination::bootstrap-5') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection