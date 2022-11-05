<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Product\EditProductRequest;
use App\Http\Requests\Product\ProductRequest;
use App\Models\Product;
use App\Traits\HelperTrait;
use App\Traits\FileTrait;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    //
    use FileTrait,HelperTrait;

    public function add(ProductRequest $request){

        $path = $this->upload($request->file('image'),'product');
        $product = Product::create([
            'name' => $request->name ,
            'image' => $path,
            'description' => $request->description,
        ]);
        return $this->customresponseformat('create product succssfly',$product);
    }//end function add product

    public function show(){

        $product = Product::paginate();
        return $this->customresponseformat('show all products',$product);

    }//end show

    public function show_product($id){

        $product = Product::find($id);
        if($product){
            return $this->customresponseformat('product info',$product);
        }
        return $this->customresponseformat('product not found',[],404);

    }//end show_product

    public function edit(EditProductRequest $request){

        $data =[
            'name'       =>$request->name,
            'description'=>$request->description
        ];

        $product= Product::find($request->id);
        if($this->checkfile($request,'image',$product)){

            $image =  $this->upload($request->file('image'),'product');
            $data['image'] = $image;

        }

        $product->update($data);
        return $this->customresponseformat('updated product succssfly',$product);

    }// end edit

    public function delete($id){
        $product = Product::find($id);
        if($product){
            $this->deletefile($product->image);
            $product->delete();
            return $this->customresponseformat('delete succssufly',[]);
        }
        return $this->customresponseformat('product not found',[],404);
}



}
