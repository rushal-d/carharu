<?php

namespace App\Http\Controllers;

use App\Attribute;
use App\Sub_Attribute;
use Illuminate\Http\Request;

class SubAttributeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $subs = Sub_Attribute::get();
        $attributes = Attribute::get();
        return view('sub_attributes.index', [
            'subs' => $subs,
            'attributes' => $attributes
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $attributes = Attribute::pluck('name', 'id');
        return view('sub_attributes.create', [
            'attributes' => $attributes
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $attribute_id = $request->attribute_id;
        $subs = $request->name;
        foreach($subs as $sub){
            $sub_attribute = new Sub_Attribute();
            $sub_attribute->attribute_id = $attribute_id;
            $sub_attribute->name = $sub['attributes'];
            $sub_attribute->save();
        }
        return redirect()->route('sub-attribute-index');
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
        //
    }
}
