<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\User;
use App\Exports\OrdersExport;
use DB;
use PDF;
use Alert;

class ReportController extends Controller
{
  private $titlePage='Report Pesanan';

  public function index(Request $request)
  {
    $params=[
      'title' => $this->titlePage
    ];
    $yr 	= $request->get('tahun');
    $mt 	= $request->get('bulan');
    $us 	= $request->get('kasir');

    $users	= User::all();
    $data 	= Order::all();
    $terjual = DB::table ('terjual')
    ->join('products', function($join){
      $join->on('products.name', '=', 'terjual.name')
      ->on('products.lokasi', '=', 'terjual.cabang');
    })
    ->get();
    $link = DB::table ('terjual')
    ->groupBy('cabang')
    ->get();
    $total = DB::table('orders')->where('payment_id', '<', 3)->sum('total');
    $role  = DB::table('role')
    ->join('users', 'role.user_id', '=', 'users.id')
    ->get();
    return view('backend.admin.report.index', $params, compact('data','link', 'terjual', 'users','total', 'role'));
  }
  public function download(Request $request)
  {
    $tipe   = $request->get('tipe');
    if ($tipe == null) {
      return redirect()->back()->with('failed', 'Data tidak ada');
    }elseif ($tipe == 1) {
      return $this->pdf($request);
    }else{
      return $this->excel($request);
    }
  }
  public function pdf(Request $request)
  {
   $yr 	= $request->get('tahun');
   $mt 	= $request->get('bulan');
   $us 	= $request->get('kasir');

   $users	= User::all();
   $data 	= new Order();
   if ($yr) {
    $data = $data->whereYear('created_at', $yr);
  }
  if ($mt) {
    $data = $data->whereMonth('created_at', $mt);
  }
  if ($us) {
    $data = $data->where('created_by', $us);
  }
  $data = $data->get();
  $htg    = count($data);
  if ($htg > 0) {
   $pdf 	= PDF::loadView('admin.report.pdf', $data, compact('data'));	
   return $pdf->download('report.pdf');
 }
 else{
  return redirect()->back()->with('failed', 'Data tidak ada');
}
}
public function excel(Request $request)
{
  $yr     = $request->get('tahun');
  $mt     = $request->get('bulan');
  $us     = $request->get('kasir');

  $users  = User::all();
  $data   = new Order();
  if ($yr) {
    $data = $data->whereYear('created_at', $yr);
  }
  if ($mt) {
    $data = $data->whereMonth('created_at', $mt);
  }
  if ($us) {
    $data = $data->where('created_by', $us);
  }
  $data = $data->get();
  $htg  = count($data);
  if ($htg > 0) {
    return Excel::download(new OrdersExport($yr, $mt, $us), 'report.xlsx');
  }else{
    return redirect()->back()->with('failed', 'Data tidak ada');
  }
}
}
