<?php

namespace App\Http\Controllers;

use App\Http\Resources\Product as ProductResource;
use App\Model\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;


class ProductController extends ApiController
{

    public function __construct()
    {
        $this->middleware('jwt.auth', ['only' => ['store','update','destroy']]);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $slug = ['slug' => Str::slug($request->get('name'))];

        $request->merge($slug);

        $validate = $this->validateProduct($request->all());

        if($validate->fails()){
            return $this->respondWithErrorValidation("Algunos datos del producto no cumplen los criterios",$validate->errors()->toArray());
        }

        $product = Product::createProduct($request)->load('category');

        $product = new ProductResource($product);

        return $this->respondSuccessCreated("Producto registrado con exito",['producto' => $product]);

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
     * @param Product $product
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Product $product)
    {
        $slug = ['slug' => Str::slug($request->get('name'))];

        $request->merge($slug);

        $validate = $this->validateUpdateProduct($request->all(),$product);

        if($validate->fails()){
            return $this->respondWithErrorValidation("Algunos datos del producto no cumplen los criterios",$validate->errors()->toArray());
        }

        if(!$product->updateProduct($request)){
            return $this->respondBadRequest("No se pudo actualizar el producto");
        }

        $product = new ProductResource($product);

        return $this->respondSuccess("Producto registrado con exito",['producto' => $product]);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     *
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Product $product)
    {
        $disabled = $product->update(['status'=>false]);

        if(!$disabled){
            return $this->respondBadRequest("No se pudo deshabilitar el producto");
        }

        $product = new ProductResource($product);

        return $this->respondSuccess("Producto deshabilitado con exito",['producto' => $product]);

    }


    protected function validateProduct(array $data)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255','unique:products'],
            'category_id' => ['required','exists:categories,id'],
        ]);
    }

    protected function validateUpdateProduct(array $data, Product $product)
    {
        return Validator::make($data, [
            'name' => ['required', 'string', 'max:255'],
            'slug' => ['required', 'string', 'max:255',Rule::unique('products')->ignore($product->id)],
            'category_id' => ['required','exists:categories,id'],
        ]);
    }
}
