@extends('layouts.master')
@section('title', 'Data Member')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Data Member</h4>
                    {{-- <p class="card-description"> Basic form layout </p> --}}
                    <form class="forms-sample" method="POST" action="/admin/member/{{$member->id}}/update">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="name" id='name' value="{{$member->name}}" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" id='username' value="{{$member->username}}" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" id='password' value="{{$member->password}}" placeholder="Password" disabled>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id='alamat' value="{{$member->alamat}}" placeholder="Alamat">
                        </div>
                        <div class="form-group">
                            <label for="">Nomor Telepon</label>
                            <input type="text" class="form-control" name="no_telp" id='no_telp' onkeydown="checklen(this, 15)" value="{{$member->no_telp}}" placeholder="Nomor Telepon">
                            <p class="text-danger" id='err-length' style="display: none">Nomor Telepon Tidak Boleh Melebihi 15 angka!</p>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Submit</button>
                        <a href="/admin/member" class="btn btn-light">Cancel</a>
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