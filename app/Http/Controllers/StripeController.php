<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderProduct;
use App\Models\Part;
use Exception;
use Illuminate\Http\Request;
use Stripe\Checkout\Session;
use Stripe\Customer;
use Stripe\Exception\SignatureVerificationException;
use Stripe\Stripe;
use Stripe\Webhook;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;
use UnexpectedValueException;

class StripeController extends Controller
{
    public function index()
    {
        $cart = session()->get("cart");

        if (empty($cart)) {
            return redirect()->route("cart.index")
                ->with("error", "Your cart is empty");
        }

        $total = 0;
        $shippingCost = 0;
        $shippingDate = now()->addDays(3);

        foreach ($cart as $id => $details) {
            $total += $details["price"] * $details["count"];
        }

        if ($total < 100) {
            $shippingCost = 10;
        }

        $total += $shippingCost;

        foreach ($cart as $id => $details) {
            if ($details->quantity == 0) {
                $shippingDate = $shippingDate->addDays(3);
                break;
            }
        }

        return view(
            "stripe.index",
            compact("cart", "total", "shippingCost", "shippingDate")
        );
    }

    public function checkout(Request $request)
    {
        $request->validate([
            "firstName" => "required|alpha|max:100",
            "lastName" => "required|alpha|max:100",
            "email" => "required|email",
            "phone" => "required|numeric",
            "country" => "required",
            "city" => "required",
            "address" => "required|max:100",
            "address2" => "nullable|max:100",
            "zipCode" => "required|numeric",
            "state" => "required",
        ]);

        if ($errors = $request->session()->get('errors')) {
            return redirect()->back()->withErrors($errors);
        }

        if ($request->input('saveInfo')) {
            auth()->user()->update([
                "firstName" => $request->firstName,
                "lastName" => $request->lastName,
                "email" => $request->email,
                "phone" => $request->phone,
                "country" => $request->country,
                "city" => $request->city,
                "address" => $request->address,
                "address2" => $request->address2,
                "zipCode" => $request->zipCode,
                "state" => $request->state,
            ]);
        }

        Stripe::setApiKey(config("stripe.sk"));

        $customer = Customer::create([
            "address" => [
                "line1" => $request->address,
                "line2" => $request->address2,
                "postal_code" => $request->zipCode,
                "city" => $request->city,
                "country" => $request->country,
                "state" => $request->state,
            ],
            "email" => $request->email,
            "name" => $request->firstName . " " . $request->lastName,
            "phone" => $request->phone,
        ]);

        if (auth()->check() && !auth()->user()->stripe_id) {
            auth()->user()->update([
                "stripe_id" => $customer->id,
            ]);
        }

        $session = Session::create([
            "line_items" => [[$this->buildLineItems()]],
            "mode" => "payment",
            "success_url" => route("stripe.success") . "?session_id={CHECKOUT_SESSION_ID}",
            "cancel_url" => route("stripe.index"),
            "payment_method_types" => ["card"],
            "customer" => $customer->id,
            "locale" => app()->getLocale()
        ]);

        $order = Order::create([
            "userId" => auth()->user()->id ?? null,
            "session" => $session->id,
            "amount" => $session->amount_total,
            "status" => "unpaid",
        ]);

        $cart = session()->get("cart");
        foreach ($cart as $part) {
            OrderProduct::create([
                "orderId" => $order->id,
                "partId" => $part->id,
                "quantity" => $part->count,
            ]);

            $part->quantity -= $part->count;
            unset($part->count, $part->name);
            $part->save();
        }

        return redirect($session->url);
    }

    private function buildLineItems(): array
    {
        $array = session()->get("cart");
        $lineItems = [];

        foreach ($array as $part) {
            $lineItems[] = [
                "price_data" => [
                    "currency" => "eur",
                    "product_data" => [
                        "name" => $part->{app()->getLocale() . 'Name'},
                    ],
                    "unit_amount" => $part->price * 100,
                ],
                "quantity" => $part->count,
            ];
        }

        return $lineItems;
    }

    public function webhook()
    {
        $endpoint_secret = config("stripe.webhook_secret");

        $event = null;

        try {
            $payload = @file_get_contents('php://input');
            $sig_header = $_SERVER['HTTP_STRIPE_SIGNATURE'];

            $event = Webhook::constructEvent(
                $payload, $sig_header, $endpoint_secret
            );
        } catch (UnexpectedValueException|SignatureVerificationException) {
            return response('', 400);
        }

        // Handle the event
        switch ($event->type) {
            case 'checkout.session.completed':
                $session = $event->data->object;

                $order = Order::where('session', $session->id)->first();
                if ($order && $order->status === 'unpaid') {
                    $order->status = 'paid';
                    $order->save();
                }
            default:
                echo 'Received unknown event type ' . $event->type;
        }

        return response('');
    }

    public function success()
    {
        Stripe::setApiKey(config("stripe.sk"));
        $sessionId = request()->get("session_id");

        try {
            $session = Session::retrieve($sessionId);

            if (!$session) {
                throw new Exception("Session not found");
            }

            $customer = Customer::retrieve($session->customer);

            $order = Order::where("session", $session->id)->first();
            if (!$order) {
                throw new Exception("Order not found");
            }

            if ($order->status === "unpaid") {
                $order->status = "paid";
                $order->save();

                session()->forget("cart");
            }

            $popularProducts = Part::inRandomOrder()->limit(6)->get();

            return view("stripe.success", compact("session", "popularProducts", "customer", "order"));
        } catch (\Exception $e){
            throw new NotFoundHttpException();
        }
    }
}
