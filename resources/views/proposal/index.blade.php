<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Proposal Saya') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="mb-6">
                <a href="{{ route('proposal.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    + Buat Proposal Baru
                </a>
            </div>

            @if ($proposal->count() > 0)
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="overflow-x-auto">
                    <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                        <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                            <tr>
                                <th scope="col" class="px-6 py-3">Judul</th>
                                <th scope="col" class="px-6 py-3">Jumlah Dana (Rp)</th>
                                <th scope="col" class="px-6 py-3">Tanggal Mulai</th>
                                <th scope="col" class="px-6 py-3">Status</th>
                                <th scope="col" class="px-6 py-3">Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($proposal as $item)
                            <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                                <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">
                                    {{ $item->title }}
                                </td>
                                <td class="px-6 py-4">
                                    Rp {{ number_format($item->amount, 0, ',', '.') }}
                                </td>
                                <td class="px-6 py-4">
                                    {{ $item->start_date->format('d/m/Y') }}
                                </td>
                                <td class="px-6 py-4">
                                    <span class="px-2 py-1 rounded text-xs font-semibold
                                                @if ($item->status === 'draft')
                                                    bg-gray-200 text-gray-800
                                                @elseif ($item->status === 'submitted')
                                                    bg-yellow-200 text-yellow-800
                                                @elseif ($item->status === 'approved')
                                                    bg-green-200 text-green-800
                                                @elseif ($item->status === 'rejected')
                                                    bg-red-200 text-red-800
                                                @endif
                                            ">
                                        {{ ucfirst($item->status) }}
                                    </span>
                                </td>
                                <td class="px-6 py-4 flex gap-2">
                                    @if ($item->status === 'draft')
                                    <a href="{{ route('proposal.view', $item) }}" class="text-yellow-600 hover:underline">View</a>
                                    <a href="{{ route('proposal.edit', $item) }}" class="text-blue-600 hover:underline">Edit</a>
                                    <form action="{{ route('proposal.submit', $item) }}" method="POST" class="inline">
                                        @csrf
                                        <button type="submit" class="text-green-600 hover:underline">Submit</button>
                                    </form>

                                    @elseif ($item->status === 'submitted')
                                    <a href="{{ route('proposal.view', $item) }}" class="text-yellow-600 hover:underline">View</a>
                                    @endif

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
                    <p class="mb-4">Anda belum membuat proposal apapun.</p>
                    <a href="{{ route('proposal.create') }}" class="text-blue-600 hover:underline">Buat proposal pertama Anda sekarang</a>
                </div>
            </div>
            @endif
        </div>
    </div>
</x-app-layout>