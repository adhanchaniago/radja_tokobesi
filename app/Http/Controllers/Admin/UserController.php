<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\User;
use App\Model\Cabang;
use App\Model\Akses;
use DB;
use Alert;


class UserController extends Controller
{
  private $titlePage='User';
  private $titlePage2='Tambah User';
  private $titlePage3='Update User';

  protected $folder   = 'backend.setting.user';
  protected $rdr   = '/admin/user';
  public function index()
  {
    $params=[
      'title' => $this->titlePage
    ];
    $data = User::orderBy('id')->paginate(10);
    $role  = DB::table('role')
    ->join('users', 'role.user_id', '=', 'users.id')
    ->get();
    return view($this->folder.'.index', $params,compact('data', 'role'));
  }
  public function create()
  {
    $params=[
      'title' => $this->titlePage2
    ];
    $data = Cabang::all();
    $role  = DB::table('role')
    ->join('users', 'role.user_id', '=', 'users.id')
    ->get();
    return view($this->folder.'.create',$params, compact('data','role'));
  }
  public function store(Request $request)
  {
    $data = new User;
    $data->name     = $request->name;
    $data->email     = $request->email;
    $data->level     = $request->level;
    $data->lokasi     = $request->lokasi;
    $data->password     = bcrypt($request->password);
    $data->save();

    $data2 = new Akses;
    $data2->user_id     = $data->id;
    $data2->save();
    return redirect('admin/user')->with('success', 'Data Berhasil Ditambah');
  }
  public function show($id)
  {

  }
  public function edit($id)
  {
    $params=[
      'title' => $this->titlePage3
    ];
    $data   = User::find($id);
    $cabang   = Cabang::all();
    $role  = DB::table('role')
    ->join('users', 'role.user_id', '=', 'users.id')
    ->get();
    return view($this->folder.'.edit',$params, compact('data', 'cabang', 'role'));
  }
  public function update(Request $request, $id)
  {
    $this->validate($request,[
      'name'  => 'required',
      'email'  => 'required|email|unique:users,email',
      'password'  => 'required',
    ]);
    $datas = $request->all();
    if (empty($datas['password'])) {
      unset($datas['password']);
      $this->validate($request,[
        'name'  => 'required',
        'email'  => 'required|email|unique:users,email',
      ]);
    }else{
      $this->validate($request,[
        'name'  => 'required',
        'email'  => 'required|email|unique:users,email',
        'password'  => 'required',
      ]);
    }
    User::find($id)->update([
      'name'  => $request->name,
      'email'  => $request->email,
      'password'  => bcrypt($request->password),
    ]);
    return redirect($this->rdr)->with('success', 'Data berhasil di rubah');
  }
  public function destroy($id)
  {
    $data = User::find($id);
    $data->delete();
    return redirect($this->rdr)->with('success', 'Data berhasil di hapus');
  }
}
