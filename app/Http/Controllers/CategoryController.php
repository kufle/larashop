<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use Illuminate\Validation\Rule;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {   
        $keyword = $request->get('keyword');

        if($keyword){
            $categories = \App\Category::where('name','LIKE',"%$keyword%")->paginate(10);
        }else{
            $categories = \App\Category::paginate(10);
        }

        return view('categories.index',['categories'=>$categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view("categories.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        \Validator::make($request->all(),[
            "name" => "required|min:3|max:20",
            "image" => "required",
        ])->validate();

        $new_category = new \App\Category;
        $new_category->name = $request->get('name');

        if($request->file('image')){
            $image_path = $request->file('image')->store('category_images','public');
            $new_category->image = $image_path;
        }

        $new_category->created_by = \Auth::user()->id; 
        $new_category->slug = str_slug($request->get('name'),"-");

        $new_category->save();

        return redirect()->route('categories.create')->with('status','Categories Successfully Created');
       
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $category = \App\Category::findOrFail($id);

        return view('categories.show',['category'=>$category]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $category = \App\Category::findOrFail($id);

        return view('categories.edit',['category'=>$category]);
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
        $category_update = \App\Category::findOrFail($id);
        
        \Validator::make($request->all(),[
            "name" => "required|min:3|max:20",
            "slug" => ["required",Rule::unique("categories")->ignore($category_update->slug,"slug")]
        ])->validate();
        $name = $request->get('name');
        $slug = $request->get('slug');
        
        $category_update->name = $name;
        $category_update->slug = str_slug($slug,'-');
        if($request->file('image')){
            if(file_exists(storage_path('app/public'.$category_update->image))){
                \Storage::delete('public/'.$category_update->image);
            }
            $file = $request->file('image')->store('category_images','public');
            $category_update->image = $file;
        }

        $category_update->updated_by = \Auth::user()->id;
        $category_update->save();

        return redirect()->route('categories.edit',['id'=>$id])->with('status','Category Successfully Update');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = \App\Category::findOrFail($id);
        $category->deleted_by = \Auth::user()->id;
        $category->save();
        $category->delete();
        
        return redirect()->route('categories.index')->with('status','Category successfully moved to trash');
    }

    public function trash()
    {
        $category = \App\Category::onlyTrashed()->paginate(10);

        return view('categories.trash',['categories'=> $category]);
    }

    public function restore($id)
    {
        $category = \App\Category::withTrashed()->findOrFail($id);
        if($category->trashed()){
            $category->restore();
        }else{
            return redirect()->route('categories.index')->with('status','Category Is not in Trash');
        }

        return redirect()->route('categories.index')->with('status','Category Successfully Restored');
    }

    public function deletePermanent($id){
        $category = \App\Category::withTrashed()->findOrFail($id);

        if(!$category->trashed()){
            return redirect()->route('categories.index')->with('status','Can not Delete Permanent Active Category');
        }else{
            $category->forceDelete();

            return redirect()->route('categories.index')->with('status','Category Permanently deleted');
        }
    }

    public function ajaxSearch(Request $request){
        $keyword = $request->get('q');

        $categories = \App\Category::where('name','LIKE',"%$keyword%")->get();

        return $categories;
    }
}
