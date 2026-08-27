<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    private function getCartItems()
    {
        if (Auth::check()) {
            return CartItem::where('user_id', Auth::id())->with('book')->get();
        }
        return CartItem::where('session_id', session()->getId())->with('book')->get();
    }

    public function index()
    {
        $cartItems = $this->getCartItems();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'আপনার কার্ট ফাঁকা! অর্ডার করতে প্রথমে বই যোগ করুন।');
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->book->effective_price * $item->quantity;
        });

        return view('pages.checkout.index', compact('cartItems', 'subtotal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'customer_name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'email' => 'nullable|email|max:255',
            'district' => 'required|string|max:100',
            'address' => 'required|string',
            'payment_method' => 'required|in:cod,bkash,nagad,rocket',
        ]);

        $cartItems = $this->getCartItems();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'আপনার কার্ট ফাঁকা!');
        }

        $subtotal = $cartItems->sum(function ($item) {
            return $item->book->effective_price * $item->quantity;
        });

        $shippingCharge = (strtolower(trim($request->district)) === 'dhaka' || $request->district === 'ঢাকা') ? 60.00 : 110.00;
        $totalAmount = $subtotal + $shippingCharge;

        $orderNumber = 'NCTB-ORD-' . strtoupper(Str::random(8));

        $order = Order::create([
            'order_number' => $orderNumber,
            'user_id' => Auth::id(),
            'customer_name' => $request->customer_name,
            'phone' => $request->phone,
            'email' => $request->email,
            'district' => $request->district,
            'address' => $request->address,
            'subtotal' => $subtotal,
            'shipping_charge' => $shippingCharge,
            'total_amount' => $totalAmount,
            'payment_method' => $request->payment_method,
            'payment_status' => ($request->payment_method === 'cod') ? 'pending' : 'paid',
            'order_status' => 'pending',
            'notes' => $request->notes,
        ]);

        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'book_id' => $item->book_id,
                'book_title' => $item->book->title,
                'unit_price' => $item->book->effective_price,
                'quantity' => $item->quantity,
                'total_price' => $item->book->effective_price * $item->quantity,
            ]);
        }

        // Clear cart
        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())->delete();
        } else {
            CartItem::where('session_id', session()->getId())->delete();
        }

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'আপনার অর্ডারটি সফলভাবে সম্পন্ন হয়েছে! ট্র্যাকিং নম্বর: ' . $order->order_number);
    }
}
