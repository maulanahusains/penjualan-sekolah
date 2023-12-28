@extends('layouts.master')
@section('title', 'Data User')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Data User <button type="button" class="btn-sm btn-info float-right" data-toggle="modal" data-target="#create"><i class="fa fa-plus"></i> Tambah Data</button></h4>
                    <p class="card-description"> Untuk Mengelola Data User</p>
                    <table id="dataTable" class="table table-hover">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Level</th>
                                <th>Tanggal Daftar</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($user as $u)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $u->name }}</td>
                                <td>{{ $u->username }}</td>
                                <td>{{ $u->level }}</td>
                                <td>{{ $u->created_at }}</td>
                                <td>
                                    <a href="/admin/user/{{$u->id}}/pass" class="btn-sm btn-info"><i class="fa fa-key"></i> Ganti Password</a>
                                    <a href="/admin/user/{{$u->id}}/edit" class="btn-sm btn-warning"><i class="fa fa-edit"></i> Edit</a>
                                    <a class="btn-sm btn-danger" onclick="JanganDelete('/admin/user/{{$u->id}}/destroy')"><i class="fa fa-trash"></i> Hapus</a>
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
                <h4 class="modal-title">Tambah Data User</h4>
                <button type="button" class="close" data-dismiss="modal">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="/admin/user/store" method="POST">
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
                        <label for="">Level</label>
                        <select name="level" id='level' class="form-control">
                            <option value="Admin">Admin</option>
                            <option value="Kasir">Kasir</option>
                        </select>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" data-dismiss="modal" class="btn btn-secondary"><i class="fa fa-return"></i> Close</button>
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