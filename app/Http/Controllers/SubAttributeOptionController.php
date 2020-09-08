<?php

namespace App\Http\Controllers;

use App\Feature;
use App\Sub_Attribute;
use App\SubAttributeOptionModel;
use Illuminate\Http\Request;

class SubAttributeOptionController extends Controller
{
    public function index(Request $request){
        $options = SubAttributeOptionModel::paginate(100);
        return view('subattributeoption.index', compact(['options']));
    }

    public function create(){
        $features = Feature::where('feature', 'Color')->pluck('feature', 'id');
        return view('subattributeoption.create', compact(['features']));
    }

    public function store(Request $request){
        $option = new SubAttributeOptionModel();
        $option->subattribute_id = $request->subattribute_id;
        $option->label = $request->label;
        $option->value = $request->value;
        $option->save();
        $message = 'Added Successfully';
        $notification = array(
            'message' => 'Added Successfully',
            'alert-type' => 'success',
        );
        $status = true;
        return response()->json(compact(['status','message']));
        //return redirect()->route('sub-attributes-options-create')->with($notification);
    }

    public function storeOld(Request $request){
        $option = new SubAttributeOptionModel();
        $option->subattribute_id = $request->subattribute_id;
        $option->label = $request->label;
        $option->value = $request->value;
        $option->save();
        $notification = array(
            'message' => 'Added Successfully',
            'alert-type' => 'success',
        );
        return redirect()->route('sub-attributes-options-create')->with($notification);
    }

    public function edit($id){
        $option = SubAttributeOptionModel::find($id);
        $features = Feature::where('feature', 'Color')->pluck('feature', 'id');
        return view('subattributeoption.edit', compact(['features', 'option']));
    }

    public function update($id, Request $request){
        $option = SubAttributeOptionModel::find($id);
        if(!empty($option)){
            $option->subattribute_id = $request->subattribute_id;
            $option->label = $request->label;
            $option->value = $request->value;
            if($option->save()){
                $notification = array(
                    'message' => 'Updated Successfully',
                    'alert-type' => 'success',
                );
                return redirect()->route('sub-attributes-options-edit', $id)->with($notification);
            }
        }
        $notification = array(
            'message' => 'Error Occurred!',
            'alert-type' => 'error',
        );
        return redirect()->route('sub-attributes-options-edit', $id)->with($notification);
    }

    public function destroy(Request $request){
        if(!empty($request->id)){
            if(SubAttributeOptionModel::find($request->id)->delete()){
                echo 'Successfully Deleted';
            }else {
                echo "Error deleting!";
            }
        }
        else {
            echo "Error deleting!";
        }

    }

    public function alreadyExits(Request $request){
        $value = $request->value;
        $label = $request->label;
        if(!empty($value)  && !empty($label)){
            if(!$request->has('id')){ //if from create request
                $labelDB = SubAttributeOptionModel::where('label', $label)->first();
                $valueDB = SubAttributeOptionModel::where('value',$value)->first();
            }
            else{ //request from update request
                $labelDB = SubAttributeOptionModel::where('id', '!=', $request->id)->where('label', $label)->first();
                $valueDB = SubAttributeOptionModel::where('id', '!=', $request->id)->where('value', $value)->first();
            }
            $status = false;
            $status1 = false;
            $status2 = false;
            $mesg = '';
            if(!empty($labelDB)){
                $status1 = true;
                $mesg = 'Color Name already exists!';
            }

            if(!empty($valueDB)){
                $status2 = true;
                $mesg .= 'Color Value already exists!';
            }
            if($status1 || $status2){
                $status = true;
            }
            return response()->json(compact(['status','mesg']));
        }
    }

    public function getColors(){
        $colors = SubAttributeOptionModel::where('subattribute_id', Feature::where('feature', 'Color')->value('id'))->get();
        return response()->json(compact(['colors']));
    }
}
