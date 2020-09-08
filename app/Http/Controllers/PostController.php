<?php

namespace App\Http\Controllers;

use App\Category;
use App\Helpers\BSDateHelper;
use App\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $posts = Post::orderBy('sort_order', 'asc')->paginate(20);
        return view('posts.index', ['posts' => $posts]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $category = Category::pluck('name', 'id');
        $date_today_np = BSDateHelper::AdToBsEN('-', date('Y-m-d'));
        return view('posts.create', ['date_today_np' => $date_today_np, 'category' => $category]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $post = new Post();
        $post->name = $request->name;
        $post->description = $request->description;
        $post->excerpt = $request->excerpt;
        $post->published_date = $request->published_date;
        $post->published_date_np = $request->published_date_np;
        $post->sort_order = $request->sort_order;
        $post->featured_image = $request->featured_image;
        $post->seo_title = $request->seo_title;
        $post->seo_description = $request->seo_description;
        $post->save();

        if($post->save()){
            $post->categories()->sync($request->category_ids);
        }

        return redirect()->route('posts.index');
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
        $post = Post::where('id', $id)->first();
        $category = Category::pluck('name', 'id');
        return view('posts.edit', ['post' => $post, 'category' => $category]);
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
        $post = Post::find($id);
        $post->name = $request->name;
        $post->description = $request->description;
        $post->excerpt = $request->excerpt;
        $post->featured_image = $request->featured_image;
        $post->published_date_np = $request->published_date_np;
        $post->published_date = $request->published_date;
        $post->sort_order = $request->sort_order;
        $post->seo_title = $request->seo_title;
        $post->seo_description = $request->seo_description;
        $post->slug = null;
        if(!empty($request->slug)){
            $cat = Post::findBySlug($request->slug);
            if(empty($cat)){
                $post->slug = $request->slug;
            }
        }
        $post->save();

        if($post->save()){
            $post->categories()->sync($request->category_ids);
        }
        return redirect()->route('posts.edit', [$id]);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();
        return redirect()->route('posts.index');
    }
}
