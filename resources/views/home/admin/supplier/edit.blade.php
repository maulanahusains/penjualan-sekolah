@extends('layouts.master')
@section('title', 'Data Supplier')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Data Supplier</h4>
                    {{-- <p class="card-description"> Basic form layout </p> --}}
                    <form class="forms-sample" method="POST" action="/admin/supplier/{{$supplier->id}}/update">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Nama Supplier</label>
                            <input type="text" class="form-control" name="nama_supplier" id='nama_supplier' value="{{$supplier->nama_supplier}}" placeholder="Nama Supplier">
                        </div>
                        <div class="form-group">
                            <label for="">Nama Perusahaan</label>
                            <input type="text" class="form-control" name="nama_perusahaan" id='nama_perusahaan' value="{{$supplier->nama_perusahaan}}" placeholder="Nama Perusahaan">
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id='alamat' value="{{$supplier->alamat}}" placeholder="Alamat">
                        </div>
                        <div class="form-group">
                            <label for="">Nomor Telepon</label>
                            <input type="text" class="form-control" name="no_telp" id='no_telp' onkeydown="checklen(this, 15)" value="{{$supplier->no_telp}}" placeholder="Nomor Telepon">
                            <p class="text-danger" id='err-length' style="display: none">Nomor Telepon Tidak Boleh Melebihi 15 angka!</p>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Submit</button>
                        <a href="/admin/supplier" class="btn btn-light">Cancel</a>
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