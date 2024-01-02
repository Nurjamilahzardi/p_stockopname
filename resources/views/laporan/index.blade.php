@extends('layouts.main')
@section('Report','active')
@section('container')

<h3 class="mt-4"><center>Laporan Data Stok Opname</center></h3>
<div style="text-align: right;" class="">
    <div>{{ date('d F Y') }}</div>
    <button class="btn btn-outline-secondary hide-on-print" onclick="print()"><i class="fa fa-print"></i> 
    Print</button>
</div>
<div class="container rounded p-2">
    <div class="row hide-on-print">
        <div class="col-12">
            <label for="" class="fw-bold">Filter Tanggal</label>
        </div>
        <div class="col-md-3">
            <form action="{{ route('dashboard.filter') }}" method="POST">
                @csrf
                <div class="form-group">
                    <input type="date" name="tglawal" id="tglawal" class="form-control datepicker-date @error('tglawal') is-invalid @enderror" placeholder="Tanggal Awal" value="@error('tglawal') is-invalid @enderror">
                </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <input type="date" name="tglakhir" id="tglakhir" class="form-control datepicker-date @error('tglakhir') is-invalid @enderror" placeholder="Tanggal Akhir" value="@error('tglakhir') is-invalid @enderror">
            </div>
        </div>
        <div class="col-md-3">
            <div class="form-group">
                <button id="tombolFilter" type="submit" class="btn btn-outline-primary">
                    Filter
                </button>
            </div>
        </form>
        </div>
        <div class="container">
    </div>
</div>
<div class="text-center rounded mt-2">
    <div class="d-flex align-items-center justify-content-between mb-2">
        <div class="mb-0 fs-5 fw-bold">Transaksi</div>
        
    </div>
    <div class="table-responsive">
        <table class="table text-start align-middle table-bordered table-hover mb-0 border-secondary-subtle">
            <thead class="table-primary">
                <tr class="text-dark">
                    <th>Tanggal</th>
                    <th>Nama Barang</th>
                    <th>Merk Barang</th>
                    <th>Barang Masuk</th>
                    <th>Barang Keluar</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($dashboards as $dashboard)
                <tr>
                    <td>{{$dashboard->tanggal_trans}}</td>
                    <td>{{$dashboard->barang_nama}}</td>
                    <td>{{$dashboard->barang_merk}}</td>
                    <td>{{$dashboard->barang_masuk}}</td>
                    <td>{{$dashboard->barang_keluar}}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    <div class="d-flex align-items-center justify-content-between mb-2 mt-4">
        <div class="text-dark">Stok Tersedia :  
        @php
            $totalBarangMasuk = 0;
            $totalBarangKeluar = 0;

            foreach ($dashboards as $dashboard) {
                $totalBarangMasuk += $dashboard->barang_masuk;
                $totalBarangKeluar += $dashboard->barang_keluar;
            }

            $stokTersedia = $totalBarangMasuk - $totalBarangKeluar;
            echo $stokTersedia;
        @endphp
        </div>
    </div>
    <div class="table-responsive">
        <table class="table text-start align-middle table-bordered table-hover mb-5">
            <thead class="table-primary">
                <tr class="text-dark">
                    <th>Kode Barang</th>
                    <th>Nama Barang</th>
                    <th>Merk Barang</th>
                    <th>Jenis Barang</th>
                    <th>Tipe Barang</th>
                    <th>Jumlah Tersedia</th>
                    <th>Satuan</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($Stoks as $stok)
                <tr>
                    <td>{{ $stok->barang->barang_code }}</td>
                    <td>{{ $stok->barang->barang_nama }}</td>
                    <td>{{ $stok->barang->barang_merk }}</td>
                    <td>{{ $stok->barang->barang_jenis }}</td>
                    <td>{{ $stok->barang->barang_tipe }}</td>
                    <td>{{ $stok->jumlah_tersedia }}</td>
                    <td>{{ $stok->barang->barang_satuan }}</td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
<div class="p-4">
    <div style="text-align: right;" class="pt-4">
        <footer class="fs-6">MSB STI OPRS. SUMBAR</footer>
    </div>
</div>
@endsection