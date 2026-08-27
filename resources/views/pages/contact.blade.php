@extends('layouts.app')

@section('title', 'যোগাযোগ ও হেল্পডেস্ক | পাঠশালা লাইব্রেরি')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center max-w-3xl mx-auto mb-12">
        <h1 class="text-3xl font-extrabold text-white mb-3">যোগাযোগ ও হেল্পডেস্ক</h1>
        <p class="text-slate-400 text-sm">বই, ডেলিভারি বা পড়াশোনা সংক্রান্ত যেকোনো বিষয়ে আমাদের সাথে মেসেজে যুক্ত হন।</p>
    </div>

    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 max-w-5xl mx-auto">
        <!-- Address Cards -->
        <div class="lg:col-span-1 space-y-4">
            <div class="glass-panel p-6 rounded-3xl border border-slate-800 space-y-2">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center mb-2">
                    <i data-lucide="map-pin" class="w-5 h-5"></i>
                </div>
                <h4 class="font-bold text-white text-sm">অফিস ঠিকানা</h4>
                <p class="text-xs text-slate-400 leading-relaxed">
                    জাতীয় শিক্ষাক্রম ও পাঠ্যপুস্তক বোর্ড (NCTB ভবন)<br>
                    ৬৯-৭০, মতিঝিল বাণিজ্যিক এলাকা, ঢাকা-১০০০।
                </p>
            </div>

            <div class="glass-panel p-6 rounded-3xl border border-slate-800 space-y-2">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center mb-2">
                    <i data-lucide="phone" class="w-5 h-5"></i>
                </div>
                <h4 class="font-bold text-white text-sm">হটলাইন নম্বর</h4>
                <p class="text-xs text-slate-400">০১৭০০-০০০০০০ (সকাল ৯টা - রাত ৮টা)</p>
            </div>

            <div class="glass-panel p-6 rounded-3xl border border-slate-800 space-y-2">
                <div class="w-10 h-10 rounded-xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center mb-2">
                    <i data-lucide="mail" class="w-5 h-5"></i>
                </div>
                <h4 class="font-bold text-white text-sm">ই-মেইল এড্রেস</h4>
                <p class="text-xs text-slate-400">support@pathshalalibrary.edu.bd</p>
            </div>
        </div>

        <!-- Contact Form -->
        <div class="lg:col-span-2 glass-panel p-6 sm:p-8 rounded-3xl border border-slate-800">
            <h3 class="text-xl font-extrabold text-white mb-6">মেসেজ পাঠান (Send Message)</h3>

            <form action="{{ route('contact.store') }}" method="POST" class="space-y-4">
                @csrf
                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">আপনার পূর্ণ নাম *</label>
                        <input type="text" name="name" required placeholder="আপনার নাম" class="w-full bg-slate-900 border border-slate-800 text-sm text-white rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">মোবাইল নম্বর *</label>
                        <input type="tel" name="phone" required placeholder="01700-000000" class="w-full bg-slate-900 border border-slate-800 text-sm text-white rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">ই-মেইল (ঐচ্ছিক)</label>
                    <input type="email" name="email" placeholder="example@gmail.com" class="w-full bg-slate-900 border border-slate-800 text-sm text-white rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">বিষয় (Subject)</label>
                    <input type="text" name="subject" placeholder="যেমন: বই ডেলিভারি বা কারিকুলাম বিষয়ে..." class="w-full bg-slate-900 border border-slate-800 text-sm text-white rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500">
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">বার্তার বিবরণ *</label>
                    <textarea name="message" rows="4" required placeholder="আপনার বার্তাটি টাইপ করুন..." class="w-full bg-slate-900 border border-slate-800 text-sm text-white rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500 resize-none"></textarea>
                </div>

                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold py-3.5 rounded-xl transition-all shadow-lg shadow-emerald-600/20">
                    মেসেজ জমা দিন (Submit Message)
                </button>
            </form>
        </div>
    </div>
</div>
@endsection
