@extends('layouts.master')
@section('title', 'Data Penjualan')
@section('content')


<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Detail Data Penjualan - {{ $penjualan->no_penjualan }}</h4>
                    <table class="my-4 table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>SEPATU</th>
                                <th>HARGA</th>
                                <th>QTY</th>
                                <th>SUB TOTAL</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($detail as $t)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $t->Sepatu->nama_sepatu }}</td>
                                <td>Rp {{number_format($t->Sepatu->harga, 2, ',', '.')}}</td>
                                <td>{{ $t->qty }}</td>
                                <td>Rp {{number_format($t->sub_total, 2, ',', '.')}}</td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Total</th>
                                <td>Rp {{ number_format($penjualan->total, 2, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th colspan="4">Diskon</th>
                                <td>Rp {{ number_format($penjualan->diskon, 2, ',', '.') }}</td>
                            </tr>
                            <tr>
                                <th colspan="4">Jumlah Bayar</th>
                                <td>Rp {{ number_format($penjualan->jumlah_bayar, 2, ',', '.') }}</td>
                            </tr>
                        </tfoot>
                    </table>
                    <form class="forms-sample" method="POST" action="/admin/penjualan/store">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Pembeli</label>
                            <input type="text" class="form-control" value="{{ $penjualan->Member->name }}" readonly>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">No Penjualan</label>
                                    <input type="text" class="form-control" name="no_penjualan" id='no_penjualan' value="{{$penjualan->no_penjualan}}" placeholder="Nama Sepatu" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Bayar</label>
                                    <input type="text" class="form-control" name="tanggal_bayar" id='tanggal_bayar' value="{{$carbon::createFromFormat('Y-m-d', $penjualan->tanggal_bayar)->format('d/M/Y')}}" placeholder="Merk" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Pembeli Bayar</label>
                                    <input type="text" class="form-control" value="Rp {{ number_format($penjualan->pembeli_bayar,2 ,',', '.') }}" name="pembeli_bayar" id='pembeli_bayar' readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Kembalian</label>
                                    <input type="text" class="form-control" id='kembalian' value="Rp {{ number_format($penjualan->kembalian,2 ,',', '.') }}" readonly>
                                </div>
                            </div>
                        </div>
                        <a href="{{url()->previous()}}" class="btn btn-secondary">Kembali</a>
                        <a href="/admin/penjualan/{{$penjualan->id}}/struk" class="btn btn-info mr-2"><i class="fa fa-print"></i> Cetak Struk</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    @if($errors->any())
    newError(@json($errors->all()))
    @endif
</script>
@endsection