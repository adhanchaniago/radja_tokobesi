<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use App\Model\Order;
use App\Model\OrderDetail;
use App\Model\User;
use App\Model\Product;
use App\Model\Category;
use App\Model\Akses;
use App\Model\Supplier;
use App\Model\Payment;
use App\Model\Report;
use Alert;


class HomeController extends Controller
{
	private $titlePage='Dashboard';
	private $view='backend.dashboard';

	public function index()
	{
		$params=[
			'title' => $this->titlePage
		];

		$pro 	= DB::table('products')->where('status', 1)->get();
		$pay 	= DB::table('payments')->where('status', 1)->get();
		$ord 	= Order::all();
		$usr 	= User::all();
		$sup 	= Supplier::all();
		$pay 	= Payment::all();
		$cat 	= Category::all();
		$role  = DB::table('role')
		->join('users', 'role.user_id', '=', 'users.id')
		->get();
		return view($this->view.'.index',$params, compact('ord','usr','pro','cat', 'pay','sup','pay','role'));
	}
}
