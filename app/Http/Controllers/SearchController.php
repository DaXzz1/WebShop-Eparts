<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarModel;
use App\Models\Part;
use http\Env\Response;
use Illuminate\Http\Request;
use function Termwind\render;

class SearchController extends Controller
{
    public function index()
    {
        $cars = Car::all();
        $models = CarModel::all();
        $parts = Part::select('parts.*', 'parts.' . app()->getLocale() . 'Name as name')->get();

        return view('search.index', compact('cars', 'parts', 'models'));
    }

    public function globalSearch(Request $request) {
        $search = $request->get('query');
        $currentLocale = app()->getLocale();

        $output = [];

        $cars = Car::where('name', 'like', '%' . $search . '%')->get();
        $models = CarModel::where('name', 'like', '%' . $search . '%')
            ->orWhereHas('car', function ($query) use ($search) {
                $query->where('name', 'like', '%' . $search . '%');
            })
            ->get();

        $parts = Part::where($currentLocale . 'Name', 'like', '%' . $search . '%')
            ->orWhere('manufacturer', 'like', '%' . $search . '%')
            ->orWhere('code', 'like', '%' . $search . '%')
            ->get();

        if ($cars->count() == 0 && $models->count() == 0 && $parts->count() == 0) {
            $output['noResults'] = view('api.search.global.noResults', compact('search'))->render();
            return response($output);
        }

        $output = array_fill_keys(['cars', 'models', 'parts'], '');

        foreach ($cars as $car) {
            $output['cars'] .= view('api.search.global.carItem', compact('car'))->render();
        }

        foreach ($models as $model) {
            $output['models'] .= view('api.search.global.modelItem', compact('model'))->render();
        }

        foreach ($parts as $part) {
            $part->name = $part->{$currentLocale . 'Name'};
            $output['parts'] .= view('api.search.global.partItem', compact('part'))->render();
        }

        return response($output);
    }

    public function externalSearch(Request $request)
    {
        $query = $request->get('query');
        $currentLocale = app()->getLocale();
        $output = '';

        $parts = Part::where($currentLocale . 'Name', 'like', '%' . $query . '%')
            ->orWhere('manufacturer', 'like', '%' . $query . '%')
            ->orWhere('code', 'like', '%' . $query . '%')
            ->where('quantity', '>', 0)
            ->get();

        if ($parts->count() == 0) {
            return view('api.search.parts.noResults', compact('query'))->render();
        }

        foreach ($parts as $part) {
            $part->name = $part->{$currentLocale . 'Name'};
            $output .= view('api.search.parts.header', compact('part'))->render();
        }

        return response($output);
    }

    public function searchModelsByCarId(Request $request, int $carId)
    {
        $search = $request->get('query');
        $car = Car::find($carId);
        $models = CarModel::where('carId', $carId)
            ->where(function ($query) use ($search) {
                $query->where('name', 'like', "%$search%")
                    ->orWhere('releasedAt', 'like', "%$search%")
                    ->orWhere('stoppedAt', 'like', "%$search%");
            })
            ->get();

        if ($models->count() == 0) {
            $view = view('api.search.models.noResults', compact('car', "search"))->render();
            return response($view);
        }

        $output = '';
        foreach ($models as $model) {
            $output .= view('api.search.models.modelItem', compact('model', 'car'))->render();
        }

        return response($output);
    }
}
