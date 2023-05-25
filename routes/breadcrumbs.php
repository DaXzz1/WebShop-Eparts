<?php

// Home
use App\Models\Car;
use App\Models\CarModel;
use App\Models\Part;
use Carbon\Carbon;
use DaveJamesMiller\Breadcrumbs\Facades\Breadcrumbs;

Breadcrumbs::for('home', function ($trail) {
    $trail->push(__('pages.home.breadcrumb'), route('home'));
});

Breadcrumbs::for('car.models', function ($trail, $car) {
    $trail->parent('home');
    $trail->push(__('pages.models.breadcrumb', ['brand' => $car->name]), route('car.models', $car->slug));
});

Breadcrumbs::for('car.parts', function ($trail, $car, $model, $modification = null) {
    $trail->parent('car.models', $car);

    if ($modification) {
        $titleWithModification = __('pages.partCategories.breadcrumb_with_modification', [
            'brand' => $car->name,
            'model' => $model->name,
            'engine' => $modification->getCapacityFloat(),
            'engine_code' => $modification->engineCode,
            'transmission' => strtolower(__('parts.values.transmission.type.' . $modification->transmissionType)),
            'transmission_drive' => strtolower(__('parts.values.transmission.drive.full.' . $modification->transmissionDrive)),
        ]);
        $trail->push($titleWithModification, route('car.parts', [$car->slug, $model->slug, $modification->id]));
    } else {
        $trail->push(__('pages.partCategories.breadcrumb', ['brand' => $car->name, 'model' => $model->name]), route('car.parts', [$car->slug, $model->slug]));
    }
});

Breadcrumbs::for('car.parts.byCategory', function ($trail, $car, $model, $category, $modification = null) {
    $trail->parent('car.parts', $car, $model, $modification);

    $categoryName = $category->{app()->getLocale() . "Name"};
    $trail->push($categoryName, route('car.parts.byCategory', [$car->slug, $model->slug, $category->slug, $modification->id ?? null]));
});


Breadcrumbs::for('car.parts.show', function ($trail, $car, $model, $category, $part, $modification = null) {
    $trail->parent('car.parts.byCategory', $car, $model, $category, $modification);

    $trail->push(__('pages.partDetails.breadcrumb', ['part_number' => $part->code]), route('car.parts.byCategory', [$car->slug, $model->slug, $category->slug, $modification->id ?? null]));
});


Breadcrumbs::for('search.index', function ($trail) {
    $trail->parent('home');

    $trail->push(__('pages.global_search.breadcrumb'), route('search.index'));
});

Breadcrumbs::for('profile.index', function ($trail) {
    $trail->parent('home');

    $trail->push(__('pages.my_profile.title'), route('profile.index'));
});

Breadcrumbs::for('profile.orders', function ($trail) {
    $trail->parent('profile.index');

    $trail->push(__('pages.my_orders.title'), route('profile.orders'));
});

Breadcrumbs::for('cart.index', function ($trail) {
    $trail->parent('home');

    $trail->push(__('pages.cart.title'), route('cart.index'));
});

Breadcrumbs::for('stripe.index', function ($trail) {
    $trail->parent('cart.index');

    $trail->push(__('pages.stripe.title'), route('cart.index'));
});
