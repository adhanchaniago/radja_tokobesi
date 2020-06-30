@extends('layout.main')
@section('title', $title)
@section('content')
<div class="card ">
  <div class="card-header ">
    <h4 class="card-title">{{$title}}</h4>
  </div>
  <div class="card-body ">
    <form method="post" method="post" action="{{route('item.store')}}" class="form-horizontal" enctype="multipart/form-data" >
      @csrf
      <div class="row">
        <label class="col-md-3 col-form-label">Kategori</label>
        <div class="col-md-9">
          <div class="form-group">
            <select class="form-control" required="" name="category">
              <option value=""> -- Silahkan Pilih Kategori -- </option>
              @foreach ($data as $row)
              <option class="form-control" value="{{$row->id}}">{{$row->name}}</option>
              @endforeach
            </select>
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-md-3 col-form-label">Nama</label>
        <div class="col-md-9">
          <div class="form-group">
            <input type="text" name="name" class="form-control" required="">
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-md-3 col-form-label">Merk</label>
        <div class="col-md-9">
          <div class="form-group">
            <input type="text" name="merk" class="form-control" required="">
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-md-3 col-form-label">Harga Beli</label>
        <div class="col-md-3">
          <div class="form-group">
            <input id="masking1" type="text" name="purchase_price" class="form-control" required="">
          </div>
        </div>
        <label class="col-md-3 col-form-label">Harga Jual</label>
        <div class="col-md-3">
          <div class="form-group">
            <input id="masking2" type="text" name="price" class="form-control" required="">
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-md-3 col-form-label">Stock</label>
        <div class="col-md-3">
          <div class="form-group">
            <input type="text" name="stock" class="form-control" required="">
          </div>
        </div>
        <label class="col-md-3 col-form-label">Stock Minim</label>
        <div class="col-md-3">
          <div class="form-group">
            <input type="text" name="stock_minim" class="form-control" required="">
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-md-3 col-form-label">Status</label>
        <div class="col-md-3">
          <div class="form-group">
            <div class="form-check form-check-radio">
              <label class="form-check-label">
                <input name="status" value="1" class="form-check-input" type="radio" name="exampleRadio" id="exampleRadios3" value="option1">
                <span class="form-check-sign"></span>
                Ada
              </label>
              <label class="form-check-label">
                <input  name="status" value="0"  class="form-check-input" type="radio" name="exampleRadio" id="exampleRadios3" value="option1">
                <span class="form-check-sign"></span>
                Tidak Ada
              </label>
            </div>
          </div>
        </div>
        <label class="col-md-3 col-form-label">Satuan</label>
        <div class="col-md-2">
          <div class="form-group">
            <input type="text" name="satuan" class="form-control" required="">
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-md-3 col-form-label">Cabang Toko</label>
        <div class="col-md-9">
          <div class="form-group">
           <select name="nama_cabang" class="form-control" required="">
            <option value=""> -- Silahkan Pilih Cabang -- </option>
            @foreach ($cabang as $row)
            <option class="form-control" value="{{$row->nama_cabang}}">{{$row->nama_cabang}}</option>
            @endforeach
          </select>
        </div>
      </div>
    </div>
    <div class="row">
      <label class="col-md-3 col-form-label">Gambar Produk</label>
      <div class="col-md-9">
        <div class="form-group">
          <span class="btn btn-rose btn-round btn-file">
            <span class="fileinput-new">Pilih Gambar</span>
            <input type="file" name="image" id="image" required="">
          </span>
        </div>
      </div>
    </div>
    <div class="row">
      <label class="col-md-3"></label>
      <div class="col-md-9">
        <div class="form-check">
          <label class="form-check-label">
            <input class="form-check-input" type="checkbox">
            <span class="form-check-sign"></span>
            Ingatkan Saya 
          </label>
        </div>
      </div>
    </div>
  </div>
  <div class="card-footer ">
    <div class="row">
      <label class="col-md-3"></label>
      <div class="col-md-9">
        <button type="reset" class="btn btn-fill btn-danger">Reset</button>
        <button type="submit" class="btn btn-fill btn-success">Masuk</button>
      </div>
    </div>
  </div>
</form>

</div>
@endsection
