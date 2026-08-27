@extends('layouts.app')

@section('title', 'সকল বোর্ড বই (Class 1 to 12) | পাঠশালা লাইব্রেরি')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-8">
    <!-- Header Title -->
    <div class="mb-8">
        <h1 class="text-3xl font-extrabold text-white">এনসিটিবি বোর্ড বই ক্যাটালগ</h1>
        <p class="text-slate-400 text-sm mt-1">বাংলাদেশের ১ম থেকে ১২ শ শ্রেণীর সকল বিষয় ও লেখকের বই অনলাইন ফিল্টারিং</p>
    </div>

    <!-- Layout: Sidebar Filter + Main Books Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-4 gap-8">
        <!-- Sidebar Filters -->
        <div class="lg:col-span-1 space-y-6">
            <div class="glass-panel p-5 rounded-2xl border border-slate-800 space-y-6">
                <form action="{{ route('books.index') }}" method="GET" id="filter-form">
                    <!-- Search Input -->
                    <div class="mb-5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-emerald-400 mb-2">অনুসন্ধান (Search)</label>
                        <div class="relative">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="বইয়ের নাম..." 
                                class="w-full bg-slate-900 border border-slate-700 text-slate-200 text-xs rounded-xl pl-9 pr-3 py-2.5 focus:outline-none focus:border-emerald-500 font-medium">
                            <i data-lucide="search" class="absolute left-3 top-3 w-4 h-4 text-slate-400"></i>
                        </div>
                    </div>

                    <!-- Filter by Class -->
                    <div class="mb-5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-emerald-400 mb-2">শ্রেণী নির্বাচন (Class)</label>
                        <select name="class" onchange="document.getElementById('filter-form').submit()" class="w-full bg-slate-900 border border-slate-700 text-slate-200 text-xs rounded-xl px-3 py-2.5 focus:outline-none focus:border-emerald-500 font-medium">
                            <option value="">সকল শ্রেণী (All Classes)</option>
                            @foreach($gradeLevels as $grade)
                                <option value="{{ $grade->code }}" {{ request('class') == $grade->code ? 'selected' : '' }}>
                                    {{ $grade->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter by Subject -->
                    <div class="mb-5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-emerald-400 mb-2">বিষয় (Subject)</label>
                        <select name="subject" onchange="document.getElementById('filter-form').submit()" class="w-full bg-slate-900 border border-slate-700 text-slate-200 text-xs rounded-xl px-3 py-2.5 focus:outline-none focus:border-emerald-500 font-medium">
                            <option value="">সকল বিষয় (All Subjects)</option>
                            @foreach($subjects as $sub)
                                <option value="{{ $sub->code }}" {{ request('subject') == $sub->code ? 'selected' : '' }}>
                                    {{ $sub->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Filter by Author -->
                    <div class="mb-5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-emerald-400 mb-2">লেখক / পাবলিকেশন</label>
                        <select name="author" onchange="document.getElementById('filter-form').submit()" class="w-full bg-slate-900 border border-slate-700 text-slate-200 text-xs rounded-xl px-3 py-2.5 focus:outline-none focus:border-emerald-500 font-medium">
                            <option value="">সকল লেখক (All Authors)</option>
                            @foreach($authors as $aut)
                                <option value="{{ $aut->slug }}" {{ request('author') == $aut->slug ? 'selected' : '' }}>
                                    {{ $aut->name }}
                                </option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Sort By -->
                    <div class="mb-5">
                        <label class="block text-xs font-bold uppercase tracking-wider text-emerald-400 mb-2">সাজান (Sort By)</label>
                        <select name="sort" onchange="document.getElementById('filter-form').submit()" class="w-full bg-slate-900 border border-slate-700 text-slate-200 text-xs rounded-xl px-3 py-2.5 focus:outline-none focus:border-emerald-500 font-medium">
                            <option value="latest" {{ request('sort') == 'latest' ? 'selected' : '' }}>সর্বশেষ যুক্ত</option>
                            <option value="price_low" {{ request('sort') == 'price_low' ? 'selected' : '' }}>মূল্য: কম থেকে বেশি</option>
                            <option value="price_high" {{ request('sort') == 'price_high' ? 'selected' : '' }}>মূল্য: বেশি থেকে কম</option>
                            <option value="rating" {{ request('sort') == 'rating' ? 'selected' : '' }}>সর্বোচ্চ রেটিং</option>
                        </select>
                    </div>

                    <a href="{{ route('books.index') }}" class="w-full bg-slate-800 hover:bg-slate-700 text-slate-300 font-semibold text-xs py-2.5 rounded-xl flex items-center justify-center gap-1.5 transition-colors">
                        <i data-lucide="rotate-ccw" class="w-3.5 h-3.5"></i>
                        <span>ফিল্টার রিসেট করুন</span>
                    </a>
                </form>
            </div>
        </div>

        <!-- Books Grid Column -->
        <div class="lg:col-span-3">
            @if($books->isEmpty())
                <div class="glass-panel p-12 text-center rounded-2xl border border-slate-800">
                    <i data-lucide="search-x" class="w-12 h-12 text-slate-500 mx-auto mb-3"></i>
                    <h3 class="text-lg font-bold text-white mb-1">কোনো বই পাওয়া যায়নি</h3>
                    <p class="text-xs text-slate-400 mb-4">অনুগ্রহ করে অন্য শব্দ বা ফিল্টার ব্যবহার করে চেষ্টা করুন।</p>
                    <a href="{{ route('books.index') }}" class="bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold px-4 py-2 rounded-xl inline-block">
                        সকল বই দেখুন
                    </a>
                </div>
            @else
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
                    @foreach($books as $book)
                        <x-book-card :book="$book" />
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $books->links() }}
                </div>
            @endif
        </div>
    </div>
</div>
@endsection
