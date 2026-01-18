<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard Reviewer') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-6">
                <!-- Card: Menunggu Review -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Menunggu Review</div>
                    <div class="text-3xl font-bold text-yellow-500 mt-2">{{ $pendingReviews }}</div>
                </div>

                <!-- Card: Sudah Di-Approve -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Disetujui</div>
                    <div class="text-3xl font-bold text-green-500 mt-2">{{ $approvedReviews }}</div>
                </div>

                <!-- Card: Ditolak -->
                <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg p-6">
                    <div class="text-gray-600 dark:text-gray-400 text-sm font-semibold">Ditolak</div>
                    <div class="text-3xl font-bold text-red-500 mt-2">{{ $rejectedReviews }}</div>
                </div>
            </div>

            <!-- Pending Reviews -->
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Proposal Menunggu Review</h3>
                </div>
                
                @if ($pendingProposals->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Judul</th>
                                    <th scope="col" class="px-6 py-3">Dosen</th>
                                    <th scope="col" class="px-6 py-3">Dana (Rp)</th>
                                    <th scope="col" class="px-6 py-3">Tanggal Submit</th>
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($pendingProposals as $proposal)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $proposal->title }}</td>
                                        <td class="px-6 py-4">{{ $proposal->user->name }}</td>
                                        <td class="px-6 py-4">Rp {{ number_format($proposal->amount, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">{{ $proposal->updated_at->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('reviews.show', $proposal) }}" class="text-blue-600 hover:underline font-semibold">Review</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-6 text-gray-500 dark:text-gray-400 text-center">
                        Tidak ada proposal yang menunggu review saat ini.
                    </div>
                @endif
            </div>

            <!-- Proposal Disetujui -->
             <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-10">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Proposal Disetujui</h3>
                </div>

                @if ($approvedProposals->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Judul</th>
                                    <th scope="col" class="px-6 py-3">Dosen</th>
                                    <th scope="col" class="px-6 py-3">Dana (Rp)</th>
                                    <th scope="col" class="px-6 py-3">Tanggal Submit</th>
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($approvedProposals as $proposal)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $proposal->title }}</td>
                                        <td class="px-6 py-4">{{ $proposal->user->name }}</td>
                                        <td class="px-6 py-4">Rp {{ number_format($proposal->amount, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">{{ $proposal->updated_at->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('reviews.show', $proposal) }}" class="text-blue-600 hover:underline font-semibold">Review</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-6 text-gray-500 dark:text-gray-400 text-center">
                        Tidak ada proposal yang menunggu review saat ini.
                    </div>
                @endif
            </div>

            <!-- Proposal Ditolak -->
             <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg mt-10">
                <div class="p-6 border-b border-gray-200 dark:border-gray-700">
                    <h3 class="text-lg font-semibold text-gray-900 dark:text-gray-100">Proposal Ditolak</h3>
                </div>

                @if ($rejectedProposals->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full text-sm text-left text-gray-500 dark:text-gray-400">
                            <thead class="text-xs text-gray-700 uppercase bg-gray-50 dark:bg-gray-700 dark:text-gray-400">
                                <tr>
                                    <th scope="col" class="px-6 py-3">Judul</th>
                                    <th scope="col" class="px-6 py-3">Dosen</th>
                                    <th scope="col" class="px-6 py-3">Dana (Rp)</th>
                                    <th scope="col" class="px-6 py-3">Tanggal Submit</th>
                                    <th scope="col" class="px-6 py-3">Aksi</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($rejectedProposals as $proposal)
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700 hover:bg-gray-50 dark:hover:bg-gray-900">
                                        <td class="px-6 py-4 font-medium text-gray-900 dark:text-white">{{ $proposal->title }}</td>
                                        <td class="px-6 py-4">{{ $proposal->user->name }}</td>
                                        <td class="px-6 py-4">Rp {{ number_format($proposal->amount, 0, ',', '.') }}</td>
                                        <td class="px-6 py-4">{{ $proposal->updated_at->format('d/m/Y') }}</td>
                                        <td class="px-6 py-4">
                                            <a href="{{ route('reviews.show', $proposal) }}" class="text-blue-600 hover:underline font-semibold">Review</a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="p-6 text-gray-500 dark:text-gray-400 text-center">
                        Tidak ada proposal yang menunggu review saat ini.
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>