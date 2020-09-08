<?php

namespace App\Http\Controllers;

use App\Category;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $categories = Category::orderBy('order', 'asc')->paginate(20);
        return view('category.index', ['categories' => $categories]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {
        $category = Category::pluck('name', 'id');
        $title = "Create Post Category";
        return view('category.create', ['title' => $title, 'category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return Response
     */
    public function store(Request $request)
    {
        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = $request->image;
        $category->order = $request->order;
        $category->parent_id = $request->parent_id;
        $category->save();
        return redirect()->route('post-category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function edit($id)
    {
        $title = "Edit Post Category";
        $parentCategory = Category::where('id', '<>', $id)->pluck('name', 'id');
        $category = Category::find($id);
        return view('category.edit', ['category' => $category, 'title' => $title, 'parentCategory' => $parentCategory]);
    }


    /**
     * @param Request $request
     * @param $id
     * @return \Illuminate\Http\RedirectResponse
     */
    public function update(Request $request, $id)
    {
        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;
        $category->image = $request->image;
        $category->order = $request->order;
        $category->parent_id = $request->parent_id;
        $category->slug = null;
        if(!empty($request->slug))
        {
            $cat = Category::findBySlug($request->slug);
            if(empty($cat)){
                $category->slug = $request->slug;
            }
        }
        $category->save();
        return redirect()->route('post-category.edit', $category->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id)
    {
        $category = Category::find($id);
        $category->delete();
        return redirect()->route('post-category.index');
    }
}
