<?php

namespace App\Http\Controllers;

use App\Modell;
use App\Blog;
use Illuminate\Http\Request;
use Illuminate\Http\UploadedFile;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
        $model = Modell::where('model_id', $request->id)->first();
//        dd($model->model_id);
        return view('blogs.create', ['model' => $model]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $blog = new Blog();
        $blog->model_id = $request->model_id;
        $blog->title = $request->main_title;
        $blog->description = $request->description;
        $blog->blog_cover = $request->blog_image;
        $blog->save();

        return redirect()->route('model.show', $blog->model_id);
    }

    public function blogDetail($id)
    {
        $blogs = Blog::where('blog_id', $id)->get();
        return view('blogs.blog-detail', ['blogs' => $blogs]);
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
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $blog = Blog::where('id', $id)->first();
        $blogDetailId = $blog->blog_id;
        $blog->delete();
        return redirect()->route('blog-detail', ['id' => $blogDetailId]);
    }
}
