<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use Brian2694\Toastr\Facades\Toastr;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;
use Carbon\Carbon;
use App\Category;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::latest()->get();
        return view('backend.admin.category.index', compact('categories') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('backend.admin.category.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([

            'name' => 'required|unique:categories', 
            'image' => 'required|file|mimes:jpeg,png,jpg|max:3050', 
        ]);
        
//          Get Image file
        $image = $request->file('image');
        $slug = Str::slug($request->name);
        if(isset($image)){
//          make Unique nam efor image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
 //         Check is category Dir is Exists
            if(!Storage::disk('public')->exists('category')){

                Storage::disk('public')->makeDirectory('category');

            }
//          Resize image for category and Upload
                $category = Image::make($image)->resize('1600','479')->stream();
                Storage::disk('public')->put('category/'. $imagename, $category);
 //         Check is category Slider Dir is Exists

            if(!Storage::disk('public')->exists('category/slider')){

                Storage::disk('public')->makeDirectory('category/slider');
            }

//          Resize image for category and Upload
                $slider = Image::make($image)->resize('500','333')->stream();
                Storage::disk('public')->put('category/slider/'. $imagename, $slider);              
            
        } 
        else{
            $imagename = 'default.png';
        }

//      Save all to category
        $category = new Category();
        $category->name = strtoupper($request->name);
        $category->slug = $slug;
        $category->image = $imagename; 
        $category->save();

        if( $category){
            Toastr::success('Category Created Sucessfully!!', 'Success');
            return redirect()->route('admin.category.index');

        }else{
            Toastr::error('Something Went Wrong :(', 'Error');
            return redirect()->route('admin.category.index');
        }  
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = Category::find($id);
        return view('backend.admin.category.edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([

            'name' => 'required', 
            'image' => 'image|file|mimes:jpeg,png,jpg', 
        ]);
        
//          Get Image file
        $image = $request->file('image');
        $slug = Str::slug($request->name);
        $category = Category::find($id);

        if(isset($image)){
//          make Unique nam efor image
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
 //         Check is category Dir is Exists
            if(!Storage::disk('public')->exists('category')){

                Storage::disk('public')->makeDirectory('category');

            }
//          Delete Old Image of Category if HAS:

            if(Storage::disk('public')->exists('category/'.$category->image)){

                Storage::disk('public')->delete('category/'.$category->image);
            }

//          Resize image for category and Upload
                $categoryImage = Image::make($image)->resize('1600','479')->stream();
                Storage::disk('public')->put('category/'. $imagename, $categoryImage);
 //         Check is category Slider Dir is Exists

            if(!Storage::disk('public')->exists('category/slider')){

                Storage::disk('public')->makeDirectory('category/slider');
            }
//          Delete Old Image of Category/Slider if HAS:

            if(Storage::disk('public')->exists('category/slider/'.$category->image)){
                
                Storage::disk('public')->delete('category/slider/'.$category->image);
            }

//          Resize image for category and Upload
                $slider = Image::make($image)->resize('500','333')->stream();
                Storage::disk('public')->put('category/slider/'. $imagename, $slider);              
            
        } 
        else{
            $imagename = $category->image;
        }

//      Save all to category
        $category->name = strtoupper($request->name);
        $category->slug = $slug;
        $category->image = $imagename; 
        $category->save();

        if( $category){
            Toastr::success('Category Updated Sucessfully!!', 'Success');
            return redirect()->route('admin.category.index');

        }else{
            Toastr::error('Something Went Wrong :(', 'Error');
            return redirect()->route('admin.category.index');
        } 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        
        if(Storage::disk('public')->exists('category/'.$category->image)){

            Storage::disk('public')->delete('category/'.$category->image);
        }

        if(Storage::disk('public')->exists('category/slider/'.$category->image)){
            
            Storage::disk('public')->delete('category/slider/'.$category->image);
        }

        $category->delete();

        if( $category){
            Toastr::success('Category Deleted Sucessfully!', 'Success');
            return redirect()->route('admin.category.index');

        }else{
            Toastr::error('Something Went Wrong :(', 'Error');
            return redirect()->route('admin.category.index');
        }
    }
    
}
