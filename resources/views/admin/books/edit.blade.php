@extends('layouts.admin')

@section('title', 'বই সম্পাদনা করুন - পাঠশালা এডমিন')
@section('page_header', 'বই সম্পাদনা (Edit Book)')

@section('content')
<div class="max-w-4xl mx-auto">
    <div class="glass-card p-6 rounded-2xl border border-slate-800 space-y-6">
        <div class="flex items-center justify-between border-b border-slate-800 pb-4">
            <h2 class="text-base font-bold text-white flex items-center gap-2">
                <i data-lucide="edit-3" class="w-5 h-5 text-indigo-400"></i> বইয়ের তথ্য আপডেট
            </h2>
            <a href="{{ route('admin.books.index') }}" class="text-xs text-slate-400 hover:text-white flex items-center gap-1">
                &larr; বইয়ের তালিকায় ফিরে যান
            </a>
        </div>

        <form action="{{ route('admin.books.update', $book->id) }}" method="POST" class="space-y-5">
            @csrf
            @method('PUT')

            <div class="grid grid-cols-1 md:grid-cols-2 gap-5">
                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">বইয়ের শিরোনাম *</label>
                    <input type="text" name="title" value="{{ old('title', $book->title) }}" required 
                        class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500">
                    @error('title') <span class="text-rose-400 text-[11px]">{{ $message }}</span> @enderror
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">প্রকাশনী/বোর্ড *</label>
                    <input type="text" name="publisher" value="{{ old('publisher', $book->publisher) }}" required
                        class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">শ্রেণী *</label>
                    <select name="grade_level_id" required class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500">
                        @foreach($gradeLevels as $grade)
                            <option value="{{ $grade->id }}" {{ old('grade_level_id', $book->grade_level_id) == $grade->id ? 'selected' : '' }}>{{ $grade->name_bn }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">বিষয় *</label>
                    <select name="subject_id" required class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500">
                        @foreach($subjects as $subject)
                            <option value="{{ $subject->id }}" {{ old('subject_id', $book->subject_id) == $subject->id ? 'selected' : '' }}>{{ $subject->name_bn }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">লেখক *</label>
                    <select name="author_id" required class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500">
                        @foreach($authors as $author)
                            <option value="{{ $author->id }}" {{ old('author_id', $book->author_id) == $author->id ? 'selected' : '' }}>{{ $author->name_bn }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">রেগুলার মূল্য (৳) *</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', $book->price) }}" required
                        class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">ছাড়কৃত বিশেষ মূল্য (৳)</label>
                    <input type="number" step="0.01" name="discount_price" value="{{ old('discount_price', $book->discount_price) }}"
                        class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">মোট পৃষ্ঠা *</label>
                    <input type="number" name="page_count" value="{{ old('page_count', $book->page_count) }}" required
                        class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">স্টক স্ট্যাটাস *</label>
                    <select name="stock_status" required class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500">
                        <option value="in_stock" {{ old('stock_status', $book->stock_status) == 'in_stock' ? 'selected' : '' }}>ইন স্টক (In Stock)</option>
                        <option value="out_of_stock" {{ old('stock_status', $book->stock_status) == 'out_of_stock' ? 'selected' : '' }}>স্টক আউট (Out of Stock)</option>
                    </select>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1.5">কভার কালার থিম *</label>
                    <select name="cover_color" required class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl px-4 py-2.5 focus:outline-none focus:border-emerald-500">
                        <option value="from-emerald-600 to-teal-800" {{ $book->cover_color == 'from-emerald-600 to-teal-800' ? 'selected' : '' }}>Emerald Green</option>
                        <option value="from-indigo-600 to-blue-800" {{ $book->cover_color == 'from-indigo-600 to-blue-800' ? 'selected' : '' }}>Indigo Blue</option>
                        <option value="from-purple-600 to-pink-800" {{ $book->cover_color == 'from-purple-600 to-pink-800' ? 'selected' : '' }}>Purple Velvet</option>
                        <option value="from-amber-600 to-orange-800" {{ $book->cover_color == 'from-amber-600 to-orange-800' ? 'selected' : '' }}>Amber Bronze</option>
                    </select>
                </div>
            </div>

            <div>
                <label class="block text-xs font-semibold text-slate-300 mb-1.5">বইয়ের বিবরণ *</label>
                <textarea name="description" rows="4" required
                    class="w-full bg-slate-950 border border-slate-800 text-slate-200 text-xs rounded-xl p-4 focus:outline-none focus:border-emerald-500">{{ old('description', $book->description) }}</textarea>
            </div>

            <div class="flex items-center gap-2">
                <input type="checkbox" name="is_featured" id="is_featured" value="1" {{ old('is_featured', $book->is_featured) ? 'checked' : '' }} class="rounded bg-slate-950 border-slate-800 text-emerald-500">
                <label for="is_featured" class="text-xs text-slate-300 font-semibold cursor-pointer">ফিচার্ড বই হিসেবে প্রদর্শন করুন</label>
            </div>

            <div class="pt-4 border-t border-slate-800 flex justify-end gap-3">
                <a href="{{ route('admin.books.index') }}" class="bg-slate-800 hover:bg-slate-700 text-slate-300 text-xs px-5 py-2.5 rounded-xl font-bold">
                    বাতিল করুন
                </a>
                <button type="submit" class="bg-indigo-600 hover:bg-indigo-500 text-white text-xs font-bold px-6 py-2.5 rounded-xl transition-all shadow-lg">
                    তথ্য আপডেট করুন
                </button>
            </div>
        </form>
    </div>
</div>
@endsection
