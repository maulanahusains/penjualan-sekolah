@extends('layouts.master')
@section('title', 'Data Penjualan')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Penjualan 
                        <a href="/admin/penjualan/create" class="btn-sm btn-info float-right ml-2"><i class="fa fa-plus"></i> Tambah Data</a>
                        <a data-target="#rangelaporan" data-toggle="modal" class="btn-sm btn-primary float-right"><i class="fa fa-print"></i> Cetak Laporan</a>
                    </h4>
                    <p class="card-description"> Untuk Mengelola Data Penjualan</p>
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>No Penjualan</th>
                                <th>Member</th>
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
                                <td>{{ $u->Member->name }}</td>
                                <td>{{ $u->Kasir->name }}</td>
                                <td>{{ $u->tanggal_bayar }}</td>
                                <td>Rp.{{ number_format($u->jumlah_bayar, 0, ',', '.') }}</td>
                                <td>
                                    <a href="/admin/penjualan/{{$u->id}}/detail" class="btn-sm btn-info"><i class="fa fa-print"></i> Detail Transaksi</a>
                                    <a href="/admin/penjualan/{{$u->id}}/edit" class="btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                    <a class="btn-sm btn-danger" onclick="JanganDelete('/admin/penjualan/{{$u->id}}/destroy')"><i class="fa fa-trash"></i> Hapus</a>
                                    {{-- <button class="btn-sm btn-danger" onclick="Delete('/admin/penjualan/{{$u->id}}/destroy')">Hapus</button> --}}
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
<div class="modal fade" tabindex="-1" role="dialog" id="rangelaporan" aria-labelledby="modal-create" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Penjualan</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/penjualan/laporan" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Mulai</label>
                        <input type="date" name="laporanmulai" class="form-control">
                    </div>
                    <div class="form-group">
                        <label for="">Selesai</label>
                        <input type="date" name="laporanselesai" class="form-control">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-print"></i> Cetak</button>
            </form>
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