@extends('layouts.app')

@section('title', 'আমার অর্ডারসমূহ | পাঠশালা লাইব্রেরি')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-3xl font-extrabold text-white mb-6">আমার সাম্প্রতিক অর্ডারসমূহ</h1>

    @if($orders->isEmpty())
        <div class="glass-panel p-12 text-center rounded-3xl border border-slate-800">
            <i data-lucide="package-open" class="w-16 h-16 text-slate-500 mx-auto mb-4"></i>
            <h3 class="text-xl font-bold text-white mb-2">কোনো অর্ডার রেকর্ড পাওয়া যায়নি</h3>
            <p class="text-xs text-slate-400 mb-6">আপনি এখনও কোনো বইয়ের অর্ডার সম্পন্ন করেননি।</p>
            <a href="{{ route('books.index') }}" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs px-6 py-3 rounded-xl inline-block shadow-lg">
                বোর্ড বই দেখুন
            </a>
        </div>
    @else
        <div class="space-y-4">
            @foreach($orders as $order)
                <div class="glass-panel p-6 rounded-2xl border border-slate-800 flex flex-col sm:flex-row items-center justify-between gap-4">
                    <div>
                        <div class="flex items-center gap-3 mb-2">
                            <span class="font-extrabold text-emerald-400 text-sm">{{ $order->order_number }}</span>
                            <span class="text-[10px] bg-slate-800 text-slate-300 font-bold px-2 py-0.5 rounded border border-slate-700">
                                {{ strtoupper($order->payment_method) }}
                            </span>
                            <span class="text-[10px] bg-emerald-500/20 text-emerald-300 font-bold px-2 py-0.5 rounded border border-emerald-500/30">
                                {{ ucfirst($order->order_status) }}
                            </span>
                        </div>
                        <p class="text-xs text-slate-300">ক্রেতা: <strong>{{ $order->customer_name }}</strong> ({{ $order->phone }})</p>
                        <p class="text-[11px] text-slate-400 mt-1">তারিখ: {{ $order->created_at->format('d M Y, h:i A') }}</p>
                    </div>

                    <div class="flex items-center gap-4">
                        <div class="text-right">
                            <span class="text-xs text-slate-400 block">সর্বমোট মূল্য</span>
                            <span class="text-lg font-extrabold text-emerald-400">৳{{ number_format($order->total_amount, 0) }}</span>
                        </div>
                        <a href="{{ route('orders.show', $order->id) }}" class="bg-slate-900 hover:bg-slate-800 text-white border border-slate-700 text-xs font-bold px-4 py-2.5 rounded-xl flex items-center gap-1">
                            <span>মেমো দেখুন</span>
                            <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    </div>
                </div>
            @endforeach
        </div>
    @endif
</div>
@endsection
