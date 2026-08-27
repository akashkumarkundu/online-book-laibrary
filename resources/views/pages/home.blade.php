@extends('layouts.app')

@section('title', 'জাতীয় ডিজিটাল ই-পাঠাগার BD | Class 1 to 12')

@section('content')
<!-- Hero Section -->
<div class="relative overflow-hidden bg-slate-950 pt-8 pb-16 border-b border-slate-800/60">
    <div class="absolute top-1/4 left-1/2 -translate-x-1/2 -translate-y-1/2 w-[600px] h-[300px] bg-emerald-600/15 rounded-full blur-[120px] pointer-events-none"></div>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 relative z-10 text-center">
        <div class="inline-flex items-center gap-2 px-3.5 py-1.5 rounded-full bg-emerald-500/10 border border-emerald-500/30 text-emerald-400 text-xs font-semibold mb-6">
            <i data-lucide="shield-check" class="w-4 h-4"></i>
            <span>NCTB জাতীয় শিক্ষাক্রম ও পাঠ্যপুস্তক বোর্ড অনুমোদিত অনলাইন ই-পাঠাগার</span>
        </div>

        <h1 class="text-3xl sm:text-5xl lg:text-6xl font-extrabold tracking-tight text-white mb-6 leading-tight max-w-5xl mx-auto">
            বাংলাদেশের ১ম থেকে ১২ শ শ্রেণীর <br>
            <span class="gradient-text">ডিজিটাল ফ্রি অনলাইন ই-পাঠাগার ও বুকশপ</span>
        </h1>

        <p class="text-slate-300 text-base sm:text-lg max-w-3xl mx-auto mb-8 font-normal leading-relaxed">
            Class 1 থেকে Class 12 পর্যন্ত বাংলা, ইংরেজি, গণিত, বিজ্ঞান, ধর্ম, BGS, ICT, পদার্থ, রসায়ন, জীববিজ্ঞান, উচ্চতর গণিত ও হিসাববিজ্ঞান সহ সকল বোর্ড বই অনলাইনে পড়ুন ও হার্ডকপি অর্ডার করুন।
        </p>

        <!-- Search Bar -->
        <div class="max-w-2xl mx-auto relative mb-10">
            <form action="{{ route('books.index') }}" method="GET" class="relative flex items-center">
                <i data-lucide="search" class="absolute left-4 w-5 h-5 text-emerald-400"></i>
                <input type="text" name="search" placeholder="বইয়ের নাম, বিষয় বা শ্রেণীর নাম লিখে খুঁজুন (যেমন: Class 6, Physics, ICT)..." 
                    class="w-full pl-12 pr-28 py-4 bg-slate-900/90 border-2 border-slate-700 focus:border-emerald-500 rounded-2xl text-slate-100 placeholder-slate-400 focus:outline-none focus:ring-4 focus:ring-emerald-500/20 shadow-2xl text-sm sm:text-base font-medium transition-all">
                <button type="submit" class="absolute right-2.5 bg-emerald-600 hover:bg-emerald-500 text-white px-5 py-2.5 rounded-xl text-xs sm:text-sm font-semibold transition-all flex items-center gap-1.5">
                    <span>খুঁজুন</span>
                    <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </button>
            </form>
        </div>

        <!-- Quick Stats -->
        <div class="grid grid-cols-2 md:grid-cols-4 gap-4 max-w-4xl mx-auto">
            <div class="glass-panel p-4 rounded-xl text-center border border-slate-800">
                <div class="text-2xl sm:text-3xl font-extrabold text-emerald-400 mb-0.5">১২ টি শ্রেণী</div>
                <div class="text-xs text-slate-400 font-medium">Class 1 to Class 12</div>
            </div>
            <div class="glass-panel p-4 rounded-xl text-center border border-slate-800">
                <div class="text-2xl sm:text-3xl font-extrabold text-teal-400 mb-0.5">{{ $totalBooksCount }} টি বই</div>
                <div class="text-xs text-slate-400 font-medium">NCTB ও বিখ্যাত লেখকগণ</div>
            </div>
            <div class="glass-panel p-4 rounded-xl text-center border border-slate-800">
                <div class="text-2xl sm:text-3xl font-extrabold text-indigo-400 mb-0.5">১০০% ফ্রি অনলাইন</div>
                <div class="text-xs text-slate-400 font-medium">ই-বুক ফ্লিপবুক রিডার</div>
            </div>
            <div class="glass-panel p-4 rounded-xl text-center border border-slate-800">
                <div class="text-2xl sm:text-3xl font-extrabold text-amber-400 mb-0.5">{{ number_format($totalReadersCount) }}</div>
                <div class="text-xs text-slate-400 font-medium">সক্রিয় অনলাইন শিক্ষার্থী</div>
            </div>
        </div>
    </div>
</div>

<!-- Main Catalog Container -->
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <!-- Class Level Selector Pills -->
    <div class="mb-10">
        <div class="flex items-center justify-between mb-4">
            <h2 class="text-xl font-bold text-white flex items-center gap-2">
                <i data-lucide="layers" class="w-5 h-5 text-emerald-400"></i>
                <span>শ্রেণী নির্বাচন করুন (Select Class):</span>
            </h2>
            <a href="{{ route('books.index') }}" class="text-xs text-emerald-400 font-semibold hover:underline flex items-center gap-1">
                <span>সকল বই দেখুন</span>
                <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
            </a>
        </div>

        <div class="grid grid-cols-2 sm:grid-cols-4 md:grid-cols-6 gap-3">
            @foreach($gradeLevels as $grade)
                <a href="{{ route('books.index', ['class' => $grade->code]) }}" class="bg-slate-900 hover:bg-slate-850 border border-slate-800 hover:border-emerald-500/50 p-3.5 rounded-xl text-center transition-all group">
                    <div class="text-xs font-bold text-emerald-400 uppercase tracking-wider mb-1">{{ $grade->name }}</div>
                    <div class="text-[11px] text-slate-400 group-hover:text-slate-200">{{ $grade->books_count ?? 5 }} টি পাঠ্যবই</div>
                </a>
            @endforeach
        </div>
    </div>

    <!-- Featured Books Section -->
    <div class="mb-12">
        <div class="flex items-center justify-between mb-6">
            <div>
                <h3 class="text-2xl font-extrabold text-white">জনপ্রিয় বোর্ড বইসমূহ</h3>
                <p class="text-xs text-slate-400 mt-1">NCTB অনুমোদিত এবং শীর্ষ জনপ্রিয় সকল বোর্ড বই</p>
            </div>
            <a href="{{ route('books.index') }}" class="bg-slate-900 hover:bg-slate-800 text-slate-200 border border-slate-800 text-xs px-4 py-2 rounded-xl font-bold transition-colors flex items-center gap-1.5">
                <span>সব দেখুন</span>
                <i data-lucide="chevron-right" class="w-4 h-4"></i>
            </a>
        </div>

        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($featuredBooks as $book)
                <x-book-card :book="$book" />
            @endforeach
        </div>
    </div>
</div>
@endsection
