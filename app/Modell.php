<?php

namespace App;

use Cviebrock\EloquentSluggable\Sluggable;
use Cviebrock\EloquentSluggable\SluggableScopeHelpers;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Config;
use function foo\func;

class Modell extends Model
{
    use SoftDeletes;
    use Sluggable;
    use SluggableScopeHelpers;

    public function sluggable()
    {
        return[
            'slug' =>[
                'source' => 'model_name'
            ]
        ];
    }

    public $table = "models";
    public $primaryKey = "model_id";

    public function brand()
    {
        return $this->belongsTo(Brand::class, 'brand_id', 'brand_id');
    }

    public function detail(){
        return $this->hasMany(Detail::class, 'model_id', 'model_id');
    }

    public function attribute_model(){
        return $this->hasMany(Attribute_Model::class, 'model_id', 'model_id');
    }

    public function transmissions(){
        return $this->belongsToMany('App\Sub_Division', 'model_transmission', 'model_id', 'transmission_id')->withTimestamps();
    }

    public function fuels(){
        return $this->belongsToMany('App\Sub_Division', 'model_fuel', 'model_id', 'fuel_id')->withTimestamps();
    }

    public function colorImages(){
        return $this->hasMany('App\SubAttributeOptionGallery', 'model_id', 'model_id');
    }

    public function body_type()
    {
        return $this->belongsTo(Sub_Division::class, 'model_body_type_id', 'id');
    }

    public function model_suspension()
    {
        return $this->hasMany(Model_Suspension::class, 'model_id', 'model_id');
    }

    public function model_dimension(){
        return $this->hasMany(Model_Dimension::class, 'model_id', 'model_id');
    }

    public function gallery()
    {
        return $this->hasMany(Gallery::class, 'model_id', 'model_id');
    }


    public function scopeExteriorImages($query)
    {
        return $query->whereHas('gallery', function($query){
            return $query->where('category', Config::get('constants.image_category_interior'));
        });
    }

    public function review()
    {
        return $this->hasMany(Review::class, 'model_id', 'model_id');
    }

    public function blog()
    {
        return $this->hasMany(Blog::class, 'model_id', 'model_id');
    }

    public function categories()
    {
        return $this->belongsToMany('App\Model_Category', 'model_categories_pivot',
            'model_id', 'category_id', 'model_id', 'id')->withTimestamps();
    }

    public function suspensions()
    {
        return $this->belongsToMany(Suspension::class, 'model_suspensions', 'model_id', 'suspension_id', 'model_id');
    }

    public function variants(){
        return $this->hasMany(Modell::class, 'parent_id', 'model_id');
    }

    public function base(){
        return $this->hasOne(Modell::class, 'model_id', 'parent_id');
    }

    public function getPermalinkAttribute(){
        return route('car', ['brand' => $this->brand->slug, 'slug' => $this->slug ]);
    }

    public function getSpecsLinkAttribute(){
         return ($this->getPermalinkAttribute() . '/specs');
    }

    public function getFeaturedImageAttribute(){
       return asset("uploads/{$this->model_image}");
    }

    public function scopeOnlyBase($query){
        $query->where('parent_id', NULL);
    }

    public function scopeFeaturedCars($query){
        return $query->OnlyBase()->whereHas('categories', function ($query){
            $query->where('category_id', $this->getCategoryIDBySlug('featured'));
        })->orderBy('created_at', 'desc')->get()->take(4);
    }

    public function scopePopularCars($query){
        return $query->OnlyBase()->whereHas('categories', function ($query){
            $query->where('category_id', $this->getCategoryIDBySlug('popular'));
        })->orderBy('created_at', 'desc')->get()->take(4);
    }

    public function scopeSameBrandCars($query, $id, $brand_id){
        return $query->OnlyBase()->where('brand_id', $brand_id)->where('model_id', '!=', $id)->orderBy('created_at', 'desc')->get()->take(4);
    }

    public function scopeSimilarCars($query, $id, $body_type_id){
        return $query->OnlyBase()->where('model_body_type_id', $body_type_id)->where('model_id', '!=', $id)->orderBy('created_at', 'desc')->get()->take(4);
    }

    public function getPriceInWordsAttribute()
    {
        $variants = $this->variants;
        $price = $this->attributes['price'];
        if(!empty($price)){
            return 'Rs. '. $this->priceInWords($price);
        }
        else if(count($variants) > 0) {
            return 'Rs. ' . $this->priceInWords($variants->min('price')) . 'onwards';
        }
        return (!empty($this->attributes['priceInWords'])) ?  $this->attributes['priceInWords'] : '';
    }

    public function getMinPriceAttribute()
    {
        $variants = $this->variants;
        $price = $this->attributes['price'];
        if(!empty($price)){
            return 'Rs. '. $this->priceInWords($price);
        }
        else if(count($variants) > 0) {
            return 'Rs. ' . $this->priceInWords($variants->min('price'));
        }
        return (!empty($this->attributes['priceInWords'])) ?  $this->attributes['priceInWords'] : '';
    }

    public function getMaxPriceAttribute()
    {
        $variants = $this->variants;
        $price = $this->attributes['price'];
        if(!empty($price)){
            return 'Rs. '. $this->priceInWords($price);
        }
        else if(count($variants) > 0) {
            return 'Rs. ' . $this->priceInWords($variants->max('price'));
        }
        return (!empty($this->attributes['priceInWords'])) ?  $this->attributes['priceInWords'] : '';
    }


    public function getMileageAttribute($value){
        if(empty($value)){
            $variants = $this->variants;
            return $variants->max('mileage');
        }
        else {
            return $value . ' kmpl';
        }
    }

    public function getEngineAttribute($value){
        if(empty($value)){
            $variants = $this->variants;
            return trim($variants->min('engine') . ' - ' . $variants->max('engine'));
        }
        else{
            return trim($value .' cc');
        }
    }

    public function getTransmissionAllAttribute(){
        $variants = $this->variants;
        if(count($variants) > 0){
            $transmissions = [];
            foreach ($variants as $variant){
                //transmissions
                $transmission_arr = $variant->transmissions->pluck('name')->toArray();
                //check if already in array
                foreach ($transmission_arr as $key => $value){
                    if(!in_array($value, $transmissions)) $transmissions[] = $value;
                }
            }
            return trim(implode(', ', $transmissions));
        }
        else{
            return trim(implode(', ', $this->transmissions->pluck('name')->toArray()));
        }
    }


    public function getFuelAllAttribute(){
        $variants = $this->variants;
        if(count($variants) > 0){
            $fuels = [];
            foreach ($variants as $variant){
                //transmissions
                $fuel_arr = $variant->fuels->pluck('name')->toArray();
                //check if already in array
                foreach ($fuel_arr as $key => $value){
                    if(!in_array($value, $fuels)) $fuels[] = $value;
                }
            }
            return trim(implode(', ', $fuels));
        }
        else{
            return trim(implode(', ', $this->fuels->pluck('name')->toArray()));
        }
    }

    public function getSeatsAttribute($value){
        if(empty($value)){
            $variants = $this->variants;
            return $variants->max('seats');
        }
        else{
            return $value;
        }
    }


    public function priceInWords($price){
        //check the length of the price
        $len = strlen($price);
        //check the length of price and determine lakh or crore
        if($len >= 6 && $len <= 7 ){
            $price_decimal = round($price / 100000, 2);
            return $price_decimal . ' Lakhs ';
        }
        else if($len >= 8 && $len <= 9 ){
            $price_decimal = round($price / 1000000, 2);
            return $price_decimal . ' Crore ';
        }
    }


    public function getCategoryIDBySlug($slug){
        return \App\Model_Category::findBySlug($slug)->id;
    }

/*

    public function getMileageAttribute($value)
    {
        //get starting price if have variants
        $variants = $this->variants;
        $mileage = $value;
        if(count($variants) > 0){
            $mileage = $variants->max('mileage');
        }
        return $mileage;
    }

    public function getEngineAttribute($value)
    {
        //get starting price if have variants
        $variants = $this->variants;
        $engine = $value;
        if(count($variants) > 0){
            $engine = $variants->min('engine') . ' - ' . $variants->max('engine');
        }
        return $engine;
    }*/


}
