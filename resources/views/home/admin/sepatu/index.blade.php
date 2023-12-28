@extends('layouts.master')
@section('title', 'Data Sepatu')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Sepatu <button type="button" class="btn-sm btn-info float-right" data-toggle="modal" data-target="#create"><i class="fa fa-plus"></i> Tambah Data</button></h4>
                    <p class="card-description"> Untuk Mengelola Data Sepatu</p>
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama Sepatu</th>
                                <th>Supplier</th>
                                <th>Merk</th>
                                <th>Warna</th>
                                <th>Harga</th>
                                <th>Stok</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($sepatu as $u)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $u->nama_sepatu }}</td>
                                <td>{{ $u->Supplier->nama_supplier }}</td>
                                <td>{{ $u->merk }}</td>
                                <td>{{ $u->warna }}</td>
                                <td>Rp {{ number_format($u->harga, 2, ',', '.') }}</td>
                                <td>{{ $u->stok }}</td>
                                <td>
                                    <a href="/admin/sepatu/{{$u->id}}/edit" class="btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                    <a class="btn-sm btn-danger" onclick="JanganDelete('/admin/sepatu/{{$u->id}}/destroy')"><i class="fa fa-trash"></i> Hapus</a>
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
<div class="modal fade" tabindex="-1" role="dialog" id="create" aria-labelledby="modal-create" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h4 class="modal-title">Tambah Data Sepatu</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/sepatu/store" method="POST" enctype="multipart/form-data">
                    {{ csrf_field() }}
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Supplier</label>
                                <select name="id_supplier" id='id_supplier' class="form-control">
                                    @foreach($supplier as $s)
                                    <option value="{{$s->id}}">{{$s->nama_supplier}}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="">Nama Sepatu</label>
                                <input type="text" class="form-control" name="nama_sepatu" id='nama_sepatu' value="{{old('nama_sepatu')}}" placeholder="Nama Sepatu">
                            </div>
                            <div class="form-group">
                                <label for="">Merk</label>
                                <input type="text" class="form-control" name="merk" id='merk' value="{{old('merk')}}" placeholder="Merk">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Warna</label>
                                <input type="text" class="form-control" name="warna" id='warna' value="{{old('warna')}}" placeholder="Warna">
                            </div>
                            <div class="form-group">
                                <label for="">Stok</label>
                                <input type="text" class="form-control" name="stok" id='stok' onkeydown="checklen(this, 15)" value="{{old('stok')}}" placeholder="Stok">
                                <p class="text-danger" id='err-length' style="display: none">Stok Tidak Boleh Melebihi 15 angka!</p>
                            </div>
                            <div class="form-group">
                                <label for="">Harga</label>
                                <input type="text" class="form-control" id='harga' oninput="makeItGood(this, '#rawharga')" value="Rp " placeholder="Harga">
                                <input type="hidden" name="harga" id="rawharga">
                            </div>
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="">Photo</label>
                        <input type="file" class="form-control" name="photo">
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary">Close</button>
                <button type="submit" class="btn btn-success"><i class="fa fa-save"></i> Simpan</button>
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