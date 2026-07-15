<x-app-layout>
    <x-slot name="header">
        <div class="flex flex-row justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Detail Transaksi') }}
            </h2>
            <a href="{{ route('admin.subscribe_transactions.index') }}" class="text-sm text-indigo-600 hover:underline">← Kembali ke Daftar</a>
        </div>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8 space-y-6">
            @if(session('success'))
                <div class="p-4 bg-green-100 border border-green-300 text-green-700 rounded-lg flex items-center gap-3">
                    <span class="text-xl">✅</span> {{ session('success') }}
                </div>
            @endif

            {{-- Status Banner --}}
            @if($subscribeTransaction->is_paid)
                <div class="p-4 bg-emerald-50 border border-emerald-200 text-emerald-800 rounded-xl flex items-center gap-3">
                    <span class="text-xl">🎉</span>
                    <div>
                        <p class="font-bold text-sm">Transaksi Disetujui</p>
                        <p class="text-xs text-emerald-600">Aktif sejak {{ \Carbon\Carbon::parse($subscribeTransaction->subscription_start_date)->format('d M Y') }} · Kadaluarsa {{ \Carbon\Carbon::parse($subscribeTransaction->subscription_start_date)->addMonth()->format('d M Y') }}</p>
                    </div>
                </div>
            @else
                <div class="p-4 bg-amber-50 border border-amber-200 text-amber-800 rounded-xl flex items-center gap-3">
                    <span class="text-xl">⏳</span>
                    <div>
                        <p class="font-bold text-sm">Menunggu Konfirmasi</p>
                        <p class="text-xs text-amber-600">Bukti transfer sudah diupload, belum di-approve</p>
                    </div>
                </div>
            @endif

            {{-- Main Card --}}
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-xl">
                {{-- Header: proof + info --}}
                <div class="p-8 flex flex-col sm:flex-row gap-8">
                    {{-- Proof of Payment --}}
                    <div class="flex-shrink-0">
                        <p class="text-slate-500 text-xs font-semibold uppercase tracking-widest mb-3">Bukti Transfer</p>
                        @if($subscribeTransaction->proof)
                            <img src="{{ Storage::url($subscribeTransaction->proof) }}" 
                                 alt="Bukti Transfer" 
                                 class="w-[180px] h-[240px] object-contain rounded-xl border border-slate-200 shadow-sm">
                        @else
                            <div class="w-[180px] h-[140px] flex items-center justify-center bg-slate-50 rounded-xl border border-dashed border-slate-300 text-slate-400 text-sm">
                                Tidak ada bukti
                            </div>
                        @endif
                    </div>

                    {{-- Transaction Details --}}
                    <div class="flex-grow grid grid-cols-2 gap-5 content-start">
                        <div>
                            <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Total Pembayaran</p>
                            <p class="text-indigo-900 text-2xl font-bold">Rp {{ number_format($subscribeTransaction->total_amount, 0, ',', '.') }}</p>
                        </div>
                        <div>
                            <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Tanggal Upload</p>
                            <p class="text-indigo-900 font-semibold">{{ $subscribeTransaction->created_at->format('d M Y, H:i') }} WIB</p>
                        </div>
                        <div>
                            <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Student</p>
                            <p class="text-indigo-900 font-semibold">{{ $subscribeTransaction->user->name ?? '—' }}</p>
                            <p class="text-slate-500 text-xs">{{ $subscribeTransaction->user->email ?? '' }}</p>
                        </div>
                        <div>
                            <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Kursus</p>
                            <p class="text-indigo-900 font-semibold">{{ $subscribeTransaction->course->name ?? 'Langganan Umum' }}</p>
                            @if($subscribeTransaction->course)
                                <p class="text-slate-500 text-xs">{{ ucfirst($subscribeTransaction->course->difficulty) }}</p>
                            @endif
                        </div>
                        @if($subscribeTransaction->is_paid)
                            <div>
                                <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Mulai Langganan</p>
                                <p class="text-indigo-900 font-semibold">{{ \Carbon\Carbon::parse($subscribeTransaction->subscription_start_date)->format('d M Y') }}</p>
                            </div>
                            <div>
                                <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider mb-1">Kadaluarsa</p>
                                <p class="text-indigo-900 font-semibold">{{ \Carbon\Carbon::parse($subscribeTransaction->subscription_start_date)->addMonth()->format('d M Y') }}</p>
                            </div>
                        @endif
                    </div>
                </div>

                <hr class="border-slate-100 mx-8">

                {{-- Action Area --}}
                <div class="p-8">
                    @if(!$subscribeTransaction->is_paid)
                        <p class="text-slate-500 text-sm mb-4">Verifikasi bukti transfer lalu klik tombol di bawah untuk mengaktifkan akses student.</p>
                        <form action="{{ route('admin.subscribe_transactions.update', $subscribeTransaction) }}" method="POST">
                            @csrf
                            @method('PUT')
                            <button type="submit" 
                                    class="font-bold py-3 px-8 bg-indigo-700 hover:bg-indigo-800 text-white rounded-full transition-colors"
                                    onclick="return confirm('Approve transaksi ini? Akses student akan langsung aktif selama 30 hari.')">
                                ✓ Approve & Aktifkan Akses
                            </button>
                        </form>
                    @else
                        <div class="flex items-center gap-3">
                            <span class="font-bold py-3 px-8 bg-emerald-600 text-white rounded-full">
                                ✓ Approved — Akses Aktif
                            </span>
                            <span class="text-sm text-slate-500">
                                Kadaluarsa: {{ \Carbon\Carbon::parse($subscribeTransaction->subscription_start_date)->addMonth()->format('d M Y') }}
                            </span>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
