<?php

namespace App\Http\Controllers;

use App\Models\Wishlist;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class WishlistController extends Controller
{
    /**
     * @return Builder<Wishlist>
     */
    private function getWishlistQuery(): Builder
    {
        if (Auth::check()) {
            return Wishlist::where('user_id', Auth::id());
        }

        return Wishlist::where('session_id', session()->getId());
    }

    public function index(): View
    {
        $wishlistItems = $this->getWishlistQuery()->with('book.author', 'book.gradeLevel')->get();

        return view('pages.wishlist.index', compact('wishlistItems'));
    }

    public function toggle(Request $request): RedirectResponse
    {
        $request->validate([
            'book_id' => 'required|exists:books,id',
        ]);

        $bookId = (int) $request->book_id;
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
