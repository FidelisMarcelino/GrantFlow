<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200">
            Edit Proposal
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-3xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <form method="POST" action="{{ route('proposal.update', $proposal) }}">
                    @csrf
                    @method('PUT')

                    <!-- Judul -->
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Judul</label>
                        <input type="text" name="title"
                            class="w-full rounded border-gray-300"
                            value="{{ old('title', $proposal->title) }}">
                        @error('title') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <!-- Deskripsi -->
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Deskripsi</label>
                        <textarea name="description" rows="5"
                            class="w-full rounded border-gray-300">{{ old('description', $proposal->description) }}</textarea>
                        @error('description') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <!-- Amount -->
                    <div class="mb-4">
                        <label class="block font-medium mb-1">Jumlah Dana</label>
                        <input type="number" name="amount"
                            class="w-full rounded border-gray-300"
                            value="{{ old('amount', $proposal->amount) }}">
                        @error('amount') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <!-- Start Date -->
                    <div class="mb-6">
                        <label class="block font-medium mb-1">Tanggal Mulai</label>
                        <input type="date" name="start_date"
                            class="w-full rounded border-gray-300"
                            value="{{ old('start_date', $proposal->start_date->format('Y-m-d')) }}">
                        @error('start_date') <p class="text-red-500 text-sm">{{ $message }}</p> @enderror
                    </div>

                    <div class="flex justify-end gap-3">
                        <a href="{{ route('proposal.index') }}"
                           class="px-4 py-2 bg-gray-300 rounded">
                            Batal
                        </a>
                        <button type="submit"
                            class="px-4 py-2 bg-blue-600 text-white rounded">
                            Simpan Perubahan
                        </button>
                    </div>

                </form>

            </div>
        </div>
    </div>
</x-app-layout>
