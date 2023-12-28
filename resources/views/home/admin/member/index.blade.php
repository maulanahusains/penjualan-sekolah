@extends('layouts.master')
@section('title', 'Data Member')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data Member <button type="button" class="btn-sm btn-info float-right" data-toggle="modal" data-target="#create"><i class="fa fa-plus"></i> Tambah Data</button></h4>
                    <p class="card-description"> Untuk Mengelola Data Member</p>
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Alamat</th>
                                <th>Nomor Telepon</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($member as $u)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->username }}</td>
                                <td>{{ $u->alamat }}</td>
                                <td>{{ $u->no_telp }}</td>
                                <td>
                                    <a href="/admin/member/{{$u->id}}/pass" class="btn-sm btn-info"><i class="fa fa-key"></i> Ganti Password</a>
                                    <a href="/admin/member/{{$u->id}}/edit" class="btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                    <a class="btn-sm btn-danger" onclick="JanganDelete('/admin/member/{{$u->id}}/destroy')"><i class="fa fa-trash"></i> Hapus</a>
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
                <h4 class="modal-title">Tambah Data Member</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/member/store" method="POST">
                    {{ csrf_field() }}
                    <div class="form-group">
                        <label for="">Nama</label>
                        <input type="text" class="form-control" name="name" id='name' value="{{old('name')}}" placeholder="Nama">
                    </div>
                    <div class="form-group">
                        <label for="">Username</label>
                        <input type="text" class="form-control" name="username" id='username' value="{{old('username')}}" placeholder="Username">
                    </div>
                    <div class="form-group">
                        <label for="">Password</label>
                        <input type="password" class="form-control" name="password" id='password' value="{{old('password')}}" placeholder="Password">
                    </div>
                    <div class="form-group">
                        <label for="">Alamat</label>
                        <input type="text" class="form-control" name="alamat" id='alamat' value="{{old('alamat')}}" placeholder="Alamat">
                    </div>
                    <div class="form-group">
                        <label for="">Nomor Telepon</label>
                        <input type="text" class="form-control" name="no_telp" id='no_telp' onkeydown="checklen(this, 15)" value="{{old('no_telp')}}" placeholder="Nomor Telepon">
                        <p class="text-danger" id='err-length' style="display: none">Nomor Telepon Tidak Boleh Melebihi 15 angka!</p>
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