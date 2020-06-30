@extends('layout.main')
@section('title', $title)
@section('content')

<div class="row">
    <div class="col-md-12">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">{{$title}}</h4>
                <!-- Example split danger button -->
                @if(auth()->user()->level == 'Owner') 
                <div  class="btn-group">
                    <a href="{{route('supplier.create')}}"><button type="button" class="btn btn-success"><i class="now-ui-icons ui-1_simple-add"></i> Tambah</button></a>
                    <button type="button" class="btn btn-success dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                        <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu">
                        <a class="dropdown-item" href="{{route('supplier.pdf')}}">Import</a>
                    </div>
                </div>
                @endif
            </div>
            <div class="card-body">
                <div class="toolbar">
                </div>
                <table id="table_id" class="table table-striped table-bordered" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Perusahaan</th>
                            <th>Produk</th>
                            <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                    </thead>
                    <tfoot>
                        <tr>
                            <th>No</th>
                            <th>Nama</th>
                            <th>Perusahaan</th>
                            <th>Produk</th>
                            <th class="disabled-sorting text-right">Actions</th>
                        </tr>
                    </tfoot>
                    <tbody>
                        @php
                        $nomor = 1;
                        @endphp
                        @foreach ($data as $row)
                        <tr>
                            <td>{{$nomor++}}</td>
                            <td>{{$row->nama}}</td>
                            <td>{{$row->perusahaan}}</td>
                            <td>{{$row->produk}}</td>
                            <td class="text-center">
                                <form id="data-{{ $row->id }}" action="{{route('supplier.destroy',$row->id)}}" method="post">
                                    {{csrf_field()}}
                                    {{method_field('delete')}}
                                </form>  
                                <a target="_blank" href="https://wa.me/{{$row->notelp}}"  class="btn btn-round btn-success btn-icon btn-sm edit"><i class="far fa-address-book"></i></a>
                                @if(auth()->user()->level == 'Owner') 
                                <a href="{{url('admin/supplier/'.$row->id.'/edit')}}" data-toggle="modal" data-target="#modal-edit{{$row->id}}"  class="btn btn-round btn-info btn-icon btn-sm like"><i class="fas fa-heart"></i></a>
                                <a href="{{url('admin/supplier/'.$row->id.'/edit')}}"  class="btn btn-round btn-warning btn-icon btn-sm edit"><i class="far fa-calendar-alt"></i></a>
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="deleteRow( {{ $row->id }} )" class="btn btn-round btn-danger btn-icon btn-sm remove"><i class="fas fa-times"></i></button>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
                @foreach ($data as $row)
                @include('backend.admin.supplier.modal')
                @endforeach
            </div>
        </div>
    </div>
</div>

@endsection
