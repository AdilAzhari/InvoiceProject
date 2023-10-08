<?php

namespace App\Http\Controllers;

use App\Models\products;
use App\Http\Requests\StoreproductsRequest;
use App\Http\Requests\UpdateproductsRequest;
use App\Models\sections;
use Illuminate\Http\Request;

class ProductsController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = products::all();
        $sections = sections::all();
        return view('products.products',compact(['products','sections']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreproductsRequest $request)
    {

        products::create([
            'Product_name' => $request->Product_name,
            'description' => $request->description,
            'section_id' => $request->section_id,
        ]);

        session()->flash('Add', 'Products has been added');
        return redirect('/products');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(products $products)
    {

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateproductsRequest $request, products $products)
    {
        return $request;
        products::where('id',$request->pro_id)->update([
            'Product_name' => $request->Product_name,
            'description' => $request->description,
            'section_id' => $request->section_id,
        ]);

        session()->flash('Edit', 'Products has been updated');
        return redirect('/products');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Request $request)
    {
        products::findOrFail($request->pro_id)->delete();
        session()->flash('delete', 'products has been deleted');
        return redirect('/products');
    }
}
