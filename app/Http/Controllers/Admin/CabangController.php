<?php

namespace App\Http\Controllers\Admin;

use App\Model\Cabang;
use DB;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;

class CabangController extends Controller
{
  protected $folder = 'backend.admin.cabang';
  protected $rdr = '/admin/cabang';
  private $titlePage='Cabang Toko';
  private $titlePage2='Tambah Cabang Toko';
  private $titlePage3='Update Cabang Toko';

  public function index()
  {
    $params=[
      'title' => $this->titlePage
    ];
    $data   = Cabang::all();
    $role  = DB::table('role')
    ->join('users', 'role.user_id', '=', 'users.id')
    ->get();
    return view($this->folder.'.index',$params, compact('data','role'));
  }
  public function create()
  {
    $params=[
      'title' => $this->titlePage2
    ];
    $role  = DB::table('role')
    ->join('users', 'role.user_id', '=', 'users.id')
    ->get();
    return view($this->folder.'.create',$params, compact('role'));
  }
  public function store(Request $request)
  {
    $data   = new Cabang;
    $data->nama_cabang   = $request->nama_cabang;
    $data->save();
    DB::table('role_cabang')->insert([
      'nama_cabang' =>  $request->nama_cabang
    ]);
    return redirect($this->rdr)->with('success', 'Data Berhasil di tambahkan');
  }
  public function show(Request $request)
  {

  }
  public function edit($id)
  {
    $params=[
      'title' => $this->titlePage3
    ];
    $data = Cabang::find($id);
    $role  = DB::table('role')
    ->join('users', 'role.user_id', '=', 'users.id')
    ->get();
    return view($this->folder.'.edit',$params, compact('data', 'role'));
  }

  public function update(Request $request, $id)
  {
    $this->validate($request,[
      'nama_cabang'  => 'required'
    ]);
    Cabang::find($id)->update([
      'nama_cabang'  => $request->nama_cabang
    ]);
    return redirect($this->rdr)->with('success', 'Data Berhasil di ubah');
  }

  public function destroy($id)
  {
    $data   = Cabang::find($id);
    $data->delete();
    return redirect($this->rdr)->with('success', 'Data berhasil di Hapus');

  }
}
