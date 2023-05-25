<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarModel;
use Illuminate\Http\Request;

class ModelsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function index(Car $car)
    {
        return view("models.index", [
            "models" => $car->models,
            "car" => $car,
        ]);
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\CarModel  $models
     * @return \Illuminate\Http\Response
     */
    public function show(CarModel $models)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\CarModel  $models
     * @return \Illuminate\Http\Response
     */
    public function edit(CarModel $models)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CarModel  $models
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, CarModel $models)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CarModel  $models
     * @return \Illuminate\Http\Response
     */
    public function destroy(CarModel $models)
    {
        //
    }
}
