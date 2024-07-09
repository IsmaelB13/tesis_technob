@if ($errors->any())
    <div {{ $attributes }}>
        <div class="font-medium text-red-600">{{ __('Datos Ingresados incorrectamente') }}</div>

    </div>
@endif
