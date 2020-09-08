<?php

namespace App\Http\Controllers;

use App\Blog;
use App\Brand;
use App\Modell;
use App\Review;
use Illuminate\Http\Request;
use PHPHtmlParser\Dom;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $data['blog'] = Blog::query()->orderBy('blog_id');
        $data['review'] = Review::query();
        $data['brand'] = Brand::query();
        $data['model'] = Modell::query();
        return view('home', $data);
    }


    public function scrape(Request $request){
        $dom = new Dom;

        if($request->has('url') && !empty($request->url)){
            $url = $request->url;
        }
        else{
            $url = 'https://www.carwale.com/tata-cars/nexon-ev/xzpluslux/';
        }
//        $url = 'https://www.carwale.com/hyundai-cars/kona-electric/premiumdualtone/';
        $dom = $dom->loadFromUrl($url);
        $html = $dom->outerHtml;
        $title = $dom->find('#version_heading_lang')->text;
        //$price = $dom->find('.selected-version__price')->text;
        $basic_specs = $dom->find('.key-specs tr');
        $specs = [];
        foreach ($basic_specs as $basic_spec){
            $label = strtolower(trim($basic_spec->find('.left-data')->text));
            $value = trim(($basic_spec->find('.right-data span')->text));
            //some conditions for specs
            if($label == 'price'){
                //preg_replace('/[\x00-\x1F\x7F]/u', '', $value);
                $specs[$label] = doubleval(trim(str_replace('&#8377;','', $value)));
            }
            else if($label == 'fueltype'){
                $value = explode('/>', $value);

                if(count($value) > 1){
                    $specs[$label] = $value[1];
                }
                else{
                    $specs[$label] = $value;
                }
            }
            else{
                $specs[$label] = $value;
            }
        }
        $specs_all = [];
        $all_specs = $dom->find('.specs tr');
        foreach ($all_specs as $spec) {
            $label = ($spec->find('td')[0]);
            $value = ($spec->find('td')[1]);
            if(!empty($label) && property_exists($label, 'text')){
                $specs[strtolower($label->text)] = $value->text;
            }
        }

        dd($title, $specs);

    }

    public function scrapeColor(Request $request){
        $dom = new Dom;
        if($request->has('url') && !empty($request->url)){
            $url = $request->url;
        }
        else{
            $url = 'https://www.carwale.com/tata-cars/nexon-ev/xzpluslux/';
        }
        $dom = $dom->loadFromUrl($url);
        $html = $dom->outerHtml;
        $colors = $dom->find('#colorThumbnail .circle');
        $colors_all = [];
        $colorCarousel = $dom->find('#color-carousel li');
        foreach ($colors as $key => $color){
            $label = ($color->getAttribute('data-label'));
            $val = ($color->getAttribute('style'));
            $value = (str_replace('background-color: ', '', $val));
            $colors_all[$key]['label'] = $label;
            $colors_all[$key]['value'] = $value;
            $colors_all[$key]['image'] = $colorCarousel[$key]->find('img')->getAttribute('data-original');
            if(!file_exists(public_path('test/cars'))){
                mkdir(public_path('test/cars'));
            }
            file_put_contents('test/cars/'.$label.'.jpg', file_get_contents($colors_all[$key]['image']));
        }
        dd($colors_all);
    }
}
