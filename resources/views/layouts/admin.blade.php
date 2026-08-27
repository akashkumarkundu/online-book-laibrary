<!DOCTYPE html>
<html lang="bn" class="dark">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title', 'এডমিন প্যানেল | পাঠশালা লাইব্রেরি')</title>

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
        .active-admin-nav {
            background: linear-gradient(135deg, #059669 0%, #047857 100%);
            color: #ffffff !important;
            box-shadow: 0 4px 14px 0 rgba(5, 150, 105, 0.35);
        }
    </style>
</head>
<body class="bg-slate-950 text-slate-100 min-h-screen flex flex-col md:flex-row">

    <!-- Admin Sidebar -->
    <aside class="w-full md:w-64 bg-slate-900 border-b md:border-b-0 md:border-r border-slate-800 flex-shrink-0 flex flex-col">
        <div class="p-5 border-b border-slate-800 flex items-center justify-between">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3">
                <div class="w-9 h-9 rounded-lg bg-emerald-600 flex items-center justify-center text-white shadow-md">
                    <i data-lucide="shield-check" class="w-5 h-5"></i>
                </div>
                <div>
                    <span class="font-extrabold text-base text-white tracking-wide">পাঠশালা <span class="text-emerald-400">এডমিন</span></span>
                    <p class="text-[10px] text-slate-400 font-medium">কন্ট্রোল প্যানেল</p>
                </div>
            </a>
            <a href="{{ route('home') }}" class="md:hidden text-xs text-emerald-400 hover:underline flex items-center gap-1">
                <i data-lucide="external-link" class="w-3.5 h-3.5"></i> মূল সাইট
            </a>
        </div>

        <nav class="p-4 space-y-1.5 flex-grow">
            <a href="{{ route('admin.dashboard') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('admin.dashboard') ? 'active-admin-nav' : 'text-slate-300 hover:text-white hover:bg-slate-800/60' }}">
                <i data-lucide="layout-dashboard" class="w-4 h-4 text-emerald-400"></i>
                <span>ড্যাশবোর্ড (Dashboard)</span>
            </a>

            <a href="{{ route('admin.books.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('admin.books.*') ? 'active-admin-nav' : 'text-slate-300 hover:text-white hover:bg-slate-800/60' }}">
                <i data-lucide="book-open" class="w-4 h-4 text-teal-400"></i>
                <span>বই ব্যবস্থাপনা (Books)</span>
            </a>

            <a href="{{ route('admin.orders.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('admin.orders.*') ? 'active-admin-nav' : 'text-slate-300 hover:text-white hover:bg-slate-800/60' }}">
                <i data-lucide="shopping-bag" class="w-4 h-4 text-indigo-400"></i>
                <span>অর্ডারসমূহ (Orders)</span>
            </a>

            <a href="{{ route('admin.contacts.index') }}" class="flex items-center gap-3 px-4 py-2.5 rounded-xl text-xs font-bold transition-all {{ request()->routeIs('admin.contacts.*') ? 'active-admin-nav' : 'text-slate-300 hover:text-white hover:bg-slate-800/60' }}">
                <i data-lucide="mail" class="w-4 h-4 text-amber-400"></i>
                <span>বার্তা ইনবক্স (Messages)</span>
            </a>
        </nav>

        <div class="p-4 border-t border-slate-800 space-y-2">
            <a href="{{ route('home') }}" class="w-full flex items-center justify-center gap-2 bg-slate-800 hover:bg-slate-700 text-slate-200 py-2 rounded-xl text-xs font-bold transition-colors">
                <i data-lucide="external-link" class="w-4 h-4 text-emerald-400"></i> মূল ওয়েবসাইটে ফিরে যান
            </a>
        </div>
    </aside>

    <!-- Main Content Body -->
    <div class="flex-grow flex flex-col min-w-0">
        <!-- Admin Top Header -->
        <header class="bg-slate-900/80 backdrop-blur border-b border-slate-800 px-6 py-4 flex items-center justify-between">
            <h1 class="text-lg font-bold text-white flex items-center gap-2">
                @yield('page_header', 'এডমিন ম্যানেজমেন্ট')
            </h1>
            <div class="flex items-center gap-3 text-xs text-slate-400">
                <span class="bg-emerald-500/20 text-emerald-300 px-2.5 py-1 rounded-full font-semibold border border-emerald-500/30">
                    এডমিনিস্ট্রেটর
                </span>
            </div>
        </header>

        <!-- Flash Messages -->
        <div class="px-6 pt-4">
            @if(session('success'))
                <div id="toast-success" class="bg-emerald-950 border border-emerald-500/50 text-emerald-200 p-4 rounded-xl text-xs font-semibold flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <i data-lucide="check-circle-2" class="w-5 h-5 text-emerald-400"></i>
                        <span>{{ session('success') }}</span>
                    </div>
                </div>
            @endif
            @if(session('error'))
                <div id="toast-error" class="bg-rose-950 border border-rose-500/50 text-rose-200 p-4 rounded-xl text-xs font-semibold flex items-center justify-between mb-4">
                    <div class="flex items-center gap-2">
                        <i data-lucide="alert-circle" class="w-5 h-5 text-rose-400"></i>
                        <span>{{ session('error') }}</span>
                    </div>
                </div>
            @endif
        </div>

        <main class="p-6 flex-grow">
            @yield('content')
        </main>

        <footer class="border-t border-slate-800 p-4 text-center text-xs text-slate-500">
            &copy; 2026 পাঠশালা এডমিন কন্ট্রোল প্যানেল | NCTB BD E-Library System
        </footer>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', () => {
            lucide.createIcons();
        });
    </script>
</body>
</html>
