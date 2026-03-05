<x-main-layout :title-page="__('Kunjungan')">
    <div class="card">
        <div class="card-body">
            @include('kunjungan.partials.toolbar')

            <x-notif-alert class="mt-4" />
        </div>

        @include('kunjungan.partials.list-kunjungan')

        <div class="card-body">
            {{ $kunjungans->links() }}
        </div>
    </div>
</x-main-layout>