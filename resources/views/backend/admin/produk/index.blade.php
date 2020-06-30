@extends('layout.main')
@section('title', $title)
@section('content')
@include('backend.admin.produk.import')
<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="card-header">
        <h4 class="card-title">{{$title}}</h4>
        <!-- Example split danger button -->
        @if(auth()->user()->level == 'Owner') 
        <div  class="btn-group">
         <a href="{{route('item.create')}}"><button type="button" class="btn btn-success"><i class="now-ui-icons ui-1_simple-add"></i> Tambah</button></a>
         <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          <span class="sr-only">Toggle Dropdown</span>
        </button>
        <div class="dropdown-menu">
          <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modal-edit">Import CSV</a>
          <a href="{{asset('images/format.csv')}}" class="dropdown-item" >Format CSV</a>
        </div>
      </div>
      @endif
    </div>
    <div class="card-body filterable">
      <div class="toolbar">
      </div>
      <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
        <thead>
          <tr>
            <th>No</th>
            <th>Gambar</th>
            <th>Nama</th>
            <th>Cabang Toko</th>
            <th>Merk</th>
            @if((auth()->user()->level == 'Owner') or (auth()->user()->level == 'Purchase'))
            <th>Harga Beli</th>
            @endif
            <th>Harga Jual</th>
            <th>Stock</th>
            <th>Stock Minim</th>
            <th width="18%" class="disabled-sorting text-center">Actions</th>
          </tr>
        </thead>
        <tfoot>
          <tr class="filters">
            <th>#</th>
            <th><input type="text" class="form-control" placeholder="Gambar" disabled></th>
            <th><input type="text" class="form-control" placeholder="Nama" disabled></th>
            <th><input type="text" class="form-control" placeholder="Cabang Toko" disabled></th>
            <th><input type="text" class="form-control" placeholder="Merk" disabled></th>
            @if((auth()->user()->level == 'Owner') or (auth()->user()->level == 'Purchase'))
            <th><input type="text" class="form-control" placeholder="Harga Beli" disabled></th>
            @endif
            <th><input type="text" class="form-control" placeholder="Harga Jual" disabled></th>
            <th><input type="text" class="form-control" placeholder="Stock" disabled></th>
            <th><input type="text" class="form-control" placeholder="Stock Minim" disabled></th>
            
            <th><button class="btn btn-default btn-xs btn-filter"><span class="fa fa-filter"></span> Filter</button></th>
          </tr>
        </tfoot>
        <tbody>
          @php
          $nomor = 1;
          function rupiah($m)
          {
            $rupiah = "Rp ".number_format($m,0,",",".").",-";
            return $rupiah;
          }
          @endphp
          @foreach ($data as $row)
          @if((auth()->user()->level == 'Admin') && ($row->lokasi) == (auth()->user()->lokasi))
          <tr>
            <td>{{$nomor++}}</td>
            <td class="text-center"><img width="70%" height="20%" src="{{ URL::to('/') }}/images/{{ $row->image }}"></td></td>
            <td>{{$row->name}}</td>
            <td>{{$row->lokasi}}</td>
            <td>{{$row->merk}}</td>
            @if((auth()->user()->level == 'Owner') or (auth()->user()->level == 'Purchase'))
            <td>{{rupiah($row->purchase_price)}}</td>
            @endif
            @if($row->price > $row->purchase_price)
            <td>{{rupiah($row->price)}}</td>
            @else
            <td><span class="label bg-red"><b>{{rupiah($row->price)}}</b></span></td>
            @endif
            <td>
              @if ($row->stock < $row->stock_minim )
              <b>{{$row->stock}}</b> {{$row->satuan}}
              @else
              {{$row->stock}} {{$row->satuan}}
              @endif
            </td>
            <td>
             {{$row->stock_minim}} {{$row->satuan}}
           </td>
           <td class="text-right">
             <form id="data-{{ $row->id }}" action="{{route('item.destroy',$row->id)}}" method="post">
              {{csrf_field()}}
              {{method_field('delete')}}
            </form>
            @if((auth()->user()->level == 'Owner') or (auth()->user()->level == 'Purchase' ))

            @if ($row->stock > $row->stock_minim )
            @else
            <form style="float: left;" action="{{route('restock.produk', $row->id)}}" method="post">
              {{ csrf_field() }}
              {{ method_field('PATCH')}}

              <input type="hidden" name="name" value="{{$row->name}}">
              <input type="hidden" name="lokasi" value="{{$row->lokasi}}">
              <input type="hidden" name="satuan" value="{{$row->satuan}}">
              <button type="submit" class="btn btn-round btn-success btn-icon btn-sm like"><i class="fas fa-gas-pump"></i></button>
            </form>
            @endif
            <a href="{{url('admin/produk/'.$row->id.'/edit')}}" data-toggle="modal" data-target="#modal-edit{{$row->id}}" class="btn btn-round btn-info btn-icon btn-sm like"><i class="fas fa-shopping-cart"></i></a>
            <a href="{{url('admin/item/'.$row->id.'/edit')}}"  class="btn btn-round btn-warning btn-icon btn-sm edit"><i class="far fa-calendar-alt"></i></a>
            @csrf
            @method('DELETE')
            <button type="submit" onclick="deleteRow( {{ $row->id }} )" class="btn btn-round btn-danger btn-icon btn-sm remove"><i class="fas fa-times"></i></button>
            @endif
          </td>
        </tr>
        @elseif((auth()->user()->level == 'Owner'))
        <tr>
          <td>{{$nomor++}}</td>
          <td class="text-center"><a href="{{ URL::to('/') }}/images/{{ $row->image }}"><img width="70%" height="20%" src="{{ URL::to('/') }}/images/{{ $row->image }}"></a></td>
          <td>{{$row->name}}</td>
          <td>{{$row->lokasi}}</td>
          <td>{{$row->merk}}</td>
          @if((auth()->user()->level == 'Owner') or (auth()->user()->level == 'Purchase'))
          <td>{{rupiah($row->purchase_price)}}</td>
          @endif
          @if($row->price > $row->purchase_price)
          <td>{{rupiah($row->price)}}</td>
          @else
          <td><span class="label bg-red"><b>{{rupiah($row->price)}}</b></span></td>
          @endif
          <td>
            @if ($row->stock < $row->stock_minim )
            <b>{{$row->stock}}</b> {{$row->satuan}}
            @else
            {{$row->stock}} {{$row->satuan}}
            @endif
          </td>
          <td>
           {{$row->stock_minim}} {{$row->satuan}}
         </td>
         <td class="text-right">
          @if((auth()->user()->level == 'Owner') or (auth()->user()->level == 'Purchase' ))

          @if ($row->stock > $row->stock_minim )
          @else 
          <form style="float: left;" action="{{route('restock.produk', $row->id)}}" method="post">
            {{ csrf_field() }}
            {{ method_field('PATCH')}}

            <input type="hidden" name="name" value="{{$row->name}}">
            <input type="hidden" name="lokasi" value="{{$row->lokasi}}">
            <input type="hidden" name="satuan" value="{{$row->satuan}}">
            <button type="submit" class="btn btn-round btn-success btn-icon btn-sm like"><i class="fas fa-gas-pump"></i></button>
          </form>

          @endif
          <form id="data-{{ $row->id }}" action="{{route('item.destroy',$row->id)}}" method="post">
            {{csrf_field()}}
            {{method_field('delete')}}
          </form>
          <a style="float: left;" href="{{url('admin/produk/'.$row->id.'/edit')}}" data-toggle="modal" data-target="#modal-sold{{$row->id}}"  class="btn btn-round btn- btn-icon btn-sm like"><i class="fas fa-shopping-cart "></i></a>
          <a href="{{url('admin/produk/'.$row->id.'/edit')}}" data-toggle="modal" data-target="#modal-edit{{$row->id}}"  class="btn btn-round btn-info btn-icon btn-sm like"><i class="fas fa-heart"></i></a>
          <a href="{{url('admin/item/'.$row->id.'/edit')}}"  class="btn btn-round btn-warning btn-icon btn-sm edit"><i class="far fa-calendar-alt"></i></a>
          @csrf
          @method('DELETE')
          <button type="submit" onclick="deleteRow( {{ $row->id }} )" class="btn btn-round btn-danger btn-icon btn-sm remove"><i class="fas fa-times"></i></button>
          @endif
        </td>
      </tr>
      @elseif((auth()->user()->level == 'Purchase') && ($row->stock < $row->stock_minim ))
      <tr>
        <td>{{$nomor++}}</td>
        <td class="text-center"><img width="70%" height="20%" src="{{ URL::to('/') }}/images/{{ $row->image }}"></td></td>
        <td>{{$row->name}}</td>
        <td>{{$row->lokasi}}</td>
        <td>{{$row->merk}}</td>
        @if((auth()->user()->level == 'Owner') or (auth()->user()->level == 'Purchase'))
        <td>{{rupiah($row->purchase_price)}}</td>
        @endif
        @if($row->price > $row->purchase_price)
        <td>{{rupiah($row->price)}}</td>
        @else
        <td><span class="label bg-red"><b>{{rupiah($row->price)}}</b></span></td>
        @endif
        <td>
          @if ($row->stock < $row->stock_minim )
          <b>{{$row->stock}}</b> {{$row->satuan}}
          @else
          {{$row->stock}} {{$row->satuan}}
          @endif
        </td>
        <td>
         {{$row->stock_minim}} {{$row->satuan}}
       </td>
       <td class="text-right">
         <form id="data-{{ $row->id }}" action="{{route('item.destroy',$row->id)}}" method="post">
          {{csrf_field()}}
          {{method_field('delete')}}
        </form>
        @if((auth()->user()->level == 'Owner') or (auth()->user()->level == 'Purchase' ))

        @if ($row->stock > $row->stock_minim )
        @else 
        <form  action="{{route('restock.produk', $row->id)}}" method="post">
          {{ csrf_field() }}
          {{ method_field('PATCH')}}

          <input type="hidden" name="name" value="{{$row->name}}">
          <input type="hidden" name="lokasi" value="{{$row->lokasi}}">
          <input type="hidden" name="satuan" value="{{$row->satuan}}">
          <button style="display: block; margin: auto;" type="submit" class="btn btn-round btn-success btn-icon btn-sm like"><i class="fas fa-gas-pump"></i></button>
        </form>
        @endif  
        @endif
      </td>
    </tr>
    @endif

    @endforeach
  </tbody>
