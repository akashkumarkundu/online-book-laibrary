<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\CartItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    private function getCartQuery()
    {
        if (Auth::check()) {
            return CartItem::where('user_id', Auth::id());
        }
        return CartItem::where('session_id', session()->getId());
    }

    public function index()
    {
        $cartItems = $this->getCartQuery()->with('book.author')->get();
        $subtotal = $cartItems->sum(function ($item) {
            return $item->book->effective_price * $item->quantity;
        });

        return view('pages.cart.index', compact('cartItems', 'subtotal'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $bookId = $request->book_id;
        $quantity = $request->quantity ?? 1;

        $cartQuery = $this->getCartQuery();
        $existing = $cartQuery->where('book_id', $bookId)->first();

        if ($existing) {
            $existing->increment('quantity', $quantity);
        } else {
            CartItem::create([
                'user_id' => Auth::id(),
                'session_id' => Auth::check() ? null : session()->getId(),
                'book_id' => $bookId,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'বইটি কার্টে যোগ করা হয়েছে!');
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'quantity' => 'required|integer|min:1',
        ]);

        $cartItem = $this->getCartQuery()->findOrFail($id);
        $cartItem->update(['quantity' => $request->quantity]);

        return redirect()->back()->with('success', 'কার্ট আপডেট করা হয়েছে!');
    }

    public function destroy($id)
    {
        $cartItem = $this->getCartQuery()->findOrFail($id);
        $cartItem->delete();

        return redirect()->back()->with('success', 'বইটি কার্ট থেকে সরানো হয়েছে!');
    }
}
