<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

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
     * Store a newly created resource in storage.
     *
     * @param Request $request
     * @return void
     */
    public function store(Request $request, Product $product)
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

    public function getPage($page): JsonResponse
    {
        $products = Product::paginate(5, ['*'], 'page', $page);
        return response()->json($products);
    }

    public function refresh(): bool
    {
        $response = Http::get('https://biditwarehouse.herokuapp.com/products');

        foreach($response->object() as $item){
            if(Product::where('_unique', '=', $item->_id)->first()) continue;
            $product = new Product();
            $product->_unique = $item->_id;
            $product->name = $item->name;
            $product->description = $item->description;
            $product->price = (double)$item->startingPrice ?? 0;
            $product->image = $item->imageURL;
            $product->save();
        }

        return true;
    }

}
