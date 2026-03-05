<x-main-layout :title="__('Edit Kunjungan')">
    <div class="row">
        <form class="card" action="{{ route('kunjungan.update', $kunjungan->id) }}" method="POST">
            <div class="card-body">
                @csrf
                @method('PUT')
                @include('kunjungan.partials._form', ['update' => true])
            </div>
        </form>
    </div>
</x-main-layout>

@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif