<div class="min-h-screen bg-gradient-to-br from-blue-50 to-indigo-100 py-8 px-4">
    <div class="max-w-4xl mx-auto"> <!-- Increased width from max-w-2xl to max-w-4xl -->
        <!-- Form Card -->
        <div class="bg-blue rounded-xl shadow-lg overflow-hidden border border-gray-200">
            <!-- Header with improved contrast -->
            <div class="bg-gradient-to-r from-blue-600 to-indigo-700 p-8 text-white"> <!-- Darker gradient for better contrast -->
                <h1 class="text-3xl font-bold flex items-center gap-3"> <!-- Larger text -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                    </svg>
                    Form Tes Fisik
                </h1>
                <p class="text-blue-100 text-lg mt-2"> <!-- Larger text with better contrast -->
                    Silakan isi formulir tes fisik di bawah.
                </p>
            </div>
            
            <!-- Form Content -->
            <div class="p-1"> <!-- Increased padding -->
                <form wire:submit="create" class="space-y-8"> <!-- Increased spacing -->
                    <!-- Form Fields Container -->
                    <div class="bg-blue-50 p-6 rounded-lg border border-blue-100"> <!-- Increased padding -->
                        {{ $this->form }}
                    </div>
                    
                    <!-- Submit Button -->
                    <div class="flex justify-center pt-6 pb-6"> <!-- Increased padding -->
                        <button type="submit" class="flex items-center justify-center gap-2 bg-gradient-to-r from-blue-600 to-indigo-700 hover:from-blue-700 hover:to-indigo-800 text-white font-semibold py-3 px-8 rounded-lg shadow-md hover:shadow-lg transition-all duration-200 text-lg"> <!-- Larger text -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            Kirim Tes Fisik
                        </button>
                    </div>
                </form>
            </div>
            
            <!-- Footer -->
            <div class="bg-gray-50 px-8 py-5 text-sm text-gray-600 border-t border-gray-200"> <!-- Increased padding -->
                <div class="flex items-center justify-between">
                    <span class="text-base">© 2025 SMK Muh Mungkid</span> <!-- Slightly larger text -->
                    {{-- <div class="flex items-center gap-6"> <!-- Increased gap -->
                        <a href="#" class="hover:text-blue-600 transition-colors font-medium">Help</a> <!-- Bolder links -->
                        <a href="#" class="hover:text-blue-600 transition-colors font-medium">Privacy</a>
                        <a href="#" class="hover:text-blue-600 transition-colors font-medium">Terms</a>
                    </div> --}}
                </div>
            </div>
        </div>
        
        <!-- Modals -->
        <x-filament-actions::modals />
    </div>
</div>