<x-main-layout :title-page="__('Tambah Kunjungan')">  
    <div class="row">
        <div class="form-kunjungan-container">
            <form class="card" action="{{ route('kunjungan.store') }}" method="POST">
                <div class="card-body">
                    @include('kunjungan.partials._form')
                </div>
            </form>
        </div>
    </div>
</x-main-layout>