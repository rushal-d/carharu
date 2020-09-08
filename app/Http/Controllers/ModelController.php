<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Attribute_Model;
use App\Brand;
use App\Detail;
use App\Feature;
use App\Gallery;
use App\Mail\Mailtrap;
use App\Model_Category;
use App\ModelCategoryPivot;
use App\Modell;
use App\Specification;
use App\Sub_Attribute;
use App\Sub_Division;
use App\SubAttributeOptionGallery;
use App\SubAttributeOptionModel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class ModelController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $models = Modell::with('brand','variants','categories')->whereNull('parent_id');
        $brand = Brand::pluck('brand_name', 'brand_id');
        //$featured_category = Model_Category::where('name', 'featured')->first();
        //$popular_category = Model_Category::where('name', 'popular')->first();
        $sortbycategory = Model_Category::pluck('name', 'id');

        /*if(!empty($request->lower && $request->upper && $request->lower != 0)){
            $lower = explode('lakh', $request->lower);
            $models = $models->where('price', '>=', $request->lower)->where('price', '<=', $request->upper);
        }
        if($request->has('featured'))
        {
            $models = Modell::whereHas('categories', function($query) use($featured_category){
                $query->where('category_id', $featured_category->id);
            });
        }
        if($request->has('popular'))
        {
            $models = Modell::whereHas('categories', function ($query) use ($popular_category){
                $query->where('category_id', $popular_category->id);
            });
        }
        if($request->has('variants'))
        {
            $models = Modell::where('parent_id', '<>', null);
        }
        */
        if($request->has('model_category') && !empty($request->model_category))
        {
            $models = $models->whereHas('categories', function($query) use ($request){
               $query->where('category_id', $request->model_category);
            });
        }
        if($request->has('model_name') && !empty($request->model_name))
        {
            $models = $models->where('model_name', 'LIKE', '%'.$request->model_name.'%');
        }

        if($request->has('brand_name') && !empty($request->brand_name))
        {
            $models = $models->where('brand_id', (int)($request->brand_name));
        }
        if(!empty($request->model_name))
        {
            $models = $models->where('model_name', 'LIKE','%'. $request->model_name. '%' );
        }
        $models = $models->latest()->paginate(50);
        $model_category = Model_Category::pluck('name', 'id');
        return view('models.index', ['models' => $models, 'sortbycategory' => $sortbycategory,
            'brand' => $brand, 'model_category' => $model_category]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data['features'] = Feature::where('feature', 'Color')->pluck('feature', 'id');
        $data['category'] = Config::get('constants.category');
        $data['brands'] = Brand::pluck('brand_name', 'brand_id');
        $data['body_type'] = Sub_Division::where('division_id', 1)->pluck('name', 'id');
        return view('models.create', $data);
    }

    public function createvariant()
    {
        $data['specs'] = Specification::get();
        $data['colorIdInSpec'] = Specification::where('specification', 'Colors')->first();
        $data['features'] = Feature::pluck('feature', 'id');
        $data['feats'] = Feature::with('spec')->orderBy('specs_id')->get();
        $data['models'] = Modell::whereNull('parent_id')->orderBy('model_name', 'asc')->pluck('model_name', 'model_id');
        $data['brands'] = Brand::pluck('brand_name', 'brand_id');
        $data['category'] = Config::get('constants.category');
        $data['body_type'] = Sub_Division::where('division_id', 1)->pluck('name', 'id');
        $data['transmission_type'] = Sub_Division::transmission()->pluck('name', 'id');
        $data['fuel_type'] = Sub_Division::fuel()->pluck('name', 'id');
        $data['model_category'] = Model_Category::pluck('name', 'id');
        $data['attributes'] = Attribute::get();
        $data['subs'] = Sub_Attribute::get();
        return view('models.createvaraint', $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $status = false;
        try{
            DB::beginTransaction();
            $models = new Modell();
            $models->brand_id = $request->brand_name;
            $models->model_name = $request->model_name;
            $models->model_description = $request->model_description;
            $models->model_body_type_id = $request->model_body_type;
            $models->launch_date = $request->launch_date;
            $models->seo_title = $request->seo_title;
            $models->seo_description = $request->seo_description;
            $models->model_image = ($request->model_image[0] != null) ? $request->model_image[0] : '';
            $models->model_image_title = ($request->model_image[0] != null) ? $request->model_image_title[0] : '';
            if($models->save())
            {
                //check interior images
                if(!empty($request->interior_images))
                {
                    foreach($request->interior_images as $key => $image)
                    {
                        $gallery = new Gallery();
                        $gallery->category = Config::get('constants.image_category_interior'); //interior
                        $gallery->model_id = $models->model_id;
                        $gallery->image = $image;
                        $gallery->title = ($request->interior_images_title[$key] != null) ? $request->interior_images_title[$key] : '';
                        $gallery->save();
                    }
                }
                //check exterior images
                if(!empty($request->exterior_images))
                {
                    foreach($request->exterior_images as $key => $image)
                    {
                        $gallery = new Gallery();
                        $gallery->category = Config::get('constants.image_category_exterior'); //exterior
                        $gallery->model_id = $models->model_id;
                        $gallery->image = $image;
                        $gallery->title = ($request->exterior_images_title[$key] != null) ? $request->exterior_images_title[$key] : '';
                        $gallery->save();
                    }
                }
                //check other
                if(!empty($request->other_images))
                {
                    foreach($request->other_images as $key => $image)
                    {
                        $gallery = new Gallery();
                        $gallery->category = Config::get('constants.image_category_other'); //other_images
                        $gallery->model_id = $models->model_id;
                        $gallery->image = $image;
                        $gallery->title = ($request->other_images_title[$key] != null) ? $request->other_images_title[$key] : '';
                        $gallery->save();
                    }
                }

                //check if has color images
                if(!empty($request->color_images)){
                    $cat_id = Config::get('constants.image_category_color');
                    foreach ($request->color_images as $key => $images){
                        $gallery = new Gallery();
                        $gallery->category =  $cat_id; //color_images
                        $gallery->model_id = $models->model_id;
                        $gallery->image = end($images); //only take last image from array
                        $gallery->title = ($request->title_color_images[$key] != null) ? $request->title_color_images[$key] : '';
                        if($gallery->save()){
                           $optionGallery = new SubAttributeOptionGallery();
                            $optionGallery->model_id = $models->model_id;
                            $optionGallery->subattribute_option_id = $request->color_options[$key];
                            $optionGallery->gallery_id = $gallery->id;
                            $optionGallery->save();
                        }
                    }
                }
            }
            $status = true;
        }catch (\Exception $e){
            $status = false;
            DB::rollBack();
        }
        if($status){
            DB::commit();
        }
        $alert_type = ($status) ? 'success' : 'danger';
        $mesg = ($status) ? 'Added Successfully' : 'Error Occurred! Try Again!';
        $notification = array(
            'message' => $mesg,
            'alert-type' => $alert_type,
        );
        return redirect()->route('model.index')->with($notification);
    }

    public function storevariant(Request $request)
    {
        $status = false;
        try {
            DB::beginTransaction();
            $models = new Modell();
            $models->model_name = $request->model_name;
            $models->model_description = $request->model_description;
            $models->launch_date = $request->launch_date;
            $models->price = $request->price;
            $models->mileage = $request->mileage;
            $models->engine = $request->engine;
            $models->seats = $request->seats;
            $models->parent_id = $request->parent_model;
            $parent_model = Modell::find($request->parent_model);
            $models->model_body_type_id = $parent_model->model_body_type_id;
            $models->brand_id = $parent_model->brand_id;
            $models->seo_title = $request->seo_title;
            $models->seo_description = $request->seo_description;
            $models->model_image = ($request->model_image[0] != null) ? $request->model_image[0] : '';
            $models->model_image_title = ($request->model_image[0] != null) ? $request->model_image_title[0] : '';
            $saveModel = $models->save();
            if ($saveModel) {
                $models->transmissions()->sync($request->transmission_type);
                $models->fuels()->sync($request->fuel_type);
                //check interior images
                if (!empty($request->interior_images)) {
                    foreach ($request->interior_images as $key => $image) {
                        $gallery = new Gallery();
                        $gallery->category = Config::get('constants.image_category_interior'); //interior
                        $gallery->model_id = $models->model_id;
                        $gallery->image = $image;
                        $gallery->title = ($request->interior_images_title[$key] != null) ? $request->interior_images_title[$key] : '';
                        $gallery->save();
                    }
                }
                //check exterior images
                if(!empty($request->exterior_images))
                {
                    foreach($request->exterior_images as $key => $image)
                    {
                        $gallery = new Gallery();
                        $gallery->category = Config::get('constants.image_category_exterior'); //exterior
                        $gallery->model_id = $models->model_id;
                        $gallery->image = $image;
                        $gallery->title = ($request->exterior_images_title[$key] != null) ? $request->exterior_images_title[$key] : '';
                        $gallery->save();
                    }
                }
                //check other
                if (!empty($request->other_images)) {
                    foreach ($request->other_images as $key => $image) {
                        $gallery = new Gallery();
                        $gallery->category = Config::get('constants.image_category_other'); //other_images
                        $gallery->model_id = $models->model_id;
                        $gallery->image = $image;
                        $gallery->title = ($request->other_images_title[$key] != null) ? $request->other_images_title[$key] : '';
                        $gallery->save();
                    }
                }

                foreach ($request->features as $featureId => $featureValue) {
                    $detail = new Detail();
                    $detail->feature_id = $featureId;
                    $detail->value = $featureValue;
                    $detail->model_id = $models->model_id;
                    $detail->save();
                }

                foreach ($request->sub_attributes as $subId => $subValue) {
                    $sub_model = new Attribute_Model();
                    $sub_model->sub_attribute_id = $subId;
                    $sub_model->value = $subValue;
                    $sub_model->model_id = $models->model_id;
                    $sub_model->save();
                }

                $feature_id = $request->feat_id;
                $colors = $request->color;
                if(!empty($colors)){
                    foreach ($colors as $color) {
                        $co = new Detail();
                        $co->feature_id = $feature_id;
                        $co->model_id = $models->model_id;
                        $co->value = $color['coname'] . "," . $color['picker'];
                        $co->save();
                    }
                }

                if (!empty($request->docs)) {
                    foreach ($request->docs as $doc) {
                        $gallery = new Gallery();
                        $gallery->category = $request->category;
                        $gallery->model_id = $models->model_id;
                        $gallery->image = $doc;
                        $gallery->save();
                    }
                }
            }
            $status = true;
        }catch (\Exception $e){
            dd($e);
            $status = false;
            DB::rollBack();
        }
        if($status){
            DB::commit();
        }
        $alert_type = ($status) ? 'success' : 'danger';
        $mesg = ($status) ? 'Added Successfully' : 'Error Occurred! Try Again!';
        $notification = array(
            'message' => $mesg,
            'alert-type' => $alert_type,
        );
        return redirect()->route('model.variants')->with($notification);;
    }

    public function clonevariant($id)
    {
        $status = false;
        try{
            DB::beginTransaction();
            $variant = Modell::find($id);
            $variant->model_name = $variant->model_name . ' Clone';
            $cloneVariant = $variant->replicate();
            $clone = $cloneVariant->push(); //method will fetch you the newly created id for the Model from the database and then you can use the Model object to attach new relationship

            //save the gallery
            $cloneVariant->gallery()->saveMany($variant->gallery);

            //save the specs
            $cloneVariant->detail()->saveMany($variant->detail);
            //save the specs
            $cloneVariant->attribute_model()->saveMany($variant->attribute_model);
            $status = true;
        }catch (\Exception $ex){
            $status = false;
            DB::rollBack();
            dd($ex);
            echo ('Error: '. $ex->getMessage() . '  Line: '. $ex->getLine());
        }
        if($status){
            DB::commit();
        }
        $alert_type = ($status) ? 'success' : 'danger';
        $mesg = ($status) ? 'Cloned Successfully' : 'Error Occurred! Try Again!';
        $notification = array(
            'message' => $mesg,
            'alert-type' => $alert_type,
        );
        return redirect()->route('model.variants')->with($notification);
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
        $model = Modell::find($id);
        $interior_images = $model->gallery->where('category', Config::get('constants.image_category_interior'));
        $exterior_images = $model->gallery->where('category', Config::get('constants.image_category_exterior'));
        $other_images = $model->gallery->where('category', Config::get('constants.image_category_other'));
        $models = Modell::pluck('model_name', 'model_id');
        $brands = Brand::pluck('brand_name', 'brand_id');
        $body_type = Sub_Division::where('division_id', 1)->pluck('name', 'id');
        $category = Config::get('constants.category');
        $features = Feature::where('feature', 'Color')->pluck('feature', 'id');
        return view('models.edit', ['model' => $model, 'category' => $category, 'models' => $models,
                                           'brands' => $brands, 'body_type' => $body_type,
            'interior_images' => $interior_images, 'exterior_images' => $exterior_images, 'other_images' => $other_images,
            'features' => $features]);
    }

    public function editvariant($id)
    {
        $models = Modell::pluck('model_name', 'model_id');
        $model = Modell::with('detail')->where('model_id', $id)->first();

        $interior_images = $model->gallery->where('category', Config::get('constants.image_category_interior'));
        $exterior_images = $model->gallery->where('category', Config::get('constants.image_category_exterior'));
        $other_images = $model->gallery->where('category', Config::get('constants.image_category_other'));
        $specs = Specification::get();
        $brands = Brand::pluck('brand_name', 'brand_id');
        $feats = Feature::with('spec', 'detail')->orderBy('specs_id')->get();
        $colorIdInSpec = Specification::where('specification', 'Colors')->first();
        $body_type = Sub_Division::where('division_id', 1)->pluck('name', 'id');
        $transmission_type = Sub_Division::transmission()->pluck('name', 'id');
        $fuel_type = Sub_Division::fuel()->pluck('name', 'id');
        $category = Config::get('constants.category');
        $model_category = Model_Category::pluck('name', 'id');
        $attributes = Attribute::get();
        $subs = Sub_Attribute::get();
        return view('models.editvariant', ['transmission_type' => $transmission_type, 'category' => $category, 'model_category' => $model_category, 'feats' => $feats, 'colorIdInSpec' => $colorIdInSpec, 'models' => $models,
            'model' => $model, 'specs' => $specs, 'brands' => $brands, 'body_type' => $body_type, 'fuel_type' => $fuel_type,
            'attributes' => $attributes, 'subs' => $subs,'interior_images' => $interior_images, 'exterior_images' => $exterior_images, 'other_images' => $other_images]);
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

        $status = false;
        try{
            DB::beginTransaction();
            $model = Modell::find($id);
            $model->brand_id = $request->brand_name;
            $model->model_body_type_id = $request->model_body_type;
            $model->model_name = $request->model_name;
            $model->model_description = $request->model_description;
            $model->launch_date = $request->launch_date;
            $model->seo_title = $request->seo_title;
            $model->seo_description = $request->seo_description;
            $model->model_image = ($request->model_image[0] != null) ? $request->model_image[0] : '';
            $model->model_image_title = ($request->model_image[0] != null) ? $request->model_image_title[0] : '';

            if($model->save())
            {
                //process interior images
                $category_id = Config::get('constants.image_category_interior');
                //first check images to del -- del images that are not in current ids
                if(!empty($request->interior_images_ids)){
                    $del_imgs = Gallery::where('model_id', $id)->where('category',$category_id )
                    ->whereNotIn('id', $request->interior_images_ids)->delete();
                }
                else{
                    //remove all images -- no ids means all are gone
                    $del_imgs = Gallery::where('model_id', $id)->where('category',$category_id )->delete();
                }
                //check if all empty -- deleted in prev request
                if(!empty($request->interior_images)){
                    foreach($request->interior_images as $key => $image)
                    {
                        $image_id = (isset($request->interior_images_ids[$key]) && $request->interior_images_ids[$key] != null) ? $request->interior_images_ids[$key] : 0;
                        //check if update request -- check if id exits
                        $gallery = new Gallery();
                        if(!empty($image_id)){
                            $gallery = Gallery::find($image_id);
                        }
                        $gallery->category = $category_id; //interior
                        $gallery->model_id = $id;
                        $gallery->image = $image;
                        $gallery->title = (isset($request->interior_images_title[$key]) && $request->interior_images_title[$key] != null) ? $request->interior_images_title[$key] : '';
                        $gallery->save();
                    }
                }
                //process exterior images
                $category_id = Config::get('constants.image_category_exterior');
                //first check images to del -- del images that are not in current ids
                if(!empty($request->exterior_images_ids)){
                    $del_imgs = Gallery::where('model_id', $id)->where('category',$category_id )
                    ->whereNotIn('id', $request->exterior_images_ids)->delete();
                }
                else{
                    //remove all images -- no ids means all are gone
                    $del_imgs = Gallery::where('model_id', $id)->where('category',$category_id )->delete();
                }
                //check if all empty -- deleted in prev request
                if(!empty($request->exterior_images)) {
                    foreach ($request->exterior_images as $key => $image) {
                        $image_id = (isset($request->exterior_images_ids[$key]) && $request->exterior_images_ids[$key] != null) ? $request->exterior_images_ids[$key] : 0;
                        //check if update request -- check if id exits
                        $gallery = new Gallery();
                        if (!empty($image_id)) {
                            $gallery = Gallery::find($image_id);
                        }
                        $gallery->category = $category_id; //interior
                        $gallery->model_id = $id;
                        $gallery->image = $image;
                        $gallery->title = (isset($request->exterior_images_title[$key]) && $request->exterior_images_title[$key] != null) ? $request->exterior_images_title[$key] : '';
                        $gallery->save();
                    }
                }

                //process other images
                $category_id = Config::get('constants.image_category_other');
                //first check images to del -- del images that are not in current ids
                if(!empty($request->other_images_ids)){
                    $del_imgs = Gallery::where('model_id', $id)->where('category',$category_id )
                        ->whereNotIn('id', $request->other_images_ids)->delete();
                }
                else{
                    //remove all images -- no ids means all are gone
                    $del_imgs = Gallery::where('model_id', $id)->where('category',$category_id )->delete();
                }
                //check if all empty -- deleted in prev request
                if(!empty($request->other_images)) {
                    foreach ($request->other_images as $key => $image) {
                        $image_id = (isset($request->other_images_ids[$key]) && $request->other_images_ids[$key] != null) ? $request->other_images_ids[$key] : 0;
                        //check if update request -- check if id exits
                        $gallery = new Gallery();
                        if (!empty($image_id)) {
                            $gallery = Gallery::find($image_id);
                        }
                        $gallery->category = $category_id; //interior
                        $gallery->model_id = $id;
                        $gallery->image = $image;
                        $gallery->title = (isset($request->other_images_title[$key]) && $request->other_images_title[$key] != null) ? $request->other_images_title[$key] : '';
                        $gallery->save();
                    }
                }


                //process color images
                $category_id = Config::get('constants.image_category_color');
                // delete the color from subattribute_option_gallery
                if(!empty($request->color_ids)){
                    $del_colors =  SubAttributeOptionGallery::where('model_id', $id)
                        ->whereNotIn('id', $request->color_ids)->delete();
                }
                else{
                    //remove all colors -- no ids means all are gone
                    $del_colors = SubAttributeOptionGallery::where('model_id', $id)->delete();
                }
                //first check images to del -- del images that are not in current ids
                if(!empty($request->color_images_ids)){
                    $del_imgs = Gallery::where('model_id', $id)->where('category',$category_id )
                        ->whereNotIn('id', $request->color_images_ids)->delete();
                }
                else{
                    //remove all images -- no ids means all are gone
                    $del_imgs = Gallery::where('model_id', $id)->where('category',$category_id )->delete();
                }


                //check if all empty -- deleted in prev request
                if(!empty($request->color_images)) {
                    foreach ($request->color_images as $key => $images) {
                        //get image id from prev request if has any
                        $image_id = (isset($request->color_images_ids[$key]) && $request->color_images_ids[$key] != null) ? $request->color_images_ids[$key] : 0;
                        //check if update request -- check if id exits
                        $gallery = new Gallery();
                        if (!empty($image_id)) {
                            $gallery = Gallery::find($image_id);
                        }
                        $gallery->category = $category_id; //interior
                        $gallery->model_id = $id;
                        $gallery->image = $images[0]; //always take only one image -- here take first image -- in create take last image
                        $gallery->title = (isset($request->title_color_images[$key]) && $request->title_color_images[$key] != null) ? $request->title_color_images[$key] : '';
                        if($gallery->save()){ //also save in subattribute_option_gallery

                            //get color id from prev request if has any
                            $color_option_id = (isset($request->color_ids[$key]) && $request->color_ids[$key] != null) ? $request->color_ids[$key] : 0;

                            //check if update request -- check if id exits
                            $optionGallery = new SubAttributeOptionGallery();
                            if (!empty($color_option_id)) {
                                $optionGallery = SubAttributeOptionGallery::find($color_option_id);
                            }
                            $optionGallery->model_id = $id;
                            $optionGallery->subattribute_option_id = (isset($request->color_options[$key]) && $request->color_options[$key] != null) ? $request->color_options[$key] : NULL;
                            $optionGallery->gallery_id = $gallery->id;
                            if(!empty($optionGallery->subattribute_option_id) && !empty($optionGallery->gallery_id)){
                                $optionGallery->save();
                            }
                        }
                    }
                }

            }
            $status = true;
        }catch (\Exception $e){
            $status = false;
            DB::rollBack();
            dd($e);
        }
        if($status){
            DB::commit();
        }
        $alert_type = ($status) ? 'success' : 'danger';
        $mesg = ($status) ? 'Updated Successfully' : 'Error Occurred! Try Again!';
        $notification = array(
            'message' => $mesg,
            'alert-type' => $alert_type,
        );
        return redirect()->route('model.edit', $model->model_id)->with($notification);
    }

    public function updatevariant(Request $request, $id)
    {
        $status = false;
        try {
            DB::beginTransaction();
            $featuredone = $request->feat;
            $popularone = $request->popular;
            $variant = $request->variants;
            $model = Modell::where('model_id', $id)->first();
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
            $model->model_image = ($request->model_image[0] != null) ? $request->model_image[0] : '';
            $model->model_image_title = ($request->model_image[0] != null) ? $request->model_image_title[0] : '';
            if ($model->save()) {
                $model->transmissions()->sync($request->transmission_type);
                $model->fuels()->sync($request->fuel_type);
                //save images
                //process interior images
                $category_id = Config::get('constants.image_category_interior');
                //first check images to del -- del images that are not in current ids
                if (!empty($request->interior_images_ids)) {
                    $del_imgs = Gallery::where('model_id', $id)->where('category', $category_id)
                        ->whereNotIn('id', $request->interior_images_ids)->delete();
                } else {
                    //remove all images -- no ids means all are gone
                    $del_imgs = Gallery::where('model_id', $id)->where('category', $category_id)->delete();
                }
                //check if all empty -- deleted in prev request
                if (!empty($request->interior_images)) {
                    foreach ($request->interior_images as $key => $image) {
                        $image_id = (isset($request->interior_images_ids[$key]) && $request->interior_images_ids[$key] != null) ? $request->interior_images_ids[$key] : 0;
                        //check if update request -- check if id exits
                        $gallery = new Gallery();
                        if (!empty($image_id)) {
                            $gallery = Gallery::find($image_id);
                        }
                        $gallery->category = $category_id; //interior
                        $gallery->model_id = $id;
                        $gallery->image = $image;
                        $gallery->title = (isset($request->interior_images_title[$key]) && $request->interior_images_title[$key] != null) ? $request->interior_images_title[$key] : '';
                        $gallery->save();
                    }
                }
                //process exterior images
                $category_id = Config::get('constants.image_category_exterior');
                //first check images to del -- del images that are not in current ids
                if (!empty($request->exterior_images_ids)) {
                    $del_imgs = Gallery::where('model_id', $id)->where('category', $category_id)
                        ->whereNotIn('id', $request->exterior_images_ids)->delete();
                } else {
                    //remove all images -- no ids means all are gone
                    $del_imgs = Gallery::where('model_id', $id)->where('category', $category_id)->delete();
                }
                //check if all empty -- deleted in prev request
                if (!empty($request->exterior_images)) {
                    foreach ($request->exterior_images as $key => $image) {
                        $image_id = (isset($request->exterior_images_ids[$key]) && $request->exterior_images_ids[$key] != null) ? $request->exterior_images_ids[$key] : 0;
                        //check if update request -- check if id exits
                        $gallery = new Gallery();
                        if (!empty($image_id)) {
                            $gallery = Gallery::find($image_id);
                        }
                        $gallery->category = $category_id; //interior
                        $gallery->model_id = $id;
                        $gallery->image = $image;
                        $gallery->title = (isset($request->exterior_images_title[$key]) && $request->exterior_images_title[$key] != null) ? $request->exterior_images_title[$key] : '';
                        $gallery->save();
                    }
                }

                //process other images
                $category_id = Config::get('constants.image_category_other');
                //first check images to del -- del images that are not in current ids
                if (!empty($request->other_images_ids)) {
                    $del_imgs = Gallery::where('model_id', $id)->where('category', $category_id)
                        ->whereNotIn('id', $request->other_images_ids)->delete();
                } else {
                    //remove all images -- no ids means all are gone
                    $del_imgs = Gallery::where('model_id', $id)->where('category', $category_id)->delete();
                }
                //check if all empty -- deleted in prev request
                if (!empty($request->other_images)) {
                    foreach ($request->other_images as $key => $image) {
                        $image_id = (isset($request->other_images_ids[$key]) && $request->other_images_ids[$key] != null) ? $request->other_images_ids[$key] : 0;
                        //check if update request -- check if id exits
                        $gallery = new Gallery();
                        if (!empty($image_id)) {
                            $gallery = Gallery::find($image_id);
                        }
                        $gallery->category = $category_id; //interior
                        $gallery->model_id = $id;
                        $gallery->image = $image;
                        $gallery->title = (isset($request->other_images_title[$key]) && $request->other_images_title[$key] != null) ? $request->other_images_title[$key] : '';
                        $gallery->save();
                    }
                }


                Detail::where('model_id', $model->model_id)->delete();
                foreach ($request->features as $featureId => $featureValue) {
                    $detail = new Detail();
                    $detail->feature_id = $featureId;
                    $detail->value = $featureValue;
                    $detail->model_id = $model->model_id;
                    $detail->save();
                }

                $feature_id = $request->feat_id;
                $colors = $request->color;
                if(!empty($colors)){
                    foreach ($colors as $color) {
                        $co = new Detail();
                        $co->feature_id = $feature_id;
                        $co->model_id = $model->model_id;
                        $co->value = $color['coname'] . "," . $color['picker'];
                        $co->save();
                    }
                }
                Attribute_Model::where('model_id', $model->model_id)->delete();
                foreach ($request->sub_attributes as $subId => $subValue) {
                    $sub_model = new Attribute_Model();
                    $sub_model->sub_attribute_id = $subId;
                    $sub_model->value = $subValue;
                    $sub_model->model_id = $model->model_id;
                    $sub_model->save();
                }
                if ($request->has('docs') && count($request->docs) > 0) {
                    foreach ($request->docs as $doc) {
                        $gallery = new Gallery();
                        $gallery->category = $request->category;
                        $gallery->model_id = $model->model_id;
                        $gallery->image = $doc;
                        $gallery->save();
                    }
                }
            }
            $status = true;
        }catch (\Exception $e){
            $status = false;
            DB::rollBack();
            dd($e);
        }
        if($status){
            DB::commit();
        }
        $alert_type = ($status) ? 'success' : 'danger';
        $mesg = ($status) ? 'Updated Successfully' : 'Error Occurred! Try Again!';
        $notification = array(
            'message' => $mesg,
            'alert-type' => $alert_type,
        );
        return redirect()->route('model.editvariant', $model->model_id)->with($notification);
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

    public function variants(Request $request){
        //check if has request or not
        $models = Modell::with('brand','base')->whereNotNull('parent_id');
        if($request->has('model') && !empty(trim($request->model))){
            $models->where('model_name', 'LIKE', '%'.trim($request->model.'%'));
        }
        if($request->has('base') && !empty($request->base)){
            $models->where('parent_id', $request->base);
        }
        if($request->has('brand') && !empty($request->brand)){
            $models->where('brand_id', $request->brand);
        }
        $models = $models->latest()->paginate(50);
        $cars = Modell::whereNull('parent_id')->pluck('model_name', 'model_id');
        $brands = Brand::pluck('brand_name', 'brand_id');

        return view('models.variants', compact(['models', 'cars', 'brands']));
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
