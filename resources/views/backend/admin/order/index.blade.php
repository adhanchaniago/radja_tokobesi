@extends('layout.main')
@section('title', $title)
@section('content')
<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$title}}</h4>
                <!-- Example split danger button -->
                <div  class="btn-group">
                   <a href="{{route('order.create')}}"><button type="button" class="btn btn-success"><i class="now-ui-icons ui-1_simple-add"></i> Tambah</button></a>
                   <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    <span class="sr-only">Toggle Dropdown</span>
                </button>
            </div>
            
        </div>
        <div class="card-body">
            <div class="toolbar">
            </div>
            <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
                <thead>
                    <tr>
                        <th>No</th>
                        <th width="12%">Nomor Pelanggan</th>
                        <th>Nama Pelanggan</th>
                        <th>Kasir</th>
                        <th>Cabang</th>
                        <th>No Telepon</th>
                        <th>Dipesan</th>
                        <th class="disabled-sorting text-right">Actions</th>
                    </tr>
                </thead>
                <tfoot>
                    <tr>
                        <th>No</th>
                        <th>Nomor Pelanggan</th>
                        <th>Nama Pelanggan</th>
                        <th>Kasir</th>
                        <th>Cabang</th>
                        <th>No Telepon</th>
                        <th>Dipesan</th>
                        <th class="disabled-sorting text-right">Actions</th>
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
                    @if ($row->keperluan == 'Penjualan')
                    <tr>
                        <td>{{$nomor++}}</td>
                        <td>{{$row->table_number}}</td>
                        <td>{{$row->name}}</td>
                        <td>{{$row->user->name}}</td>
                        <td>{{$row->lokasi}}</td>
                        <td><a target="_blank" href="https://api.whatsapp.com/send?phone={{$row->notelp}}" class="btn btn-success" ><i class="fas fa-upload"></i> {{$row->notelp}}</a></td>
                        <td>{{$row->created_at}}</td>
                        <td class="text-center">
                            <form id="data-{{ $row->id }}" action="{{route('order.destroy',$row->id)}}" method="post">
                                {{csrf_field()}}
                                {{method_field('delete')}}
                            </form>
                            <a href="{{url('admin/order/'.$row->id.'/edit')}}" data-toggle="modal" data-target="#modal-edit{{$row->id}}"  class="btn btn-round btn-info btn-icon btn-sm like"><i class="fas fa-heart"></i></a>
                            @csrf
                            @method('DELETE')
                            @if(auth()->user()->level == 'Owner') 

                            <button type="submit" onclick="deleteRow( {{ $row->id }} )" class="btn btn-round btn-danger btn-icon btn-sm remove"><i class="fas fa-times"></i></button>
                            @endif
                        </td>
                    </tr>
                    @endif
                    @endforeach
                </tbody>
            </table>
            @foreach ($data as $row)
            @include('backend.admin.order.modal')  
            @endforeach
        </div>
    </div>
</div>
</div>
</div>
<script src="https://code.jquery.com/jquery-3.3.1.min.js"></script
@endsection
