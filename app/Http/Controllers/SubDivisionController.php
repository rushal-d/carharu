<?php

namespace App\Http\Controllers;

use App\Division;
use App\Sub_Division;
use Illuminate\Http\Request;

class SubDivisionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $div = Division::pluck('name', 'id');
        $divisions = Division::get();
        $subs = Sub_Division::get();
        return view('sub_divisions.index', ['subs' => $subs, 'divisions' => $divisions, 'div' => $div]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $sub = new Sub_Division();
        $sub->name = $request->name;
        $sub->division_id = $request->division;
        $sub->save();

        return redirect()->route('sub-division.index');
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
        $sub = Sub_Division::find($id);
        $sub->delete();

        return redirect()->route('sub-division.index');
    }
}
