@extends('layout.main')
@section('title', $title)
@section('content')
<div class="card ">
  <div class="card-header ">
    <h4 class="card-title">{{$title}}</h4>
  </div>
  <div class="card-body ">
    <form method="post"  enctype="multipart/form-data" method="post" action="{{route('item.update', $data->id)}}" class="form-horizontal">
      @csrf
      @method('PUT')
      <div class="row">
        <label class="col-md-3 col-form-label">Kategori</label>
        <div class="col-md-9">
          <div class="form-group">
            <select class="form-control" required="" name="category">
              <option value=""> -- Silahkan Pilih Kategori -- </option>
              @foreach ($cat as $row)
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
            <input type="text" name="name" value="{{$data->name}}" class="form-control" required="">
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-md-3 col-form-label">Merk</label>
        <div class="col-md-9">
          <div class="form-group">
            <input type="text" name="merk"  value="{{$data->merk}}" class="form-control" required="">
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-md-3 col-form-label">Harga Beli</label>
        <div class="col-md-3">
          <div class="form-group">
            <input id="masking1" type="text" name="purchase_price"  value="{{$data->purchase_price}}" class="form-control" required="">
          </div>
        </div>
        <label class="col-md-3 col-form-label">Harga Jual</label>
        <div class="col-md-3">
          <div class="form-group">
            <input id="masking2" type="text" name="price"  value="{{$data->price}}" class="form-control" required="">
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-md-3 col-form-label">Stock</label>
        <div class="col-md-3">
          <div class="form-group">
            <input type="text" name="stock"  value="{{$data->stock}}" class="form-control" required="">
          </div>
        </div>
        <label class="col-md-3 col-form-label">Stock Minim</label>
        <div class="col-md-3">
          <div class="form-group">
            <input type="text" name="stock_minim"  value="{{$data->stock_minim}}" class="form-control" required="">
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
            <input type="text" value="{{$data->satuan}}" name="satuan" class="form-control" required="">
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
      <div class="col-md-1">
        <div class="form-group">
          <img width="100%" height="20%" src="{{ URL::to('/') }}/images/{{ $data->image }}">
        </div>
      </div>
      <div class="col-md-6">
        <div class="form-group">
          <span class="btn btn-rose btn-round btn-file">
            <span class="fileinput-new">Update Gambar</span>
            <input type="file" name="image" id="image" required="">
            <input type="hidden" name="hidden_image" value="{{ $data->image }}" />
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