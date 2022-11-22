 @if (session()->has('success'))
     <x-alert type="success" message="{{ session()->get('success') }}">
         <x-slot:icon>
             <i class="bi bi-check-circle-fill"></i>
         </x-slot:icon>
     </x-alert>
     @php
         session()->forget('success');
     @endphp
 @endif



 @if (session()->has('info'))
     <x-alert type="info" message="{{ session()->get('info') }}">
         <x-slot:icon>
             <i class="bi bi-info-circle-fill"></i>
         </x-slot:icon>
     </x-alert>


     @php
         session()->forget('info');
     @endphp
 @endif



 @if (session()->has('warning'))
     <x-alert type="warning" message="{{ session()->get('warning') }}">
         <x-slot:icon>
             <i class="bi bi-exclamation-circle-fill"></i>
         </x-slot:icon>
     </x-alert>
     @php
         session()->forget('warning');
     @endphp
 @endif



 @if (session()->has('error'))
     <x-alert type="danger" message="{{ session()->get('error') }}">
         <x-slot:icon>
             <i class="bi bi-x-circle-fill"></i>
         </x-slot:icon>
     </x-alert>
     @php
         session()->forget('error');
     @endphp
 @endif


 <script>
     var alertList = document.querySelectorAll('.alert');

     alertList.forEach(function(alert) {
         new bootstrap.Alert(alert);
     });
 </script>
