<?php

namespace App\Model;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name','slug'];

    public static function createCategory(Request $request){
        return self::create([
            'name' => $request->get('name'),
            'slug' => Str::slug($request->get('name')),
        ]);
    }
}
