@extends('home.profile.master')
@section('title', 'PROFILE')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">PROFIL</h4><br>

                    <form action="/member/profile/change" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Nama</label>
                            <input type="text" class="form-control" name="name" id='name' value="{{$user->name}}" placeholder="Nama">
                        </div>
                        <div class="form-group">
                            <label for="">Username</label>
                            <input type="text" class="form-control" name="username" id='username' value="{{$user->username}}" placeholder="Username">
                        </div>
                        <div class="form-group">
                            <label for="">Password</label>
                            <input type="password" class="form-control" name="password" id='password' value="{{$user->password}}" placeholder="Password" disabled>
                        </div>
                        <div class="form-group">
                            <label for="">Alamat</label>
                            <input type="text" class="form-control" name="alamat" id='alamat' value="{{$user->alamat}}" placeholder="Alamat">
                        </div>
                        <div class="form-group">
                            <label for="">Nomor Telepon</label>
                            <input type="text" class="form-control" name="no_telp" id='no_telp' value="{{$user->no_telp}}" placeholder="Nomor Telepon">
                        </div>
                        <button type="submit" class="btn-sm btn-success">Simpan</button>
                        <button type="button" onclick="Balik('/member/dashboard')" class="btn-sm btn-secondary">Kembali</button>
                        <button type="button" class="btn-sm btn-danger" onclick="Confirem('/member/profile/pass')">Change Pass</button>
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