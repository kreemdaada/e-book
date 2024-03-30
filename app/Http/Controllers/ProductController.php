<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Product;

class ProductController extends Controller
{
    public function index(){
        $products = Product::all();
        return view('products.index', ['products' => $products]);
    }
#----------------------------------------------------------------
    public function create(){
            return view('products.create');
        }
#----------------------------------------------------------------
    public function store(Request $request){
        # prüfen ob request zur databank angekommen wurde , soll mir name des products zeigen
        # dd($request->name);
        $data = $request->validate([
            'name' => 'required',
            'menge' => 'required|numeric',
            'description' => 'nullable',
            'price' =>  ['required', 'regex:/^\d+(\.\d{1,3})?$/']
        ]);
        $newProduct = Product::create($data);

        return redirect(route('product.index'));

        }
#----------------------------------------------------------------
        public function edit(Product $product){
            return view('products.edit', ['product' => $product]);
        }

        public function update(Product $product, Request $request){
            $data = $request->validate([
                'name' => 'required',
                'menge' => 'required|numeric',
                'description' => 'nullable',
                'price' =>  ['required', 'regex:/^\d+(\.\d{1,3})?$/']
            ]);
            $product->update($data);
            return redirect(route('product.index'))->with('erfolgreich','Product schon Updated !!');
        }
#----------------------------------------------------------------
        public function destroy(Product $product){
                    $product->delete();
                    return redirect(route('product.index'))->with('erfolgreich','Product schon gelöscht !!');
                }
}
