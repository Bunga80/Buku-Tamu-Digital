<button {{ $attributes->merge([
        'type' => 'submit', 
        'class' => 'btn btn-primary'
    ]) }}
    style="
        background-color: #28A745 !important;
        color: #FFFFFF !important;
        font-size: 20px !important;
        font-weight: 700 !important;
        padding: 15px 40px !important;
        border: none !important;
        border-radius: 15px !important;
        width: 100% !important;
    "
>
    {{ $slot }}
</button>
