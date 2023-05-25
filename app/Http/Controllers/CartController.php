<?php

namespace App\Http\Controllers;

use App\Models\Car;
use App\Models\OrderProduct;
use App\Models\Part;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\StripeClient;

class CartController extends Controller
{
    public function index()
    {
        $cart = session()->get("cart");
        $totalPrice = 0;
        $popularProducts = OrderProduct::select("partId")
            ->groupBy("partId")
            ->orderByRaw("COUNT(partId) DESC")
            ->limit(6)
            ->get()
            ->pluck("partId")
            ->toArray();
        $popularProducts = Part::whereIn('id', $popularProducts)->get();

        if (!$cart) {
            $cart = [];
            return view("cart.index", compact("cart", "totalPrice", "popularProducts"));
        }

        foreach ($cart as $part) {
            $totalPrice += $part->price * $part->count;
            $part->name = $part->{app()->getLocale() . "Name"};
        }

        return view("cart.index", compact("cart", "totalPrice", "popularProducts"));
    }

    public function add(string $id)
    {
        $part = Part::where("id", $id)->first();

        if ($part === null) {
            return redirect()
                ->back()
                ->with("notification", ["type" => "error", "message" => __('notifications.cart.product_not_found.message', ['id' => $id]), "title" => __('notifications.cart.product_not_found.title')]);
        }

        if ($part->count + 1 > $part->quantity) {
            return redirect()
                ->back()
                ->with("notification", ["type" => "error", "message" => __('notifications.cart.count_exceeded.message', ['id' => $id]), "title" => __('notifications.cart.count_exceeded.title')]);
        }

        $cart = session()->get("cart");

        if (!$cart) {
            $part->count = 1;

            $cart = [
                $part->id => $part,
            ];

            session()->put("cart", $cart);

            return redirect()
                ->back()
                ->with("notification", ["type" => "success", "message" => __('notifications.cart.added.message'), "title" => __('notifications.cart.added.title')]);
        }

        if (isset($cart[$part->id])) {
            $cart[$part->id]->count++;
            session()->put("cart", $cart);

            return redirect()
                ->back()
                ->with("notification", ["type" => "success", "message" => __('notifications.cart.incremented.message'), "title" => __('notifications.cart.incremented.title')]);
        }

        $part->count = 1;
        $cart[$part->id] = $part;

        session()->put("cart", $cart);

        return redirect()
            ->back()
            ->with("notification", ["type" => "success", "message" => __('notifications.cart.added.message'), "title" => __('notifications.cart.added.title')]);
    }

    public function clear()
    {
        session()->forget("cart");
        return redirect()
            ->back()
            ->with("notification", ["type" => "success", "message" => __('notifications.cart.cleared.message'), "title" => __('notifications.cart.cleared.title')]);
    }

    public function increment(string $id)
    {
        $cart = session()->get("cart");
        $part = Part::find($id)->first();

        if (!$part) {
            abort(404);
        }

        foreach ($cart as $key => $item) {
            if ($item->id == $id) {
                if ($item->count + 1 > $item->quantity) {
                    return redirect()
                        ->back()
                        ->with("notification", ["type" => "error", "message" => __('notifications.cart.count_exceeded.message', ['id' => $id]), "title" => __('notifications.cart.count_exceeded.title')]);
                }

                $item->count++;
            }
        }

        session()->put("cart", $cart);

        return redirect()
            ->back()
            ->with("notification", ["type" => "success", "message" => __('notifications.cart.incremented.message'), "title" => __('notifications.cart.incremented.title')]);
    }

    public function decrement(string $id)
    {
        $cart = session()->get("cart");
        $part = Part::find($id)->first();

        if (!$part) {
            redirect()
                ->back()
                ->with("notification", ["type" => "error", "message" => __('notifications.cart.product_not_found.message', ['id' => $id]), "title" => __('notifications.cart.product_not_found.title')]);
        }

        foreach ($cart as $key => $item) {
            if ($item->id == $id) {
                if ($item->count == 1) {
                    unset($cart[$key]);
                } else {
                    $item->count--;
                }
            }
        }

        session()->put("cart", $cart);

        return redirect()
            ->back()
            ->with("notification", ["type" => "success", "message" => __('notifications.cart.decremented.message'), "title" => __('notifications.cart.decremented.title')]);
    }

    public function remove(Request $request, string $id)
    {
        $cart = session()->get("cart");
        $part = Part::where("id", $id)->first();

        if (!$part) {
            abort(404);
        }

        if (isset($cart[$part->id])) {
            unset($cart[$part->id]);
            session()->put("cart", $cart);
        }

        return redirect()
            ->back()
            ->with("notification", ["type" => "success", "message" => __('notifications.cart.removed.message'), "title" => __('notifications.cart.removed.title')]);
    }

    public function updateCount(Request $request, string $id)
    {
        $cart = session()->get("cart");
        $part = Part::where("id", $id)->first();

        if (!$part) {
            abort(404);
        }

        if (isset($cart[$part->id])) {
            $cart[$part->id]->count = $request->count;
            session()->put("cart", $cart);
        }

        return redirect()
            ->back()
            ->with("notification", ["type" => "success", "message" => __('notifications.cart.countUpdated.message'), "title" => __('notifications.cart.countUpdated.title')]);
    }
}
