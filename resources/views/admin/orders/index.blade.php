@extends('layouts.admin')

@section('title', 'অর্ডার ব্যবস্থাপনা - পাঠশালা এডমিন')
@section('page_header', 'অর্ডার ব্যবস্থাপনা (Order Management)')

@section('content')
<div class="space-y-6">
    <!-- Search & Filter Bar -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-slate-900/60 p-4 rounded-2xl border border-slate-800">
        <form action="{{ route('admin.orders.index') }}" method="GET" class="flex items-center gap-3 w-full flex-1 max-w-xl">
            <div class="relative flex-1">
                <i data-lucide="search" class="absolute left-3 top-2.5 w-4 h-4 text-slate-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="অর্ডার নং, নাম বা মোবাইল দিয়ে খুঁজুন..." 
                    class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl pl-9 pr-4 py-2 focus:outline-none focus:border-emerald-500">
            </div>
            <select name="status" class="bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-3 py-2 focus:outline-none focus:border-emerald-500">
                <option value="">সকল স্ট্যাটাস</option>
                <option value="pending" {{ request('status') == 'pending' ? 'selected' : '' }}>পেন্ডিং (Pending)</option>
                <option value="processing" {{ request('status') == 'processing' ? 'selected' : '' }}>প্রসেসিং (Processing)</option>
                <option value="completed" {{ request('status') == 'completed' ? 'selected' : '' }}>সম্পন্ন (Completed)</option>
                <option value="cancelled" {{ request('status') == 'cancelled' ? 'selected' : '' }}>বাতিল (Cancelled)</option>
            </select>
            <button type="submit" class="bg-slate-800 hover:bg-slate-700 text-white text-xs px-4 py-2 rounded-xl font-bold">
                ফিল্টার
            </button>
        </form>
    </div>

    <!-- Orders Table -->
    <div class="glass-card rounded-2xl border border-slate-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-900 text-slate-400 border-b border-slate-800 uppercase tracking-wider">
                    <tr>
                        <th class="px-5 py-3.5">অর্ডার নাম্বার</th>
                        <th class="px-5 py-3.5">গ্রাহক ও মোবাইল</th>
                        <th class="px-5 py-3.5">জেলা ও ঠিকানা</th>
                        <th class="px-5 py-3.5">পেমেন্ট মেথড</th>
                        <th class="px-5 py-3.5">মোট মূল্য</th>
                        <th class="px-5 py-3.5">স্ট্যাটাস</th>
                        <th class="px-5 py-3.5 text-right">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 text-slate-300">
                    @forelse($orders as $order)
                        <tr class="hover:bg-slate-800/40 transition-colors">
                            <td class="px-5 py-4 font-mono font-bold text-white">#{{ $order->order_number }}</td>
                            <td class="px-5 py-4">
                                <div class="font-bold text-white">{{ $order->customer_name }}</div>
                                <div class="text-[11px] text-slate-400 font-mono">{{ $order->phone }}</div>
                            </td>
                            <td class="px-5 py-4 text-slate-300">
                                <div class="font-semibold text-emerald-400">{{ $order->district }}</div>
                                <div class="text-[11px] text-slate-400 max-w-xs truncate">{{ $order->address }}</div>
                            </td>
                            <td class="px-5 py-4 font-medium uppercase text-slate-300">
                                {{ str_replace('_', ' ', $order->payment_method) }}
                            </td>
                            <td class="px-5 py-4 font-extrabold text-emerald-400">
                                ৳ {{ number_format($order->total_amount, 2) }}
                            </td>
                            <td class="px-5 py-4">
                                @if($order->order_status === 'completed')
                                    <span class="bg-emerald-500/20 text-emerald-300 text-[10px] px-2.5 py-1 rounded-full font-bold border border-emerald-500/30">সম্পন্ন</span>
                                @elseif($order->order_status === 'processing')
                                    <span class="bg-indigo-500/20 text-indigo-300 text-[10px] px-2.5 py-1 rounded-full font-bold border border-indigo-500/30">প্রসেসিং</span>
                                @elseif($order->order_status === 'cancelled')
                                    <span class="bg-rose-500/20 text-rose-300 text-[10px] px-2.5 py-1 rounded-full font-bold border border-rose-500/30">বাতিল</span>
                                @else
                                    <span class="bg-amber-500/20 text-amber-300 text-[10px] px-2.5 py-1 rounded-full font-bold border border-amber-500/30">পেন্ডিং</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-right">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="bg-emerald-600 hover:bg-emerald-500 text-white px-3 py-1.5 rounded-lg text-xs font-semibold inline-flex items-center gap-1">
                                    <i data-lucide="eye" class="w-3 h-3"></i> বিস্তারিত
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-8 text-slate-500">কোনো অর্ডার পাওয়া যায়নি।</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($orders->hasPages())
            <div class="p-4 border-t border-slate-800">
                {{ $orders->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
