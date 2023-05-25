<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use App\Models\User;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Validation\Rule;
use Illuminate\View\View;
use Ramsey\Uuid\Uuid;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display the user's order history.
     */
    public function orders(Request $request): View
    {
        return view('profile.orders', [
            'orders' => $request->user()->orders()->where("isIgnoring", "=", "false")->orderByDesc('boughtAt')->paginate(10),
        ]);
    }

    public function ignoreOrder(Request $request, $orderId): RedirectResponse
    {
        $order = $request->user()->orders()->find($orderId);

        if (!$order) {
            return redirect()->route('profile.orders')->with('notification', [
                'type' => 'error',
                'title' => __('notifications.order.not_found.title'),
                'message' => __('notifications.order.not_found.message', ['id' => $orderId]),
            ]);
        }

        $order->isIgnoring = true;
        $order->save();

        return redirect()->route('profile.orders')->with('notification', [
            'type' => 'success',
            'title' => __('notifications.order.deleted.title'),
            'message' => __('notifications.order.deleted.message', ['id' => $orderId]),
        ]);
    }

    public function ignoreAllOrders(Request $request): RedirectResponse
    {
        $orders = $request->user()->orders()->where("isIgnoring", "=", "false")->get();

        foreach ($orders as $order) {
            $order->isIgnoring = true;
            $order->save();
        }

        return redirect()->route('profile.orders')->with('notification', [
            'type' => 'success',
            'title' => __('notifications.order.deleted_all.title'),
            'message' => __('notifications.order.deleted_all.message'),
        ]);
    }

    public function index(Request $request): View
    {
        $countries = config('stripe.available_countries');

        foreach ($countries as $key => $country) {
            // create the object with the country code as id
            $countries[$key] = (object) [
                'id' => $country,
                'name' => __('countries.' . $country),
            ];
        }

        return view('profile.index', [
            'user' => $request->user(),
            'countries' => $countries,
        ]);
    }

    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(Request $request): RedirectResponse
    {
        $request->validate([
            'email' => 'required|email|max:255|unique:users,email,' . $request->user()->id,
            'password' => 'nullable|string|min:8|confirmed',
            'passwordConfirmation' => 'nullable|string|min:8|same:password',
            'firstName' => 'nullable|string|max:100|min:3',
            'lastName' => 'nullable|string|max:100|min:3',
            'phone' => 'nullable|string|max:100|min:3',
            'address' => 'nullable|string|max:100|min:3',
            'country' => 'nullable|string|max:2|min:2',
            'zipCode' => 'nullable|string|max:100|min:3',
            'city' => 'nullable|string|max:100|min:3',
        ]);

        if ($errors = $request->session()->get('errors')) {
            return redirect()->back()->withErrors($errors)->with('notification', [
                'type' => 'error',
                'title' => __('notifications.profile.validation_error.title'),
                'message' => __('notifications.profile.validation_error.message'),
            ]);
        }

        $request->user()->fill($request->all());

        if ($request->file('avatar')) {
            // delete the old avatar image
            File::delete(public_path('images/users/' . $request->user()->avatar));

            $request->user()->avatar = Uuid::uuid4() . "." . $request->file('avatar')->getClientOriginalExtension();
            $request->file('avatar')->move(public_path('images/users'), $request->user()->avatar);
        }

        if ($request->user()->password) {
            $request->user()->password = bcrypt($request->user()->password);
        } else {
            unset($request->user()->password);
        }

        $request->user()->save();

        return redirect()->route('profile.index')->with('notification', [
            'type' => 'success',
            'title' => __('notifications.profile.updated.title'),
            'message' => __('notifications.profile.updated.message'),
        ]);

//        $request->user()->fill($request->validated());
//
////        if ($request->user()->isDirty('password')) {
////            // check if the password is not empty and same with password_confirmation
////            if ($request->user()->password != $request->user()->password_confirmation) {
////                return redirect()->back()->with('notification', [
////                    'type' => 'error',
////                    'title' => __('notifications.profile.password_not_match.title'),
////                    'message' => __('notifications.profile.password_not_match.message'),
////                ]);
////            }
////
////            // check if the password is current password
////            if (password_verify($request->user()->password, $request->user()->getAuthPassword())) {
////                return redirect()->back()->with('notification', [
////                    'type' => 'error',
////                    'title' => __('notifications.profile.password_same.title'),
////                    'message' => __('notifications.profile.password_same.message'),
////                ]);
////            }
////        }
//
//        $request->user()->save();
//
//        return redirect()->route('home')->with('notification', [
//            'type' => 'success',
//            'title' => __('notifications.profile.updated.title'),
//            'message' => __('notifications.profile.updated.message'),
//        ])->withInput();
    }
}
