<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    private function getWishlistQuery()
    {
        if (Auth::check()) {
            return Wishlist::where('user_id', Auth::id());
        }
        return Wishlist::where('session_id', session()->getId());
    }

    public function index()
    {
        $wishlistItems = $this->getWishlistQuery()->with('book.author', 'book.gradeLevel')->get();
        return view('pages.wishlist.index', compact('wishlistItems'));
    }

    public function toggle(Request $request)
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $bookId = $request->book_id;
        $query = $this->getWishlistQuery()->where('book_id', $bookId);

        if ($query->exists()) {
            $query->delete();
            $message = 'বইটি উইশলিস্ট থেকে সরানো হয়েছে!';
        } else {
            Wishlist::create([
                'user_id' => Auth::id(),
                'session_id' => Auth::check() ? null : session()->getId(),
                'book_id' => $bookId,
            ]);
            $message = 'বইটি উইশলিস্টে যোগ করা হয়েছে! ❤️';
        }

        return redirect()->back()->with('success', $message);
    }
}
