<x-main-layout :title="__('Edit User')">
    <div class="row justify-content-center">
        <form class="card col-lg-6 col-md-8" action="{{ route('user.update', $user->id) }}" method="POST">
            <div class="card-body">
                @method('PUT')
                @include('user.partials._form', ['update' => true])
            </div>
        </form>
    </div>
</x-main-layout>