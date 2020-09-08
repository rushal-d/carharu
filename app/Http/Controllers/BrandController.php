<?php

namespace App\Http\Controllers;

use App\Modell;
use App\Post;
use Illuminate\Http\Request;
use App\Brand;
use Illuminate\Support\Facades\Storage;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['title'] = "List of Brands";
        $data['brands'] = Brand::select()->paginate(50);
        return view('brands.index', $data);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('brands.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $brand = new Brand();
        $brand->brand_name = $request->brand_name;
        $brand->brand_description = $request->brand_description;
        if(!empty($request->docs)) {
            foreach ($request->docs as $docs) {
                $brand->brand_image = $docs;
            }
        }
        $brand->seo_title = $request->seo_title;
        $brand->seo_description = $request->seo_description;
        $brand->save();
        return redirect()->route('brand.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $brand = Brand::where('brand_id', $id)->firstOrFail();

//        $models = Modell::whereNull('parent_id')->where('brand_id', $id)->get();
        $models = $brand->models()->where('parent_id', null)->paginate(50);

        return view('models.listofmodels', ['brand' => $brand, 'models' => $models]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $brand = Brand::where('brand_id', $id)->first();
        return view('brands.edit', ['brand' => $brand]);
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
        $brand = Brand::where('brand_id', $id)->first();
        $brand->brand_name = $request->brand_name;
        $brand->brand_description = $request->brand_description;
        $brand->brand_image = $request->brand_image;
        $brand->seo_title = $request->seo_title;
        $brand->seo_description = $request->seo_description;
        $brand->slug = null;
        if(!empty($request->slug)){
            $cat = Brand::findBySlug($request->slug);
            if(empty($cat)){
                $brand->slug = $request->slug;
            }
        }
        $brand->save();
        return redirect()->route('brand.edit', $brand->brand_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $brand = Brand::where('brand_id', $id)->first();
        $brand->delete();
        return redirect()->route('brand.index');
    }
}
