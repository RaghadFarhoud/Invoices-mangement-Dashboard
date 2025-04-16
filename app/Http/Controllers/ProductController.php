<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Section;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('products.products');


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
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'product_name' => 'required|unique:products|max:255',
            'section_name' => 'required',
            'description' => 'required'
        ],
            [
                'section_name.required' => 'please enter the section name',
                'description.required' => 'please describe your product',
                'product_name.unique' => 'choose another name, this name has already been taken',
                'product_name.max' => 'TMI'
            ]
        );
        Product::create([
            'product_name' => $request->product_name,
            'section_name' => $request->section_name,
            'description' => $request->description,
            'created_by' => (Auth::user()->name)

        ]);
        session()->flash('Add', 'Added sucssesfully');
        return redirect('/products');

    }
    public function show(Product $product)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
    }
}
