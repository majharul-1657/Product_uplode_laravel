<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\product;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Validator;


class productController extends Controller
{
    function index(){
        $s['products'] = product::all();

        // return view('product.index', compact('products', 'admin'));
        // return view('product.index', [' products'=> $products, ]);

        return view('product.index',$s);

    }
    function create(){
        return view('product.create');
    }
    function store(Request $req){
        $validator =validator::make($req->all(),[
            'name'=>['required', 'string', ],
            'price'=>['required', 'numeric', '' ],
            'image'=>['required', 'image', 'mimes:jpeg,png,jpg,gif,webp','max:2048'],

        ]);
        if($validator->fails()){
            return  redirect()->back()->withErrors($validator)->withInput();
        }

        $insert = new product();
        if($req->hasFile('image')){
            $image = $req->file('image');
            $path = $image->store("products/$insert->id", 'public');
            $insert->image = $path;
        }



        $insert->name = $req->name;
        $insert->price = $req->price;
        $insert->save();

                                // ebar submit data dekhar jonne nicher code likhte hbe
        return redirect()->route('product.index')->with('success','Data Insert Successfully.');


    }
    function edit($id){
        $s['product'] = product::findOrFail($id);

        return view('product.edit', $s);


    }

    function update(Request $req, $id){

        $validator =validator::make($req->all(),[
            'name'=>['required', 'string', ],
            'price'=>['required', 'numeric', '' ],
            'image'=>['nullable', 'image', 'mimes:jpeg,png,jpg,gif,webp','max:2048'],

        ]);
        if($validator->fails()){
            return  redirect()->back()->withErrors($validator)->withInput();
        }


        $product = product::findOrFail($id);

        if($req->hasFile('image')){
            $image = $req->file('image');
            $path = $image->store("products", 'public');
            Storage::delete('public/'. $req->image);
            $product->image = $path;
        }


        $product->name = $req->name;
        $product->price = $req->price;
         $product->update();

        return redirect()->route('product.index')->with('success','Data Insert Successfully.');

    }

    // delete function

    function delete($id){
        $product = product::findOrFail($id);
        $product->delete();

        return redirect()->back();

    }
}

