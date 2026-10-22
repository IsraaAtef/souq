<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        //
        $search = $request->query('search');


        $products = Product::query();
        $products->where('price','>','200');
        if($search){
            $products->where('name','LIKE',"{$search}%");
        }
        $products = $products->paginate(10)->withQueryString();
;

        return view('layout.Products.index', compact('products'));
;
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
        $product = new Product();
            return view('layout.Products.create',compact('product'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
        $request->validate([
            'name' => 'string|max:255|required',
            'description' => 'string|nullable',
            'price' => 'numeric|required|min:0',
            'store_id' => 'required|exists:stores,id',
            'category_id' => 'required|exists:categories,id'
        ]);

        $name = $request->name;
        $slug = Str::slug($name);
        $old_slug = $slug;
        $count = 1;

        while(Product::where('slug',$slug)->exists()){
            $slug = $old_slug . '-' . $count;
            $count++;
        }

        $request->merge(['slug' => $slug]);
        Product::create($request->all());
    

       return redirect()->route('dashboard.products.index')->with('success','تم اضافة الصنف بنجاح');
    }

    /**
     * Display the specified resource.
     */
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
        return view('layout.products.edit',compact('product'));

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Product $product)
    {
        //
         $request->validate([
            'name' => 'string|max:255|required',
            'description' => 'string|nullable',
            'price' => 'numeric|required|min:0',
            'store_id' => 'required|exists:stores,id',
            'category_id' => 'required|exists:categories,id'
        ]);

        $name = $request->name;
        if($name != $product->name){
            $slug = Str::slug($name);
            $old_slug = $slug;
            $count = 1;

            while(Product::where('id','<>',$product->id)->where('slug',$slug)->exists()){
                $slug = $old_slug . '-' . $count;
                $count++;
            }

        $request->merge(['slug' => $slug]);
        }
        $product->update($request->all());
    

       return redirect()->route('dashboard.products.index')->with('success','تم تعديل الصنف بنجاح');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Product $product)
    {
        //
         $product->delete();
        return redirect()->route('dashboard.products.index')->with('error','تم حذف الصنف ');
    }
}
