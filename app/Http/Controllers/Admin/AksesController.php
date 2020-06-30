<?php

namespace App\Http\Controllers\Admin;

use App\Model\Akses;
use App\Model\User;
use DB;
use App\Model\Cabang;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;

class AksesController extends Controller
{
  private $titlePage='Akses Management';
  protected $folder   = 'backend.admin.akses';
  protected $rdr   = '/admin/akses';
  public function index()
  {
    $params=[
      'title' => $this->titlePage
    ];
    $data =  DB::table('role')
    ->join('users', 'role.user_id', '=', 'users.id')
    ->get();
    $user = User::all();
    $cabang = Cabang::all();
    $role_cabang = DB::table('role_cabang')
    ->join('users', 'role_cabang.user_id', '=', 'users.id')
    ->get();
    $role  = DB::table('role')
    ->join('users', 'role.user_id', '=', 'users.id')
    ->get();
    return view($this->folder.'.index',$params, compact('role_cabang', 'cabang', 'data','user','role'));
  }

  public function store(Request $request)
  {
    DB::table('role')
    ->where('user_id', $request->user_id)
    ->update([
      'is_admin' => $request->is_admin,
      'is_akses' => $request->is_akses,
      'is_supplier' => $request->is_supplier,
      'is_kategori' => $request->is_kategori,
      'is_produk' => $request->is_produk,
      'is_order' => $request->is_order,
      'is_pay' => $request->is_pay,
      'is_report' => $request->is_report,
      'is_kas' => $request->is_kas,
      'is_stok' => $request->is_stok,
      'is_cabang' => $request->is_cabang,
      'is_user' => $request->is_user
    ]);
    return redirect('admin/akses')->with('success', 'Selamat Data Telah Tersimpan');
  }

  public function show(Request $request)
  {

    DB::table('role_cabang')
    ->where('user_id', '=', $request->user_id)
    ->delete();
    $count  = count($request->cabang);
    for ($i=0; $i < $count; $i++) {
      DB::table('role_cabang')
      // ->where('user_id',  $request->user_id)
      ->insert([
        'user_id' => $request->user_id,
        'nama_cabang' => $request->cabang[$i]
      ]);
    }
    // return response()->json($request->cabang);
    return redirect('admin/akses')->with('success', 'Selamat Data Telah Tersimpan');
  }

  
  public function edit(Akses $akses)
  {
        //
  }


  public function update(Request $request, Akses $akses)
  {
        //
  }


  public function destroy( $id)
  {
    $data   = Akses::find($id);
    $data->delete();
    return redirect($this->rdr)->with('success', 'Data berhasil di Hapus');
  }

}
