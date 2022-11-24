<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\EditProductRequest;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Product;
use App\Traits\HelperTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    //
    use FileTrait,HelperTrait;
    public function __construct()
    {
        $this->middleware('permission:add-product')->only(['add','show_add_form']);
        $this->middleware('permission:show-products')->only(['show']);
        $this->middleware('permission:show-product')->only(['show_product']);
        $this->middleware('permission:edit-product')->only(['edit','show_edit']);
        $this->middleware('permission:delete-product')->only(['delete']);

    }//end construct

    public function show_add_form(){

        return view('dashboard.product.add_product');
    }


    public function add(ProductRequest $request){

        $path = $this->upload($request->file('image'),'images/product');
        $product = Product::create([
            'name' => $request->name ,
            'image' => $path,
            'description' => $request->description,
        ]);
        toastr()->success("create product succssfly");
        return redirect()->route('show-products');

    }//end function add product

    public function show(){
        $products = Product::paginate(4);
        return view('dashboard.product.show_products',compact('products'));
    }//end show

    public function show_edit($id){
        $product = Product::findOrfail($id);
        return view('dashboard.product.edit_product',compact('product'));


    }//end function show_edit


    public function edit(EditProductRequest $request){

        $data =[
            'name'       =>$request->name,
            'description'=>$request->description
        ];

        $product= Product::find($request->id);
        if($this->checkfile($request,'image',$product)){
            $image =  $this->upload($request->file('image'),'images/product');
            $data['image'] = $image;

        }

        $product->update($data);
        toastr()->success("update product succssfly");
        return redirect()->route('show-products');

    }// end edit


    public function delete(Request $request){
        $validator = Validator::make($request->all(), [
            'product_id' => 'required'
        ]);
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }


        $product = Product::findOrFail($request->product_id);
        $product->delete();
        $this->deletefile($product->image);
        toastr()->success("delete product succses");
        return  redirect()->route('show-products');

    }//end delete



}//end class
