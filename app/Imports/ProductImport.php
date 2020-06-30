<?php

namespace App\Imports;

use App\Model\Product;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class ProductImport implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        return new Product([
            'category_id'     => $row['category_id'],
            'name'    => $row['name'], 
            'merk'    => $row['merk'], 
            'price'    => $row['price'], 
            'purchase_price'    => $row['purchase_price'], 
            'status'    => $row['status'], 
            'stock'    => $row['stock'], 
            'stock_minim'    => $row['stock_minim'], 
            'satuan'    => $row['satuan'], 
            'lokasi'    => $row['lokasi'], 
            'created_at'    => date('Y-m-d H:i:s'),
            'updated_at'    => date('Y-m-d H:i:s'),

        ]);
    }
}
