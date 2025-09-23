<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8 px-4">
    <div class="max-w-4xl mx-auto">
        <div class="bg-blue rounded-xl shadow-lg overflow-hidden border border-gray-200">
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-white">
                <h1 class="text-3xl font-bold flex items-center gap-3">
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Form Tes Fisik
                </h1>
                <p class="text-blue-100 text-lg mt-2">
                    Silakan isi formulir tes fisik di bawah.
                </p>
            </div>
            
            <!-- PIN Input Section -->
            <div id="pin-section" class="p-8 flex flex-col items-center">
                <label for="pin-input" class="mb-2 text-lg font-semibold text-blue-700">Masukkan PIN untuk mengakses formulir:</label>
                <input id="pin-input" type="password" class="border border-blue-300 rounded px-4 py-2 mb-3 focus:outline-none focus:ring-2 focus:ring-blue-400" placeholder="PIN" />
                <button onclick="checkPin()" class="bg-blue-600 hover:bg-blue-700 text-blue font-semibold px-6 py-2 rounded shadow transition-all duration-200">Submit PIN</button>
                <span id="pin-error" class="text-red-500 mt-2 hidden">PIN salah, coba lagi.</span>
            </div>

            <!-- Form Content (hidden by default) -->
            <div id="form-content" class="p-1 hidden">
                <form wire:submit="create" class="space-y-8">
                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-100">
                        {{ $this->form }}
                    </div>
                    <div class="flex justify-center pt-6 pb-6">
                        <button type="submit" class="flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-semibold py-3 px-8 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 text-lg">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Kirim Tes Fisik
                        </button>
                    </div>
                </form>
            </div>
            
            <div class="bg-gray-50 px-8 py-5 text-sm text-gray-600 border-t border-gray-200">
                <div class="flex items-center justify-between">
                    <span class="text-base">© 2025 SMK Muh Mungkid</span>
                </div>
            </div>
        </div>
        <x-filament-actions::modals />
    </div>
</div>

<script>
    // Ganti PIN sesuai kebutuhan
    const CORRECT_PIN = '1972';

    function checkPin() {
        const pinInput = document.getElementById('pin-input').value;
        const errorMsg = document.getElementById('pin-error');
        if (pinInput === CORRECT_PIN) {
            document.getElementById('pin-section').style.display = 'none';
            document.getElementById('form-content').classList.remove('hidden');
        } else {
            errorMsg.classList.remove('hidden');
        }
    }
</script>