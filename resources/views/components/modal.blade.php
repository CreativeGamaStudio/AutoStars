
@props(['size' => 'sm', 'md', 'lg'])
<!-- Cek id, arialabel, dan $slot -->
<div class="modal modal-blur modal-fade-show" id="{{ $attributes->get('id') }}" aria-labelledby="{{ $attributes->get('id') }}-label"
    aria-modal="true" role="dialog">
    <div {{ $attributes->merge(['class' => 'modal-dialog modal-dialog-centered modal-'.$size]) }}  role="document">
        <div class="modal-content">
            <div class="modal-header d-print-none">
                <h5 class="modal-title" id="{{ $attributes->get('id') }}-label">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="{{ $attributes->get('id') }}-body">
                {{ $slot }}
            </div>
<<<<<<< HEAD
            
=======
            @if (isset($footer))
            <div class="modal-footer d-print-none">
                {{$footer}}
            </div>
            @endif
>>>>>>> cdd8b53d1822a572a4659b02e25e76feaeabe8cc
        </div>
    </div>
</div>
