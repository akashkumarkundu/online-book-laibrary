@extends('layouts.app')

@section('title', 'ই-লাইব্রেরি সেবাসমূহ | পাঠশালা লাইব্রেরি')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
    <div class="text-center max-w-3xl mx-auto mb-16">
        <h1 class="text-3xl sm:text-4xl font-extrabold text-white mb-4">
            আমাদের ডিজিটাল ই-লাইব্রেরির <span class="gradient-text">স্মার্ট সেবাসমূহ</span>
        </h1>
        <p class="text-slate-400 text-base leading-relaxed">
            বাংলাদেশের যেকোনো স্থান থেকে শিক্ষার্থীরা ১-ক্লিকে বিনামূল্যে বোর্ড বই পড়তে, ডাউনলোড করতে ও অর্ডার করতে পারবে।
        </p>
    </div>

    <!-- 6 Digital Services Breakdown -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-8 mb-16">
        <div class="glass-card p-6 rounded-3xl border border-slate-800 space-y-3">
            <div class="w-12 h-12 rounded-2xl bg-emerald-500/10 text-emerald-400 flex items-center justify-center">
                <i data-lucide="book-open" class="w-6 h-6"></i>
            </div>
            <h3 class="text-lg font-bold text-white">১. ডিজিটাল ই-বুক ফ্লিপবুক রিডার</h3>
            <p class="text-slate-400 text-xs leading-relaxed">এইচডি কোয়ালিটিতে পৃষ্ঠা উল্টে বই পড়ার সুবিধা। অডিও রিডার ও অধ্যায় সূচিপত্র সহ।</p>
        </div>

        <div class="glass-card p-6 rounded-3xl border border-slate-800 space-y-3">
            <div class="w-12 h-12 rounded-2xl bg-indigo-500/10 text-indigo-400 flex items-center justify-center">
                <i data-lucide="truck" class="w-6 h-6"></i>
            </div>
            <h3 class="text-lg font-bold text-white">২. দেশব্যাপী হোম ডেলিভারি</h3>
            <p class="text-slate-400 text-xs leading-relaxed">বাংলাদেশের ৬৪ জেলায় ৩-৫ কার্যদিবসের মধ্যে ক্যাশ অন ডেলিভারিতে অরিজিনাল বোর্ড বই পৌঁছানো।</p>
        </div>

        <div class="glass-card p-6 rounded-3xl border border-slate-800 space-y-3">
            <div class="w-12 h-12 rounded-2xl bg-amber-500/10 text-amber-400 flex items-center justify-center">
                <i data-lucide="brain-circuit" class="w-6 h-6"></i>
            </div>
            <h3 class="text-lg font-bold text-white">৩. স্মার্ট অধ্যায় ভিত্তিক কুইজ</h3>
            <p class="text-slate-400 text-xs leading-relaxed">অধ্যায়ভিত্তিক MCQ অনুশীলনী এবং সঠিক উত্তরের তাৎক্ষণিক ব্যাখ্যাসহ মেধা যাচাই।</p>
        </div>

        <div class="glass-card p-6 rounded-3xl border border-slate-800 space-y-3">
            <div class="w-12 h-12 rounded-2xl bg-rose-500/10 text-rose-400 flex items-center justify-center">
                <i data-lucide="volume-2" class="w-6 h-6"></i>
            </div>
            <h3 class="text-lg font-bold text-white">৪. বাংলা ভয়েস অডিও রিডার</h3>
            <p class="text-slate-400 text-xs leading-relaxed">ছোটদের ও দৃষ্টি প্রতিবন্ধী শিক্ষার্থীদের জন্য বাংলায় পড়ে শুনানোর টেক্সট-টু-স্পিচ সুবিধা।</p>
        </div>

        <div class="glass-card p-6 rounded-3xl border border-slate-800 space-y-3">
            <div class="w-12 h-12 rounded-2xl bg-teal-500/10 text-teal-400 flex items-center justify-center">
                <i data-lucide="file-down" class="w-6 h-6"></i>
            </div>
            <h3 class="text-lg font-bold text-white">৫. অফলাইন PDF ডাউনলোড</h3>
            <p class="text-slate-400 text-xs leading-relaxed">ইন্টারনেট ছাড়া পড়ার জন্য মোবাইল ও পিসিতে সরাসরি এনসিটিবি অনুমোদিত PDF ডাউনলোড।</p>
        </div>

        <div class="glass-card p-6 rounded-3xl border border-slate-800 space-y-3">
            <div class="w-12 h-12 rounded-2xl bg-purple-500/10 text-purple-400 flex items-center justify-center">
                <i data-lucide="headphones" class="w-6 h-6"></i>
            </div>
            <h3 class="text-lg font-bold text-white">৬. ২৪/৭ শিক্ষার্থী হেল্পডেস্ক</h3>
            <p class="text-slate-400 text-xs leading-relaxed">পাঠ্যক্রম ও যেকোনো শিক্ষনীয় বিষয়ে পরামর্শ দিতে সদা প্রস্তুত আমাদের হেল্প টিম।</p>
        </div>
    </div>
</div>
@endsection
