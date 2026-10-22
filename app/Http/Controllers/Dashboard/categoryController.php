<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class categoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {

        $search = $request->query('search');
    // $categories = Category::select('name')->get();
     // $categories = Category::all();
      //$categories = Category::where('is_active',false)->where('name','LIKE',"{$search}%")->get();
      //$categories = Category::where('is_active',false)->when($search,function($query,$search){
      //$query->where('name',$search); 
      //})->get();


      $categories = Category::query();

      $categories->where('is_active',true);
      if($search){
            $categories->where('name','LIKE',"{$search}%");
      }
         $categories = $categories->get();

      return view('layout.Categories.index',compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {

        //
        $category = new Category();
        return view('layout.Categories.create',compact('category'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       dd([
    'has_file' => $request->hasFile('image_path'),
    'file' => $request->file('image_path'),
    'error' => $request->file('image_path')?->getError(),
    'error_message' => $request->file('image_path')?->getErrorMessage(),
]);
        //validate
        $request->validate([
                'name' => 'string|max:255|required',
                'description' => 'string|nullable',
                'is_active' => 'in:on,off',
                'image_path' =>'nullable|file|image'
        ]);

        $name = $request->name;
        $slug = Str::slug($name);
        $old_slug = $slug;
        $count = 1;
        //$check_slug = Category::where('slug',$slug);
        //if($check_slug){
          //  $slug = $slug .'1';
       // }
        while(Category::where('slug',$slug)->exists()){
                            $slug = $old_slug .'-' .$count;
                            $count++;
        }
        $is_active = $request->is_active == 'on' ? 1: 0;
$image_path = null;

        if($request->hasFile('image_path')){
            $image = $request->file('image_path');
            $time = now()->format('Y-m-d_H-i-s');
            $image_name = $time . '_' . uniqid() . '.' . $image->extension();
            $image_path = $image->storeAs('categories',$image_name,'public');
            $request->merge([
                'image_path' => $image_path
            ]);
        }
        //Category::create($request->all());
        //$request->merge(['slug' => $slug,
            //'is_active' => $is_active])
        Category::create([
            'name' => $name,
            'description' => $request->description ?? null,
            'slug' => $slug,
            'is_active' => $is_active,
                        'image_path' => $image_path

        ]);
               return redirect()->route('dashboard.categories.index')->with('success','تم اضافة الصنف بنجاح');

       }

    /**
     * Display the specified resource.
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Category $category)
    {
        //
        return view('layout.categories.edit',compact('category'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Category $category)
    {
        //

        //validate
        $request->validate([
                'name' => 'string|max:255|required',
                'description' => 'string|nullable',
                'is_active' => 'in:on,off',
                'image_path' =>'file|image|nullable'
        ]);

        $name = $request->name;
        if($name != $category->name){
        $slug = Str::slug($name);
                $old_slug = $slug;
                $count = 1;
                
                while(Category::where('id','<>',$category->id)->where('slug',$slug)->exists()){
                                    $slug = $old_slug .'-' .$count;
                                    $count++;
                }
                $request->merge(['slug' => $slug]);
        }
        
        $is_active = $request->is_active == 'on' ? 1: 0;
         $request->merge([
            'is_active' => $is_active
        ]);

        $image_path = null;

        $image_old = $category->image_path;
        if($request->hasFile('image_path')){
            $image = $request->file('image_path');
            $time = now()->format('Y-m-d_H-i-s');
            $image_name = $time . '_' . uniqid() . '.' . $image->extension();
            $image_path = $image->storeAs('categories',$image_name,'public');
            if($image_path && $image_old){
                Storage::disk('public')->delete($image_old);
            }
            $request->merge([
                'image_path' => $image_path
            ]);
        }

        $category->update($request->all());
       
         return redirect()->route('dashboard.categories.index')->with('success', 'تم تعديل الصنف بنجاح');

    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Category $category)
    {
        //
         $image_old = $category->image_path;
        $category->delete();
        if($image_old){
                Storage::disk('public')->delete($image_old);
        }
        return redirect()->route('dashboard.categories.index')->with('error','تم حذف الصنف بنجاح');
    }
}
