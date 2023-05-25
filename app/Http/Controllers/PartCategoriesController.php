<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarModel;
use App\Models\Category;
use App\Models\ModelModification;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;

class PartCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return Application|Factory|View
     */
    public function index(Car $car, CarModel $model, ModelModification $modification = null)
    {
        $categories = Category::with("partCategories")->whereHas("partCategories", function ($query) use ($model, $modification) {
            $query->where("modelId", $model->id);
        })->get();

        foreach ($categories as $category) {
            $category->name = $category->{app()->getLocale() . "Name"};

            foreach ($category->partCategories as $partCategory) {
                $partCategory->name = $partCategory->{app()->getLocale() . "Name"};
                $partCategory->count = $partCategory->parts()->count();
            }
        }

        return view("partCategory.index", compact("categories", "model", "car", "modification"));
    }
}
