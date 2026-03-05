<x-main-layout :title-page="__('Tambah User')">
    <div class="row justify-content-center">
        <form class="card col-lg-6 col-md-8" action="{{ route('user.store') }}" method="POST">
            <div class="card-body">
                @include('user.partials._form', ['roles' => $roles])
            </div>
        </form>
    </div>
</x-main-layout>