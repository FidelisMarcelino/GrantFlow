<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Daftar Review') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            @if ($proposals->count() > 0)
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Judul</th>
                                    <th scope="col" class="px-6 py-3">Dosen</th>
                                    <th scope="col" class="px-6 py-3">Dana (Rp)</th>
                                    <th scope="col" class="px-6 py-3">Tanggal Mulai</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($proposals as $proposal)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                            {{ $proposal->title }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $proposal->user->name }}
                                        </td>
                                        <td class="px-6 py-4">
                                            Rp {{ number_format($proposal->amount, 0, ',', '.') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            {{ $proposal->start_date->format('d/m/Y') }}
                                        </td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 rounded text-xs font-semibold
                                                @if ($proposal->status === 'submitted') bg-yellow-200 text-yellow-800
                                                @elseif ($proposal->status === 'approved') bg-green-200 text-green-800
                                                @elseif ($proposal->status === 'rejected') bg-red-200 text-red-800
                                                @else bg-gray-200 text-gray-800
                                                @endif
                                            ">
                                                {{ ucfirst($proposal->status) }}
                                            </span>
                                        </td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('reviews.show', $proposal) }}" class="text-blue-600 hover:underline font-semibold">Review</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @else
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                    <div class="p-6 text-gray-500 dark:text-gray-400 text-center">
                        <p>Tidak ada proposal yang menunggu review.</p>
                    </div>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>