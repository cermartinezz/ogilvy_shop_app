<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class Stock extends Model
{
    protected $fillable = ['code_bar','brand','model','price','discount','percentage_discount','available','product_id','buyer','purchase_date'];

    public function product(){
        return $this->belongsTo(Product::class);
    }

    public static function addItemToStock(Request $request){
        return self::create([
            'code_bar' => $request->get('code_bar'),
            'brand' => Str::ucfirst($request->get('brand')),
            'model' => Str::lower($request->get('model')),
            'price' => $request->get('price'),
            'discount' => $request->get('discount'),
            'percentage_discount' => $request->get('percentage_discount'),
            'available' => $request->get('available'),
            'product_id' => $request->get('product_id'),
        ]);
    }

    public function updateItemToStock(Request $request){
        return $this->update([
            'code_bar' => $request->get('code_bar'),
            'brand' => Str::ucfirst($request->get('brand')),
            'model' => Str::lower($request->get('model')),
            'price' => $request->get('price'),
            'discount' => $request->get('discount'),
            'percentage_discount' => $request->get('percentage_discount'),
            'available' => $request->get('available'),
            'product_id' => $request->get('product_id'),
        ]);
    }

    public function deleteItemFromStock(){
        try {
            return $this->delete();
        } catch (\Exception $e) {
            return $e;
        }
    }

    public function isSelled(){
        return $this->available != 3 ? true : false;
    }

}
