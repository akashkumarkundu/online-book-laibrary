@props(['book'])

<div class="glass-card rounded-2xl p-5 border border-slate-800 flex flex-col justify-between group hover:border-emerald-500/50 transition-all">
    <div>
        <!-- Cover Card -->
        <div class="h-48 rounded-xl bg-gradient-to-br {{ $book->cover_color }} p-4 text-white flex flex-col justify-between shadow-lg relative overflow-hidden mb-4 group-hover:scale-[1.02] transition-transform">
            <div class="flex items-center justify-between z-10">
                <span class="bg-black/40 backdrop-blur-sm text-emerald-300 text-[10px] font-extrabold px-2 py-0.5 rounded border border-emerald-400/30">
                    NCTB BD
                </span>
                <span class="bg-white/20 backdrop-blur-sm text-white text-[11px] font-bold px-2 py-0.5 rounded">
                    {{ $book->gradeLevel->name ?? 'Class 1-12' }}
                </span>
            </div>

            <div class="z-10">
                <h4 class="font-extrabold text-base leading-tight drop-shadow-md line-clamp-2">{{ $book->title }}</h4>
                <p class="text-[11px] text-amber-300 font-semibold mt-1">{{ $book->author->name ?? 'NCTB Board' }}</p>
            </div>

            <i data-lucide="book" class="absolute -right-4 -bottom-4 w-28 h-28 text-white/10 pointer-events-none"></i>
        </div>

        <!-- Details -->
        <div class="space-y-2 mb-4">
            <div class="flex items-center justify-between text-xs text-slate-400">
                <span class="flex items-center gap-1 text-amber-400 font-bold">
                    <i data-lucide="star" class="w-3.5 h-3.5 fill-amber-400 text-amber-400"></i> {{ $book->rating }}
                </span>
                <span class="text-slate-400 font-medium text-xs">{{ number_format($book->reader_count) }} পাঠক</span>
            </div>

            <a href="{{ route('books.show', $book->id) }}" class="font-bold text-slate-100 text-sm leading-snug line-clamp-2 hover:text-emerald-400 transition-colors">
                {{ $book->title }}
            </a>

            <!-- Price in BDT -->
            <div class="flex items-center gap-2 pt-1">
                <span class="text-lg font-extrabold text-emerald-400">৳{{ number_format($book->effective_price, 0) }}</span>
                @if($book->discount_price)
                    <span class="text-xs text-slate-400 line-through">৳{{ number_format($book->price, 0) }}</span>
                    <span class="text-[10px] bg-rose-500/20 text-rose-300 font-bold px-1.5 py-0.5 rounded">ছাড়!</span>
                @endif
            </div>
        </div>
    </div>

    <!-- Action Buttons -->
    <div class="space-y-2 pt-3 border-t border-slate-800/80">
        <a href="{{ route('books.read', $book->id) }}" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-xs py-2.5 rounded-xl flex items-center justify-center gap-1.5 transition-all shadow-md shadow-emerald-600/20">
            <i data-lucide="book-open" class="w-4 h-4"></i>
            <span>অনলাইনে পড়ুন</span>
        </a>

        <div class="grid grid-cols-2 gap-2">
            <!-- Add to Cart Form -->
            <form action="{{ route('cart.store') }}" method="POST">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-slate-200 border border-slate-700 font-semibold text-[11px] py-2 rounded-lg flex items-center justify-center gap-1">
                    <i data-lucide="shopping-cart" class="w-3.5 h-3.5 text-emerald-400"></i>
                    <span>কার্টে যোগ করুন</span>
                </button>
            </form>

            <!-- Wishlist Form -->
            <form action="{{ route('wishlist.toggle') }}" method="POST">
                @csrf
                <input type="hidden" name="book_id" value="{{ $book->id }}">
                <button type="submit" class="w-full bg-slate-900 hover:bg-slate-800 text-rose-300 border border-slate-700 font-semibold text-[11px] py-2 rounded-lg flex items-center justify-center gap-1">
                    <i data-lucide="heart" class="w-3.5 h-3.5 text-rose-400"></i>
                    <span>উইশলিস্ট</span>
                </button>
            </form>
        </div>
    </div>
</div>
