<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\Request;

class Product extends Model
{
    protected $fillable = ['name','slug','category_id','status'];

    public function category(){
        return $this->belongsTo(Category::class);
    }

    public static function createProduct(Request $request){
        return self::create([
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'category_id' => $request->get('category_id'),
            'status' => 1
        ]);
    }

    public function updateProduct(Request $request){
         return $this::update([
            'name' => $request->get('name'),
            'slug' => $request->get('slug'),
            'category_id' => $request->get('category_id')
        ]);
    }

    public function disabledProduct(Request $request){
        return $this::update([
            'status' => false,
        ]);
    }
}
