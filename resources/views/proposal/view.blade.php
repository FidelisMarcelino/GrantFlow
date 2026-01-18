<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Detail Proposal') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-4xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 shadow-sm sm:rounded-lg p-6">

                <div class="mb-4">
                    <p class="text-sm text-gray-500">Judul</p>
                    <p class="text-lg font-semibold text-gray-900 dark:text-white">
                        {{ $proposal->title }}
                    </p>
                </div>

                <div class="mb-4">
                    <p class="text-sm text-gray-500">Jumlah Dana</p>
                    <p class="text-gray-900 dark:text-white">
                        Rp {{ number_format($proposal->amount, 0, ',', '.') }}
                    </p>
                </div>

                <div class="mb-4">
                    <p class="text-sm text-gray-500">Tanggal Mulai</p>
                    <p class="text-gray-900 dark:text-white">
                        {{ $proposal->start_date->format('d/m/Y') }}
                    </p>
                </div>

                <div class="mb-6">
                    <p class="text-sm text-gray-500">Status</p>
                    <span class="px-3 py-1 rounded text-sm font-semibold
                        @if ($proposal->status === 'draft') bg-gray-200 text-gray-800
                        @elseif ($proposal->status === 'submitted') bg-yellow-200 text-yellow-800
                        @elseif ($proposal->status === 'approved') bg-green-200 text-green-800
                        @elseif ($proposal->status === 'rejected') bg-red-200 text-red-800
                        @endif
                    ">
                        {{ ucfirst($proposal->status) }}
                    </span>
                </div>

                <div class="flex gap-3">
                    @if ($proposal->status === 'draft')
                        <a href="{{ route('proposal.edit', $proposal) }}"
                           class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">
                            Edit
                        </a>
                    @endif

                    <a href="{{ route('proposal.index') }}"
                       class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">
                        Kembali
                    </a>
                </div>

            </div>
        </div>
    </div>
</x-app-layout>
