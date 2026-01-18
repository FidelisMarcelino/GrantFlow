<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Review Proposal</h2>
    </x-slot>

    <div class="py-12 max-w-3xl mx-auto">
        <div class="bg-white shadow rounded p-6">

            <h3 class="text-lg font-bold mb-2">{{ $proposal->title }}</h3>
            <p class="mb-2">{{ $proposal->description }}</p>
            <p class="mb-2">Dana: Rp {{ number_format($proposal->amount) }}</p>
            <p class="mb-4">Tanggal Mulai: {{ $proposal->start_date->format('d/m/Y') }}</p>

            <form method="POST" action="{{ route('reviews.store', $proposal) }}">
                @csrf

                <div class="mb-4">
                    <label class="font-medium">Reviewer Note</label>
                    <textarea name="reviewer_note" class="w-full rounded" rows="4"></textarea>
                </div>

                <div class="flex gap-3">
                    <button name="status" value="approved"
                        class="px-4 py-2 bg-green-600 text-white rounded">
                        Approve
                    </button>

                    <button name="status" value="rejected"
                        class="px-4 py-2 bg-red-600 text-white rounded">
                        Reject
                    </button>
                </div>
            </form>

        </div>
    </div>
</x-app-layout>
