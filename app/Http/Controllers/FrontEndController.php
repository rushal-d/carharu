<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Blog;
use App\Brand;
use App\Division;
use App\Model_Category;
use App\Modell;
use App\Post;
use App\Review;
use App\Specification;
use App\Sub_Division;
use Baum\Extensions\Eloquent\Model;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Config;
use Artesaos\SEOTools\Traits\SEOTools;
use MilanTarami\NumberToWordsConverter\Services\NumberToWords;
use PhpParser\Node\Expr\AssignOp\Mod;
use function foo\func;

class FrontEndController extends Controller
{
    use SEOTools;
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $title = 'CarHaru - Comprehensive Car Portal of Nepal';
        $description = 'CarHaru is Nepal\'s most best comprehensive car portal of nepal with authentic source of new car price list
        and car news and information. CarHaru helps to buy new car in Nepal at the right and best price.';
        //seo
        $this->seo()->setTitle($title);
        $this->seo()->setDescription($description);
        $brands = Brand::all();
        $slider = Post::findBySlugOrFail('slider');
        $today = Carbon::now();
        //get current month launched cars
        $just_launched = Modell::with('brand','variants')->whereMonth('launch_date', date('m'))->where('parent_id', null)->paginate(10);
        $featuredCars = Modell::with('brand','variants')->featuredCars();
        $popularCars = Modell::with('brand','variants')->popularCars();
        $upcoming = Modell::where('launch_date', '>', $today)->where('parent_id', null)->get()->take(10);
        $blogs = Blog::paginate(6);
        $transmissions = Sub_Division::transmission()->get();
        $body_types = Sub_Division::where('division_id', 1)->get();
        $fuel_types = Sub_Division::fuel()->get();
        return view('frontend.index', ['title' => $title, 'popularCars' => $popularCars, 'featuredCars' => $featuredCars,
            'just_launched' => $just_launched, 'brands' => $brands, 'today' => $today,
            'upcoming' => $upcoming, 'blogs' => $blogs, 'slider' => $slider,
            'body_types' => $body_types, 'transmissions' => $transmissions, 'fuel_types' => $fuel_types
        ]);
    }

    public function search(Request $request)
    {
        $model = Modell::where('model_name', $request->model_name)->first();
        if(!is_null($model)){
            return redirect()->route('frontend.modeldetail', ['id' => $model->model_id]);
        }else{
            return redirect()->route('frontend');
        }
    }

    public function getModel(Request $request)
    {
        $models = Modell::where('model_name', 'like','%'.$request->model_name.'%')->get();
        return response()->json([
            'models' => $models
        ]);
    }

    public function brand($slug)
    {
        $brand = Brand::findBySlug($slug);
        $brands = Brand::where('brand_id', '!=', $brand->brand_id)->get();
        $popularCars = Modell::with('brand','variants')->popularCars();
        $cars = Modell::with('brand','variants')->where('brand_id', $brand->brand_id)->where('parent_id', null)->get();
        $title = $brand->seo_title ?? $brand->brand_name . ' cars in Nepal';
        $description = $brand->seo_description ?? str_limit($brand->brand_description, 155);
        $this->seo()->setTitle($title);
        $this->seo()->setDescription($description);
        return view('frontend.brand', compact(['brand','cars','popularCars','brands']));
    }

    public function cars()
    {
        $title = 'Cars in Nepal';
        $description = 'All about cars in Nepal. CarHaru is your ultimate website to get all information about cars, price,
         specifications, features, variants and other information about cars.';
        $this->seo()->setTitle($title);
        $this->seo()->setDescription($description);
        $brands = Brand::get();
        $popularCars = Modell::with('brand','variants')->popularCars();
        $cars = Modell::with('brand','variants')->where('parent_id', null)->paginate(10);
        return view('frontend.cars', compact(['title','cars','popularCars','brands']));
    }

    public function modelDetail($brand, $slug)
    {
        $model = Modell::with(['brand','transmissions','fuels','variants','variants.transmissions','variants.fuels',
            'variants.brand','gallery', 'colorImages', 'colorImages.attribute'])->where('slug',$slug)->first();
        $variants = Modell::with(['brand','transmissions','fuels','variants','variants.transmissions','variants.fuels','variants.brand'])->where('parent_id', $model->model_id)->get();
        $title = $model->seo_title ?? $model->model_name . ' in Nepal';
        $description = $model->seo_description ?? str_limit($model->model_description, 155);
        //seo
        $this->seo()->setTitle($title);
        $this->seo()->setDescription($description);
        $colorImages = $model->colorImages;
        $exteriorImages = $model->gallery->where('category', Config::get('constants.image_category_exterior'));
        $id = $model->model_id;
        $popularCars = Modell::with('brand','variants')->popularCars();
        $sameBrandCars = Modell::with('brand','variants')->sameBrandCars($id, $model->brand_id);
        $similarCars = Modell::with('brand','variants')->similarCars($id, $model->model_body_type_id);
        return view('frontend.modeldetails', compact([
            'model','variants','title','exteriorImages','colorImages', 'popularCars', 'sameBrandCars', 'similarCars'
        ]));
    }

    public function carSpecs($brand, $slug)
    {
        $model = Modell::with(['brand','transmissions','fuels','variants','variants.transmissions','variants.fuels',
            'variants.brand','gallery', 'colorImages', 'colorImages.attribute'])->where('slug',$slug)->first();
        $variants = Modell::with(['brand','transmissions','fuels','variants','variants.transmissions','variants.fuels','variants.brand'])->where('parent_id', $model->model_id)->get();
        $title = $model->seo_title ?? $model->model_name . ' in Nepal';
        $description = $model->seo_description ?? str_limit($model->model_description, 155);
        //seo
        $this->seo()->setTitle($title);
        $this->seo()->setDescription($description);
        $colorImages = $model->colorImages;
        $exteriorImages = $model->gallery->where('category', Config::get('constants.image_category_exterior'));
        $id = $model->model_id;
        $popularCars = Modell::with('brand','variants')->popularCars();
        $sameBrandCars = Modell::with('brand','variants')->sameBrandCars($id, $model->brand_id);
        $similarCars = Modell::with('brand','variants')->similarCars($id, $model->model_body_type_id);
        return view('frontend.modeldetails', compact([
            'model', 'variants','title','exteriorImages','colorImages', 'popularCars', 'sameBrandCars', 'similarCars'
        ]));
    }

   /* public function getBasicInfo($model, $variants){
        //only get the basic info from variants if parent is null
        if(count($variants) > 0){
            $model->priceInWords = 'Rs. ' . $this->priceInWords($variants->min('price')) . 'onwards';

            $model->mileage = $variants->max('mileage');
            $model->engine = $engine = $variants->min('engine') . ' - ' . $variants->max('engine');
            //get the transmission and fuel from the variants
            $transmissions = [];
            $fuels = [];
            foreach ($variants as $variant){
                //transmissions
                $transmission_arr = $variant->transmissions->pluck('name')->toArray();
                //check if already in array
                foreach ($transmission_arr as $key => $value){
                    if(!in_array($value, $transmissions)) $transmissions[] = $value;
                }
                //fuel types
                $fuel_arr = $variant->fuels->pluck('name')->toArray();
                //check if already in array
                foreach ($fuel_arr as $key => $value){
                    if(!in_array($value, $fuels)) $fuels[] = $value;
                }
            }
            $model->transmission_all = (implode(', ', $transmissions));
            $model->fuel_all = (implode(', ', $fuels));
        }
        else{ //get from the model itself
            //$model->priceInWords = 'Rs.' . $this->priceInWords($model->price);
            $model->transmission_all = (implode(', ', $model->transmissions->pluck('name')->toArray()));
            $model->fuel_all = (implode(', ', $model->fuels->pluck('name')->toArray()));
        }

    }*/

    public function variantDetail($slug)
    {
        $variant = Modell::with('detail', 'detail.feature', 'attribute_model', 'attribute_model.sub_attribute')->whereSlug($slug)->first();
        $models = Modell::inRandomOrder()->where('parent_id', null)->get()->take(3);
        $sametopmodels = Modell::where('model_id', '<>', $variant->parent_id)->where('parent_id', null)->get()->take(10);
        $money = new NumberToWords();
        $specifications = Specification::get();
        $attributes = Attribute::get();
        //seo
        $this->seo()->setTitle($variant->seo_title ?? $variant->model_name);
        $this->seo()->setDescription($variant->seo_description ?? $variant->model_description);
        $reviews = Review::where('model_id', $variant->model_id)->get();
        $avg = $reviews->avg('rating');
        $blogs = $variant->blog()->get()->take(3);
        $colorIdInSpecs = Specification::where('specification', 'Colors')->first();
        $reviews = $variant->review()->get()->take(4);
        return view('frontend.variantdetails', ['avg' => $avg, 'variant' => $variant, 'models' => $models, 'sametopmodels' => $sametopmodels, 'money' => $money, 'specifications' => $specifications,
                                                    'colorIdInSpecs' => $colorIdInSpecs, 'reviews' => $reviews, 'attributes' => $attributes, 'blogs' => $blogs, 'reviews' => $reviews]);
    }

    public function page($slug)
    {
        $page = Post::findBySlugOrFail($slug);
        $title = $page->name;
        $content = $page->description;
        $excerpt = $page->excerpt;
        $published_date = $page->published_date;
        $featured_image = $page->featured_image;
        //seo
        $this->seo()->setTitle($page->seo_title);
        $this->seo()->setDescription($page->seo_description);
        return view('frontend.page', compact('title', 'content', 'excerpt', 'published_date', 'featured_image'));
    }

    public function compareModels(Request $request)
    {
        $mods = null;
        $brands = Brand::pluck('brand_name', 'brand_id');
        $title = "Compare Cars";
        $models = Modell::pluck('model_name', 'model_id');
        $specifications = Specification::get();
        $colorIdInSpecs = Specification::where('specification', 'Colors')->first();
        if(!empty($request->model_id)){
            $mods = Modell::whereIn('model_id', $request->model_id)->get();
            $mods = $mods->sortBy(function($model) use($request){
                return array_search($model->getKey(), $request->model_id);
            });
        }
        return view('frontend.compare', ['models' => $models, 'title' => $title, 'mods' => $mods, 'specifications' => $specifications, 'colorIdInSpecs' => $colorIdInSpecs, 'brands' => $brands]);
    }

    public function ajaxComparisonFrontEnd(Request $request)
    {
        $mods = null;
        $specifications = Specification::get();
        $colorIdInSpecs = Specification::where('specification', 'Colors')->first();
        if(!empty($request->modelIds))
        {
            $mods = Modell::whereIn('model_id', $request->modelIds)->get();
            $mods = $mods->sortBy(function($model) use ($request){
                return array_search($model->getKey(), $request->modelIds);
            });
        }


        return response()->json([
            'status' => 'true',
            'view' => view('partial.frontend-compare', [
                'mods' => $mods,
                'specifications' => $specifications,
                'colorIdInSpecs' => $colorIdInSpecs
            ])->render(),
            'message' => 'Successful'
        ]);
    }

    public function ajaxGetModelsByBrandIdFrontEnd(Request $request)
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

    public function filterPage(Request $request)
    {
        $modelsbasedonbrands = null;
        if($request->has('brand')){
            $brand = Brand::findBySlug($request->brand);
            $modelsbasedonbrands = Modell::where('brand_id', $brand->brand_id)->where('parent_id', null)->get();
        }
        if($request->has('body')){
            $model = Sub_Division::findBySlug($request->body);
            $modelsbasedonbrands = Modell::where('model_body_type_id', $model->id)->where('parent_id', null)->get();
        }
        if($request->has('transmission')){
            $model = Sub_Division::findBySlug($request->transmission);
            $modelsbasedonbrands = Modell::where('transmission_type_id', $model->id)->where('parent_id', null)->get();
        }
        if($request->has('fuel')){
            $model = Sub_Division::findBySlug($request->fuel);
            $modelsbasedonbrands = Modell::where('fuel_type_id', $model->id)->where('parent_id', null)->get();
        }
        $modelsbasedonbrands = $modelsbasedonbrands;
        $models = Modell::inRandomOrder()->where('parent_id', null)->get()->take(3);
        return view('frontend.filter-page', [
            'modelsbasedonbrands' => $modelsbasedonbrands,
            'models' => $models,
        ]);
    }

    public function blogDetail($id)
    {

    }

    public function allReviews($id)
    {
        $reviews = Review::where('model_id', $id)->get();
    }

}
