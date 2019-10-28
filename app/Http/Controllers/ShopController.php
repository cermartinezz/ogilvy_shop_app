<?php

namespace App\Http\Controllers;

use App\Model\Stock;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ShopController extends ApiController
{
    public function __construct()
    {
        $this->middleware(['jwt.auth'], ['only' => ['buyProduct']]);
    }

    public function getProducts(Request $request)
    {
        $products = Stock::with(['product','product.category'])
                        ->select('brand',
                                    'model',
                                    'price',
                                    'product_id',
                                    'discount',
                                    'percentage_discount',
                                    DB::raw('COUNT(id) as items_availabel')
                        )
                        ->whereHas('product', function (Builder $query) {
                            $query->where('status', '1');
                        })
                        ->where('available',1)
                        ->groupBy(['brand','model','price','product_id','discount','percentage_discount'])
                        ->get()
                        ;


        if( $products->count() <= 0 ){
            return $this->respondNotFound("No se encontraron elementos");
        }

        return $this->respondSuccess("Datos encontrados", ['items' => $products] );
    }

    public function buyProduct(Request $request){

        $product = Stock::where([
            ['brand', $request->get('brand') ],
            ['model', $request->get('model') ],
            ['price', $request->get('price') ],
            ['percentage_discount', $request->get('percentage_discount')]
        ])->where('available','1')->first();

        if( !$product ){
            return $this->respondBadRequest("Lo sentimos, no hay productos disponibles");
        }

        $user = auth()->user();

        $product->update([
            'available' => 3,
            'buyer' => $user->id,
        ]);

        $product->load('owner');

        return $this->respondSuccess("Compra realizada con exito", ['items'=>$product]);

    }
}
