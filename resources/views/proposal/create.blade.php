<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="">
        <div class="ml-6 mt-6 text-3xl font-bold text-gray-900 dark:text-gray-100">
            {{ __("Buat Proposal Baru") }}
        </div>

        <form class="flex flex-col px-6" action="{{ route('proposal.store') }}" method="POST">
            @csrf
            <div class="mb-3 flex flex-col">
                <label for="title" class="text-white font-semibold">Judul Proposal <span class="text-red-500">*</span></label>
                <input type="text" class="text-black rounded-lg" id="title" name="title" value="{{ old('title') }}" required>
                @error('title')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 flex flex-col">
                <label for="description" class=" text-white font-semibold">Latar Belakang & Deskripsi <span class="text-red-500">*</span></label>
                <textarea class="text-black rounded-lg" id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                @error('description')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <p class="text-white font-medium">--- Informasi Pendanaan & Waktu ---</p>

            <div class="mb-3 flex flex-col">
                <label for="amount" class=" text-white font-semibold">Nominal Dana (Rp) <span class="text-red-500">*</span></label>
                <input type="number" class="text-black rounded-lg" id="amount" name="amount" placeholder="Rp" value="{{ old('amount') }}" required>
                @error('amount')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="mb-3 flex flex-col">
                <label for="start_date" class=" text-white font-semibold">Estimasi Tanggal <span class="text-red-500">*</span></label>
                <input type="date" class="text-black rounded-lg" id="start_date" name="start_date" value="{{ old('start_date') }}" required>
                @error('start_date')
                    <span class="text-red-500 text-sm">{{ $message }}</span>
                @enderror
            </div>

            <div class="flex gap-4 mb-5">
                <button type="submit" class="border rounded-md p-2 text-white bg-blue-600 hover:bg-blue-700">Simpan</button>
                <a href="{{ route('proposal.index') }}" class="border rounded-md p-2 text-white bg-gray-600 hover:bg-gray-700">Batal</a>
            </div>
        </form>
    </div>
</x-app-layout>