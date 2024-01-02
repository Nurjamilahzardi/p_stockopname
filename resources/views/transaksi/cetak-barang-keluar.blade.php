@extends('layouts.main')
@section('Transaksi','active')
@section('container')

<h5 style="text-align: center;">Cetak Barang Keluar</h5>
<style>
    .margin-end {
        margin-inline-end: 35px; /* Sesuaikan nilai sesuai kebutuhan */
    }

</style>
    <div>
        <strong style="margin-inline-end:8px;">Tanggal Transaksi </strong>: {{ $trans->created_at->format('d F Y') }}
    </div>
    <div>
        <strong style="margin-inline-end:40px;">Unit Pengatur</strong> : {{ $trans->up_nama }}
    </div>
    @if(Auth::check())
        <div>
            @if(Auth::user()->role == 'admin')
                <strong class="">Pihak Pengambilan</strong> : 
                @if($trans->role == 'admin')
                    {{$trans->penerima}}
                @else
                    {{ $trans->name }}
                @endif
            @elseif(Auth::user()->role == 'user')
                <strong class="me-2">Pihak Penerima</strong>:  {{ $trans->name }}
            @endif
        </div>
    @endif
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
    @if(Auth::check())
        <div>
            @if(Auth::user()->role == 'admin')
            <div style="display: flex; justify-content: flex-end; align-items: flex-start;">
                <div style="width: 30%;">
                    <div class="pt-5 fs-6 text-center" style="margin-bottom: 10px;">Padang, {{$trans->created_at->format('d F Y')}}</div>
                    <div class="fs-6 text-center" style="margin-bottom: 50px;">Tanda Tangan</div>
                    <hr style="border-top: 1px solid #000; margin-top: 10px;" class="mt-4">
                    @if($trans->role == 'admin')
                    <p class="text-center">{{$trans->penerima}}</p>
                    @else
                    <p class="text-center">{{$trans->name}}</p>
                    @endif
            @elseif(Auth::user()->role == 'user')
            <div style="display: flex; justify-content: flex-end; align-items: flex-start;">
                <div style="width: 30%;">
                    <div class="pt-5 fs-6 text-center" style="margin-bottom: 10px;">Padang, {{$trans->created_at->format('d F Y')}}</div>
                    <div class="fs-6 text-center" style="margin-bottom: 50px;">Tanda Tangan</div>
                    <hr style="border-top: 1px solid #000; margin-top: 10px;" class="mt-4">
                    <p class="text-center">{{$trans->name}}</p>
                </div>
            </div>
            @endif
        </div>
    @endif
    
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
