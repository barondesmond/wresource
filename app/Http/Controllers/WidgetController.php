<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Widget;
use App\Http\Resources\WidgetResource;
use App\Http\Requests\WidgetRequest;

class WidgetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return WidgetResource::collection(Widget::select('id', 'name', 'description')->get());

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //no web interface form
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WidgetRequest $request)
    {
        $req = $request;
        //validation in WidgetRequest and reformat of json input passed
        $widget = new Widget();
        $widget->name = $req['name'];
        $widget->description = $req['description'];
        $widget->save();
        return response()->json(array('success' => true, 'last_insert_id' => $widget->id), 200);

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        if(Widget::where('id', $id)->exists()) {
            $widget = Widget::find($id);
            return new WidgetResource($widget);
        }
        else {
            return response()->json([
                       "message" => "Widget not found"
                     ], 404);
        }
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //no web interface form.
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WidgetRequest $request, $id)
    {
        $req = $request;
        //validation in WidgetRequest and json format of input
        if(Widget::where('id', $id)->exists()) {
            $widget = Widget::find($id);
            $widget->name = $req['name'];
            $widget->description = $req['description'];
            $widget->update();
            return new WidgetResource($widget);            
        }
        else {
            return response()->json([
                       "message" => "Widget not found"
                     ], 404);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        if(Widget::where('id', $id)->exists()) {
         $widget = Widget::find($id);
         $widget->delete();

         return response()->json([
           "message" => "Widget deleted"
         ], 202);
       } else {
         return response()->json([
           "message" => "Widget not found"
         ], 404);
       }
    }
}
