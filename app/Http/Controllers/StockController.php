<?php

namespace App\Http\Controllers;

use App\Http\Resources\Stock as StockResource;
use App\Model\Stock;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;


class StockController extends ApiController
{
    public function __construct()
    {
        $this->middleware(['jwt.auth','isAdmin'], ['only' => ['store','update','destroy','index','create']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $productos = Stock::all();

        $this->respondSuccess("Inventario",['inventario'=> $productos]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validate = $this->validateProduct($request->all());

        if($validate->fails()){
            return $this->respondWithErrorValidation("Algunos datos del producto no cumplen los criterios",$validate->errors()->toArray());
        }

        $product = Stock::addItemToStock($request)->load('product');

        $product = new StockResource($product);

        return $this->respondSuccessCreated("Producto registrado en el stock con exito",['producto' => $product]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request $request
     * @param Stock $stock
     * @return
     */
    public function update(Request $request, Stock $stock)
    {
        if(! $stock->isSelled() ){
            return $this->respondBadRequest("El producto no se pudo actualizar, dado que ya fue vendido");
        }

        $validate = $this->validateUpdateProduct($request->all(),$stock->id);

        if($validate->fails()){
            return $this->respondWithErrorValidation("Algunos datos del producto no cumplen los criterios",$validate->errors()->toArray());
        }

        if(!$stock->updateItemToStock($request)){
            return $this->respondBadRequest("No se pudo actualizar el producto en stock");
        }

        $stock = new StockResource($stock);

        return $this->respondSuccess("Producto en stock actualizado con exito",['producto' => $stock]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Stock $stock
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stock $stock)
    {
        if(! $stock->isSelled() ){
            return $this->respondBadRequest("El producto no se pudo actualizar, dado que ya fue vendido");
        }

        $eliminado = $stock->deleteItemFromStock();

        if($eliminado instanceof \Exception){
            return $this->respondInternalError("Hubo un error interno del sistema, para eliminar el elemento");
        }

        return $this->respondSuccess("Se ha elimiado el producto del stock");
    }

    public function validateProduct(array $data){
        return Validator::make($data, [
            'code_bar' => ['required', 'string', 'max:60','unique:stocks'],
            'brand' => ['required', 'string', 'max:40'],
            'model' => ['required', 'string', 'max:40'],
            'price' => ['required','numeric'],
            'discount' => ['required','boolean'],
            'percentage_discount' => ['required'],
            'available' => ['required','boolean'],
            'product_id' => ['required','exists:products,id'],
        ]);
    }

    public function validateUpdateProduct(array $data,$id){
        return Validator::make($data, [
            'code_bar' => ['required', 'string', 'max:60',Rule::unique('stocks')->ignore($id)],
            'brand' => ['required', 'string', 'max:40'],
            'model' => ['required', 'string', 'max:40'],
            'price' => ['required','numeric'],
            'discount' => ['required','boolean'],
            'percentage_discount' => ['required'],
            'available' => ['required','boolean'],
            'product_id' => ['required','exists:products,id'],
        ]);
    }
}
