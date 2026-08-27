@extends('layouts.app')

@section('title', 'আমার উইশলিস্ট | পাঠশালা লাইব্রেরি')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-3xl font-extrabold text-white mb-6">আমার উইশলিস্ট ❤️</h1>

    @if($wishlistItems->isEmpty())
        <div class="glass-panel p-12 text-center rounded-3xl border border-slate-800">
            <i data-lucide="heart-off" class="w-16 h-16 text-slate-500 mx-auto mb-4"></i>
            <h3 class="text-xl font-bold text-white mb-2">আপনার উইশলিস্ট ফাঁকা</h3>
            <p class="text-xs text-slate-400 mb-6">পছন্দের বইগুলো পরবর্তীতে দ্রুত খুঁজে পেতে উইশলিস্টে সেভ করে রাখুন।</p>
            <a href="{{ route('books.index') }}" class="bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs px-6 py-3 rounded-xl inline-block shadow-lg">
                বোর্ড বই ক্যাটালগ দেখুন
            </a>
        </div>
    @else
        <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-4 gap-6">
            @foreach($wishlistItems as $item)
                <x-book-card :book="$item->book" />
            @endforeach
        </div>
    @endif
</div>
@endsection
