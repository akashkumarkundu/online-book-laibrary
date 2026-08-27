<?php

namespace App\Http\Controllers;

use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        if (Auth::check()) {
            $orders = Order::where('user_id', Auth::id())->with('items')->latest()->get();
        } else {
            $orders = Order::latest()->take(5)->get();
        }

        return view('pages.orders.index', compact('orders'));
    }

    public function show($id)
    {
        $order = Order::with('items.book')->findOrFail($id);

        return view('pages.orders.show', compact('order'));
    }
}
