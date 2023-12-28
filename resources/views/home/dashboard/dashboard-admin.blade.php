@extends('layouts.master')
@section('title', 'Dashboard')
@section('content')
<div class="content-wrapper">
    <!-- Quick Action Toolbar Starts-->
    <div class="row quick-action-toolbar">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-header d-block d-md-flex">
                    <h5 class="mb-0">Quick Actions</h5>
                    <p class="ml-auto mb-0">How are your active users trending overtime?<i class="icon-bulb"></i></p>
                </div>
                <div class="d-md-flex justify-content-center row m-0 quick-action-btns" role="group" aria-label="Quick action buttons">
                    @if(Auth::User()->level == 'Admin')
                    <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                        <a href="/admin/member" class="btn px-0"> <i class="icon-user mr-2"></i> Kelola Member</a>
                    </div>
                    @endif
                    {{-- <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                        <a href="" class="btn px-0"><i class="icon-docs mr-2"></i> Create Quote</a>
                    </div> --}}
                    @if(Auth::User()->level == 'Admin' || Auth::User()->level == 'Kasir')
                    <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                        {{-- <a href="" class="btn px-0"><i class="icon-folder mr-2"></i> Tambah Transaksi</a> --}}
                        <a href="/admin/penjualan/create" class="btn px-0"><i class="icon-folder mr-2"></i> Tambah Transaksi</a>
                    </div>
                    <div class="col-sm-6 col-md-3 p-3 text-center btn-wrapper">
                        <a data-target="#rangelaporan" data-toggle="modal" class="btn px-0"><i class="icon-book-open mr-2"></i>Cetak Laporan</a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <!-- Quick Action Toolbar Ends-->
    <div class="row">
        <div class="col-md-12 grid-margin">
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="d-sm-flex align-items-baseline report-summary-header">
                                <h5 class="font-weight-semibold">Ringkasan Transaksi</h5> <span class="ml-auto">Updated Report</span> <button class="btn btn-icons border-0 p-2"><i class="icon-refresh"></i></button>
                            </div>
                        </div>
                    </div>
                    <div class="row report-inner-cards-wrapper">
                        <div class=" col-md -6 col-xl report-inner-card">
                            <div class="inner-card-text">
                                <span class="report-title">SEPATU</span>
                                <h4>{{ $total_sepatu }}</h4>
                                @if(Auth::User()->level == 'Admin')
                                <a href="/admin/sepatu" class="report-count"> See Details</a>
                                @endif
                            </div>
                            <div class="inner-card-icon bg-success">
                                <i class="icon-rocket"></i>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl report-inner-card">
                            <div class="inner-card-text">
                                <span class="report-title">SUPPLIER</span>
                                <h4>{{ $total_supplier }}</h4>
                                @if(Auth::User()->level == 'Admin')
                                <a href="/admin/supplier" class="report-count"> See Details</a>
                                @endif
                            </div>
                            <div class="inner-card-icon bg-danger">
                                <i class="icon-briefcase"></i>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl report-inner-card">
                            <div class="inner-card-text">
                                <span class="report-title">MEMBER</span>
                                <h4>{{ $total_member }}</h4>
                                @if(Auth::User()->level == 'Admin')
                                <a href="/admin/member" class="report-count"> See Details</a>
                                @endif
                            </div>
                            <div class="inner-card-icon bg-warning">
                                <i class="icon-globe-alt"></i>
                            </div>
                        </div>
                        <div class="col-md-6 col-xl report-inner-card">
                            <div class="inner-card-text">
                                <span class="report-title">PENDAPATAN</span>
                                <h4>Rp.{{ number_format($total_minggu->total_price, 0, ',', '.') }}</h4>
                                @if(Auth::User()->level == 'Admin')
                                <a href="/admin/penjualan" class="report-count"> See Details</a>
                                @endif
                            </div>
                            <div class="inner-card-icon bg-primary">
                                <i class="icon-diamond"></i>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <div class="d-sm-flex align-items-center mb-4">
                        <h4 class="card-title mb-sm-0">Histori Transaksi</h4>
                        <a href="/admin/penjualan" class="text-dark ml-auto mb-3 mb-sm-0"> Lihat Semua Penjualan</a>
                    </div>
                    <div class="table-responsive border rounded p-1">
                        <table id="" class="table table-hover">
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
                                        <a href="/admin/penjualan/{{$u->id}}/detail" class="btn-sm btn-info"><i class="fa fa-detail"></i> Detail Transaksi</a>
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
                <button type="submit" class="btn btn-success">Cetak</button>
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