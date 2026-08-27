@extends('layouts.app')

@section('title', 'শপিং কার্ট | পাঠশালা লাইব্রেরি')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-3xl font-extrabold text-white mb-6">আপনার শপিং কার্ট</h1>

    @if($cartItems->isEmpty())
        <div class="glass-panel p-12 text-center rounded-3xl border border-slate-800">
            <i data-lucide="shopping-cart" class="w-16 h-16 text-slate-500 mx-auto mb-4"></i>
            <h3 class="text-xl font-bold text-white mb-2">আপনার কার্টটি বর্তমানে ফাঁকা</h3>
            <p class="text-xs text-slate-400 mb-6">আপনার প্রয়োজনীয় বোর্ড বইগুলো সিলেক্ট করে কার্টে যোগ করুন।</p>
            <a href="{{ route('books.index') }}" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs px-6 py-3 rounded-xl inline-block shadow-lg">
                বোর্ড বই দেখুন
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">
            <!-- Cart Items List -->
            <div class="lg:col-span-2 space-y-4">
                @foreach($cartItems as $item)
                    <div class="glass-panel p-4 sm:p-5 rounded-2xl border border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4">
                        <div class="flex items-center gap-4">
                            <div class="w-14 h-16 rounded-lg bg-gradient-to-br {{ $item->book->cover_color }} p-2 text-white flex flex-col justify-between shrink-0">
                                <span class="text-[9px] font-bold">NCTB</span>
                                <i data-lucide="book" class="w-5 h-5 opacity-40"></i>
                            </div>
                            <div>
                                <h3 class="font-bold text-white text-sm">{{ $item->book->title }}</h3>
                                <p class="text-xs text-amber-400 font-semibold">{{ $item->book->author->name }}</p>
                                <span class="text-xs text-emerald-400 font-extrabold block mt-1">৳{{ number_format($item->book->effective_price, 0) }}</span>
                            </div>
                        </div>

                        <div class="flex items-center gap-4">
                            <!-- Update Quantity Form -->
                            <form action="{{ route('cart.update', $item->id) }}" method="POST" class="flex items-center gap-1">
                                @csrf
                                @method('PUT')
                                <input type="number" name="quantity" value="{{ $item->quantity }}" min="1" onchange="this.form.submit()" 
                                    class="w-16 bg-slate-900 border border-slate-700 text-white text-xs text-center py-1.5 rounded-lg font-bold">
                            </form>

                            <span class="text-sm font-extrabold text-white w-20 text-right">
                                ৳{{ number_format($item->subtotal, 0) }}
                            </span>

                            <!-- Delete Item Form -->
                            <form action="{{ route('cart.destroy', $item->id) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-slate-500 hover:text-rose-400 p-1">
                                    <i data-lucide="trash-2" class="w-4 h-4"></i>
                                </button>
                            </form>
                        </div>
                    </div>
                @endforeach
            </div>

            <!-- Order Summary -->
            <div class="lg:col-span-1">
                <div class="glass-panel p-6 rounded-2xl border border-slate-800 space-y-4 sticky top-28">
                    <h3 class="text-lg font-extrabold text-white border-b border-slate-800 pb-3">অর্ডার সারসংক্ষেপ</h3>

                    <div class="flex items-center justify-between text-xs text-slate-300">
                        <span>বইয়ের মোট মূল্য:</span>
                        <span class="font-bold text-white">৳{{ number_format($subtotal, 0) }}</span>
                    </div>
                    <div class="flex items-center justify-between text-xs text-slate-300">
                        <span>ডেলিভারি চার্জ:</span>
                        <span class="font-bold text-slate-400">চেকআউটে হিসাব করা হবে</span>
                    </div>

                    <div class="border-t border-slate-800 pt-3 flex items-center justify-between text-sm font-extrabold text-white">
                        <span>আনুমানিক মোট:</span>
                        <span class="text-lg text-emerald-400">৳{{ number_format($subtotal, 0) }}</span>
                    </div>

                    <a href="{{ route('checkout.index') }}" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs py-3.5 rounded-xl text-center block transition-all shadow-lg shadow-emerald-600/30">
                        অর্ডার করুন (Proceed to Checkout)
                    </a>
                </div>
            </div>
        </div>
    @endif
</div>
@endsection
