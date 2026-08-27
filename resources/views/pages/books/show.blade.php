@extends('layouts.app')

@section('title', $book->title . ' | পাঠশালা লাইব্রেরি')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <!-- Breadcrumb -->
    <nav class="flex items-center gap-2 text-xs text-slate-400 mb-6">
        <a href="{{ route('home') }}" class="hover:text-emerald-400">হোম</a>
        <span>/</span>
        <a href="{{ route('books.index') }}" class="hover:text-emerald-400">পাঠ্যবই</a>
        <span>/</span>
        <span class="text-slate-200 font-semibold">{{ $book->title }}</span>
    </nav>

    <!-- Main Book Header Card -->
    <div class="glass-panel p-6 sm:p-8 rounded-3xl border border-slate-800 grid grid-cols-1 md:grid-cols-3 gap-8 mb-12">
        <!-- Book Cover Preview -->
        <div class="h-80 rounded-2xl bg-gradient-to-br {{ $book->cover_color }} p-6 text-white flex flex-col justify-between shadow-2xl relative overflow-hidden">
            <div class="flex items-center justify-between z-10">
                <span class="bg-black/40 backdrop-blur-sm text-emerald-300 text-xs font-extrabold px-3 py-1 rounded border border-emerald-400/30">
                    NCTB BD
                </span>
                <span class="bg-white/20 backdrop-blur-sm text-white text-xs font-bold px-3 py-1 rounded">
                    {{ $book->gradeLevel->name ?? 'Class 1-12' }}
                </span>
            </div>

            <div class="z-10">
                <h2 class="font-extrabold text-2xl leading-tight drop-shadow-md mb-1">{{ $book->title }}</h2>
                <p class="text-xs text-amber-300 font-semibold">{{ $book->author->name ?? 'NCTB Board' }}</p>
            </div>

            <i data-lucide="book" class="absolute -right-6 -bottom-6 w-44 h-44 text-white/10 pointer-events-none"></i>
        </div>

        <!-- Information Column -->
        <div class="md:col-span-2 space-y-5">
            <div>
                <div class="flex items-center gap-2 mb-2">
                    <span class="bg-emerald-500/20 text-emerald-400 text-xs font-bold px-2.5 py-0.5 rounded border border-emerald-500/30">
                        {{ $book->subject->name ?? 'পাঠ্যবই' }}
                    </span>
                    <span class="text-xs text-slate-400 font-medium">প্রকাশক: <strong class="text-slate-200">{{ $book->publisher }}</strong></span>
                </div>
                <h1 class="text-3xl font-extrabold text-white mb-2">{{ $book->title }}</h1>
                <p class="text-xs text-amber-400 font-semibold">লেখক/সংকলক: {{ $book->author->name }}</p>
            </div>

            <!-- Price Box -->
            <div class="flex items-center gap-3 bg-slate-900/80 p-4 rounded-2xl border border-slate-800 w-fit">
                <span class="text-3xl font-extrabold text-emerald-400">৳{{ number_format($book->effective_price, 0) }}</span>
                @if($book->discount_price)
                    <span class="text-sm text-slate-400 line-through">৳{{ number_format($book->price, 0) }}</span>
                    <span class="text-xs bg-rose-500/20 text-rose-300 font-bold px-2 py-0.5 rounded border border-rose-500/30">বিশেষ মূল্যছাড়!</span>
                @endif
            </div>

            <!-- Metadata Grid -->
            <div class="grid grid-cols-2 sm:grid-cols-3 gap-3 text-xs bg-slate-900/50 p-4 rounded-xl border border-slate-800">
                <div>
                    <span class="text-slate-500 block">ISBN নম্বর:</span>
                    <span class="font-bold text-slate-200">{{ $book->isbn ?? 'NCTB-REG-2026' }}</span>
                </div>
                <div>
                    <span class="text-slate-500 block">স্টক স্ট্যাটাস:</span>
                    <span class="font-bold text-emerald-400">স্টকে আছে (In Stock)</span>
                </div>
                <div>
                    <span class="text-slate-500 block">মোট পৃষ্ঠা:</span>
                    <span class="font-bold text-slate-200">{{ $book->page_count }} পৃষ্ঠা</span>
                </div>
            </div>

            <p class="text-slate-300 text-sm leading-relaxed">{{ $book->description }}</p>

            <!-- CTA Actions -->
            <div class="flex flex-wrap items-center gap-3 pt-2">
                <a href="{{ route('books.read', $book->id) }}" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm px-6 py-3 rounded-xl flex items-center gap-2 transition-all shadow-lg shadow-emerald-600/30">
                    <i data-lucide="book-open" class="w-5 h-5"></i>
                    <span>অনলাইনে এখনই পড়ুন (Read Online)</span>
                </a>

                <form action="{{ route('cart.store') }}" method="POST" class="flex items-center gap-2">
                    @csrf
                    <input type="hidden" name="book_id" value="{{ $book->id }}">
                    <input type="number" name="quantity" value="1" min="1" class="w-16 bg-slate-900 border border-slate-700 text-white text-xs text-center py-3 rounded-xl font-bold">
                    <button type="submit" class="bg-slate-900 hover:bg-slate-800 text-white border border-slate-700 font-bold text-sm px-6 py-3 rounded-xl flex items-center gap-2 transition-colors">
                        <i data-lucide="shopping-cart" class="w-5 h-5 text-emerald-400"></i>
                        <span>কার্টে যোগ করুন</span>
                    </button>
                </form>
            </div>
        </div>
    </div>

    <!-- Chapters Index -->
    @if($book->chapters->isNotEmpty())
        <div class="glass-panel p-6 sm:p-8 rounded-3xl border border-slate-800 mb-12">
            <h3 class="text-xl font-extrabold text-white mb-4 flex items-center gap-2">
                <i data-lucide="list-tree" class="w-5 h-5 text-emerald-400"></i>
                <span>অধ্যায় সূচিপত্র (Table of Contents)</span>
            </h3>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-3">
                @foreach($book->chapters as $chap)
                    <div class="bg-slate-900/80 p-4 rounded-xl border border-slate-800 flex items-center justify-between">
                        <span class="text-xs font-bold text-slate-200">{{ $chap->title }}</span>
                        <a href="{{ route('books.read', $book->id) }}" class="text-xs text-emerald-400 font-semibold hover:underline">পড়ুন</a>
                    </div>
                @endforeach
            </div>
        </div>
    @endif
</div>
@endsection
