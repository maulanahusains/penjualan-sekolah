@extends('layouts.master')
@section('title', 'Data User')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Data User</h4>
                    {{-- <p class="card-description"> Basic form layout </p> --}}
                    <form class="forms-sample" method="POST" action="/admin/user/{{$user->id}}/update">
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
                            <label for="">Level</label>
                            <select name="level" id='level' class="form-control">
                                <option value="{{$user->level}}">{{$user->level}}
                                <option value="">-----------</option></option>
                                <option value="Admin">Admin</option>
                                <option value="Kasir">Kasir</option>
                            </select>
                        </div>
                        <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Submit</button>
                        <a href="/admin/user" class="btn btn-light">Cancel</a>
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