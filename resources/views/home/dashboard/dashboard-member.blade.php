@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex align-items-center mb-4">
                        <h4 class="card-title mb-sm-0">Histori Transaksi</h4>
                        {{-- <a href="/admin/penjualan" class="text-dark ml-auto mb-3 mb-sm-0"> Lihat Semua Penjualan</a> --}}
                    </div>
                    <div class="table-responsive border rounded p-1">
                        <table id="" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>No</th>
                                    <th>No Penjualan</th>
                                    <th>Kasir</th>
                                    <th>Tanggal Bayar</th>
                                    <th>Jumlah Bayar</th>
                                    <th>Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($penjualan as $u)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $u->no_penjualan }}</td>
                                    <td>{{ $u->Kasir->name }}</td>
                                    <td>{{ $u->tanggal_bayar }}</td>
                                    <td>Rp.{{ number_format($u->jumlah_bayar, 0, ',', '.') }}</td>
                                    <td>
                                        <a href="/member/penjualan/{{$u->id}}/detail" class="btn-sm btn-info">Detail Transaksi</a>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
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