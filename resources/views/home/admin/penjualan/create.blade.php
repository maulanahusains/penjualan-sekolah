@extends('layouts.master')
@section('title', 'Data Penjualan')
@section('content')

@php
    $diskons = 0;
    $jumlah_bayar = 0;
    $total = 0;

    foreach ($tempdetail as $k) {
        $total += $k->sub_total;
    }

    if($total >= $diskon->minimal_belanja) {
        $diskons = (int) ($diskon->potongan * $total) / 100;
        $jumlah_bayar = $total - $diskons;
    } else {
        $jumlah_bayar = $total;
    }
@endphp

<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Tambah Data Penjualan</h4>
                    <button type="button" class="btn-sm btn-info" data-toggle="modal" data-target="#addsepatu">Tambah Data</button>
                    {{-- <p class="card-description"> Basic form layout </p> --}}
                    <table class="my-4 table table-bordered">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>SEPATU</th>
                                <th>HARGA</th>
                                <th>QTY</th>
                                <th>SUB TOTAL</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($tempdetail as $t)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $t->Sepatu->nama_sepatu }}</td>
                                <td>Rp {{number_format($t->Sepatu->harga, 2, ',', '.')}}</td>
                                <td>{{ $t->qty }}</td>
                                <td>Rp {{number_format($t->sub_total, 2, ',', '.')}}</td>
                                <td>
                                    <a onclick="Delete('/admin/tempdetail/{{ $t->id }}/destroy')" class="btn-sm btn-danger"><i class="fa fa-trash"></i> Hapus</a>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th colspan="4">Total</th>
                                <td>Rp {{ number_format($total, 2, ',', '.') }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="4">Diskon</th>
                                <td>Rp {{ number_format($diskons, 2, ',', '.') }}</td>
                                <td></td>
                            </tr>
                            <tr>
                                <th colspan="4">Jumlah Bayar</th>
                                <td>Rp {{ number_format($jumlah_bayar, 2, ',', '.') }}</td>
                                <td></td>
                            </tr>
                        </tfoot>
                    </table>
                    <form class="forms-sample" method="POST" action="/admin/penjualan/store">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Member</label>
                            <select class="form-control" name="id_member" id='id_member'>
                                <option value="" hidden>-- Member --</option>
                                @foreach($member as $m)
                                <option value="{{$m->id}}">{{$m->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">No Penjualan</label>
                                    <input type="text" class="form-control" name="no_penjualan" id='no_penjualan' value="{{$no_penjualan}}" placeholder="Nama Sepatu" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Tanggal Bayar</label>
                                    <input type="text" class="form-control" name="tanggal_bayar" id='tanggal_bayar' value="{{date('d/M/Y')}}" placeholder="Merk" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Pembeli Bayar</label>
                                    <input type="text" class="form-control" value="Rp " onkeydown="kembali('{{$jumlah_bayar}}')" onkeyup="kembali('{{$jumlah_bayar}}')" id='pembeli_bayar'>
                                </div>
                                <div class="form-group">
                                    <label for="">Kembalian</label>
                                    <input type="text" class="form-control" id='kembalian' readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="kembalian" id="kembalian2">
                            <input type="hidden" name="pembeli_bayar" id="pembeli_bayar_dua">
                            <input type="hidden" name="total" value="{{$total}}">
                            <input type="hidden" name="diskon" value="{{$diskons}}">
                            <input type="hidden" name="jumlah_bayar" value="{{$jumlah_bayar}}">
                            <input type="hidden" name="id_kasir" value="{{Auth()->User()->id}}">
                        </div>
                        <a href="{{ url()->previous() }}" class="btn btn-secondary">Cancel</a>
                        <button type="submit" class="btn btn-info mr-2"><i class="fa fa-save"></i> Submit</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" tabindex="-1" role="dialog" id="addsepatu" aria-labelledby="modal-create" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Sepatu</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/tempdetail/store" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Nama Sepatu</label>
                        <select class="form-control" name="id_sepatu" id='sepatu'>
                            <option value="" hidden>-- Sepatu --</option>
                            @foreach($sepatu as $m)
                            <option value="{{$m->id}}">{{$m->nama_sepatu}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="selected-option" style="display: none">
                        <center class="my-2">
                            <img src="" id="photo" width="150">
                        </center>
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Merk</label>
                                    <input type="text" class="form-control" name="merk" id='merk' value="" placeholder="Merk" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Warna</label>
                                    <input type="text" class="form-control" name="warna" id='warna' value="" placeholder="Warna" readonly>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Stok</label>
                                    <input type="text" class="form-control" name="stok" id='stok' onkeydown="checklen(this, 15)" value="" placeholder="Stok" readonly>
                                </div>
                                <div class="form-group">
                                    <label for="">Harga</label>
                                    <input type="text" class="form-control" name="harga" id='harga'  value="" placeholder="Harga" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Qty</label>
                            <input type="text" class="form-control" name="qty" id='qty'>
                        </div>
                        <div class="form-group">
                            <input type="hidden" name="no_penjualan" value="{{ $no_penjualan }}">
                            <input type="hidden" name="back" value="/penjualan/create">
                        </div>
                    </div>
            </div>
            <div class="selected-option" style="display: none">
                <div class="modal-footer">
                    <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                    <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</div>

<script>
    $('#id_sepatu').val('-- Sepatu --');
    $(document).ready(function() {
        $('#sepatu').on('change', function() {
            let kode = $(this).val();
            if(kode) {
                $.ajax({
                    url: '/admin/sepatu/' + kode,
                    type: 'GET',
                    data: {
                        '_token': '{{ csrf_token() }}'
                    },
                    dataType: 'json',
                    success: function(data) {
                        if(data) {
                            $('#merk').val(data.merk);
                            $('#harga').val(new Intl.NumberFormat('id', {style: 'currency', currency: 'IDR'}).format(data.harga));
                            $('#stok').val(data.stok);
                            $('#photo').attr('src', 'http://127.0.0.1:8000/storage/shoeimg/' + data.photo);
                            $('#warna').val(data.warna);
                            $('.selected-option').show();
                        }
                    }
                })
            }
        });
    });

    function reset(str) {
        return str.split('.').join('');
    }

    function makeItGood(e, realVal) {
        $(e)
            .val(
                reset(
                    $(e).val()
                )
            .replace(/\B(?=(\d{3})+(?!\d))/g, "."));

        let sliced = ($(e).val()).slice(3);
        $(`${realVal}`).val(reset(sliced));
    }

    function kembali (totalBayar) {
        makeItGood('#pembeli_bayar', '#pembeli_bayar_dua');
        let pembeli_bayar = $('#pembeli_bayar_dua').val();
        let jumlah_bayar = pembeli_bayar - totalBayar;

        if(pembeli_bayar == '' || pembeli_bayar == null || isNaN(pembeli_bayar)) {
            $('#kembalian').val('Rp 0')
            $('#kembalian2').val(0)
            return
        }
        $('#kembalian').val(new Intl.NumberFormat('id', { style: 'currency', currency: 'IDR' }).format(jumlah_bayar))
        $('#kembalian2').val(jumlah_bayar);
        return
    }
</script>

<script>
    @if($errors->any())
    newError(@json($errors->all()))
    @endif
</script>
@endsection