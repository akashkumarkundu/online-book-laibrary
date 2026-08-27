<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Contracts\View\View;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index(): View
    {
        if (Auth::check()) {
            $orders = Order::where('user_id', Auth::id())->with('items')->latest()->get();
        } else {
            $orders = Order::latest()->take(5)->get();
        }

        return view('pages.orders.index', compact('orders'));
    }

    public function show(int|string $id): View
    {
        /** @var Order $order */
        $order = Order::with('items.book')->findOrFail($id);

        return view('pages.orders.show', compact('order'));
    }
}
