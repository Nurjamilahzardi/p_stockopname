@extends('layouts.main')
@section('Transaksi','active')
@section('container')

<h5 style="text-align: center;">Cetak Barang Masuk</h5>
<style>
    .margin-end {
        margin-inline-end: 35px; /* Sesuaikan nilai sesuai kebutuhan */
    }
</style>
    <div>
        <strong>Tanggal Transaksi </strong>: {{ \Carbon\Carbon::parse($trans->tanggal_trans)->format('d F Y') }}
    </div>
    <div>
        <strong class="margin-end">Unit Pengatur</strong>: {{ $trans->up_nama }}
    </div>

<div class="container">
    <table id="tableBarang" class="table table-bordered text-dark table-sm" style="text-align: center;" border="1">
        <thead class="table-primary">
            <tr>
                <th>No</th>
                <th>Kode Barang</th>
                <th>Nama Barang</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($detail as $item)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $item->barang_code }}</td>
                    <td>{{ $item->barang_nama }}</td>
                    <td>{{ $item->jumlah }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</div>

<div style="text-align: center; margin-top: 20px;">
    <a href="/transaksi" class="btn btn-primary hide-on-print">Kembali ke Transaksi</a>
    <button onclick="konfirmasiCetak()" class="btn btn-success hide-on-print">Cetak</button>
</div>

<script>
    function konfirmasiCetak() {
        if (confirm("Apakah Anda yakin ingin mencetak?")) {
            window.print();
        }
    }
</script>
@endsection
