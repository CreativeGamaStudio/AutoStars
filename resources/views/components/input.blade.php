<div class="mb-3">
    <label for="{{ $attributes->get('id') }}" class="form-label">{{ $attributes->get('label') }}</label>
    <input type="{{ $attributes->get('type') ?? "text" }}" class="form-control" id="{{ $attributes->get('id') }}" name="{{ $attributes->get('name') }}"
        placeholder="{{ $attributes->get('placeholder') }}">

</div>
