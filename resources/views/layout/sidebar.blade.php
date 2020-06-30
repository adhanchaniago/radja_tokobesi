 <div class="sidebar" data-color="green">
  <div class="logo">
    <a href="#" class="simple-text logo-mini">
      <img style="border-radius: 50%;" src="{{asset('/images/logo.png')}}">
    </a>
    <a href="#" class="simple-text logo-normal">
      Kasir Online 
    </a>
  </div>
  <div class="sidebar-wrapper" id="sidebar-wrapper">
    <ul class="nav">
      @foreach ($role as $row)
      @if($row->is_admin == 1 && $row->user_id == auth()->user()->id)
      <li class="{{Request::is('admin')?'active':''}}">
        <a href="{{url('admin/')}}">
          <i class="now-ui-icons design_app"></i>
          <p>Beranda</p>
        </a>
      </li>
      @endif

      @if($row->is_akses == 1 && $row->user_id == auth()->user()->id)
      <li class="{{Request::is('admin/akses')?'active':''}}">
        <a href="{{url('/admin/akses/')}}">
          <i class="now-ui-icons education_atom"></i>
          <p>Hak Akses</p>
        </a>
      </li>
      @endif

      @if($row->is_supplier == 1 && $row->user_id == auth()->user()->id)
      <li class="{{Request::is('admin/supplier')?'active':''}}">
        <a href="{{url('/admin/supplier/')}}">
          <i class="now-ui-icons users_circle-08"></i>
          <p>Supplier</p>
        </a>
      </li>
      @endif

      @if($row->is_kategori == 1 && $row->user_id == auth()->user()->id)
      <li class="{{Request::is('admin/category')?'active':''}}">
        <a href="{{url('/admin/category/')}}">
          <i class="now-ui-icons ui-1_bell-53"></i>
          <p>Kategori</p>
        </a>
      </li>
      @endif

      @if($row->is_produk == 1 && $row->user_id == auth()->user()->id)
      <li class="{{Request::is('admin/item')?'active':''}}">
        <a href="{{url('/admin/item/')}}">
          <i class="now-ui-icons files_box"></i>
          <p>Produk</p>
        </a>
      </li>
      @endif

      @if($row->is_order == 1 && $row->user_id == auth()->user()->id)
      <li class="{{Request::is('admin/order')?'active':''}}">
        <a href="{{url('/admin/order/')}}">
          <i class="now-ui-icons shopping_bag-16"></i>
          <p>Order</p>
        </a>
      </li>
      @endif

      @if($row->is_pay == 1 && $row->user_id == auth()->user()->id)
      <li class="{{Request::is('admin/payment')?'active':''}}">
        <a href="{{url('/admin/payment/')}}">
          <i class="now-ui-icons business_money-coins"></i>
          <p>Pembayaran</p>
        </a>
      </li>
      @endif

      @if($row->is_report == 1 && $row->user_id == auth()->user()->id)
      <li class="{{Request::is('admin/report')?'active':''}}">
        <a href="{{url('/admin/report/')}}">
          <i class="now-ui-icons business_badge"></i>
          <p>Laporan Penjualan</p>
        </a>
      </li>
      @endif

      @if($row->is_kas == 1 && $row->user_id == auth()->user()->id)
      <li class="{{Request::is('admin/kas')?'active':''}}">
        <a href="{{url('/admin/kas/')}}">
          <i class="now-ui-icons business_globe"></i>
          <p>Kas</p>
        </a>
      </li>
      @endif
      
      @if($row->is_stok == 1 && $row->user_id == auth()->user()->id)
      <li class="{{Request::is('admin/restock')?'active':''}}">
        <a href="{{url('/admin/restock/')}}">
          <i class="now-ui-icons health_ambulance"></i>
          <p>Restock</p>
        </a>
      </li>
      @endif

      @if($row->is_stok == 1 && $row->user_id == auth()->user()->id)
      <li class="{{Request::is('admin/cabang')?'active':''}}">
        <a href="{{url('/admin/cabang/')}}">
          <i class="now-ui-icons location_compass-05"></i>
          <p>Cabang</p>
        </a>
      </li>
      @endif

      @if($row->is_user == 1 && $row->user_id == auth()->user()->id)
      <li class="{{Request::is('admin/user')?'active':''}}">
        <a href="{{url('/admin/user/')}}">
          <i class="now-ui-icons users_single-02"></i>
          <p>User</p>
        </a>
      </li>
      @endif
      @endforeach
        
      <li>
        <a href="{{url('logout')}}">
          <i class="now-ui-icons business_bank"></i>
          <p>logout</p>
        </a>
      </li>

    </ul>
  </div>
</div>

