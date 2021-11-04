<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Contracts\Support\Renderable;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return Renderable
     */
    public function index()
    {
       //$Product = Product::all();   //No Controller uz view failu dati aiziet
        //return view('home')->with(Product::all());
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return void
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request, Product $product )
    {
        $request->validate([
            'name'=>'required',
            'price'=>'required',
            'image'=>'required|mimes:jpg,png,jpeg|max:6048',
            'description'=>'required',
        ]);
        $newImageName = time() . '-' . $request->name . '.' . $request->image->extension();

        $request->image->move(public_path('images'),$newImageName);

        //$noliktava->create($request->all());
        $product = Product::create([
            'name'=>$request->input('name'),
           'price'=>$request->input('price'),
            'image'=>$newImageName,
            'description'=>$request->input('description')

        ]);
        return redirect()->route('auction.index');
      //return redirect()->route('product.index');
        //return view('home');
    }

    /**
     * Display the specified resource.
     *
     * @param Product $product
     * @return Renderable
     */
    public function show(Product $product)
    {

    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Product $product
     * @return void
     */
    public function edit(Product $product)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param Request $request
     * @param Product $product
     * @return void
     */
    public function update(Request $request, Product $product)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return void
     */
    public function destroy(Product $product)
    {
        //
    }
}
