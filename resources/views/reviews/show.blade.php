<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Review Proposal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-3 gap-6">
                <!-- Detail Proposal -->
                <div class="col-span-2">
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 mb-6">
                        <h3 class="text-2xl font-bold text-gray-900 dark:text-gray-100 mb-4">{{ $proposal->title }}</h3>
                        
                        <div class="mb-6">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Diajukan oleh</p>
                            <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $proposal->user->name }} ({{ $proposal->user->email }})</p>
                        </div>

                        <div class="grid grid-cols-2 gap-6 mb-6">
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Jumlah Dana</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">Rp {{ number_format($proposal->amount, 0, ',', '.') }}</p>
                            </div>
                            <div>
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Tanggal Mulai</p>
                                <p class="text-lg font-semibold text-gray-900 dark:text-gray-100">{{ $proposal->start_date->format('d/m/Y') }}</p>
                            </div>
                        </div>

                        <div class="mb-6">
                            <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Deskripsi</p>
                            <p class="text-gray-900 dark:text-gray-100 whitespace-pre-wrap">{{ $proposal->description }}</p>
                        </div>
                    </div>
                </div>

                <!-- Form Review / Info Review -->
                <div>
                    <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6 sticky top-6">
                        
                        @if ($proposal->status === 'submitted')
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Berikan Review</h4>

                            <form action="{{ route('reviews.review', $proposal) }}" method="POST">
                                @csrf
                                
                                <div class="mb-4">
                                    <label for="status" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Status <span class="text-red-500">*</span>
                                    </label>
                                    <select id="status" name="status" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500" required>
                                        <option value="">Pilih Status</option>
                                        <option value="approved">✓ Setujui</option>
                                        <option value="rejected">✗ Tolak</option>
                                    </select>
                                    @error('status')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-6">
                                    <label for="reviewer_note" class="block text-sm font-medium text-gray-700 dark:text-gray-300 mb-2">
                                        Catatan Review <span class="text-red-500">*</span>
                                    </label>
                                    <textarea id="reviewer_note" name="reviewer_note" rows="6" class="w-full px-4 py-2 border border-gray-300 dark:border-gray-600 rounded-lg bg-white dark:bg-gray-700 text-gray-900 dark:text-gray-100 focus:ring-blue-500 focus:border-blue-500" placeholder="Tulis catatan review Anda di sini..." required>{{ old('reviewer_note') }}</textarea>
                                    @error('reviewer_note')
                                        <span class="text-red-500 text-sm">{{ $message }}</span>
                                    @enderror
                                </div>

                                <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                                    Kirim Review
                                </button>
                            </form>
                        @else
                            <!-- Info Review untuk Approved/Rejected -->
                            <h4 class="text-lg font-semibold text-gray-900 dark:text-gray-100 mb-4">Informasi Review</h4>

                            <div class="mb-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Status</p>
                                <span class="px-3 py-1 rounded text-sm font-semibold
                                    @if ($proposal->status === 'approved') bg-green-200 text-green-800
                                    @elseif ($proposal->status === 'rejected') bg-red-200 text-red-800
                                    @endif
                                ">
                                    {{ ucfirst($proposal->status) }}
                                </span>
                            </div>

                            <div class="mb-4">
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Direview oleh</p>
                                <p class="text-gray-900 dark:text-gray-100">
                                    @if ($proposal->reviewer)
                                        {{ $proposal->reviewer->name }}
                                    @else
                                        -
                                    @endif
                                </p>
                            </div>

                            <div class="mb-6">
                                <p class="text-sm text-gray-600 dark:text-gray-400 mb-2">Catatan Review</p>
                                <p class="text-gray-900 dark:text-gray-100 whitespace-pre-wrap text-sm">{{ $proposal->reviewer_note }}</p>
                            </div>
                        @endif

                        <a href="{{ route('reviews.index') }}" class="block mt-3 text-center text-gray-600 dark:text-gray-400 hover:text-gray-900 dark:hover:text-gray-100 text-sm">
                            Kembali ke Daftar
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>