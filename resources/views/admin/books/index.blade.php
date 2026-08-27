@extends('layouts.admin')

@section('title', 'বই ব্যবস্থাপনা - পাঠশালা এডমিন')
@section('page_header', 'বই ব্যবস্থাপনা (Books List)')

@section('content')
<div class="space-y-6">
    <!-- Action & Search Bar -->
    <div class="flex flex-col sm:flex-row items-center justify-between gap-4 bg-slate-900/60 p-4 rounded-2xl border border-slate-800">
        <form action="{{ route('admin.books.index') }}" method="GET" class="flex items-center gap-3 w-full sm:w-auto flex-1 max-w-lg">
            <div class="relative flex-1">
                <i data-lucide="search" class="absolute left-3 top-2.5 w-4 h-4 text-slate-400"></i>
                <input type="text" name="search" value="{{ request('search') }}" placeholder="বইয়ের নাম দিয়ে অনুসন্ধান করুন..." 
                    class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl pl-9 pr-4 py-2 focus:outline-none focus:border-emerald-500">
            </div>
            <select name="grade_level_id" class="bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-3 py-2 focus:outline-none focus:border-emerald-500">
                <option value="">সকল শ্রেণী</option>
                @foreach($gradeLevels as $grade)
                    <option value="{{ $grade->id }}" {{ request('grade_level_id') == $grade->id ? 'selected' : '' }}>{{ $grade->name_bn }}</option>
                @endforeach
            </select>
            <button type="submit" class="bg-slate-800 hover:bg-slate-700 text-white text-xs px-4 py-2 rounded-xl font-bold">
                ফিল্টার
            </button>
        </form>

        <a href="{{ route('admin.books.create') }}" class="w-full sm:w-auto bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold px-4 py-2.5 rounded-xl transition-all flex items-center justify-center gap-2 shadow-lg shadow-emerald-600/20">
            <i data-lucide="plus" class="w-4 h-4"></i> নতুন বই যোগ করুন
        </a>
    </div>

    <!-- Books Table -->
    <div class="glass-card rounded-2xl border border-slate-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-900 text-slate-400 border-b border-slate-800 uppercase tracking-wider">
                    <tr>
                        <th class="px-5 py-3.5">বইয়ের শিরোনাম</th>
                        <th class="px-5 py-3.5">শ্রেণী</th>
                        <th class="px-5 py-3.5">বিষয়</th>
                        <th class="px-5 py-3.5">মূল্য (ছাড়)</th>
                        <th class="px-5 py-3.5">স্টক</th>
                        <th class="px-5 py-3.5 text-right">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 text-slate-300">
                    @forelse($books as $book)
                        <tr class="hover:bg-slate-800/40 transition-colors">
                            <td class="px-5 py-4 font-bold text-white flex items-center gap-3">
                                <div class="w-8 h-10 rounded bg-gradient-to-br {{ $book->cover_color ?? 'from-emerald-700 to-teal-900' }} flex items-center justify-center text-[10px] font-bold text-white shadow">
                                    NCTB
                                </div>
                                <div>
                                    <div class="font-bold text-white">{{ $book->title }}</div>
                                    <div class="text-[11px] text-slate-400 font-normal">প্রকাশনী: {{ $book->publisher }}</div>
                                </div>
                            </td>
                            <td class="px-5 py-4 font-semibold text-emerald-400">
                                {{ $book->gradeLevel->name_bn ?? 'N/A' }}
                            </td>
                            <td class="px-5 py-4 text-slate-300">
                                {{ $book->subject->name_bn ?? 'N/A' }}
                            </td>
                            <td class="px-5 py-4 font-bold text-white">
                                ৳ {{ number_format($book->price, 2) }}
                                @if($book->discount_price)
                                    <span class="block text-[11px] text-emerald-400">ছাড়: ৳ {{ number_format($book->discount_price, 2) }}</span>
                                @endif
                            </td>
                            <td class="px-5 py-4">
                                @if($book->stock_status === 'in_stock')
                                    <span class="bg-emerald-500/20 text-emerald-300 text-[10px] px-2 py-0.5 rounded-full font-bold border border-emerald-500/30">ইন স্টক</span>
                                @else
                                    <span class="bg-rose-500/20 text-rose-300 text-[10px] px-2 py-0.5 rounded-full font-bold border border-rose-500/30">স্টক আউট</span>
                                @endif
                            </td>
                            <td class="px-5 py-4 text-right space-x-2">
                                <a href="{{ route('admin.books.edit', $book->id) }}" class="bg-indigo-600/80 hover:bg-indigo-600 text-white px-3 py-1.5 rounded-lg text-xs font-semibold inline-flex items-center gap-1">
                                    <i data-lucide="edit-3" class="w-3.5 h-3.5"></i> এডিট
                                </a>
                                <form action="{{ route('admin.books.destroy', $book->id) }}" method="POST" class="inline" onsubmit="return confirm('আপনি কি নিশ্চিত যে এই বইটি মুছে ফেলতে চান?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-rose-900/60 hover:bg-rose-800 text-rose-200 px-3 py-1.5 rounded-lg text-xs font-semibold border border-rose-700/50">
                                        মুছুন
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-slate-500">কোনো বই পাওয়া যায়নি।</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($books->hasPages())
            <div class="p-4 border-t border-slate-800">
                {{ $books->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
