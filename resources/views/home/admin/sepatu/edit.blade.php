@extends('layouts.master')
@section('title', 'Data Sepatu')
@section('content')
<div class="content-wrapper">
    <div class="row">
        <div class="col-lg-12 grid-margin stretch-card">
            <div class="card">
                <div class="card-body">
                    <h4 class="card-title">Edit Data Sepatu</h4>
                    {{-- <p class="card-description"> Basic form layout </p> --}}
                    <form class="forms-sample" method="POST" action="/admin/sepatu/{{$sepatu->id}}/update">
                        {{ csrf_field() }}
                        <div class="row">
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Supplier</label>
                                    <select name="id_supplier" id='id_supplier' class="form-control">
                                        <option value="{{$sepatu->id_supplier}}">{{$sepatu->Supplier->nama_supplier}}</option>
                                        @foreach($supplier as $s)
                                        <option value="{{$s->id}}">{{$s->nama_supplier}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="">Nama Sepatu</label>
                                    <input type="text" class="form-control" name="nama_sepatu" id='nama_sepatu' value="{{$sepatu->nama_sepatu}}" placeholder="Nama Sepatu">
                                </div>
                                <div class="form-group">
                                    <label for="">Merk</label>
                                    <input type="text" class="form-control" name="merk" id='merk' value="{{$sepatu->merk}}" placeholder="Merk">
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="">Warna</label>
                                    <input type="text" class="form-control" name="warna" id='warna' value="{{$sepatu->warna}}" placeholder="Warna">
                                </div>
                                <div class="form-group">
                                    <label for="">Stok</label>
                                    <input type="text" class="form-control" name="stok" id='stok' onkeydown="checklen(this, 15)" value="{{$sepatu->stok}}" placeholder="Stok">
                                    <p class="text-danger" id='err-length' style="display: none">Stok Tidak Boleh Melebihi 15 angka!</p>
                                </div>
                                <div class="form-group">
                                    <label for="">Harga</label>
                                    <input type="text" class="form-control"  id='harga' oninput="makeItGood(this, '#hargaasli')" value="Rp {{number_format($sepatu->harga, 0, ',', '.')}}" placeholder="Harga">
                                    <input type="hidden" name="harga" id="hargaasli">
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="">Photo</label>
                            <input type="file" class="form-control" name="photo">
                        </div>
                        <button type="submit" class="btn btn-primary mr-2"><i class="fa fa-save"></i> Submit</button>
                        <a href="/admin/sepatu" class="btn btn-light">Cancel</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    

    // let harga = document.querySelector('#harga');
    // harga.oninput(function() {
    //     console.log('aksjdbasb')
    // })

    // $('#harga').on('input', function() {

    //     let cuk = reset( $(this).val() )
    //         .replace(/\B(?=(\d{3})+(?!\d))/g, ",");

    //     $(this).val(cuk);

    //     $('#hargaasli').val(reset(cuk))
    // });
</script>

<script>
    @if($errors->any())
    newError(@json($errors->all()))
    @endif
</script>
@endsection