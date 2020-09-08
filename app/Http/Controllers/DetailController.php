<?php

namespace App\Http\Controllers;

use App\Detail;
use App\Feature;
use App\Modell;
use App\Specification;
use Illuminate\Http\Request;

class DetailController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create(Request $request)
    {
//        dd($request->id);
        $model = Modell::where('model_id', $request->id)->first();
//        dd($model);
        $specs = Specification::get();

//        dd($specs->count());
        $features = Feature::pluck('feature', 'id');
        $feats = Feature::with('spec')->orderBy('specs_id')->get();
//        dd($feats);
        return view('details.create', ['features' => $features, 'model' => $model, 'feats' => $feats, 'specs' => $specs]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
//        dd($request->all());
        $detail = new Detail;

        foreach ($request->features as $featureId => $featureValue) {

            $detail = new Detail();
            $detail->feature_id = $featureId;
            $detail->value = $featureValue;
            $detail->model_id = $request->model_id;
            $detail->save();
        }

        return redirect()->route('details.create', ['id' => $detail->model_id]);
    }

    /**
     * Display the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param int $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
