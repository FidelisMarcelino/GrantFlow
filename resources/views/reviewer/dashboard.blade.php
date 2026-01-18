<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl">Dashboard Reviewer</h2>
    </x-slot>

    <div class="py-12 max-w-7xl mx-auto">
        <div class="bg-white p-6 rounded shadow">
            <p>Selamat datang Reviewer 👋</p>
            <a href="{{ route('reviews.index') }}"
               class="text-blue-600 underline mt-3 inline-block">
                Lihat Proposal untuk Direview
            </a>
        </div>
    </div>
</x-app-layout>
