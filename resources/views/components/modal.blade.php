<!-- Cek id, arialabel, dan $slot -->
<div class="modal modal-blur modal-fade-show" id="{{ $attributes->get('id') }}" aria-labelledby="{{ $attributes->get('id') }}-label"
    aria-modal="true" role="dialog">
    <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="{{ $attributes->get('id') }}-label">{{ $title }}</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body" id="{{ $attributes->get('id') }}-body">
                {{ $slot }}
            </div>
        </div>
    </div>
</div>