<?php

namespace App\Http\Controllers;

use App\Models\Car;
use Illuminate\Contracts\Foundation\Application;
use Illuminate\Contracts\View\Factory;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\StripeClient;

class CarsController extends Controller
{
    public function index()
    {
        $cars = Car::orderBy("name")->get();

        return view("home", [
            "cars" => $cars,
        ]);
    }
}
