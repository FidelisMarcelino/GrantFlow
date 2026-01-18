<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Dosen') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Card: Total Proposal -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Total Proposal</div>
                    <div class="text-3xl font-bold text-gray-900 dark:text-gray-100 mt-2">{{ $totalProposals }}</div>
                </div>

                <!-- Card: Draft -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Masih Draft</div>
                    <div class="text-3xl font-bold text-gray-500 mt-2">{{ $draftProposals }}</div>
                </div>

                <!-- Card: Menunggu Review -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Menunggu Review</div>
                    <div class="text-3xl font-bold text-yellow-500 mt-2">{{ $submittedProposals }}</div>
                </div>
            </div>

            <!-- Action Button -->
            <div class="mb-6">
                <a href="{{ route('proposal.create') }}" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    + Buat Proposal Baru
                </a>
            </div>

            <!-- Recent Proposals -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Proposal Terbaru Saya</h3>
                </div>
                
                @if ($recentProposals->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Judul</th>
                                    <th scope="col" class="px-6 py-3">Dana (Rp)</th>
                                    <th scope="col" class="px-6 py-3">Status</th>
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($recentProposals as $proposal)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $proposal->title }}</td>
                                        <td class="px-6 py-4">Rp {{ number_format($proposal->amount, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">
                                            <span class="px-2 py-1 rounded text-xs font-semibold
                                                @if ($proposal->status === 'draft')
                                                    bg-gray-200 text-gray-800
                                                @elseif ($proposal->status === 'submitted')
                                                    bg-yellow-200 text-yellow-800
                                                @elseif ($proposal->status === 'approved')
                                                    bg-green-200 text-green-800
                                                @else
                                                    bg-red-200 text-red-800
                                                @endif
                                            ">
                                                {{ ucfirst($proposal->status) }}
                                            </span>
                                        </td>

                                        @if($proposal->status === 'draft')
                                            <td class="px-6 py-4">
                                                <a href="{{ route('proposal.edit', $proposal) }}" class="text-blue-600 hover:underline">Edit</a>
                                            </td>
                                        @else
                                            @if($proposal->status === 'submitted')
                                                <td class="px-6 py-4">
                                                    <span class="text-yellow-800 font-semibold">Menunggu Review</span>
                                                </td>
                                            @else
                                                <td class="px-6 py-4">
                                                    <a href="{{ route('proposal.view', $proposal) }}" class="text-blue-600 hover:underline">View</a>
                                                </td>
                                            @endif
                                        @endif
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-6 text-gray-500 dark:text-gray-400 text-center">
                        Belum ada proposal. <a href="{{ route('proposal.create') }}" class="text-blue-600 hover:underline">Buat sekarang</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>