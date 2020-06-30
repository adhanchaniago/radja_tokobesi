@extends('layout.main')
@section('title', $title)
@section('content')
<div class="card ">
  <div class="card-header ">
    <h4 class="card-title">{{$title}}</h4>
  </div>
  <div class="card-body ">
    <form method="post" method="post" action="{{route('order.store')}}" class="form-horizontal">
      @csrf
      <div class="row">
        <label class="col-md-2 col-form-label">Cabang Toko</label>
        <div class="col-md-8">
          <div class="form-group">
            <input type="text" name="lokasi" value="{{auth()->user()->lokasi}}" class="form-control" readonly="">
            <input type="hidden" name="keperluan" value="Penjualan" class="form-control" readonly="">
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-md-2 col-form-label">Petugas Kasir</label>
        <div class="col-md-3">
          <div class="form-group">
            <input type="text" name="user_id" value="{{auth()->user()->name}}" class="form-control" readonly="">
          </div>
        </div>
        <label class="col-md-2 col-form-label">Tanggal Pemesanan</label>
        <div class="col-md-3">
          <div class="form-group">
            <input type="text" name="created_at" value="{{date('d F Y')}}" class="form-control" readonly="">
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-md-2 col-form-label">Nomor Pemesanan</label>
        <div class="col-md-3">
          <div class="form-group">
            <input type="text" name="table_number" class="form-control" required="">
          </div>
        </div>
        <label class="col-md-2 col-form-label">Metode Pembayaran</label>
        <div class="col-md-3">
          <div class="form-group">
           <select class="form-control" name="payment_id" required="">
            <option value="">Metode Pembayaran</option>
            @foreach ($data as $row)
            @if ($row->status)
            <option value="{{$row->id}}">{{$row->name}}</option>
            @endif
            @endforeach
          </select>
        </div>
      </div>
    </div>
    <div id="app">
      <div class="row" v-for="(order, index) in orders" :key="index">
        <label class="col-md-2 col-form-label">Order Pesanan</label>
        <div class="col-md-4">
          <div class="form-group">
            <select class="form-control" name="pesanan[]" v-model="order.pesanan">
              @foreach ($pro as $mow)
              @if ($mow->status)
              <option value="{{$mow->id}}">{{$mow->name}}</option>
              @endif
              @endforeach
            </select>
            <input type="hidden" name="nama[]" :value="product_name(order.pesanan, index)">
            <input type="hidden" name="harga[]" :value="product_price(order.pesanan, index)">
            <input type="hidden" name="stock[]" :value="product_stock(order.pesanan, index)">
            <input type="hidden" name="hasil[]" class="form-control" readonly v-model="order.hasil" :value="hasil(order.pesanan, order.jumlah, index)">
          </div>
        </div>
        <label class="col-md-2 col-form-label">Jumlah</label>
        <div class="col-md-3">
          <div class="form-group">
            <input type="number" name="jumlah[]" class="form-control" value="{{old('jumlah')}}" id="inputJumlah" placeholder="ex: 2" v-model="order.jumlah">
          </div>
        </div>
        <label class="col-md-2 col-form-label">Catatan</label>
        <div class="col-md-4">
          <div class="form-group">
            <input type="text" name="note[]" class="form-control" value="{{old('note')}}" id="inputNote" placeholder="Catatan" >
          </div>
        </div>
        <label class="col-md-2 col-form-label">Subtotal</label>
        <div class="col-md-3">
          <div class="form-group">
            <input  type="text" name="subtotal[]" class="form-control" readonly v-model="order.subtotal" :value="subtotal(order.pesanan, order.jumlah, index)">
            <button type="button" class="btn btn-danger btn-sm" @click="delOrder(index)"><i class="fa fa-trash"></i></button>
            <button type="button" class="btn btn-success btn-sm" @click="addOrder()" ><i class="fa fa-plus"></i></button>
          </div>
        </div>
      </div>
      <div class="row">
        <label class="col-md-2 col-form-label">Nama Pembeli</label>
        <div class="col-md-2">
          <div class="form-group">
            <input type="text" name="name" class="form-control" required="">
          </div>
        </div>
        <label class="col-md-2 col-form-label">Nomor Telepon</label>
        <div class="col-md-2">
          <div class="form-group">
            <input type="text" name="notelp" class="form-control" required="">
          </div>
        </div>
        <label class="col-md-1 col-form-label">Diskon</label>
        <div class="col-md-2">
          <div class="form-group">
            <input type="text" name="discount" class="form-control" v-model="discount" required="">
          </div>
        </div>

      </div><br>
      <div style="text-align: center; font-size: 24px;" class="row">
       <div class="col-md-12">
        <input type="hidden" name="total" :value="total" readonly="">
        <b>Total Rp @{{rupiah(total)}}</b>
      </div>
    </div>
  </div>

</div><br>
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
@section('script')
<script src="https://cdnjs.cloudflare.com/ajax/libs/vue/2.6.10/vue.min.js"></script>
<script type="text/javascript">
  new Vue({
    el: '#app',
    data: {
      orders: [
      {pesanan: 0, nama: "", harga: 0, jumlah: 1, subtotal: 0},
      ],
      discount: 0,
      note: "",
    },
    methods: {
      addOrder(){
        var orders = {pesanan: 0, nama: "", harga: 0, jumlah: 1, subtotal: 0};
        this.orders.push(orders);
      },
      delOrder(index){
        if (index > 0){
          this.orders.splice(index,1);
        }
      },
      hasil(pesanan, jumlah, index){
        var hasil  = this.stock[pesanan]- jumlah ;
        this.orders[index].hasil = hasil;
        return hasil;
      },

      subtotal(pesanan, jumlah, index){
        var subtotal  = this.produk[pesanan]*jumlah;
        this.orders[index].subtotal = subtotal;
        return subtotal;
      },
      rupiah(total){
        let val = (total/1).toFixed(2).replace('.', ',')
        return val.toString().replace(/\B(?=(\d{3})+(?!\d))/g, ".")
      },
      product_name(pesanan, index){
        var product_name = this.nama[pesanan];
        this.orders[index].nama = product_name;
        return product_name;
      },
      product_stock(pesanan, index){
        var product_stock = this.stock[pesanan];
        this.orders[index].stock = product_stock;
        return product_stock;
      },
      product_price(pesanan, index){
        var product_price = this.produk[pesanan];
        this.orders[index].harga = product_price;
        return product_price;
      },
    },
    computed: {
      stock(){
        let produk  = [];
        produk[0] = 0;
        @foreach ($pro as $produk)
        produk[{{$produk->id}}]  = {{$produk->stock}}
        @endforeach
        return produk;
      },
      produk(){
        let produk  = [];
        produk[0] = 0;
        @foreach ($pro as $produk)
        produk[{{$produk->id}}]  = {{$produk->price}}
        @endforeach
        return produk;
      },
      nama(){
        let produk  = [];
        produk[0] = 0;
        @foreach ($pro as $produk)
        produk[{{$produk->id}}]  = "{{$produk->name}}"
        @endforeach
        return produk;
      },
      total(){
        var total = this.orders
        .map(order=>order.subtotal)
        .reduce((prev, next)=>prev+next);
        return total - (total * this.discount / 100);
      },
    }
  });
</script>
@endsection
@endsection
