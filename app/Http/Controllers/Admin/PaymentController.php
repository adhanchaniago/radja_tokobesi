<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Payment;
use DB;
use Alert;

class PaymentController extends Controller
{
    private $titlePage='Metode Pembayaran';
    private $titlePage2='Tambah Metode Pembayaran';
    private $titlePage3='Update Metode Pembayaran';

    protected $folder   = 'backend.admin.payment';
    protected $rdr      = '/admin/payment';
    public function index()
    {
        $params=[
            'title' => $this->titlePage
        ];
        $data   = Payment::orderBy('id')->paginate(10);
        $role  = DB::table('role')
        ->join('users', 'role.user_id', '=', 'users.id')
        ->get();
        return view($this->folder.'.index', $params, compact('data', 'role'));
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
        $this->validate($request, [
            'name'  => 'required',
            'status'  => 'required',
        ]);
        $data = new Payment;
        $data->name = $request->name;
        $data->status = $request->status;
        $data->save();
        return redirect($this->rdr)->with('success', 'Data Berhasil di Tambah');
    }

    public function show($id)
    {
        //
    }
    public function edit($id)
    {
        $params=[
            'title' => $this->titlePage
        ];
        $data   = Payment::find($id);
        $role  = DB::table('role')
        ->join('users', 'role.user_id', '=', 'users.id')
        ->get();
        return view($this->folder.'.edit',$params, compact('data', 'role'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name'  => 'required',
            'status'  => 'required',
        ]);
        Payment::find($id)->update([
            'name'  => $request->name,
            'status'  => $request->status,
        ]);
        return redirect($this->rdr)->with('success', 'Data Berhasil di Ubah');
    }

    public function destroy($id)
    {
        $data = Payment::find($id);
        $data->delete();
        return redirect($this->rdr)->with('success', 'Data berhasil di hapus');
    }
}
