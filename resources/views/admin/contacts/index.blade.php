@extends('layouts.admin')

@section('title', 'বার্তা ইনবক্স - পাঠশালা এডমিন')
@section('page_header', 'গ্রাহকদের বার্তা ইনবক্স (Contact Inbox)')

@section('content')
<div class="space-y-6">
    <div class="glass-card rounded-2xl border border-slate-800 overflow-hidden">
        <div class="overflow-x-auto">
            <table class="w-full text-left text-xs">
                <thead class="bg-slate-900 text-slate-400 border-b border-slate-800 uppercase tracking-wider">
                    <tr>
                        <th class="px-5 py-3.5">প্রেরক ও মোবাইল</th>
                        <th class="px-5 py-3.5">বিষয়</th>
                        <th class="px-5 py-3.5">বার্তা (Message)</th>
                        <th class="px-5 py-3.5">স্ট্যাটাস</th>
                        <th class="px-5 py-3.5">তারিখ</th>
                        <th class="px-5 py-3.5 text-right">অ্যাকশন</th>
                    </tr>
                </thead>
                <tbody class="divide-y divide-slate-800/60 text-slate-300">
                    @forelse($contacts as $contact)
                        <tr class="hover:bg-slate-800/40 transition-colors">
                            <td class="px-5 py-4">
                                <div class="font-bold text-white">{{ $contact->name }}</div>
                                <div class="text-[11px] text-slate-400 font-mono">{{ $contact->phone }}</div>
                                @if($contact->email)
                                    <div class="text-[10px] text-slate-500">{{ $contact->email }}</div>
                                @endif
                            </td>
                            <td class="px-5 py-4 font-semibold text-emerald-400">
                                {{ $contact->subject ?? 'সাধারণ জিজ্ঞাসা' }}
                            </td>
                            <td class="px-5 py-4 text-slate-300 max-w-sm">
                                <p class="line-clamp-2">{{ $contact->message }}</p>
                            </td>
                            <td class="px-5 py-4">
                                <form action="{{ route('admin.contacts.update-status', $contact->id) }}" method="POST">
                                    @csrf
                                    @method('PATCH')
                                    <select name="status" onchange="this.form.submit()" class="bg-slate-950 border border-slate-800 text-[11px] rounded-lg px-2 py-1 font-semibold text-slate-300 focus:outline-none focus:border-emerald-500">
                                        <option value="pending" {{ $contact->status === 'pending' ? 'selected' : '' }}>পেন্ডিং</option>
                                        <option value="replied" {{ $contact->status === 'replied' ? 'selected' : '' }}>উত্তর দেওয়া হয়েছে</option>
                                        <option value="closed" {{ $contact->status === 'closed' ? 'selected' : '' }}>বন্ধ (Closed)</option>
                                    </select>
                                </form>
                            </td>
                            <td class="px-5 py-4 text-slate-400">
                                {{ $contact->created_at ? $contact->created_at->format('d M, Y') : 'N/A' }}
                            </td>
                            <td class="px-5 py-4 text-right">
                                <form action="{{ route('admin.contacts.destroy', $contact->id) }}" method="POST" class="inline" onsubmit="return confirm('এই বার্তাটি মুছে ফেলতে চান?')">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="bg-rose-900/60 hover:bg-rose-800 text-rose-200 px-3 py-1.5 rounded-lg text-xs font-semibold border border-rose-700/50">
                                        মুছুন
                                    </button>
                                </form>
                            </td>
                        </tr>
                    @empty
                        <tr>
                            <td colspan="6" class="text-center py-8 text-slate-500">কোনো ইনবক্স বার্তা পাওয়া যায়নি।</td>
                        </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($contacts->hasPages())
            <div class="p-4 border-t border-slate-800">
                {{ $contacts->links() }}
            </div>
        @endif
    </div>
</div>
@endsection
