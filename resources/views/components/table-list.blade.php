<div class="table-responsive">
    <table {{ $attributes->merge(['class' => 'table table-hover table-bordered']) }}>
        <thead>
            {{ $header }}
        </thead>
        <tbody>
            {{ $slot }}
        </tbody>
    </table>
</div>