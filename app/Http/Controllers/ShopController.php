<?php

namespace App\Http\Controllers;

use App\Model\Stock;
use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class ShopController extends ApiController
{
    public function __construct()
    {
        $this->middleware(['jwt.auth'], ['only' => ['buyProduct']]);
    }

    /**
     * Lista de productos disponibles para compras
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
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

    /**
     * Compra de productos
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function buyProduct(Request $request){

        //Obtenemos el primer producto disponible del inventario
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

        //Actualizamos la disponibilidad del producto a comprado y le asignamos al comprador
        $product->update([
            'available' => 3,
            'buyer' => $user->id,
        ]);

        $product->load('owner');

        return $this->respondSuccess("Compra realizada con exito", ['items' => $product]);

    }
}
