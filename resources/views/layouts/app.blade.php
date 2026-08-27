<!DOCTYPE html>
<html lang="bn" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'জাতীয় ডিজিটাল ই-পাঠাগার ও বুকশপ BD | Class 1 to 12')</title>
    <meta name="description" content="বাংলাদেশের ১ম থেকে ১২ শ (দ্বাদশ) শ্রেণীর শিক্ষার্থীদের জন্য এনসিটিবি (NCTB) অনুমোদিত সকল বোর্ড বই অনলাইনে পড়ার ও হার্ডকপি অর্ডার করার ই-পাঠাগার।">

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Hind+Siliguri:wght@300;400;500;600;700&family=Inter:wght@300;400;500;600;700;800&display=swap" rel="stylesheet">
    
    <!-- Lucide Icons -->
    <script src="https://unpkg.com/lucide@latest"></script>

    @vite(['resources/css/app.css', 'resources/js/app.js'])

    <style>
        body {
            font-family: 'Hind Siliguri', 'Inter', sans-serif;
        }
        .active-nav {
            background: linear-gradient(135deg, #10b981 0%, #059669 100%);
            color: #ffffff !important;
            box-shadow: 0 4px 14px 0 rgba(16, 185, 129, 0.39);
        }
        .gradient-text {
            background: linear-gradient(135deg, #34d399 0%, #10b981 50%, #6366f1 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
        .modal-backdrop {
            background: rgba(15, 23, 42, 0.85);
            backdrop-filter: blur(8px);
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex flex-col selection:bg-emerald-500 selection:text-white">

    <!-- Top Announcement Bar -->
    <div class="bg-gradient-to-r from-emerald-700 via-teal-800 to-indigo-900 text-white text-xs md:text-sm py-2 px-4 text-center font-medium flex items-center justify-center gap-2 shadow-md">
        <span class="bg-emerald-500/30 px-2 py-0.5 rounded-full text-[11px] uppercase tracking-wider border border-emerald-400/40">NCTB BD ২০২৬</span>
        <span>🇧🇩 ১ম থেকে ১২ শ শ্রেণীর এনসিটিবি অনুমোদিত সকল বই অনলাইনে পড়ুন ও হার্ডকপি ডেলিভারি নিন!</span>
    </div>

    <!-- Navigation Bar -->
    <header class="sticky top-0 z-40 glass-panel border-b border-slate-800/80 backdrop-blur-md bg-slate-950/90">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 h-20 flex items-center justify-between">
            <!-- Brand Logo -->
            <a href="{{ route('home') }}" class="flex items-center gap-3 group">
                <div class="w-11 h-11 rounded-xl bg-gradient-to-br from-emerald-600 to-teal-700 flex items-center justify-center text-white shadow-lg shadow-emerald-600/30 group-hover:scale-105 transition-transform duration-300">
                    <i data-lucide="book-open-check" class="w-6 h-6"></i>
                </div>
                <div>
                    <div class="flex items-center gap-2">
                        <span class="font-extrabold text-xl tracking-tight text-white">পাঠশালা<span class="text-emerald-400">লাইব্রেরি</span></span>
                        <span class="text-[10px] bg-emerald-500/20 text-emerald-300 font-bold px-1.5 py-0.5 rounded border border-emerald-500/30">NCTB BD</span>
                    </div>
                    <p class="text-[11px] text-slate-400 font-medium">শ্রেণী ১ - ১২ শ ই-পাঠাগার ও বুকশপ</p>
                </div>
            </a>

            <!-- Navigation Links -->
            <nav class="hidden md:flex items-center gap-1 bg-slate-900/90 p-1.5 rounded-xl border border-slate-800">
                <a href="{{ route('home') }}" class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2 {{ request()->routeIs('home') ? 'active-nav' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                    <i data-lucide="home" class="w-4 h-4"></i>
                    <span>হোম</span>
                </a>
                <a href="{{ route('books.index') }}" class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2 {{ request()->routeIs('books.*') ? 'active-nav' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                    <i data-lucide="book-copy" class="w-4 h-4"></i>
                    <span>বোর্ড বই (Class 1-12)</span>
                </a>
                <a href="{{ route('services.index') }}" class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2 {{ request()->routeIs('services.index') ? 'active-nav' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                    <i data-lucide="sparkles" class="w-4 h-4"></i>
                    <span>সেবাসমূহ</span>
                </a>
                <a href="{{ route('contact.index') }}" class="px-4 py-2 rounded-lg text-xs font-bold transition-all flex items-center gap-2 {{ request()->routeIs('contact.index') ? 'active-nav' : 'text-slate-300 hover:text-white hover:bg-slate-800' }}">
                    <i data-lucide="headphones" class="w-4 h-4"></i>
                    <span>যোগাযোগ</span>
                </a>
            </nav>

            <!-- Actions Bar -->
            <div class="flex items-center gap-2 sm:gap-3">
                <!-- Search Button -->
                <form action="{{ route('books.index') }}" method="GET" class="hidden lg:flex items-center relative">
                    <i data-lucide="search" class="absolute left-3 w-4 h-4 text-emerald-400"></i>
                    <input type="text" name="search" value="{{ request('search') }}" placeholder="বইয়ের নাম দিয়ে খুঁজুন..." 
                        class="bg-slate-900 border border-slate-800 text-slate-200 text-xs rounded-xl pl-9 pr-4 py-2 focus:outline-none focus:border-emerald-500 w-48">
                </form>

                <!-- Wishlist Badge -->
                @php
                    $wishlistCount = \App\Models\Wishlist::when(auth()->check(), fn($q) => $q->where('user_id', auth()->id()), fn($q) => $q->where('session_id', session()->getId()))->count();
                    $cartCount = \App\Models\CartItem::when(auth()->check(), fn($q) => $q->where('user_id', auth()->id()), fn($q) => $q->where('session_id', session()->getId()))->sum('quantity');
                @endphp
                <a href="{{ route('wishlist.index') }}" class="bg-slate-900 hover:bg-slate-800 p-2.5 rounded-xl border border-slate-800 text-slate-300 hover:text-white relative transition-colors">
                    <i data-lucide="heart" class="w-5 h-5 text-rose-400"></i>
                    @if($wishlistCount > 0)
                        <span class="absolute -top-1.5 -right-1.5 bg-rose-600 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center shadow-md">
                            {{ $wishlistCount }}
                        </span>
                    @endif
                </a>

                <!-- Cart Badge -->
                <a href="{{ route('cart.index') }}" class="bg-slate-900 hover:bg-slate-800 p-2.5 rounded-xl border border-slate-800 text-slate-300 hover:text-white relative transition-colors">
                    <i data-lucide="shopping-cart" class="w-5 h-5 text-emerald-400"></i>
                    @if($cartCount > 0)
                        <span class="absolute -top-1.5 -right-1.5 bg-emerald-600 text-white text-[10px] font-bold w-4 h-4 rounded-full flex items-center justify-center shadow-md">
                            {{ $cartCount }}
                        </span>
                    @endif
                </a>

                <!-- Orders Button -->
                <a href="{{ route('orders.index') }}" class="hidden sm:flex items-center gap-1.5 bg-slate-900 hover:bg-slate-800 text-slate-200 border border-slate-800 text-xs px-3 py-2 rounded-xl font-bold transition-colors">
                    <i data-lucide="package" class="w-4 h-4 text-indigo-400"></i>
                    <span>অর্ডারসমূহ</span>
                </a>

                <!-- Admin Panel Button -->
                <a href="{{ route('admin.dashboard') }}" class="hidden sm:flex items-center gap-1.5 bg-emerald-950/80 hover:bg-emerald-900/90 text-emerald-300 border border-emerald-700/50 text-xs px-3 py-2 rounded-xl font-bold transition-colors shadow-sm">
                    <i data-lucide="shield-check" class="w-4 h-4 text-emerald-400"></i>
                    <span>এডমিন</span>
                </a>

                <!-- Mobile Menu Button -->
                <button onclick="toggleMobileMenu()" class="md:hidden bg-slate-900 p-2.5 rounded-xl text-slate-300 hover:text-white border border-slate-800">
                    <i data-lucide="menu" class="w-5 h-5"></i>
                </button>
            </div>
        </div>

        <!-- Mobile Menu Drawer -->
        <div id="mobile-menu" class="hidden md:hidden bg-slate-900/95 border-b border-slate-800 px-4 py-3 space-y-2">
            <a href="{{ route('home') }}" class="w-full text-left px-4 py-2.5 rounded-lg text-sm font-medium text-white flex items-center gap-2 hover:bg-slate-800">
                <i data-lucide="home" class="w-4 h-4 text-emerald-400"></i> হোম
            </a>
            <a href="{{ route('books.index') }}" class="w-full text-left px-4 py-2.5 rounded-lg text-sm font-medium text-slate-300 flex items-center gap-2 hover:bg-slate-800">
                <i data-lucide="book-copy" class="w-4 h-4 text-emerald-400"></i> সকল বোর্ড বই (Class 1-12)
            </a>
            <a href="{{ route('cart.index') }}" class="w-full text-left px-4 py-2.5 rounded-lg text-sm font-medium text-slate-300 flex items-center gap-2 hover:bg-slate-800">
                <i data-lucide="shopping-cart" class="w-4 h-4 text-emerald-400"></i> শপিং কার্ট ({{ $cartCount }})
            </a>
            <a href="{{ route('orders.index') }}" class="w-full text-left px-4 py-2.5 rounded-lg text-sm font-medium text-slate-300 flex items-center gap-2 hover:bg-slate-800">
                <i data-lucide="package" class="w-4 h-4 text-emerald-400"></i> আমার অর্ডারসমূহ
            </a>
            <a href="{{ route('services.index') }}" class="w-full text-left px-4 py-2.5 rounded-lg text-sm font-medium text-slate-300 flex items-center gap-2 hover:bg-slate-800">
                <i data-lucide="sparkles" class="w-4 h-4 text-emerald-400"></i> সেবাসমূহ
            </a>
            <a href="{{ route('contact.index') }}" class="w-full text-left px-4 py-2.5 rounded-lg text-sm font-medium text-slate-300 flex items-center gap-2 hover:bg-slate-800">
                <i data-lucide="headphones" class="w-4 h-4 text-emerald-400"></i> যোগাযোগ
            </a>
        </div>
    </header>

    <!-- Toast Notifications -->
    @if(session('success'))
        <div id="toast-success" class="fixed bottom-6 right-6 z-50 bg-emerald-950 border border-emerald-500/50 text-emerald-200 p-4 rounded-xl text-xs font-semibold shadow-2xl flex items-center gap-3">
            <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-400"></i>
            <span>{{ session('success') }}</span>
        </div>
    @endif
    @if(session('error'))
        <div id="toast-error" class="fixed bottom-6 right-6 z-50 bg-rose-950 border border-rose-500/50 text-rose-200 p-4 rounded-xl text-xs font-semibold shadow-2xl flex items-center gap-3">
            <i data-lucide="alert-circle" class="w-5 h-5 text-rose-400"></i>
            <span>{{ session('error') }}</span>
        </div>
    @endif

    <!-- Main Content Body -->
    <main class="flex-grow">
        @yield('content')
        {{ $slot ?? '' }}
    </main>

    <!-- Footer -->
    <footer class="bg-slate-950 border-t border-slate-800/80 pt-12 pb-8 text-slate-400 text-xs mt-auto">
        <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-4 gap-8 mb-8">
                <div class="space-y-3">
                    <div class="flex items-center gap-2">
                        <div class="w-8 h-8 rounded-lg bg-emerald-600 flex items-center justify-center text-white font-bold">
                            <i data-lucide="book-open" class="w-5 h-5"></i>
                        </div>
                        <span class="font-extrabold text-lg text-white">পাঠশালা লাইব্রেরি</span>
                    </div>
                    <p class="text-slate-400 text-xs leading-relaxed">
                        বাংলাদেশের ১ম থেকে ১২ শ শ্রেণীর শিক্ষার্থীদের জন্য জাতীয় শিক্ষাক্রম ও পাঠ্যপুস্তক বোর্ড (NCTB) অনুমোদিত ডিজিটাল ই-পাঠাগার ও ফ্রি রিডিং প্ল্যাটফর্ম।
                    </p>
                </div>

                <div>
                    <h4 class="font-bold text-white mb-3 uppercase text-xs tracking-wider">শ্রেণীসমূহ (Classes)</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('books.index', ['class' => 'class-1']) }}" class="hover:text-emerald-400">Class 1 to 5 (প্রাথমিক)</a></li>
                        <li><a href="{{ route('books.index', ['class' => 'class-6']) }}" class="hover:text-emerald-400">Class 6 to 8 (নিম্ন মাধ্যমিক)</a></li>
                        <li><a href="{{ route('books.index', ['class' => 'class-9']) }}" class="hover:text-emerald-400">Class 9 & 10 (SSC)</a></li>
                        <li><a href="{{ route('books.index', ['class' => 'class-11']) }}" class="hover:text-emerald-400">Class 11 & 12 (HSC)</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-white mb-3 uppercase text-xs tracking-wider">জনপ্রিয় লেখকগণ</h4>
                    <ul class="space-y-2">
                        <li><a href="{{ route('books.index', ['author' => 'nctb-board']) }}" class="hover:text-emerald-400">NCTB Board</a></li>
                        <li><a href="{{ route('books.index', ['author' => 'hajari-nag']) }}" class="hover:text-emerald-400">প্রফেসর মো: হাজারী ও নাগ</a></li>
                        <li><a href="{{ route('books.index', ['author' => 'shahjahan-tapan']) }}" class="hover:text-emerald-400">ড. শাহজাহান তপন</a></li>
                        <li><a href="{{ route('books.index', ['author' => 'ketab-uddin']) }}" class="hover:text-emerald-400">কেতাব উদ্দীন আহমেদ</a></li>
                    </ul>
                </div>

                <div>
                    <h4 class="font-bold text-white mb-3 uppercase text-xs tracking-wider">যোগাযোগ ও ঠিকানা</h4>
                    <p class="text-slate-400 mb-2">📍 ৬৯-৭০, মতিঝিল বাণিজ্যিক এলাকা, ঢাকা-১০০০ (NCTB ভবন)</p>
                    <p class="text-slate-400 mb-2">📞 হটলাইন: ০১৭০০-০০০০০০</p>
                    <p class="text-slate-400">✉️ সাপোর্ট: help@pathshalalibrary.edu.bd</p>
                </div>
            </div>

            <div class="border-t border-slate-800 pt-6 text-center text-slate-500">
                <p>&copy; 2026 পাঠশালা ডিজিটাল অনলাইন ই-লাইব্রেরি (BD Online Books Library). সর্বস্বত্ব সংরক্ষিত।</p>
            </div>
        </div>
    </footer>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();

            setTimeout(() => {
                const toastS = document.getElementById('toast-success');
                const toastE = document.getElementById('toast-error');
                if (toastS) toastS.remove();
                if (toastE) toastE.remove();
            }, 4000);
        });

        function toggleMobileMenu() {
            document.getElementById('mobile-menu').classList.toggle('hidden');
        }
    </script>
</body>
</html>
