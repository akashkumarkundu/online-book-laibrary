@extends('layouts.admin')

@section('title', 'অর্ডার বিস্তারিত - পাঠশালা এডমিন')
@section('page_header', 'অর্ডার মেমো ও স্ট্যাটাস আপডেট (#'.$order->order_number.')')

@section('content')
<div class="max-w-5xl mx-auto space-y-6">
    <div class="flex items-center justify-between">
        <a href="{{ route('admin.orders.index') }}" class="text-xs text-slate-400 hover:text-white flex items-center gap-1">
            &larr; অর্ডার তালিকায় ফিরে যান
        </a>
        <span class="text-xs text-slate-400">অর্ডারের তারিখ: {{ $order->created_at ? $order->created_at->format('d F, Y h:i A') : 'N/A' }}</span>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        <!-- Order Items & Receipt -->
        <div class="lg:col-span-2 space-y-6">
            <div class="glass-card p-6 rounded-2xl border border-slate-800 space-y-4">
                <h3 class="font-bold text-white text-sm border-b border-slate-800 pb-3 flex items-center gap-2">
                    <i data-lucide="book-open" class="w-4 h-4 text-emerald-400"></i> অর্ডারের বইসমূহ (Ordered Items)
                </h3>

                <div class="divide-y divide-slate-800/60">
                    @foreach($order->items as $item)
                        <div class="py-3 flex items-center justify-between gap-4">
                            <div>
                                <h4 class="font-bold text-white text-xs">{{ $item->book->title ?? $item->book_title }}</h4>
                                <p class="text-[11px] text-slate-400">একক মূল্য: ৳ {{ number_format($item->unit_price, 2) }} &times; {{ $item->quantity }} টি</p>
                            </div>
                            <div class="font-bold text-emerald-400 text-xs">
                                ৳ {{ number_format($item->subtotal, 2) }}
                            </div>
                        </div>
                    @endforeach
                </div>

                <div class="pt-4 border-t border-slate-800 space-y-2 text-xs">
                    <div class="flex justify-between text-slate-400">
                        <span>সাবটোটাল (Subtotal):</span>
                        <span class="text-slate-200">৳ {{ number_format($order->subtotal, 2) }}</span>
                    </div>
                    <div class="flex justify-between text-slate-400">
                        <span>ডেলিভারি চার্জ (Shipping):</span>
                        <span class="text-slate-200">৳ {{ number_format($order->shipping_charge, 2) }}</span>
                    </div>
                    <div class="flex justify-between font-extrabold text-sm text-white pt-2 border-t border-slate-800/60">
                        <span>সর্বমোট (Total Amount):</span>
                        <span class="text-emerald-400">৳ {{ number_format($order->total_amount, 2) }}</span>
                    </div>
                </div>
            </div>

            <!-- Customer Shipping Info -->
            <div class="glass-card p-6 rounded-2xl border border-slate-800 space-y-3 text-xs">
                <h3 class="font-bold text-white text-sm border-b border-slate-800 pb-3 flex items-center gap-2">
                    <i data-lucide="map-pin" class="w-4 h-4 text-indigo-400"></i> ডেলিভারি ঠিকানা ও গ্রাহকের তথ্য
                </h3>
                <div class="grid grid-cols-2 gap-4 text-slate-300">
                    <div>
                        <span class="text-slate-400 block text-[11px]">গ্রাহকের নাম:</span>
                        <span class="font-bold text-white">{{ $order->customer_name }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[11px]">মোবাইল নাম্বার:</span>
                        <span class="font-bold text-emerald-400 font-mono">{{ $order->phone }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[11px]">ইমেইল:</span>
                        <span>{{ $order->email ?? 'N/A' }}</span>
                    </div>
                    <div>
                        <span class="text-slate-400 block text-[11px]">জেলা:</span>
                        <span class="font-bold text-white">{{ $order->district }}</span>
                    </div>
                    <div class="col-span-2">
                        <span class="text-slate-400 block text-[11px]">সম্পূর্ণ ঠিকানা:</span>
                        <span class="font-medium text-slate-200">{{ $order->address }}</span>
                    </div>
                    @if($order->notes)
                        <div class="col-span-2 bg-slate-900/60 p-3 rounded-xl border border-slate-800">
                            <span class="text-slate-400 block text-[11px] font-bold">বিশেষ নোট:</span>
                            <span class="text-slate-300">{{ $order->notes }}</span>
                        </div>
                    @endif
                </div>
            </div>
        </div>

        <!-- Status Management Card -->
        <div class="glass-card p-6 rounded-2xl border border-slate-800 space-y-5 h-fit">
            <h3 class="font-bold text-white text-sm border-b border-slate-800 pb-3 flex items-center gap-2">
                <i data-lucide="sliders" class="w-4 h-4 text-amber-400"></i> স্ট্যাটাস আপডেট করুন
            </h3>

            <form action="{{ route('admin.orders.update-status', $order->id) }}" method="POST" class="space-y-4 text-xs">
                @csrf
                @method('PATCH')

                <div>
                    <label class="block font-semibold text-slate-300 mb-1.5">অর্ডার ডেলিভারি স্ট্যাটাস</label>
                    <select name="order_status" class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl p-3 focus:outline-none focus:border-emerald-500 font-bold">
                        <option value="pending" {{ $order->order_status === 'pending' ? 'selected' : '' }}>পেন্ডিং (Pending)</option>
                        <option value="processing" {{ $order->order_status === 'processing' ? 'selected' : '' }}>প্রসেসিং (Processing)</option>
                        <option value="completed" {{ $order->order_status === 'completed' ? 'selected' : '' }}>সম্পন্ন (Completed)</option>
                        <option value="cancelled" {{ $order->order_status === 'cancelled' ? 'selected' : '' }}>বাতিল (Cancelled)</option>
                    </select>
                </div>

                <div>
                    <label class="block font-semibold text-slate-300 mb-1.5">পেমেন্ট স্ট্যাটাস</label>
                    <select name="payment_status" class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl p-3 focus:outline-none focus:border-emerald-500 font-bold">
                        <option value="pending" {{ $order->payment_status === 'pending' ? 'selected' : '' }}>পেন্ডিং (Pending)</option>
                        <option value="paid" {{ $order->payment_status === 'paid' ? 'selected' : '' }}>পরিশোধিত (Paid)</option>
                        <option value="failed" {{ $order->payment_status === 'failed' ? 'selected' : '' }}>ব্যর্থ (Failed)</option>
                    </select>
                </div>

                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-2.5 rounded-xl transition-all shadow-lg shadow-emerald-600/20">
                    স্ট্যাটাস সংরক্ষণ করুন
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
