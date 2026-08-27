@extends('layouts.admin')

@section('title', 'নতুন বই সংযুক্ত করুন - পাঠশালা এডমিন')
@section('page_header', 'নতুন বই যুক্ত করুন (Add New Book)')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="glass-card p-6 rounded-2xl border border-slate-800 space-y-6">
        <div class="flex items-center justify-between border-b border-slate-800 pb-4">
            <h2 class="text-base font-bold text-white flex items-center gap-2">
                <i data-lucide="plus-circle" class="w-5 h-5 text-emerald-400"></i> বইয়ের বিস্তারিত তথ্য
            </h2>
            <a href="{{ route('admin.books.index') }}" class="text-xs text-slate-400 hover:text-white flex items-center gap-1">
                &larr; বইয়ের তালিকায় ফিরে যান
            </a>
        </div>

        <form action="{{ route('admin.books.store') }}" method="POST" class="space-y-5">
            @csrf

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">বইয়ের মূল শিরোনাম *</label>
                    <input type="text" name="title" value="{{ old('title') }}" required placeholder="যেমন: মাধ্যমিক বাংলা সাহিত্য (Class 9)" 
                        class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500">
                    @error('title') <span class="text-rose-400 text-[11px]">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">প্রকাশনী/বোর্ড *</label>
                    <input type="text" name="publisher" value="{{ old('publisher', 'জাতীয় শিক্ষাক্রম ও পাঠ্যপুস্তক বোর্ড (NCTB)') }}" required
                        class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500">
                    @error('publisher') <span class="text-rose-400 text-[11px]">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">শ্রেণী (Grade Level) *</label>
                    <select name="grade_level_id" required class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500">
                        <option value="">শ্রেণী নির্বাচন করুন</option>
                        @foreach($gradeLevels as $grade)
                            <option value="{{ $grade->id }}" {{ old('grade_level_id') == $grade->id ? 'selected' : '' }}>{{ $grade->name_bn }} ({{ $grade->name }})</option>
                        @endforeach
                    </select>
                    @error('grade_level_id') <span class="text-rose-400 text-[11px]">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">বিষয় (Subject) *</label>
                    <select name="subject_id" required class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500">
                        <option value="">বিষয় নির্বাচন করুন</option>
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id') == $subject->id ? 'selected' : '' }}>{{ $subject->name_bn }}</option>
                        @endforeach
                    </select>
                    @error('subject_id') <span class="text-rose-400 text-[11px]">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">লেখক (Author) *</label>
                    <select name="author_id" required class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500">
                        <option value="">লেখক নির্বাচন করুন</option>
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ old('author_id') == $author->id ? 'selected' : '' }}>{{ $author->name_bn }}</option>
                        @endforeach
                    </select>
                    @error('author_id') <span class="text-rose-400 text-[11px]">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">রেগুলার মূল্য (৳) *</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', 150) }}" required placeholder="150"
                        class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500">
                    @error('price') <span class="text-rose-400 text-[11px]">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">ছাড়কৃত বিশেষ মূল্য (৳)</label>
                    <input type="number" step="0.01" name="discount_price" value="{{ old('discount_price') }}" placeholder="120"
                        class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500">
                    @error('discount_price') <span class="text-rose-400 text-[11px]">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">মোট পৃষ্ঠা (Page Count) *</label>
                    <input type="number" name="page_count" value="{{ old('page_count', 240) }}" required placeholder="240"
                        class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500">
                    @error('page_count') <span class="text-rose-400 text-[11px]">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">স্টক স্ট্যাটাস *</label>
                    <select name="stock_status" required class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500">
                        <option value="in_stock" {{ old('stock_status') == 'in_stock' ? 'selected' : '' }}>ইন স্টক (In Stock)</option>
                        <option value="out_of_stock" {{ old('stock_status') == 'out_of_stock' ? 'selected' : '' }}>স্টক আউট (Out of Stock)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">কভার কালার থিম *</label>
                    <select name="cover_color" required class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500">
                        <option value="from-emerald-600 to-teal-800">Emerald Green</option>
                        <option value="from-indigo-600 to-blue-800">Indigo Blue</option>
                        <option value="from-purple-600 to-pink-800">Purple Velvet</option>
                        <option value="from-amber-600 to-orange-800">Amber Bronze</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1.5">বইয়ের বিবরণ ও সূচিপত্র সারাংশ *</label>
                <textarea name="description" rows="4" required placeholder="বইয়ের বিস্তারিত সারাংশ এবং শিক্ষাক্রমের লক্ষ্য..."
                    class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl p-4 focus:outline-none focus:border-emerald-500">{{ old('description') }}</textarea>
                @error('description') <span class="text-rose-400 text-[11px]">{{ $message }}</span> @enderror
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured') ? 'checked' : '' }} class="rounded bg-slate-950 border-slate-800 text-emerald-500 focus:ring-0">
                <label for="is_featured" class="text-xs text-slate-300 font-semibold cursor-pointer">ফিচার্ড বই হিসেবে হোমপেজে দেখান (Show on Homepage)</label>
            </div>

            <div class="pt-4 border-t border-slate-800 flex justify-end gap-3">
                <a href="{{ route('admin.books.index') }}" class="bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs px-5 py-2.5 rounded-xl font-bold">
                    বাতিল করুন
                </a>
                <button type="submit" class="bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold px-6 py-2.5 rounded-xl transition-all shadow-lg shadow-emerald-600/30">
                    বইটি সংক্ষণ করুন
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
