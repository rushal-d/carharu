<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Attribute_Model;
use App\Blog;
use App\Detail;
use App\Feature;
use App\Gallery;
use App\Mail\Mailtrap;
use App\Model_Category;
use App\Model_Suspension;
use App\ModelCategoryPivot;
use App\Review;
use App\Specification;
use App\Sub_Attribute;
use App\Sub_Division;
use Illuminate\Http\Request;
use App\Modell;
use App\Brand;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Mail;
use PhpParser\Node\Expr\AssignOp\Mod;
use function foo\func;

class AModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $models = Modell::with('brand')->whereNull('parent_id');
        $featured_category = Model_Category::where('name', 'featured')->first();
        $popular_category = Model_Category::where('name', 'popular')->first();
        $sortbycategory = Model_Category::pluck('name', 'id');
        $brand = Brand::pluck('brand_name', 'brand_id');
        if(!empty($request->lower && $request->upper && $request->lower != 0)){
            $lower = explode('lakh', $request->lower);
//            dd($lower);
            $models = $models->where('price', '>=', $request->lower)->where('price', '<=', $request->upper);
        }
//        if($request->has('featured'))
//        {
//            $models = Modell::whereHas('categories', function($query) use($featured_category){
//                $query->where('category_id', $featured_category->id);
//            });
//        }
//        if($request->has('popular'))
//        {
//            $models = Modell::whereHas('categories', function ($query) use ($popular_category){
//                $query->where('category_id', $popular_category->id);
//            });
//        }
//        if($request->has('variants'))
//        {
//            $models = Modell::where('parent_id', '<>', null);
//        }
        if(!empty($request->model_category))
        {
            $models = $models->whereHas('categories', function($query) use ($request){
               $query->where('category_id', $request->model_category);
            });
        }
        if(!empty($request->brand_name))
        {
            $model = $models->where('brand_id', $request->brand_name);
        }
        if(!empty($request->model_name))
        {
            $models = $models->where('model_name', 'LIKE','%'. $request->model_name. '%' );
        }
        $variants = Modell::where('parent_id', '<>', null)->get();
        $models = $models->paginate(50);
        $model_category = Model_Category::pluck('name', 'id');
        return view('models.index', ['models' => $models, 'variants' => $variants,
            'sortbycategory' => $sortbycategory, 'brand' => $brand, 'model_category' => $model_category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['specs'] = Specification::get();
        $data['colorIdInSpec'] = Specification::where('specification', 'Colors')->first();
//        dd($specs->count());
        $data['features'] = Feature::pluck('feature', 'id');
        $data['feats'] = Feature::with('spec')->orderBy('specs_id')->get();
        $data['models'] = Modell::whereNull('parent_id')->orderBy('model_name', 'asc')->pluck('model_name', 'model_id');
        $data['brands'] = Brand::pluck('brand_name', 'brand_id');
        $data['category'] = Config::get('constants.category');
        $data['body_type'] = Sub_Division::where('division_id', 1)->pluck('name', 'id');
        $data['transmission_type'] = Sub_Division::where('division_id', 2)->pluck('name', 'id');
        $data['fuel_type'] = Sub_Division::where('division_id', 3)->pluck('name', 'id');
        $data['model_category'] = Model_Category::pluck('name', 'id');
        $data['attributes'] = Attribute::get();
        $data['subs'] = Sub_Attribute::get();
        return view('models.create', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $models = new Modell();
        $models->brand_id = $request->brand_name;
        $models->model_name = $request->model_name;
        $models->model_description = $request->model_description;
        $models->model_body_type_id = $request->model_body_type;
        $fuel = $request->input('fuel_type');
        $fu = implode(',', $fuel);
        $models->fuel_type_id = $fu;
        $transmission = $request->input('transmission_type');
        $trans = implode(',', $transmission);
        $models->transmission_type_id = $trans;
        $models->launch_date = $request->launch_date;
        $models->price = $request->price;
        $models->mileage = $request->mileage;
        $models->engine = $request->engine;
        $models->seats = $request->seats;
        $models->parent_id = $request->parent_model;
        $models->seo_title = $request->seo_title;
        $models->seo_description = $request->seo_description;
        $models->model_image = $request->model_image;

        if($models->save())
        {
            //$models->categories()->sync($request->model_category_id);
        }

        if($models->save())
        {
            foreach ($request->features as $featureId => $featureValue) {
                $detail = new Detail();
                $detail->feature_id = $featureId;
                $detail->value = $featureValue;
                $detail->model_id = $models->model_id;
                $detail->save();
            }
        }

        if($models->save())
        {
            foreach($request->sub_attributes as $subId => $subValue){
                $sub_model = new Attribute_Model();
                $sub_model->sub_attribute_id = $subId;
                $sub_model->value = $subValue;
                $sub_model->model_id = $models->model_id;
                $sub_model->save();
            }
        }

        if($models->save())
        {
            $feature_id = $request->feat_id;
            $colors = $request->color;
            foreach($colors as $color)
            {
                $co =new Detail();
                $co->feature_id = $feature_id;
                $co->model_id = $models->model_id;
                $co->value =  $color['coname'] .",". $color['picker'];
                $co->save();
            }
        }

        if($models->save())
        {
            if(!empty($request->docs))
            {
                foreach($request->docs as $doc)
                {
                    $gallery = new Gallery();
                    $gallery->category = $request->category;
                    $gallery->model_id = $models->model_id;
                    $gallery->image = $doc;
                    $gallery->save();
                }
            }

        }
        return redirect()->route('model.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $model = Modell::with('detail', 'detail.feature', 'detail.feature.spec', 'brand', 'review')->where('model_id', $id)->first();
//        dd($model);
//        foreach($model->detail as $ms){
//            dd('This is suspension name: '. $ms->suspension->attribute. ' and has value'. $ms->value);
//        }
//        dd($models);
        $specs = Specification::get();
        $listofmodels = Modell::where('parent_id', $id)->paginate(50);
        $colorIdInSpec = Specification::where('specification', 'Colors')->first();
//        dd($colorIdInSpec);
        $galleries = $model->gallery()->where('model_id', $id)->get();
        $blogs = $model->blog()->get();
        $reviews = $model->review()->get();
        $transmission = explode(',', $model->transmission_type_id);
        $fuel = explode(',', $model->fuel_type_id);
//        dd($reviews->count());
//        dd($blog);
        return view('models.modeldetails', ['model' => $model, 'listofmodels' => $listofmodels, 'specs' =>$specs, 'colorIdInSpec' => $colorIdInSpec,
                                                'galleries' => $galleries, 'blogs' => $blogs, 'reviews' => $reviews, 'fuel' => $fuel, 'transmission' => $transmission]);
    }

    public function variantdetails($id)
    {
        $specs = Specification::get();
        $attributes = Attribute::get();
        $variant = Modell::with('detail', 'detail.feature', 'attribute_model', 'attribute_model.sub_attribute')->where('model_id', $id)->first();
        $colorIdInSpec = Specification::where('specification', 'Colors')->first();
        $blogs = $variant->blog()->get();
        return view('models.variantdetails', ['variant' => $variant, 'specs' => $specs, 'colorIdInSpec' => $colorIdInSpec, 'attributes' => $attributes, 'blogs' => $blogs]);
    }

    public function compareModels(Request $request)
    {
        $mods = null;
//        dd($mods->count());
        $brands = Brand::pluck('brand_name', 'brand_id');
        $models = Modell::pluck('model_name', 'model_id');
        if(!empty($request->model_id))
        {
            $mods = Modell::whereIn('model_id', $request->model_id)->get();
            $mods = $mods->sortBy(function($model) use ($request) {
                return array_search($model->getKey(), $request->model_id);
            });
        }

        return view('models.comparison', ['models' => $models, 'mods' => $mods, 'brands' => $brands]);
    }


    public function ajaxComparison(Request $request)
    {
        $mods = null;
        if(!empty($request->modelIds))
        {
            $mods = Modell::whereIn('model_id', $request->modelIds)->get();
            $mods = $mods->sortBy(function($model) use ($request){
                return array_search($model->getKey(), $request->modelIds);
            });
        }


        return response()->json([
            'status' => 'true',
            'view' => view('partial.compare', [
                'mods' => $mods
            ])->render(),
            'message' => 'Successful'
        ]);
    }

    public function ajaxGetModelsByBrandId(Request $request)
    {
//        if(empty($request->brand_id))
//        {
//            return response()->json([
//               'status' => 'true',
//               'data' => Modell::select('brand_id', 'model_id')->get(),
//                'message' => 'Retrieved all models'
//            ]);
//        }
        $brand = Brand::where('brand_id', $request->brand_id)->first();

        if(empty($brand))
        {
            return response()->json([
               'status' => 'false',
               'data' => [],
                'message' => 'No brand found'
            ]);
        }

        $models = $brand->models->where('parent_id', '<>', null)->pluck('model_name', 'model_id');

        return response()->json([
            'status' => 'true',
            'data' => $models,
            'message' => 'Models retrieved successfully'
        ]);
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $models = Modell::pluck('model_name', 'model_id');
        $model = Modell::with('detail')->where('model_id', $id)->first();
        $specs = Specification::get();
        $brands = Brand::pluck('brand_name', 'brand_id');
        $feats = Feature::with('spec', 'detail')->orderBy('specs_id')->get();
        $colorIdInSpec = Specification::where('specification', 'Colors')->first();
        $body_type = Sub_Division::where('division_id', 1)->pluck('name', 'id');
        $transmission_type = Sub_Division::where('division_id', 2)->pluck('name', 'id');
        $fuel_type = Sub_Division::where('division_id', 3)->pluck('name', 'id');
        $category = Config::get('constants.category');
        $model_category = Model_Category::pluck('name', 'id');
        $attributes = Attribute::get();
        $subs = Sub_Attribute::get();
        return view('models.edit', ['transmission_type' => $transmission_type, 'category' => $category, 'model_category' => $model_category, 'feats' => $feats, 'colorIdInSpec' => $colorIdInSpec, 'models' => $models,
                                            'model' => $model, 'specs' => $specs, 'brands' => $brands, 'body_type' => $body_type, 'fuel_type' => $fuel_type,
                                            'attributes' => $attributes, 'subs' => $subs]);
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

        $featuredone = $request->feat;
        $popularone = $request->popular;
        $variant = $request->variants;
        $model = Modell::where('model_id', $id)->first();
        $model->brand_id = $request->brand_name;
        $model->model_body_type_id = $request->model_body_type;
        $fuel = $request->input('fuel_type');
        $fu = implode(',', $fuel);
        $model->fuel_type_id = $fu;
//        dd($request->input('transmission_type'));
        $transmission = $request->input('transmission_type');
        $trans = implode(',', $transmission);
        $model->transmission_type_id = $trans;
        $model->model_name = $request->model_name;
        $model->model_description = $request->model_description;
        $model->launch_date = $request->launch_date;
        $model->price = $request->price;
        $model->mileage = $request->mileage;
        $model->engine = $request->engine;
        $model->seats = $request->seats;
        $model->parent_id = $request->parent_model;
        $model->seo_title = $request->seo_title;
        $model->seo_description = $request->seo_description;
        if(!empty($request->single_image))
        {
            $model->model_image = $request->single_image;
        } else {
            $model->model_image = 'no.png';
        }

        if($model->save()){
            //$model->categories()->sync($request->model_category_id);
        }
        if($model->save())
        {
            $details = Detail::where('model_id', $model->model_id)->delete();
        }

        if($model->save())
        {
            foreach ($request->features as $featureId => $featureValue) {
                $detail = new Detail();
                $detail->feature_id = $featureId;
                $detail->value = $featureValue;
                $detail->model_id = $model->model_id;
                $detail->save();
            }
        }

        if($model->save())
        {
            $feature_id = $request->feat_id;
            $colors = $request->color;
            foreach($colors as $color)
            {
                $co =new Detail();
                $co->feature_id = $feature_id;
                $co->model_id = $model->model_id;
                $co->value =  $color['coname'] .",". $color['picker'];
                $co->save();
            }
        }

        if($model->save())
        {
            foreach($request->sub_attributes as $subId => $subValue){
                $sub_model = new Attribute_Model();
                $sub_model->sub_attribute_id = $subId;
                $sub_model->value = $subValue;
                $sub_model->model_id = $model->model_id;
                $sub_model->save();
            }
        }

        if($model->save())
        {
            if(!empty($request->docs))
            {
                foreach($request->docs as $doc)
                {
                    $gallery = new Gallery();
                    $gallery->category = $request->category;
                    $gallery->model_id = $model->model_id;
                    $gallery->image = $doc;
                    $gallery->save();
                }
            }
        }
        return redirect()->route('model.edit', $model->model_id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Modell::where('model_id', $id)->first();
        $details =Detail::where('model_id', $model->model_id)->delete();
        $gallery = Gallery::where('model_id', $model->model_id)->delete();
        $model->delete();
        return redirect()->route('model.index', ['id' => $model->model_id]);
    }

    public function mail()
    {
        Mail::to('dangolruzan@gmail.com')->send(new Mailtrap());
    }

    public function variants(){
        $models = Modell::with('brand')->whereNotNull('parent_id')->paginate(500);
        return view('models.varaints', compact(['models']));
    }

    public function ajaxCategoryUpdate(Request $request){
        $ids = $request->ids;
        //max items in one category is 9
        $max_num = 9;
        $mesg = '';
        $status = true;
        $model = Modell::find($request->model_id);

        //check count in the category
        if($request->remove == 0 ) {
            foreach ($ids as $id) {
                $catName = Model_Category::find($id)->value('name');
                $count = ModelCategoryPivot::where('category_id', $id)->count();
                if ($count >= $max_num) {
                    $mesg .= 'Max Allowed: ' . $max_num . ' Please remove any model from ' . $catName . '! ' . "<br>";
                    $status = false;
                } else {
                    $model->categories()->attach([$id]);
                }
            }
        } else { //remove from list
            $model->categories()->detach($ids);
        }
        return response()->json(['status' => $status, 'mesg' => $mesg]);
    }
}
