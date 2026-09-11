<div class="min-h-screen bg-slate-50 py-6 px-4 sm:py-10">
    <div class="mx-auto w-full max-w-xl">

        <div class="mb-6 text-center">
            <h1 class="text-xl sm:text-2xl font-bold text-slate-800">Pendaftaran Calon Murid Baru</h1>
            <p class="mt-1 text-sm text-slate-500">SMK Muhammadiyah Mungkid</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-5 sm:p-7">

            {{-- ===================== SUKSES ===================== --}}
            @if ($suksesSubmit === true)
                <div class="flex flex-col items-center text-center py-6">
                    <div class="h-14 w-14 rounded-full bg-emerald-100 flex items-center justify-center mb-4">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-emerald-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" d="M4.5 12.75l6 6 9-13.5" />
                        </svg>
                    </div>
                    <h2 class="text-lg font-semibold text-slate-800">Pendaftaran Berhasil</h2>
                    <p class="mt-1 text-sm text-slate-500">{{ $pesanSubmit }}</p>
                    <button
                        type="button"
                        wire:click="ubahNik"
                        class="mt-6 inline-flex items-center justify-center rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-emerald-700 transition"
                    >
                        Daftarkan Calon Murid Lain
                    </button>
                </div>

            @else

                {{-- ===================== STEP 1: CEK NIK ===================== --}}
                @if (! $nikSudahDicek)
                    <div>
                        <label for="nik" class="block text-sm font-medium text-slate-700 mb-1.5">
                            Nomor Induk Kependudukan (NIK)
                        </label>
                        <div class="flex flex-col sm:flex-row gap-2">
                            <input
                                type="text"
                                id="nik"
                                inputmode="numeric"
                                maxlength="16"
                                wire:model="nik"
                                wire:keydown.enter="periksaNik"
                                placeholder="Masukkan 16 digit NIK"
                                class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm text-slate-800 placeholder:text-slate-400 focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none transition"
                            >
                            <button
                                type="button"
                                wire:click="periksaNik"
                                wire:loading.attr="disabled"
                                wire:target="periksaNik"
                                class="shrink-0 inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-2.5 text-sm font-medium text-white hover:bg-emerald-700 disabled:opacity-60 transition"
                            >
                                <span wire:loading.remove wire:target="periksaNik">Periksa</span>
                                <span wire:loading wire:target="periksaNik">Memeriksa...</span>
                            </button>
                        </div>
                        @error('nik')
                            <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                {{-- ===================== NIK SUDAH ADA ===================== --}}
                @elseif ($nikSudahAda)
                    <div class="text-center py-4">
                        <div class="h-14 w-14 mx-auto rounded-full bg-amber-100 flex items-center justify-center mb-4">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-7 w-7 text-amber-600" fill="none" viewBox="0 0 24 24" stroke-width="2" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" d="M12 9v3.75m-9.303 3.376c-.866 1.5.217 3.374 1.948 3.374h14.71c1.73 0 2.813-1.874 1.948-3.374L13.949 3.378c-.866-1.5-3.032-1.5-3.898 0L2.697 16.126zM12 15.75h.007v.008H12v-.008z" />
                            </svg>
                        </div>
                        <h2 class="text-base font-semibold text-slate-800">NIK sudah ada di sistem</h2>
                        <p class="mt-1 text-sm text-slate-500">NIK <span class="font-medium">{{ $nik }}</span> sudah terdaftar sebagai calon murid.</p>
                        <button
                            type="button"
                            wire:click="ubahNik"
                            class="mt-5 inline-flex items-center justify-center rounded-xl border border-slate-300 px-5 py-2.5 text-sm font-medium text-slate-700 hover:bg-slate-50 transition"
                        >
                            Periksa NIK Lain
                        </button>
                    </div>

                {{-- ===================== STEP 2: FORM DATA CALON MURID ===================== --}}
                @else
                    <form wire:submit="submit" class="space-y-4">

                        <div class="flex items-center justify-between rounded-xl bg-slate-50 border border-slate-200 px-4 py-2.5">
                            <div>
                                <p class="text-xs text-slate-500">NIK</p>
                                <p class="text-sm font-medium text-slate-800">{{ $nik }}</p>
                            </div>
                            <button type="button" wire:click="ubahNik" class="text-xs font-medium text-emerald-600 hover:text-emerald-700">
                                Ubah
                            </button>
                        </div>

                        @if ($suksesSubmit === false)
                            <div class="rounded-xl bg-red-50 border border-red-200 px-4 py-3 text-sm text-red-700">
                                {{ $pesanSubmit }}
                            </div>
                        @endif

                        <div>
                            <label for="nama" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Lengkap</label>
                            <input id="nama" type="text" wire:model="nama"
                                class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none transition">
                            @error('nama') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="asal_smp" class="block text-sm font-medium text-slate-700 mb-1.5">Asal SMP</label>
                            <input id="asal_smp" type="text" wire:model="asal_smp"
                                class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none transition">
                            @error('asal_smp') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div>
                            <label for="alamat" class="block text-sm font-medium text-slate-700 mb-1.5">Alamat</label>
                            <textarea id="alamat" rows="3" wire:model="alamat"
                                class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none transition"></textarea>
                            @error('alamat') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <div class="grid grid-cols-1 sm:grid-cols-2 gap-4">
                            <div>
                                <label for="nama_ortu" class="block text-sm font-medium text-slate-700 mb-1.5">Nama Orang Tua</label>
                                <input id="nama_ortu" type="text" wire:model="nama_ortu"
                                    class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none transition">
                                @error('nama_ortu') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                            <div>
                                <label for="no_wa" class="block text-sm font-medium text-slate-700 mb-1.5">Nomor WhatsApp</label>
                                <input id="no_wa" type="text" inputmode="numeric" wire:model="no_wa" placeholder="08xxxxxxxxxx"
                                    class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none transition">
                                @error('no_wa') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
                            </div>
                        </div>

                        {{-- Upload scan KK --}}
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Scan Kartu Keluarga</label>
                            <label class="flex flex-col items-center justify-center gap-1.5 rounded-xl border-2 border-dashed border-slate-300 px-4 py-6 text-center cursor-pointer hover:border-emerald-400 hover:bg-emerald-50/40 transition">
                                <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 text-slate-400" fill="none" viewBox="0 0 24 24" stroke-width="1.5" stroke="currentColor">
                                    <path stroke-linecap="round" stroke-linejoin="round" d="M12 16.5V9.75m0 0l-3.75 3.75M12 9.75l3.75 3.75M6.75 19.5a4.5 4.5 0 01-1.41-8.775 5.25 5.25 0 0110.233-2.33 3 3 0 013.758 3.848A3.752 3.752 0 0118 19.5H6.75z" />
                                </svg>
                                <span class="text-sm text-slate-600">
                                    @if ($scan_kk)
                                        {{ $scan_kk->getClientOriginalName() }}
                                    @else
                                        Ketuk untuk unggah foto/scan KK
                                    @endif
                                </span>
                                <span class="text-xs text-slate-400">JPG/PNG, maks 4MB</span>
                                <input type="file" wire:model="scan_kk" accept="image/*" class="hidden">
                            </label>
                            <div wire:loading wire:target="scan_kk" class="mt-1.5 text-xs text-slate-400">Mengunggah file...</div>
                            @error('scan_kk') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        {{-- Pencarian murid pendamping --}}
                        <div>
                            <label class="block text-sm font-medium text-slate-700 mb-1.5">Murid Pendamping</label>

                            @if ($pendamping_id)
                                <div class="flex items-center justify-between rounded-xl bg-emerald-50 border border-emerald-200 px-4 py-2.5">
                                    <span class="text-sm text-emerald-800 font-medium">{{ $pendamping_nama }}</span>
                                    <button type="button" wire:click="batalPendamping" class="text-xs font-medium text-emerald-700 hover:text-emerald-900">
                                        Ganti
                                    </button>
                                </div>
                            @else
                                <div class="relative">
                                    <input
                                        type="text"
                                        wire:model.live.debounce.300ms="carianPendamping"
                                        placeholder="Ketik nama murid aktif..."
                                        class="w-full rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none transition"
                                    >
                                    <div wire:loading wire:target="carianPendamping" class="absolute right-3 top-1/2 -translate-y-1/2 text-xs text-slate-400">
                                        Mencari...
                                    </div>

                                    @if (strlen($carianPendamping) >= 2)
                                        <div class="mt-1.5 rounded-xl border border-slate-200 divide-y divide-slate-100 overflow-hidden">
                                            @forelse ($this->hasilPendamping as $murid)
                                                <button
                                                    type="button"
                                                    wire:click="pilihPendamping({{ $murid->id }})"
                                                    class="w-full text-left px-4 py-2.5 text-sm hover:bg-slate-50 transition"
                                                >
                                                    <span class="font-medium text-slate-800">{{ $murid->nama }}</span>
                                                    <span class="text-slate-400"> — {{ optional($murid->kelas)->nama ?? '-' }}</span>
                                                </button>
                                            @empty
                                                <div class="px-4 py-2.5 text-sm text-slate-400">Murid tidak ditemukan.</div>
                                            @endforelse
                                        </div>
                                    @endif
                                </div>
                            @endif
                            @error('pendamping_id') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        {{-- Captcha sederhana --}}
                        <div>
                            <label for="captcha" class="block text-sm font-medium text-slate-700 mb-1.5">
                                Verifikasi: berapa {{ $captchaA }} + {{ $captchaB }}?
                            </label>
                            <input
                                id="captcha"
                                type="text"
                                inputmode="numeric"
                                wire:model="captchaJawaban"
                                placeholder="Jawaban"
                                class="w-full sm:w-40 rounded-xl border border-slate-300 px-4 py-2.5 text-sm focus:border-emerald-500 focus:ring-2 focus:ring-emerald-100 outline-none transition"
                            >
                            @error('captchaJawaban') <p class="mt-1.5 text-sm text-red-600">{{ $message }}</p> @enderror
                        </div>

                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            wire:target="submit"
                            class="w-full inline-flex items-center justify-center gap-2 rounded-xl bg-emerald-600 px-5 py-3 text-sm font-semibold text-white hover:bg-emerald-700 disabled:opacity-60 transition"
                        >
                            <span wire:loading.remove wire:target="submit">Kirim Pendaftaran</span>
                            <span wire:loading wire:target="submit">Menyimpan...</span>
                        </button>
                    </form>
                @endif
            @endif
        </div>
    </div>
</div>