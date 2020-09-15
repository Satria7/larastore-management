<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {

        $categories = \App\Category::paginate(10);

        $filterKeyword = $request->get("keyword");

        if ($filterKeyword) {
            $categories = \App\Category::where("name", "LIKE", "%$filterKeyword%")->paginate(10);
        }

        return view("categories.index", compact("categories"));
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
        $name = $request->get("name");
        $newCategory = new \App\Category;
        $newCategory->name = $name;

        if ($request->file("image")) {
            $imagePath = $request->file("image")->store("category_images", "public");
            $newCategory->image = $imagePath;
        }

        $newCategory->created_by = \Auth::user()->id;
        $newCategory->slug = \Str::slug($name, '-');
        $newCategory->save();

        return redirect()->route("categories.index")->with("status", "Category Succesfully created");
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
        return view("categories.show", compact("category"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $categoryToEdit = \App\Category::findOrFail($id);
        return view("categories.edit", ["category" => $categoryToEdit]);
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
        $name = $request->get("name");
        $slug = $request->get("slug");
        $category = \App\Category::findOrFail($id);
        $category->name = $name;
        $category->slug = $slug;
        if ($request->file("image")) {
            if ($category->image && file_exists(storage_path("app/public/" . $category->image))) {
                \Storage::delete("public/" . $category->name);
            }
            $newImage = $request->file("image")->store("category_images", "public");
            $category->image = $newImage;
        }
        $category->updated_by = \Auth::user()->id;
        $category->slug = \Str::slug($name);
        $category->save();
        return redirect()->route("categories.index")->with("status", "Category succesfully updated");
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
        $category->delete();
        return redirect()->route("categories.index")->with("status", "Category moved to trash");
    }

    // trash
    public function trash()
    {
        $categories = \App\Category::onlyTrashed()->paginate(10);
        return view("categories.trash", compact("categories"));
    }

    // restore
    public function restore($id)
    {
        $category = \App\Category::withTrashed()->findOrFail($id);
        if ($category->trashed()) {
            $category->restore();
        } else {
            return redirect()->route("categories.index")->with("status", "Category is not on trash");
        }
        return redirect()->route("categories.index")->with("status", "Category succesfully restored");
    }

    // delete permanent
    public function deletePermanent($id)
    {
        $category = \App\Category::withTrashed()->findOrFail($id);
        if (!$category->trashed()) {
            return redirect()->route("categories.index")->with("status", "Can't delete permanent active category");
        } else {
            $category->forceDelete();
            return redirect()->route("categories.index")->with("status", "Category deleted permanently");
        }
    }
}
