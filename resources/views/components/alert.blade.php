 <div class="alert alert-{{ $attributes->get('type') }} alert-dismissible d-flex align-items-center position-absolute top-0 start-50 translate-middle-x mt-3"
     role="alert">
     <div class="px-2">
         {{ $icon }}
     </div>
     <div>
         {{-- Attribute Message --}}
         {{ $attributes->get('message') }}
     </div>
 </div>
