@extends('user.main')

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
    <div style="text-align: center;" class="">
        <div style="display: inline-block; width: 20%;" class="">
            <div class="pt-5 fs-6" style="margin-bottom: 10px;">Tanda Tangan</div>
            <div class="row mb-4">Pengambilah</div>
            <hr style="border-top: 1px solid #000; margin-top: 10px;" class="mt-4">
            <p>{{$trans->penerima}}</p>
        </div>
    </div>
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
