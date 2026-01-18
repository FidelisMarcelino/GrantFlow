<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Daftar Proposal untuk Review</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto">
        <div class="bg-white shadow rounded p-6">
            @if ($proposals->count())
                <table class="w-full text-sm">
                    <thead>
                        <tr>
                            <th>Judul</th>
                            <th>Dosen</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($proposals as $proposal)
                        <tr class="border-t">
                            <td>{{ $proposal->title }}</td>
                            <td>{{ $proposal->user->name }}</td>
                            <td>
                                <a href="{{ route('reviews.show', $proposal) }}" class="text-blue-600">View</a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            @else
                <p>Tidak ada proposal untuk direview.</p>
            @endif
        </div>
    </div>
</x-app-layout>
