@extends('layouts.admin')

@section('title', 'ড্যাশবোর্ড - পাঠশালা এডমিন')
@section('page_header', 'ড্যাশবোর্ড ওভারভিউ (Dashboard Overview)')

@section('content')
<div class="space-y-6">
    <!-- Stat Cards Grid -->
    <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-5">
        <!-- Total Books -->
        <div class="glass-card p-5 rounded-2xl border border-slate-800 flex items-center justify-between">
            <div>
                <p class="text-xs text-slate-400 font-semibold mb-1">মোট বই (Total Books)</p>
                <h3 class="text-2xl font-extrabold text-white">{{ number_format($totalBooks) }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center">
                <i data-lucide="book-copy" class="w-6 h-6"></i>
            </div>
        </div>

        <!-- Total Orders -->
        <div class="glass-card p-5 rounded-2xl border border-slate-800 flex items-center justify-between">
            <div>
                <p class="text-xs text-slate-400 font-semibold mb-1">মোট অর্ডার (Orders)</p>
                <h3 class="text-2xl font-extrabold text-white">{{ number_format($totalOrders) }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center">
                <i data-lucide="shopping-cart" class="w-6 h-6"></i>
            </div>
        </div>

        <!-- Revenue -->
        <div class="glass-card p-5 rounded-2xl border border-slate-800 flex items-center justify-between">
            <div>
                <p class="text-xs text-slate-400 font-semibold mb-1">মোট আয় (Total Revenue)</p>
                <h3 class="text-2xl font-extrabold text-emerald-400">৳ {{ number_format($totalRevenue, 2) }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-teal-500/10 text-teal-400 flex items-center justify-center">
                <i data-lucide="banknote" class="w-6 h-6"></i>
            </div>
        </div>

        <!-- Pending Contacts -->
        <div class="glass-card p-5 rounded-2xl border border-slate-800 flex items-center justify-between">
            <div>
                <p class="text-xs text-slate-400 font-semibold mb-1">নতুন বার্তা (Unread Messages)</p>
                <h3 class="text-2xl font-extrabold text-amber-400">{{ number_format($pendingContacts) }}</h3>
            </div>
            <div class="w-12 h-12 rounded-xl bg-amber-500/10 text-amber-400 flex items-center justify-center">
                <i data-lucide="mail-warning" class="w-6 h-6"></i>
            </div>
        </div>
    </div>

    <!-- Quick Actions -->
    <div class="flex items-center justify-between bg-slate-900/60 p-4 rounded-2xl border border-slate-800 flex-wrap gap-4">
        <h3 class="text-sm font-bold text-white flex items-center gap-2">
            <i data-lucide="zap" class="w-4 h-4 text-emerald-400"></i> দ্রুত অ্যাকশন (Quick Actions):
        </h3>
        <div class="flex items-center gap-3">
            <a href="{{ route('admin.books.create') }}" class="bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold px-4 py-2 rounded-xl transition-all flex items-center gap-2 shadow-lg shadow-emerald-600/20">
                <i data-lucide="plus-circle" class="w-4 h-4"></i> নতুন বই যুক্ত করুন
            </a>
            <a href="{{ route('admin.orders.index') }}" class="bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-bold px-4 py-2 rounded-xl transition-all flex items-center gap-2">
                <i data-lucide="list-ordered" class="w-4 h-4 text-indigo-400"></i> সকল অর্ডার দেখুন
            </a>
        </div>
    </div>

    <!-- Recent Orders Table -->
    <div class="glass-card rounded-2xl border border-slate-800 overflow-hidden">
        <div class="p-5 border-b border-slate-800 flex items-center justify-between">
            <h3 class="font-bold text-white text-sm flex items-center gap-2">
                <i data-lucide="clock" class="w-4 h-4 text-indigo-400"></i> সাম্প্রতিক অর্ডারসমূহ (Recent Orders)
            </h3>
            <a href="{{ route('admin.orders.index') }}" class="text-xs text-emerald-400 hover:underline">সকল অর্ডার দেখুন &rarr;</a>
        </div>

        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-900 text-slate-400 border-b border-slate-800 uppercase tracking-wider">
                    <tr>
                        <th class="px-5 py-3.5">অর্ডার নং</th>
                        <th class="px-5 py-3.5">গ্রাহকের নাম</th>
                        <th class="px-5 py-3.5">মোবাইল</th>
                        <th class="px-5 py-3.5">মোট টাকা</th>
                        <th class="px-5 py-3.5">স্ট্যাটাস</th>
                        <th class="px-5 py-3.5">তারিখ</th>
                        <th class="px-5 py-3.5 text-right">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 text-slate-300">
                    @forelse($recentOrders as $order)
                        <tr class="hover:bg-slate-800/40 transition-colors">
                            <td class="px-5 py-4 font-mono font-bold text-white">#{{ $order->order_number }}</td>
                            <td class="px-5 py-4 font-medium text-white">{{ $order->customer_name }}</td>
                            <td class="px-5 py-4 text-slate-400">{{ $order->phone }}</td>
                            <td class="px-5 py-4 font-bold text-emerald-400">৳ {{ number_format($order->total_amount, 2) }}</td>
                            <td class="px-5 py-4">
                                @if($order->order_status === 'completed')
                                    <span class="bg-emerald-500/20 text-emerald-300 text-[11px] px-2.5 py-1 rounded-full font-semibold border border-emerald-500/30">সম্পন্ন</span>
                                @elseif($order->order_status === 'processing')
                                    <span class="bg-indigo-500/20 text-indigo-300 text-[11px] px-2.5 py-1 rounded-full font-semibold border border-indigo-500/30">প্রসেসিং</span>
                                @elseif($order->order_status === 'cancelled')
                                    <span class="bg-rose-500/20 text-rose-300 text-[11px] px-2.5 py-1 rounded-full font-semibold border border-rose-500/30">বাতিল</span>
                                @else
                                    <span class="bg-amber-500/20 text-amber-300 text-[11px] px-2.5 py-1 rounded-full font-semibold border border-amber-500/30">পেন্ডিং</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-slate-400">{{ $order->created_at ? $order->created_at->format('d M, Y') : 'N/A' }}</td>
                            <td class="px-5 py-4 text-right">
                                <a href="{{ route('admin.orders.show', $order->id) }}" class="bg-slate-800 hover:bg-slate-700 text-slate-200 px-3 py-1.5 rounded-lg text-xs font-semibold">
                                    বিস্তারিত
                                </a>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="7" class="text-center py-8 text-slate-500">কোনো অর্ডার পাওয়া যায়নি।</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
