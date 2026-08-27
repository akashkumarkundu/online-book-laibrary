@extends('layouts.app')

@section('title', 'অর্ডার চালান #' . $order->order_number)

@section('content')
<div class="max-w-4xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <div class="glass-panel p-8 sm:p-10 rounded-3xl border border-slate-800 space-y-6">
        <!-- Invoice Top Header -->
        <div class="flex flex-col sm:flex-row items-start sm:items-center justify-between border-b border-slate-800 pb-6 gap-4">
            <div>
                <div class="flex items-center gap-2 mb-1">
                    <span class="font-extrabold text-2xl text-white">পাঠশালা লাইব্রেরি</span>
                    <span class="text-[10px] bg-emerald-500/20 text-emerald-400 font-bold px-2 py-0.5 rounded border border-emerald-500/30">অফিশিয়াল চালক</span>
                </div>
                <p class="text-xs text-slate-400">ট্র্যাকিং মেমো নম্বর: <strong class="text-emerald-400">{{ $order->order_number }}</strong></p>
            </div>

            <div class="text-left sm:text-right text-xs text-slate-400">
                <p>তারিখ: <strong class="text-slate-200">{{ $order->created_at->format('d F Y, h:i A') }}</strong></p>
                <p>স্ট্যাটাস: <strong class="text-emerald-400">{{ ucfirst($order->order_status) }}</strong></p>
            </div>
        </div>

        <!-- Customer & Delivery Info -->
        <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 bg-slate-900/60 p-5 rounded-2xl border border-slate-800 text-xs">
            <div>
                <h4 class="font-bold text-emerald-400 uppercase tracking-wider mb-2">প্রাপকের বিবরণ</h4>
                <p class="text-white font-bold text-sm mb-1">{{ $order->customer_name }}</p>
                <p class="text-slate-300">ফোন: {{ $order->phone }}</p>
                @if($order->email) <p class="text-slate-300">ই-মেইল: {{ $order->email }}</p> @endif
            </div>

            <div>
                <h4 class="font-bold text-emerald-400 uppercase tracking-wider mb-2">ডেলিভারি ঠিকানা ও পেমেন্ট</h4>
                <p class="text-slate-300 mb-1">জেলা: <strong>{{ $order->district }}</strong></p>
                <p class="text-slate-300 mb-1">ঠিকানা: {{ $order->address }}</p>
                <p class="text-slate-300">পেমেন্ট মেথড: <strong class="text-amber-400">{{ strtoupper($order->payment_method) }}</strong> ({{ ucfirst($order->payment_status) }})</p>
            </div>
        </div>

        <!-- Order Items Table -->
        <div>
            <h4 class="font-bold text-white mb-3 text-sm">অর্ডারকৃত পাঠ্যবইসমূহ</h4>
            <div class="border border-slate-800 rounded-xl overflow-hidden">
                <table class="w-full text-left text-xs">
                    <thead class="bg-slate-900 text-slate-400 font-semibold border-b border-slate-800">
                        <tr>
                            <th class="p-3">বইয়ের শিরোনাম</th>
                            <th class="p-3 text-center">একক মূল্য</th>
                            <th class="p-3 text-center">পরিমাণ</th>
                            <th class="p-3 text-right">মোট</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-slate-800 text-slate-200">
                        @foreach($order->items as $item)
                            <tr>
                                <td class="p-3 font-semibold text-white">{{ $item->book_title }}</td>
                                <td class="p-3 text-center">৳{{ number_format($item->unit_price, 0) }}</td>
                                <td class="p-3 text-center">{{ $item->quantity }}</td>
                                <td class="p-3 text-right font-bold text-emerald-400">৳{{ number_format($item->total_price, 0) }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>

        <!-- Summary Totals -->
        <div class="space-y-2 text-xs border-t border-slate-800 pt-4 max-w-xs ml-auto">
            <div class="flex justify-between text-slate-300">
                <span>বইয়ের মোট দাম:</span>
                <span class="font-bold text-white">৳{{ number_format($order->subtotal, 0) }}</span>
            </div>
            <div class="flex justify-between text-slate-300">
                <span>ডেলিভারি চার্জ:</span>
                <span class="font-bold text-white">৳{{ number_format($order->shipping_charge, 0) }}</span>
            </div>
            <div class="flex justify-between text-sm font-extrabold text-white border-t border-slate-800 pt-2">
                <span>সর্বমোট পরিশোধযোগ্য:</span>
                <span class="text-emerald-400 text-lg">৳{{ number_format($order->total_amount, 0) }}</span>
            </div>
        </div>

        <!-- Action Links -->
        <div class="flex items-center justify-between pt-6 border-t border-slate-800">
            <a href="{{ route('orders.index') }}" class="text-xs text-slate-400 hover:text-white flex items-center gap-1 font-semibold">
                <i data-lucide="arrow-left" class="w-4 h-4"></i>
                <span>সকল অর্ডার দেখুন</span>
            </a>

            <button onclick="window.print()" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs px-5 py-2.5 rounded-xl shadow-lg flex items-center gap-1.5">
                <i data-lucide="printer" class="w-4 h-4"></i>
                <span>চালান প্রিন্ট করুন</span>
            </button>
        </div>
    </div>
</div>
@endsection
