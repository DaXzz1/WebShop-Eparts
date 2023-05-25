<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\CarModel;
use App\Models\Category;
use App\Models\ModelModification;
use App\Models\PartCategory;
use App\Models\Part;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class PartsController extends Controller
{
    public function index(Request $request, Car $car, CarModel $model, PartCategory $category, int $modificationId = null)
    {
        $parts = Part::query();
        $parts = $this->filterParts($request, $parts, $category->id, $modificationId);
        $categories = Category::with('partCategories')
            ->whereHas('partCategories', function (Builder $query) use ($model) {
                $query->where('modelId', $model->id);
            })
            ->get();

        $manufacturers = $this->getManufacturers($category->id, $modificationId);
        $colors = $this->getColors($category->id, $modificationId);
        $locations = $this->getLocations($category->id, $modificationId);
        $sortMethods = $this->getSortMethods();

        $minPrice = $parts->min('price');
        $maxPrice = $parts->max('price');

        $hasFilters = $request->has('manufacturer') ||
            $request->has('color') ||
            $request->has('location') ||
            $request->has('minPrice' ||
            $request->has('maxPrice') ||
            $request->has('sortMethod'));

        foreach ($parts as $part) {
            $part->name = $part->{app()->getLocale() . "Name"};
        }

        foreach ($categories as $item) {
            $item->name = $item->{app()->getLocale() . "Name"};

            foreach ($item->partCategories as $partCategory) {
                $partCategory->name = $partCategory->{app()->getLocale() . "Name"};
            }
        }

        return view("parts.parts", [
            "parts" => $parts,
            "car" => $car,
            "model" => $model,
            "categories" => $categories,
            "category" => $category,
            "modification" => ModelModification::find($modificationId),
            "manufacturers" => $manufacturers,
            "colors" => $colors,
            "locations" => $locations,
            "sortMethods" => $sortMethods,
            'request' => (object)$request->all() ?? null,
            'currentPage' => $parts->currentPage() ?? 1,
            'minPrice' => $minPrice,
            'maxPrice' => $maxPrice,
            'hasFilters' => $hasFilters,
        ]);
    }

    public function show(Car $car, CarModel $model, PartCategory $category, Part $part, int $modificationId = null)
    {
        $modification = ModelModification::find($modificationId);

        $mayBeInterested = Part::where(function ($query) use ($modificationId) {
                if ($modificationId) {
                    $query->where('modificationId', $modificationId)
                        ->orWhereNull('modificationId');
                }
            })
            ->where('id', '!=', $part->id)
            ->inRandomOrder()
            ->limit(6)
            ->get();

        $part->name = $part->{app()->getLocale() . "Name"};

        foreach ($mayBeInterested as $item) {
            $item->name = $item->{app()->getLocale() . "Name"};
            $item->category->name = $item->category->{app()->getLocale() . "Name"};

            if ($item->modification) $item->modification->name = $item->modification->{app()->getLocale() . "Name"};
        }

        return view("parts.partDetails", compact("part", "car", "model", "category", "modification", "mayBeInterested"));
    }

    private function getManufacturers(int $categoryId, int $modificationId = null)
    {
        return Part::select('manufacturer')
            ->where('categoryId', $categoryId)
            ->where(function ($query) use ($modificationId) {
                if ($modificationId) {
                    $query->where('modificationId', $modificationId)
                        ->orWhereNull('modificationId');
                }
            })
            ->distinct()
            ->orderBy('manufacturer', 'asc')
            ->get();
    }

    private function getColors(int $categoryId, int $modificationId = null)
    {
        return Part::select('color')
            ->where('categoryId', $categoryId)
            ->where(function ($query) use ($modificationId) {
                if ($modificationId) {
                    $query->where('modificationId', $modificationId)
                        ->orWhereNull('modificationId');
                }
            })
            ->distinct()
            ->orderBy('color', 'asc')
            ->get();
    }

    private function getLocations(int $categoryId, int $modificationId = null)
    {
        return Part::select('location')
            ->where('categoryId', $categoryId)
            ->where(function ($query) use ($modificationId) {
                if ($modificationId) {
                    $query->where('modificationId', $modificationId)
                        ->orWhereNull('modificationId');
                }
            })
            ->distinct()
            ->orderBy('location', 'asc')
            ->get();
    }

    private function getSortMethods()
    {
        return [
            "priceAsc" => "Price (Low to High)",
            "priceDesc" => "Price (High to Low)",
            "nameAsc" => "Name (A to Z)",
            "nameDesc" => "Name (Z to A)",
        ];
    }

    private function filterParts(Request $request, Builder $parts, int $categoryId, int $modificationId = null): LengthAwarePaginator
    {
        $name = app()->getLocale() . "Name";

        $parts->where('categoryId', $categoryId)
            ->where(function ($query) use ($modificationId) {
                if ($modificationId) {
                    $query->where('modificationId', $modificationId)
                        ->orWhereNull('modificationId');
                } else {
                    $query->whereNull('modificationId');
                }
            });

        if ($request->has('manufacturer') && $request->manufacturer !== "null") {
            $parts = $parts->where('manufacturer', $request->manufacturer);
        }

        if ($request->has('color') && $request->color !== "null") {
            $parts = $parts->where('color', $request->color);
        }

        if ($request->has('location') && $request->location !== "null") {
            $parts = $parts->where('location', $request->location);
        }

        if ($request->has('minPrice') && $request->minPrice !== null) {
            $parts = $parts->where('price', '>=', (float)$request->minPrice);
        }

        if ($request->has('maxPrice') && $request->maxPrice !== null) {
            $parts = $parts->where('price', '<=', (float)$request->maxPrice);
        }

        switch ($request->sortMethod) {
            case "priceAsc":
                $parts = $parts->orderBy('price');
                break;
            case "priceDesc":
                $parts = $parts->orderBy('price', 'desc');
                break;
            case "nameAsc":
                $parts = $parts->orderBy($name);
                break;
            case "nameDesc":
                $parts = $parts->orderBy($name, 'desc');
                break;
        }

        return $parts->paginate(12);
    }
}
