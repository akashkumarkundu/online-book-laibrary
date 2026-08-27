@extends('layouts.app')

@section('title', 'অনলাইন রিডার: ' . $book->title)

@section('content')
<div class="bg-slate-950 py-6 min-h-[85vh]">
    <div class="max-w-6xl mx-auto px-4">
        <!-- Top Toolbar Header -->
        <div class="bg-slate-900 border border-slate-800 rounded-2xl p-4 mb-6 flex flex-wrap items-center justify-between gap-4">
            <div class="flex items-center gap-3">
                <span class="bg-emerald-500/20 text-emerald-400 text-xs font-bold px-3 py-1 rounded-md border border-emerald-500/30">
                    {{ $book->gradeLevel->name ?? 'Class 1-12' }}
                </span>
                <div>
                    <h1 class="text-base sm:text-lg font-bold text-white">{{ $book->title }}</h1>
                    <p class="text-xs text-amber-400 font-medium">{{ $book->author->name }}</p>
                </div>
            </div>

            <div class="flex items-center gap-2">
                <button onclick="toggleAudioReader()" class="bg-slate-800 hover:bg-slate-700 text-slate-200 px-3.5 py-2 rounded-xl text-xs font-bold flex items-center gap-1.5 border border-slate-700 transition-colors">
                    <i data-lucide="volume-2" class="w-4 h-4 text-emerald-400"></i>
                    <span>অডিও শুনুন (Audio Reader)</span>
                </button>
                <a href="{{ route('books.show', $book->id) }}" class="bg-slate-800 hover:bg-slate-700 text-slate-300 px-3 py-2 rounded-xl text-xs font-semibold">
                    বাহির হন
                </a>
            </div>
        </div>

        <!-- Reader Canvas Grid -->
        <div class="grid grid-cols-1 md:grid-cols-4 gap-6 min-h-[60vh]">
            <!-- Chapter TOC Sidebar -->
            <div class="md:col-span-1 glass-panel p-4 rounded-2xl border border-slate-800 space-y-2 h-fit">
                <h3 class="text-xs font-extrabold uppercase text-slate-400 mb-3 tracking-wider">অধ্যায় সূচিপত্র (TOC)</h3>
                @forelse($book->chapters as $index => $chap)
                    <button onclick="loadChapter({{ $index }})" id="toc-btn-{{ $index }}" class="toc-btn w-full text-left p-3 rounded-xl text-xs font-semibold transition-all {{ $index === 0 ? 'bg-emerald-600 text-white shadow-md' : 'bg-slate-900 text-slate-300 hover:bg-slate-800' }}">
                        {{ $chap->title }}
                    </button>
                @empty
                    <div class="p-3 bg-slate-900 text-slate-400 text-xs rounded-xl">
                        অধ্যায় ১: প্রাথমিক সংস্করণ পাঠ
                    </div>
                @endforelse
            </div>

            <!-- Reading Display Area -->
            <div class="md:col-span-3 glass-panel p-6 sm:p-10 rounded-2xl border border-slate-800 flex flex-col justify-between" id="reading-content-box">
                <div id="chapter-body-text">
                    @if($book->chapters->isNotEmpty())
                        <div class="border-b border-slate-800 pb-4 mb-6">
                            <span class="text-xs text-emerald-400 font-bold uppercase">{{ $book->author->name }}</span>
                            <h2 class="text-2xl font-extrabold text-white mt-1" id="chap-title-display">{{ $book->chapters->first()->title }}</h2>
                        </div>
                        <div class="text-slate-200 text-base leading-relaxed space-y-4" id="chap-content-display">
                            <p class="text-justify font-medium">{{ $book->chapters->first()->content }}</p>
                        </div>
                    @else
                        <div class="border-b border-slate-800 pb-4 mb-6">
                            <span class="text-xs text-emerald-400 font-bold uppercase">NCTB Board</span>
                            <h2 class="text-2xl font-extrabold text-white mt-1">অধ্যায় ১: মূল পাঠ্যসূচি</h2>
                        </div>
                        <div class="text-slate-200 text-base leading-relaxed">
                            <p class="text-justify font-medium">{{ $book->description }}</p>
                        </div>
                    @endif
                </div>

                <!-- Footer Navigation -->
                <div class="pt-6 border-t border-slate-800 flex items-center justify-between mt-8">
                    <button onclick="prevChapter()" class="bg-slate-800 hover:bg-slate-700 text-slate-200 text-xs font-bold px-4 py-2.5 rounded-xl border border-slate-700">পূর্ববর্তী অধ্যায়</button>
                    <span id="chap-indicator-text" class="text-xs text-slate-400 font-semibold">অধ্যায় ১ / {{ max(1, $book->chapters->count()) }}</span>
                    <button onclick="nextChapter()" class="bg-emerald-600 hover:bg-emerald-500 text-white text-xs font-bold px-4 py-2.5 rounded-xl shadow-md">পরবর্তী অধ্যায়</button>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    const chaptersData = @json($book->chapters);
    let currentChapterIndex = 0;
    let isAudioSpeaking = false;

    function loadChapter(idx) {
        if (!chaptersData || chaptersData.length === 0) return;
        currentChapterIndex = idx;
        const chap = chaptersData[idx];

        document.getElementById('chap-title-display').innerText = chap.title;
        document.getElementById('chap-content-display').innerHTML = `<p class="text-justify font-medium mb-4">${chap.content}</p>`;
        document.getElementById('chap-indicator-text').innerText = `অধ্যায় ${idx + 1} / ${chaptersData.length}`;

        document.querySelectorAll('.toc-btn').forEach((btn, i) => {
            if (i === idx) {
                btn.className = 'toc-btn w-full text-left p-3 rounded-xl text-xs font-semibold transition-all bg-emerald-600 text-white shadow-md';
            } else {
                btn.className = 'toc-btn w-full text-left p-3 rounded-xl text-xs font-semibold transition-all bg-slate-900 text-slate-300 hover:bg-slate-800';
            }
        });
    }

    function prevChapter() {
        if (currentChapterIndex > 0) loadChapter(currentChapterIndex - 1);
    }

    function nextChapter() {
        if (chaptersData && currentChapterIndex < chaptersData.length - 1) loadChapter(currentChapterIndex + 1);
    }

    function toggleAudioReader() {
        if (!('speechSynthesis' in window)) return;
        if (isAudioSpeaking) {
            window.speechSynthesis.cancel();
            isAudioSpeaking = false;
        } else {
            const text = chaptersData && chaptersData.length > 0 ? chaptersData[currentChapterIndex].content : '{{ addslashes($book->description) }}';
            const utterance = new SpeechSynthesisUtterance(text);
            utterance.lang = 'bn-BD';
            window.speechSynthesis.speak(utterance);
            isAudioSpeaking = true;
        }
    }
</script>
@endsection
