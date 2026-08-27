<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Book;
use App\Models\Contact;
use App\Models\Order;
use Illuminate\Contracts\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $totalBooks = Book::count();
        $totalOrders = Order::count();
        $totalRevenue = Order::where('order_status', 'completed')->sum('total_amount');
        $pendingContacts = Contact::where('status', 'pending')->count();
        $recentOrders = Order::with('items')->latest()->take(6)->get();

        return view('admin.dashboard', compact(
            'totalBooks',
            'totalOrders',
            'totalRevenue',
            'pendingContacts',
            'recentOrders'
        ));
    }
}
