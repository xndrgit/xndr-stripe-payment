<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Stripe\Checkout\Session as CheckoutSession;
use Stripe\Stripe;

class StripeController extends Controller
{
    public function __construct()
    {
        // Set your secret key. Remember to switch to your live secret key in production!
        // See your keys here: https://dashboard.stripe.com/apikeys
        Stripe::setApiKey(env('STRIPE_SECRET'));
    }

    // Display the checkout page
    public function index()
    {
        return view('index');
    }

    // Handle the success callback
    public function success()
    {
        return view('index');
    }

    // Create a checkout session
    public function createCheckoutSession(Request $request)
    {
        try {
            $session = CheckoutSession::create([
                'payment_method_types' => ['card'],
                'line_items' => [[
                    'price_data' => [
                        'currency' => 'usd',
                        'product_data' => [
                            'name' => 'T-shirt',
                        ],
                        'unit_amount' => 2000, // Amount in cents
                    ],
                    'quantity' => 1,
                ]],
                'mode' => 'payment',
                'success_url' => route('success'),
                'cancel_url' => route('index'),
            ]);

            return redirect($session->url);
        } catch (Exception $e) {
            return response()->json([
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
