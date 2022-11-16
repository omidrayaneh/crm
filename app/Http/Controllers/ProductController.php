<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProductRequired;
use App\Product;

class ProductController extends Controller
{

    public function index()
    {
        return view('Product.index');
    }

    public function getData()
    {
        $products = Product::paginate(2);
        $responce = [
            'data'=> $products,
            'message'=>'success'
        ];
        return response()->json($responce,200);
    }

    public function create()
    {
        return view('product.create');
    }


    public function store(ProductRequired $request)
    {
        $inputs = $request->only(['name','price']);



        $product = new Product();
        $product->name = $inputs['name'];
        $product->price = $inputs['price'];

        $product->save();
        toastr()->success('ثبت شد');
        return redirect(route('product.index'));
    }


    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $product = Product::findOrFail($id);
        return view('Product.edit',compact(['product']));
    }


    public function update(ProductRequired $request, $id)
    {
        $inputs = $request->only(['name','price']);



        $product = Product::findOrFail($id);
        $product->name = $inputs['name'];
        $product->price = $inputs['price'];

        $product->save();
        toastr()->success('ویرایش شد');
        return redirect(route('product.index'));
    }


    public function destroy($id)
    {
        $product = Product::findOrFail($id);
        $product->delete();
        toastr()->success('حذف شد');


    }
}
