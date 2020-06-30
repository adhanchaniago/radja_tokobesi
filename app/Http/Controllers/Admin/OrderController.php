<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Http\Controllers\Controller;
use App\Model\Order;
use App\Model\Payment;
use App\Model\OrderDetail;
use App\Model\Product;
use App\Model\Terjual;
use App\Mail\SendMail;
use DB;
use Alert;

class OrderController extends Controller
{
    private $titlePage='Order Pesanan';
    private $titlePage2='Tambah Pesanan';

    protected $folder   = 'backend.admin.order';
    protected $rdr      = '/admin/order';
    public function index()
    {
        $params=[
            'title' => $this->titlePage
        ];
        $pro    = Product::all();
        $data   = Order::all();
        $role  = DB::table('role')
        ->join('users', 'role.user_id', '=', 'users.id')
        ->get();
        return view($this->folder.'.index',$params, compact('data', 'pro', 'role'));
    }
    public function create()
    {
        $params=[
            'title' => $this->titlePage
        ];
        $data  = Payment::all();
        $ord   = OrderDetail::all();
        $pro   = DB::table('products')
        ->where('lokasi', '=', (auth()->user()->lokasi))
        ->get();
        $role  = DB::table('role')
        ->join('users', 'role.user_id', '=', 'users.id')
        ->get();
        return view($this->folder.'.create',$params, compact('data','ord','pro','role'));
    }
    public function store(Request $request)
    {
        $product    = Product::find($request->pesanan);
        $count  = count($request->pesanan);
        $nama   = $request->nama;
        $harga  = $request->harga;
        $qty    = $request->jumlah;
        $note   = $request->note;
        $stock   = $request->hasil;
        $sub    = $request->subtotal;
        $disc   = $request->discount;
        $total  = $request->total;
        $lokasi  = $request->lokasi;
        $notelp  = $request->notelp;
        $keperluan  = $request->keperluan;

        // request barang terjual
        $user_id  = $request->user_id;


        $request->merge([
            'created_by'   => auth()->user()->id,
        ]);
        $order  = $request->only('name', 'notelp', 'table_number', 'payment_id', 'email', 'lokasi', 'keperluan', 'created_by');
        $orderData = Order::create($order);

        for ($i=0; $i < $count; $i++) {
            $request->merge([
                'order_id'  => $orderData->id,
                'product_name' => $nama[$i],
                'product_price' => $harga[$i],
                'quantity'  => $qty[$i],
                'note'      => $note[$i],
                'subtotal'  => $sub[$i],
            ]);
            $orderDetail    = $request->only('order_id','product_name','product_price','quantity','note', 'subtotal');
            OrderDetail::create($orderDetail);

            
            DB::table('products')
            ->where('lokasi', '=', auth()->user()->lokasi)
            ->where('name',$nama[$i])->update([
                'stock' => $stock[$i]
            ]);

        }
        // request barang Terjual
        for ($i=0; $i < $count; $i++) {
            $request->merge([
               'name' => $nama[$i],
               'terjual'  => $qty[$i],
               'cabang'      => $lokasi,
           ]);
            $terjual    = $request->only('name','cabang','terjual');
            Terjual::create($terjual);

        }


        if (empty($disc)) {
            Order::find($orderData->id)->update([
                'total' => $total,
            ]);
        }else{
            Order::find($orderData->id)->update([
                'discount' => $disc,
                'total' => $total,
            ]);
        }

        return redirect($this->rdr)->with('success', 'Data berhasil ditambahkan');
    }

    public function show($id)
    {
        $data   = Order::find($id);
        return view($this->folder.'.print', compact('data'));
    }


    public function edit($id)
    {
        $pay    = Payment::all();
        $data   = Order::find($id);
        $pro    = Product::all();
        $ord    = OrderDetail::find($id);
        $role  = DB::table('role')
        ->join('users', 'role.user_id', '=', 'users.id')
        ->get();
        return view($this->folder.'.edit', compact('data','pay','pro','ord','role'));
    }
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'table_number'  => 'required',
            'pesanan'  => 'required',
            'jumlah'  => 'required',
            'payment'  => 'required',
            'note'  => 'required',
            'user'  => 'required',
        ]);
        $data1   = Order::where('id', $id)->first();
        $data1->table_number = $request->table_number;
        $data1->payment_id = $request->payment;
        $data1->created_by = $request->user;
        $data1->save();

        $data2  = OrderDetail::where('id',$id)->first();
        $data2->order_id = $data1->id;
        $data2->product_id = $request->pesanan;
        $data2->quantity = $request->jumlah;
        $data2->note = $request->note;
        $data2->save();

        $dat = Order::find($data1->id);
        $dat->total = $data2->product->price*$request->jumlah;
        $dat->save();
        return redirect($this->rdr)->with('success', 'Data berhasil di ubah');
    }
    public function destroy($id)
    {
        $data = Order::find($id);
        $data->delete();
        return redirect($this->rdr)->with('success', 'Data berhasil dihapus');
    }
    public function sendmail($id)
    {
        $order  = Order::find($id);
        Mail::to($order)->send(new SendMail($id));
        return redirect($this->rdr)
        ->with('success', 'Email telah terkirim');
    }
}
