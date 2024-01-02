@extends('layouts.main')
@section('UP2D','active')
@section('container')

<style>
.table-responsive {
    overflow-x: auto;
}
.table-transaksi {
    font-size: 12px; /* Ganti dengan ukuran teks yang Anda inginkan */
}

/* Tabel Ketersediaan Stok Barang */
.table-ketersediaan {
    font-size: 12px; /* Ganti dengan ukuran teks yang Anda inginkan */
}
.table {
    min-width: 100%;
    width: auto;
    table-layout: auto;
}
.rounded-card {
    width: 100%; /* Ganti dengan persentase yang diinginkan */
    height: auto;
    border-radius: 50px;
}
.card {
    max-width: 100%; /* Ganti dengan persentase atau nilai maksimum yang diinginkan */
}
</style>
<div class="container">
    <div class="row">
        <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="page-header">
                <h2 class="pageheader-title text-center">UP2D</h2>
            </div> 
        </div>
    </div>
</div>
<div class="container">
    <div class="row mt-3">
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="bg-light rounded p-4 d-flex align-items-center">
                <i class="fa fa-inbox fa-3x text-primary me-4"></i>
                <div>
                    <p class="mb-2">Stok Tersedia</p>
                    <h6 class="mb-0">
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
                    </h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="bg-light rounded p-4 d-flex align-items-center">
                <i class="fas fa-box-open fa-3x text-primary me-4"></i>
                <div>
                    <p class="mb-2">Data Barang</p>
                    <h6 class="mb-0">{{ $totalBarang }}</h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="bg-light rounded p-4 d-flex align-items-center">
                <i class="fa fa-arrow-circle-down fa-3x text-primary me-4"></i>
                <div>
                    <p class="mb-2">Barang Masuk</p>
                    <h6 class="mb-0">
                        @php
                            $totalBarangMasuk = 0;
                            foreach ($dashboards as $dashboard) {
                                $totalBarangMasuk += $dashboard->barang_masuk;
                            }
                            echo $totalBarangMasuk;
                        @endphp
                    </h6>
                </div>
            </div>
        </div>
        <div class="col-xl-3 col-lg-6 col-md-6 col-sm-6 col-12">
            <div class="bg-light rounded p-4 d-flex align-items-center">
                <i class="fa fa-arrow-circle-up fa-3x text-primary me-4"></i>
                <div>
                    <p class="mb-2">Barang Keluar</p>
                    <h6 class="mb-0">
                        @php
                            $totalBarangKeluar = 0;
                            foreach ($dashboards as $dashboard) {
                                $totalBarangKeluar += $dashboard->barang_keluar;
                            }
                            echo $totalBarangKeluar;
                        @endphp
                    </h6>
                </div>
            </div>
        </div>
    </div>
</div>
<div class="container">
    <div class="row mt-3">
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header fs-5 fw-bold">Tabel Transaksi 
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table text-start align-middle text-sm table-bordered table-hover mb-3 table-transaksi">
                            <thead class="bg-light">
                                <tr class="text-dark">
                                    <th scope="col">Nama Barang</th>
                                    <th scope="col">Merk Barang</th>
                                    <th scope="col">Barang Masuk</th>
                                    <th scope="col">Barang Keluar</th>
                                </tr>
                            </thead>
                            <tbody id="tabelTransaksi">
                                @foreach ($dashboards as $dashboard)
                                <tr>
                                    <td>{{ $dashboard->barang_nama }}</td>
                                    <td>{{ $dashboard->barang_merk }}</td>
                                    <td>{{ $dashboard->barang_masuk }}</td>
                                    <td>{{ $dashboard->barang_keluar }}</td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        <div class="float-end mb-2 me-2">
                            
                            <button class="btn text-primary btn-sm " onclick="showPrevious()">Previous</button> |
                            <button class="btn text-primary btn-sm" onclick="showNext()">Next</button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-xl-6 col-lg-12 col-md-12 col-sm-12 col-12">
            <div class="card">
                <div class="card-header fs-5 fw-bold">Tabel Ketersediaan Stok Barang
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="tabelTersedia" class="table text-start align-middle table-bordered table-hover mb-0 table-ketersediaan">
                            <thead class="bg-light">
                                <tr class="text-dark">
                                    <th>Kode</th>
                                    <th>Nama Barang</th>
                                    <th>Merk Barang</th>
                                    <th>Jenis Barang</th>
                                    <th>Tipe Barang</th>
                                    <th>Jumlah Tersedia</th>
                                    <th>Satuan</th>
                                </tr>
                            </thead>
                            <tbody>
                            @foreach ($Stoks as $index => $stok)
                                <tr class="data-row" style="{{ $index >= 5 ? 'display: none;' : '' }}">
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
                        <div class="float-end me-2 mt-3 mb-2">
                            <button class="btn text-primary btn-sm " onclick="showPreviousRows()">Previous</button> |
                            <button class="btn text-primary btn-sm" onclick="showNextRows()">Next</button>
                           
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
