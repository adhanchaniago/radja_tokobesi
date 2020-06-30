<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Alert;

class RegisterController extends Controller
{
	public function index()
	{
		return view('auth.register');
	}
	public function store(Request $request)
	{
		$this->validate($request, [
			'name'  => 'required',
			'email'  => 'required|email|unique:users,email',
			'password'  => 'required',
		]);
		$data = new User;
		$data->name     = $request->name;
		$data->email     = $request->email;
		$data->password     = bcrypt($request->password);
		$data->save();
		return redirect($this->rdr)->with('success', 'Data berhasil di tambah');
	}
}
