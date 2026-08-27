@extends('layouts.app')

@section('title', 'অর্ডার চেকআউট | পাঠশালা লাইব্রেরি')

@section('content')
<div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-10">
    <h1 class="text-3xl font-extrabold text-white mb-6">অর্ডার চেকআউট ও ডেলিভারি তথ্য</h1>

    <form action="{{ route('checkout.store') }}" method="POST" class="grid grid-cols-1 lg:grid-cols-3 gap-8">
        @csrf

        <!-- Shipping & Customer Info Column -->
        <div class="lg:col-span-2 space-y-6">
            <!-- Customer Details Box -->
            <div class="glass-panel p-6 sm:p-8 rounded-3xl border border-slate-800 space-y-4">
                <h3 class="text-lg font-bold text-white flex items-center gap-2 border-b border-slate-800 pb-3">
                    <i data-lucide="user" class="w-5 h-5 text-emerald-400"></i>
                    <span>১. ক্রেতার বিস্তারিত তথ্য</span>
                </h3>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">আপনার পূর্ণ নাম *</label>
                        <input type="text" name="customer_name" required value="{{ old('customer_name', auth()->user()->name ?? '') }}" placeholder="আপনার নাম লিখুন" 
                            class="w-full bg-slate-900 border border-slate-800 text-sm text-white rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500">
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">মোবাইল নম্বর *</label>
                        <input type="tel" name="phone" required value="{{ old('phone') }}" placeholder="01700-000000" 
                            class="w-full bg-slate-900 border border-slate-800 text-sm text-white rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500">
                    </div>
                </div>

                <div>
                    <label class="block text-xs font-semibold text-slate-300 mb-1">ই-মেইল (ঐচ্ছিক)</label>
                    <input type="email" name="email" value="{{ old('email', auth()->user()->email ?? '') }}" placeholder="example@gmail.com" 
                        class="w-full bg-slate-900 border border-slate-800 text-sm text-white rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500">
                </div>

                <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">জেলা (District) *</label>
                        <select name="district" id="district-select" onchange="updateShippingCharge()" required 
                            class="w-full bg-slate-900 border border-slate-800 text-sm text-white rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500">
                            <option value="Dhaka">ঢাকা (Dhaka) - ৳৬০ ডেলিভারি</option>
                            <option value="Chittagong">চট্টগ্রাম (Chittagong) - ৳১১০ ডেলিভারি</option>
                            <option value="Rajshahi">রাজশাহী (Rajshahi) - ৳১১০ ডেলিভারি</option>
                            <option value="Khulna">খুলনা (Khulna) - ৳১১০ ডেলিভারি</option>
                            <option value="Barisal">বরিশাল (Barisal) - ৳১১০ ডেলিভারি</option>
                            <option value="Sylhet">সিলেট (Sylhet) - ৳১১০ ডেলিভারি</option>
                            <option value="Rangpur">রংপুর (Rangpur) - ৳১১০ ডেলিভারি</option>
                            <option value="Mymensingh">ময়মনসিংহ (Mymensingh) - ৳১১০ ডেলিভারি</option>
                            <option value="Other">অন্যান্য সকল জেলা - ৳১১০ ডেলিভারি</option>
                        </select>
                    </div>
                    <div>
                        <label class="block text-xs font-semibold text-slate-300 mb-1">সম্পূর্ণ ডেলিভারি ঠিকানা *</label>
                        <input type="text" name="address" required value="{{ old('address') }}" placeholder="বাসা নম্বর, রোড নম্বর, এলাকা..." 
                            class="w-full bg-slate-900 border border-slate-800 text-sm text-white rounded-xl px-4 py-3 focus:outline-none focus:border-emerald-500">
                    </div>
                </div>
            </div>

            <!-- Payment Method Box -->
            <div class="glass-panel p-6 sm:p-8 rounded-3xl border border-slate-800 space-y-4">
                <h3 class="text-lg font-bold text-white flex items-center gap-2 border-b border-slate-800 pb-3">
                    <i data-lucide="credit-card" class="w-5 h-5 text-emerald-400"></i>
                    <span>২. পেমেন্ট পদ্ধতি নির্বাচন করুন</span>
                </h3>

                <div class="grid grid-cols-2 sm:grid-cols-4 gap-3">
                    <label class="bg-slate-900 border-2 border-emerald-500/80 p-3 rounded-xl flex flex-col items-center justify-center cursor-pointer hover:bg-slate-850 text-center">
                        <input type="radio" name="payment_method" value="cod" checked class="mb-2 accent-emerald-500">
                        <span class="text-xs font-bold text-white">Cash on Delivery</span>
                        <span class="text-[10px] text-slate-400">ক্যাশ অন ডেলিভারি</span>
                    </label>

                    <label class="bg-slate-900 border border-slate-800 p-3 rounded-xl flex flex-col items-center justify-center cursor-pointer hover:bg-slate-850 text-center">
                        <input type="radio" name="payment_method" value="bkash" class="mb-2 accent-emerald-500">
                        <span class="text-xs font-bold text-pink-400">bKash</span>
                        <span class="text-[10px] text-slate-400">বিকাশ মার্চেন্ট</span>
                    </label>

                    <label class="bg-slate-900 border border-slate-800 p-3 rounded-xl flex flex-col items-center justify-center cursor-pointer hover:bg-slate-850 text-center">
                        <input type="radio" name="payment_method" value="nagad" class="mb-2 accent-emerald-500">
                        <span class="text-xs font-bold text-orange-400">Nagad</span>
                        <span class="text-[10px] text-slate-400">নগদ পেমেন্ট</span>
                    </label>

                    <label class="bg-slate-900 border border-slate-800 p-3 rounded-xl flex flex-col items-center justify-center cursor-pointer hover:bg-slate-850 text-center">
                        <input type="radio" name="payment_method" value="rocket" class="mb-2 accent-emerald-500">
                        <span class="text-xs font-bold text-purple-400">Rocket</span>
                        <span class="text-[10px] text-slate-400">রকেট ওয়ালেট</span>
                    </label>
                </div>
            </div>
        </div>

        <!-- Summary & Place Order Column -->
        <div class="lg:col-span-1">
            <div class="glass-panel p-6 rounded-3xl border border-slate-800 space-y-4 sticky top-28">
                <h3 class="text-lg font-extrabold text-white border-b border-slate-800 pb-3">অর্ডার সামারি</h3>

                <div class="space-y-2 max-h-48 overflow-y-auto pr-1 border-b border-slate-800/80 pb-3">
                    @foreach($cartItems as $item)
                        <div class="flex items-center justify-between text-xs">
                            <span class="text-slate-300 truncate w-44">{{ $item->book->title }} (x{{ $item->quantity }})</span>
                            <span class="font-bold text-slate-200">৳{{ number_format($item->subtotal, 0) }}</span>
                        </div>
                    @endforeach
                </div>

                <div class="space-y-2 text-xs text-slate-300">
                    <div class="flex items-center justify-between">
                        <span>বইয়ের সাবটোটাল:</span>
                        <span class="font-bold text-white">৳{{ number_format($subtotal, 0) }}</span>
                    </div>
                    <div class="flex items-center justify-between">
                        <span>ডেলিভারি চার্জ:</span>
                        <span class="font-bold text-emerald-400" id="shipping-charge-display">৳৬০</span>
                    </div>
                </div>

                <div class="border-t border-slate-800 pt-3 flex items-center justify-between text-sm font-extrabold text-white">
                    <span>সর্বমোট টাকা:</span>
                    <span class="text-xl text-emerald-400" id="total-amount-display">৳{{ number_format($subtotal + 60, 0) }}</span>
                </div>

                <button type="submit" class="w-full bg-emerald-600 hover:bg-emerald-500 text-white font-bold text-sm py-4 rounded-2xl text-center block transition-all shadow-xl shadow-emerald-600/30">
                    অর্ডার নিশ্চিত করুন (Confirm Order)
                </button>
            </div>
        </div>
    </form>
</div>

<script>
    const subtotal = {{ $subtotal }};
    function updateShippingCharge() {
        const district = document.getElementById('district-select').value;
        const fee = (district === 'Dhaka') ? 60 : 110;
        document.getElementById('shipping-charge-display').innerText = `৳${fee}`;
        document.getElementById('total-amount-display').innerText = `৳${(subtotal + fee).toLocaleString()}`;
    }
</script>
@endsection