</table>
@foreach ($data as $row)

@include('backend.admin.produk.modal')  
@include('backend.admin.produk.sold')  
@endforeach

</div>
</div>
</div>
</div>

@section('script')
<script type="text/javascript"> 
  $(document).ready(function () {
    $('#table-datatables').DataTable({
      "scrollX": true,
      dom: 'Bfrtip',
      buttons: ['copy', 'csv', 'excel', 'pdf', 'print'],
      "footerCallback": function ( row, data, start, end, display ) {
        var api = this.api(), data;

            // Remove the formatting to get integer data for summation
            var intVal = function ( i ) {
              return typeof i === 'string' ?
              i.replace(/[\Rp,]/g, '')*1 :
              typeof i === 'number' ?
              i : 0;
            };

            // Total over all pages
            total = api
            .column( 4 )
            .data()
            .reduce( function (a, b) {
              return intVal(a) + intVal(b);
            }, 0 );

            // Total over this page
            pageTotal = api
            .column( 4, { page: 'current'} )
            .data()
            .reduce( function (a, b) {
              return intVal(a) + intVal(b);
            }, 0 );

            // Update footer
            $( api.column( 4 ).footer() ).html(
              'Rp '+ pageTotal 
              );
          }
        });
  });
</script>

<script type="text/javascript">
  $(document).ready(function(){
    $('.filterable .btn-filter').click(function(){
      var $panel = $(this).parents('.filterable'),
      $filters = $panel.find('.filters input'),
      $tbody = $panel.find('.table tbody');
      if ($filters.prop('disabled') == true) {
        $filters.prop('disabled', false);
        $filters.first().focus();
      } else {
        $filters.val('').prop('disabled', true);
        $tbody.find('.no-result').remove();
        $tbody.find('tr').show();
      }
    });

    $('.filterable .filters input').keyup(function(e){
      /* Ignore tab key */
      var code = e.keyCode || e.which;
      if (code == '9') return;
      /* Useful DOM data and selectors */
      var $input = $(this),
      inputContent = $input.val().toLowerCase(),
      $panel = $input.parents('.filterable'),
      column = $panel.find('.filters th').index($input.parents('th')),
      $table = $panel.find('.table'),
      $rows = $table.find('tbody tr');
      /* Dirtiest filter function ever ;) */
      var $filteredRows = $rows.filter(function(){
        var value = $(this).find('td').eq(column).text().toLowerCase();
        return value.indexOf(inputContent) === -1;
      });
      /* Clean previous no-result if exist */
      $table.find('tbody .no-result').remove();
      /* Show all rows, hide filtered ones (never do that outside of a demo ! xD) */
      $rows.show();
      $filteredRows.hide();
      /* Prepend no-result row if all rows are filtered */
      if ($filteredRows.length === $rows.length) {
        $table.find('tbody').prepend($('<tr class="no-result text-center"><td colspan="'+ $table.find('.filters th').length +'">No result found</td></tr>'));
      }
    });
  });
</script>
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
@include('sweet::alert')
@endsection
@endsection
