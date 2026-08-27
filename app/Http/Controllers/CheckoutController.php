<?php

namespace App\Http\Controllers;

use App\Models\CartItem;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;

class CheckoutController extends Controller
{
    /**
     * @return Collection<int, CartItem>
     */
    private function getCartItems(): Collection
    {
        if (Auth::check()) {
            return CartItem::where('user_id', Auth::id())->with('book')->get();
        }

        return CartItem::where('session_id', session()->getId())->with('book')->get();
    }

    public function index(): View|RedirectResponse
    {
        $cartItems = $this->getCartItems();
        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'আপনার কার্ট ফাঁকা! অর্ডার করতে প্রথমে বই যোগ করুন।');
        }

        $subtotal = (float) $cartItems->sum(function ($item) {
            return $item->book->effective_price * $item->quantity;
        });

        return view('pages.checkout.index', compact('cartItems', 'subtotal'));
    }

    public function store(Request $request): RedirectResponse
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

        $subtotal = (float) $cartItems->sum(function ($item) {
            return $item->book->effective_price * $item->quantity;
        });

        $district = (string) $request->district;
        $shippingCharge = (strtolower(trim($district)) === 'dhaka' || $district === 'ঢাকা') ? 60.00 : 110.00;
        $totalAmount = $subtotal + $shippingCharge;

        $orderNumber = 'NCTB-ORD-'.strtoupper(Str::random(8));

        /** @var Order $order */
        $order = Order::create([
            'order_number' => $orderNumber,
            'user_id' => Auth::id(),
            'customer_name' => (string) $request->customer_name,
            'phone' => (string) $request->phone,
            'email' => $request->email ? (string) $request->email : null,
            'district' => $district,
            'address' => (string) $request->address,
            'subtotal' => $subtotal,
            'shipping_charge' => $shippingCharge,
            'total_amount' => $totalAmount,
            'payment_method' => (string) $request->payment_method,
            'payment_status' => ($request->payment_method === 'cod') ? 'pending' : 'paid',
            'order_status' => 'pending',
            'notes' => $request->notes ? (string) $request->notes : null,
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

        if (Auth::check()) {
            CartItem::where('user_id', Auth::id())->delete();
        } else {
            CartItem::where('session_id', session()->getId())->delete();
        }

        return redirect()->route('orders.show', $order->id)
            ->with('success', 'আপনার অর্ডারটি সফলভাবে সম্পন্ন হয়েছে! ট্র্যাকিং নম্বর: '.$order->order_number);
    }
}
