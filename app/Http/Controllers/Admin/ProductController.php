<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\ProductImport;
use App\Http\Controllers\Controller;
use App\Model\Product;
use App\Model\Restock;
use App\Model\Category;
use App\Model\Cabang;
use App\Exports\OrdersExport;
use App\Jobs\ImportJob;
use PDF;
use DB;
use Alert;

class ProductController extends Controller
{
    private $titlePage='Produk';
    private $titlePage2='Tambah Produk';
    private $titlePage3='Update Produk';

    protected $folder   = 'backend.admin.produk';
    protected $rdr   = 'admin/item';
    public function index()
    {
        $params=[
            'title' => $this->titlePage
        ];
        $data   = Product::all();
        $terjual = DB::table('terjual')
        ->join('products', function($join){
            $join->on('products.name', '=', 'terjual.name')
            ->on('products.lokasi', '=', 'terjual.cabang');
        })
        ->get();


        $role  = DB::table('role')
        ->join('users', 'role.user_id', '=', 'users.id')
        ->get();
        return view($this->folder.'.index',$params, compact('data', 'role', 'terjual'));
    }
    public function create()
    {
        $params=[
            'title' => $this->titlePage
        ];
        $data   = Category::all();
        $stock = Restock::all();
        $cabang = Cabang::all();
        $role  = DB::table('role')
        ->join('users', 'role.user_id', '=', 'users.id')
        ->get();
        return view($this->folder.'.create',$params, compact('data', 'role', 'cabang'));
    }
    public function store(Request $request)
    {

        $data   = new Product;
        $image = $request->file('image');
        $new_name = rand() . '.' . $image->getClientOriginalExtension();
        $image->move(public_path('images'), $new_name);

        $data->category_id  = $request->category;
        $data->name  = $request->name;
        $data->lokasi  = $request->nama_cabang;
        $data->price  = str_replace( ".", "", $request->price);
        $data->purchase_price  = str_replace( ".", "", $request->purchase_price);
        $data->status  = $request->status;
        $data->merk  = $request->merk;
        $data->stock  = $request->stock;
        $data->satuan  = $request->satuan;
        $data->stock_minim  = $request->stock_minim;
        $data->image  = $new_name;
        $data->save();
        return redirect($this->rdr)->with('success', 'Data berhasil ditambahkan');
    }
    public function edit($id)
    {
        $params=[
            'title' => $this->titlePage3
        ];
        $cat  = Category::all();
        $data = Product::find($id);
        $cabang = Cabang::all();
        $role  = DB::table('role')
        ->join('users', 'role.user_id', '=', 'users.id')
        ->get();
        return view($this->folder.'.edit',$params, compact('data','cat', 'role', 'cabang'));
    }

    public function update(Request $request, $id)
    {

      $image_name = $request->hidden_image;
      $image = $request->file('image');
        if($image != '')  // here is the if part when you dont want to update the image required
        {
            $image_name = rand() . '.' . $image->getClientOriginalExtension();
            $image->move(public_path('images'), $image_name);
        }
        else  // this is the else part when you dont want to update the image not required
        {

        }
        Product::find($id)->update(
            [
                'category_id'   => $request->category,
                'name'   => $request->name,
                'merk'   => $request->merk,
                'lokasi'   => $request->nama_cabang,
                'purchase_price'   => str_replace( ".", "", $request->purchase_price),
                'price'   => str_replace( ".", "", $request->price),
                'status'   => $request->status,
                'satuan'   => $request->satuan,
                'stock'   => $request->stock,
                'stock_minim'   => $request->stock_minim,
                'image'              =>         $image_name,

            ]
        );
        return redirect($this->rdr)->with('success', 'Data berhasil di ubah');
    }
    public function destroy($id)
    {
        $data   = Product::find($id);
        $data->delete();
        return redirect($this->rdr)->with('success', 'Data berhasil di Hapus');
    }
    public function deleteAll(Request $request)
    {
        $id = $request->id;
        DB::table("products")->whereIn('id',explode(",",$id))->delete();
        return redirect($this->rdr)->with('success', 'Data berhasil di Hapus');
    }
    public function multiplerecordsdelete(Request $req)
    {
        $id = $req->id;
        if ($id == NULL) {
            return redirect()->back()->with('errors', 'Gagal Menghapus');
        }else{
            foreach ($id as $ke) {
                DB::table('products')->where('id', $ke)->delete();
            }
        }
        return redirect()->back()->with('success', 'Data berhasil di Hapus');
    }
    // base print
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
        $product  = Product::all();
        $pdf    = PDF::loadView('admin.product.item.pdf',  compact('product'));    
        return $pdf->download('item.pdf');

    }
    // request barang 
    public function barang_masuk()
    {
        $data   = Product::all();
        $role  = DB::table('role')
        ->join('users', 'role.user_id', '=', 'users.id')
        ->get();
        return view($this->folder.'.index',compact('data', 'role'));
    }
    public function import(Request $request)
    {
        Excel::import(new ProductImport,request()->file('file'));
        return back()->with('success', 'Import CSV Suskses!!!');
    }
}
