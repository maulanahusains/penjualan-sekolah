@extends('home.profile.master')
@section('title', 'PROFILE')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">GANTI PASSWORD</h4><br>
                    @if(session('error'))
                    <div class="alert alert-danger">
                        {{session('error')}}
                    </div>
                    @endif
                    @if(session('success'))
                    <script>
                        Sukses({{session('success')}}) //PR
                    </script>
                    @endif
                    <form action="/admin/profile/pass/change" method="post">
                        {{ csrf_field() }}
                        <div class="form-group">
                            <label for="">Password Lama</label>
                            <input type="password" class="form-control" name="old_pass" id='old_pass' value="{{old('old_pass')}}" placeholder="Password Lama">
                        </div>
                        <div class="form-group">
                            <label for="">Password Baru</label>
                            <input type="password" class="form-control" name="password" id='password' onkeyup="cekpass()" onkeydown="cekpass()" value="{{old('password')}}" placeholder="Password Baru">
                        </div>
                        <div class="form-group">
                            <label for="">Ulangi Password Baru</label>
                            <input type="password" class="form-control" name="new_pass" id='new_pass' onkeyup="cekpass()" onkeydown="cekpass()" value="{{old('new_pass')}}" placeholder="Ulangi Password Baru">
                            <p class="text-danger" id='err-pass' style="display: none">Password tidak sama!</p>
                        </div>
                        <button type="submit" class="btn-sm btn-success">Simpan</button>
                        <button type="button" onclick="Balik('/admin/dashboard')" class="btn-sm btn-secondary">Kembali</button>
                        {{-- <button type="button" class="btn-sm btn-danger" onclick="Confirem('/admin/profile/pass')">Change Pass</button> --}}
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection