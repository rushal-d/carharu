<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', 'Auth\LoginController@showLoginForm');

Auth::routes();
Route::get('/home', 'HomeController@index')->name('/');

Route::any('backend/colors', 'SubAttributeOptionController@getColors')->name('all-colors');

Route::prefix('backend')->middleware(['auth', 'permissionmiddleware', 'web'])->group(function () {

    Route::get('/', 'HomeController@index')->name('home');
    Route::get('/home', 'HomeController@index')->name('home');
    /*User management roles------ENTRUST*/
    Route::resource('role', 'RoleController');
    Route::resource('permission', 'PermissionController');
    Route::post('/permission/add', 'PermissionController@add')->name('permission.add');
    Route::post('/permission/addmenu', 'PermissionController@displayNameStore')->name('permission.addmenu');
    Route::resource('user', 'UserController');
    Route::resource('assignrole', 'AssignRoleController');

    /*New Menu*/
    Route::get('menu', 'MenuController@index')->name('menu-index');
    Route::post('menu/store', 'MenuController@store')->name('menu-store');
    Route::post('menu/buildMenu', 'MenuController@buildMenu')->name('menu-build-menu');
    Route::post('menu/delete', 'MenuController@destroy')->name('menu-delete');
    Route::get('menu/search', 'MenuController@search')->name('menu-search');
    Route::post('menu/displayNameStore', 'MenuController@displayNameStore')->name('display-name-store');

    /*Brand*/
    Route::get('/brand', 'BrandController@index')->name('brand.index');
    Route::get('/brand/create', 'BrandController@create')->name('brand.create');
    Route::post('/brand/store', 'BrandController@store')->name('brand.store');
    Route::get('/brand/show/{id}', 'BrandController@show')->name('brand.show');
    Route::get('/brand/edit/{id}', 'BrandController@edit')->name('brand.edit');
    Route::patch('/brand/update/{id}', 'BrandController@update')->name('brand.update');
    Route::get('/brand/destroy/{id}', 'BrandController@destroy')->name('brand.destroy');

    /*Models*/
    Route::get('/model', 'ModelController@index')->name('model.index');
    Route::get('/variants', 'ModelController@variants')->name('model.variants');
    Route::get('/model/create', 'ModelController@create')->name('model.create');
    Route::get('/model/createvariant', 'ModelController@createvariant')->name('model.createvariant');
    Route::post('/model/store', 'ModelController@store')->name('model.store');
    Route::post('/model/storevariant', 'ModelController@storevariant')->name('model.storevariant');
    Route::get('/model/clonevariant/{id}', 'ModelController@clonevariant')->name('model.clonevariant');
    Route::get('/model/show/{id}', 'ModelController@show')->name('model.show');
    Route::get('/model/edit/{id}', 'ModelController@edit')->name('model.edit');
    Route::get('/model/editvariant/{id}', 'ModelController@editvariant')->name('model.editvariant');
    Route::patch('/model/update/{id}', 'ModelController@update')->name('model.update');
    Route::patch('/model/updatevariant/{id}', 'ModelController@updatevariant')->name('model.updatevariant');
    Route::get('/model/destroy/{id}', 'ModelController@destroy')->name('model.destroy');
    Route::get('/model/variantdetails/{id}', 'ModelController@variantdetails')->name('model.variantdetails');
    Route::get('/model/compare/', 'ModelController@compareModels')->name('model.compare');
    Route::get('/sendMail', 'ModelController@mail')->name('send-mail');
    Route::get('get-model-id-by-ajax', 'ModelController@ajaxGetModelsByBrandId')->name('ajax-get-models-by-brand-id');
    Route::get('ajax-comparison', 'ModelController@ajaxComparison')->name('compareByAjax');
    Route::post('/model/ajaxcategoryupdate', 'ModelController@ajaxCategoryUpdate')->name('model.ajaxcategoryupdate');

    /*Model Category*/
    Route::get('/category', 'ModelCategoryController@index')->name('category.index');
    Route::get('/category/create', 'ModelCategoryController@create')->name('category.create');
    Route::post('/category/store', 'ModelCategoryController@store')->name('category.store');
    Route::get('/category/edit/{id}', 'ModelCategoryController@edit')->name('category.edit');
    Route::patch('/category/update/{id}', 'ModelCategoryController@update')->name('category.update');
    Route::get('/category/destroy/{id}', 'ModelCategoryController@destroy')->name('category.destroy');


    /*Post Category*/
    Route::get('/post-category', 'CategoryController@index')->name('post-category.index');
    Route::get('/post-category/create', 'CategoryController@create')->name('post-category.create');
    Route::post('/post-category/store', 'CategoryController@store')->name('post-category.store');
    Route::get('/post-category/edit/{id}', 'CategoryController@edit')->name('post-category.edit');
    Route::patch('/post-category/update/{id}', 'CategoryController@update')->name('post-category.update');
    Route::get('/post-category/destroy/{id}', 'CategoryController@destroy')->name('post-category.destroy');

    /*Specification*/
    Route::get('/specs', 'SpecificationController@index')->name('specs.index');
    Route::get('/specs/create', 'SpecificationController@create')->name('specs.create');
    Route::post('/specs/store', 'SpecificationController@store')->name('specs.store');
    Route::get('/specs/destroy/{id}', 'SpecificationController@destroy')->name('specs.destroy');

    /*Features*/
    Route::get('/features', 'FeatureController@index')->name('features.index');
    Route::get('/features/create', 'FeatureController@create')->name('features.create');
    Route::post('/features/store', 'FeatureController@store')->name('features.store');

    /*Details*/
    Route::get('/details', 'DetailController@index')->name('details.index');
    Route::get('/details/create', 'DetailController@create')->name('details.create');
    Route::post('details/store', 'DetailController@store')->name('details.store');

    /*Blogs*/
    Route::get('/blogs', 'BlogController@index')->name('blogs.index');
    Route::get('/blogs/create/{id}', 'BlogController@create')->name('blogs.create');
    Route::post('/blogs/store', 'BlogController@store')->name('blogs.store');
    Route::get('/blogs/blog-detail/{id}', 'BlogController@blogDetail')->name('blog-detail');
    Route::get('/blogs/destroy/{id}', 'BlogController@destroy')->name('blogs.destroy');

    /*Reviews*/
    Route::get('/reviews/create/{id}', 'ReviewController@create')->name('review.create');
    Route::post('reviews/store/', 'ReviewController@store')->name('review.store');

    /*Posts*/
    Route::get('/posts', 'PostController@index')->name('posts.index');
    Route::get('/posts/create', 'PostController@create')->name('posts.create');
    Route::post('/posts/store', 'PostController@store')->name('posts.store');
    Route::get('/posts/edit/{id}', 'PostController@edit')->name('posts.edit');
    Route::patch('/posts/update/{id}', 'PostController@update')->name('posts.update');
    Route::get('/posts/destroy/{id}', 'PostController@destroy')->name('posts.destroy');

    /*Attributes*/
    Route::get('/attributes', 'AttributeController@index')->name('attribute.index');
    Route::get('/attributes/create', 'AttributeController@create')->name('attribute.create');
    Route::post('/attributes/store', 'AttributeController@store')->name('attribute.store');
    Route::get('/attributes/edit/{id}', 'AttributeController@edit')->name('attribute.edit');
    Route::patch('/attributes/update/{id}', 'AttributeController@update')->name('attribute.update');
    Route::get('/attributes/destroy/{id}', 'AttributeController@destroy')->name('attribute.destroy');

    /*Sub Attributes*/
    Route::get('/sub-attributes', 'SubAttributeController@index')->name('sub-attribute-index');
    Route::get('/sub-attributes/create', 'SubAttributeController@create')->name('sub-attribute-create');
    Route::post('/sub-attributes/store', 'SubAttributeController@store')->name('sub-attribute-store');
    Route::get('/sub-attributes/edit/{id}', 'SubAttributeController@edit')->name('sub-attribute-edit');
    Route::patch('/sub-attributes/update/{id}', 'SubAttributeController@update')->name('sub-attribute-update');
    Route::get('/sub-attributes/destroy/{id}', 'SubAttributeController@destroy')->name('sub-attribute-destroy');


    /*Sub Attributes*/
    Route::get('/sub-attributes-options', 'SubAttributeOptionController@index')->name('sub-attributes-options-index');
    Route::get('/sub-attributes-options/create', 'SubAttributeOptionController@create')->name('sub-attributes-options-create');
    Route::post('/sub-attributes-options/store', 'SubAttributeOptionController@store')->name('sub-attributes-options-store');
    Route::get('/sub-attributes-options/edit/{id}', 'SubAttributeOptionController@edit')->name('sub-attributes-options-edit');
    Route::post('/sub-attributes-options/update/{id}', 'SubAttributeOptionController@update')->name('sub-attributes-options-update');
    Route::post('/sub-attributes-options/destroy', 'SubAttributeOptionController@destroy')->name('sub-attributes-options-destroy');
    Route::any('/sub-attributes-options/alreadyexits', 'SubAttributeOptionController@alreadyExits')->name('sub-attributes-options-alreadyexits');

    /*Divisions*/
    Route::get('/divisions', 'DivisionController@index')->name('divisions.index');
    Route::get('/divisions/create', 'DivisionController@create')->name('divisions.create');
    Route::post('/divisions/store', 'DivisionController@store')->name('divisions.store');
    Route::get('/divisions/edit/{id}', 'DivisionController@edit')->name('divisions.edit');
    Route::patch('/divisions/update/{id}', 'DivisionController@update')->name('divisions.update');
    Route::get('/divisions/destroy/{id}', 'DivisionController@destroy')->name('divisions.destroy');

    /*Sub Divisions*/
    Route::get('/sub-divisions', 'SubDivisionController@index')->name('sub-division.index');
    Route::get('/sub-divisions/create', 'SubDivisionController@create')->name('sub-division.create');
    Route::post('/sub-divisions/store', 'SubDivisionController@store')->name('sub-division.store');
    Route::get('/sub-divisions/edit/{id}', 'SubDivisionController@edit')->name('sub-division.edit');
    Route::patch('/sub-divisions/update/{id}', 'SubDivisionController@update')->name('sub-division.update');
    Route::get('/sub-divisions/destroy/{id}', 'SubDivisionController@destroy')->name('sub-division.destroy');
});

/***
 *
 * FRONTEND
 *
 ***/

Route::get('/', 'FrontEndController@index')->name('frontend');
Route::get('/brandpage/{id}', 'FrontEndController@brandPage')->name('frontend.brandpage');
Route::get('/cars', 'FrontEndController@cars')->name('cars');
Route::get('/cars/{brand}', 'FrontEndController@brand')->name('brand');
Route::get('/cars/{brand}/{slug}', 'FrontEndController@modelDetail')->name('car');
Route::get('/cars/{brand}/{slug}/specs', 'FrontEndController@carSpecs')->name('carSpecs');
Route::get('/variant-detail/{slug}', 'FrontEndController@variantDetail')->name('frontend.variantdetail');
Route::get('/filter/', 'FrontEndController@filterPage')->name('frontend.filterpage');
Route::get('/model-search/', 'FrontEndController@search')->name('frontend.search');
Route::get('/compare-cars/', 'FrontEndController@compareModels')->name('frontend.compare');
Route::get('/model-getmodel/', 'FrontEndController@getModel')->name('get-model');
Route::get('/blog-detail/{id}', 'FrontEndController@blogDetail')->name('blog-details');
Route::get('/all-reviews/{id}', 'FrontEndController@allReviews')->name('all-reviews');
Route::get('/page/{slug}', 'FrontEndController@page')->name('page');
Route::get('get-model-id-by-ajax-frontend', 'FrontEndController@ajaxGetModelsByBrandIdFrontEnd')->name('ajax-get-models-by-brand-id-frontend');
Route::get('ajax-comparison-frontend', 'FrontEndController@ajaxComparisonFrontEnd')->name('compareByAjaxFrontend');


Route::get('scrape', 'HomeController@scrape');
Route::get('scrape/color', 'HomeController@scrapeColor');

Route::group(['middleware' => 'auth'], function(){
    /** Start of password */
    Route::get('user-password/{user}', 'UserPasswordController@edit')->name('user-password.edit');
    Route::patch('user-password/{user}', 'UserPasswordController@update')->name('user-password.update');
    /** End of password */
});

