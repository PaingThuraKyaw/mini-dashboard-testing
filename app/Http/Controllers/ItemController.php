<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreItemRequest;
use App\Http\Requests\UpdateItemRequest;
use App\Http\Resources\ItemResource;
use App\Models\Item;

class ItemController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $item = Item::when(request()->has('keyword'),function($query){
            $keyword = request()->keyword;
            $query->where("name","like","%".$keyword."%");
        })->paginate(5)->withQueryString();
        // return response()->json($item);
        return ItemResource::collection($item);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(StoreItemRequest $request)

    {
        $request->failedValidation;
        $item = Item::create([
            "name" => $request->name,
            "phNumber" => $request->phNumber,
            "company" => $request->company,
            "position" => $request->position,
            "age" => $request->age
        ]);
        return response()->json($item,200);

    }

    /**
     * Display the specified resource.
     */
    public function show(Item $item)
    {
        // return response()->json($item);
        if(is_null($item->id)){
            return response()->json(["message" => "Not found"] , 404);
        }
        return new ItemResource($item);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateItemRequest $request, Item $item)
    {
      $item->name = $request->name;
      $item->phNumber = $request->phNumber;
      $item->company = $request->company;
      $item->position = $request->position;
      $item->age = $request->age;
      $item->update();
        return response()->json($item);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Item $item)
    {
        $item->delete();
        return response()->json(["message" => "delete"],200);
    }
}
