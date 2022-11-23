@extends('layouts.app')


@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <!-- Page pre-title -->
                    <div class="page-pretitle">
                        Manage
                    </div>
                    <h2 class="page-title">
                        Employee
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-new-employee">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            New Employee
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- cek datatable -->
    <div class="container mt-3">
        <div class="card">

            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>


    <!-- x-modal item -->
    <!-- 1. ganti modal id
    2. sesuaikan form -->
    <x-modal id="modal-new-employee">
        <x-slot:title>New Employee</x-slot:title>
        <form action="{{ route('employees.store') }}" method="POST">
            @csrf
            <x-input id="name" name="name" label="Name" placeholder="Name" />
            <x-input id="phone_number" name="phone_number" label="Phone" placeholder="Phone" type="number"/>
            <x-input id="address" name="address" label="Address" placeholder="Address" />
            <x-input id="position" name="position" label="Position" placeholder="Position" />

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-modal>

{{-- modal edit --}}
    <x-modal id="modal-edit-employee">
        <x-slot:title>Edit</x-slot:title>
        <form method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-input id="name" name="name" label="Name" placeholder="Name" />
            <x-input id="phone_number" name="phone_number" label="Phone" placeholder="Phone" type="number"/>
            <x-input id="address" name="address" label="Address" placeholder="Address" />
            <x-input id="position" name="position" label="Position" placeholder="Position" />

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-modal>

    {{-- script --}} 
    <script>
        var exampleModal = document.getElementById('modal-edit-employee')
        exampleModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var data = button.getAttribute('data-bs-employee')
            data = data.replace(/'/g, '"');
            var json = JSON.parse(data);

            var inputName = document.getElementById('modal-edit-employee').querySelector('#name');
            var inputPhone = document.getElementById('modal-edit-employee').querySelector('#phone_number');
            var inputAddress = document.getElementById('modal-edit-employee').querySelector('#address');
            var inputPosition = document.getElementById('modal-edit-employee').querySelector('#position');

            inputName.value = json.name;
            inputPhone.value = json.phone_number;
            inputAddress.value = json.address;
            inputPosition.value = json.position;

            var modalTitle = exampleModal.querySelector('.modal-title')

            modalTitle.textContent = 'Edit ' + json.name
            
            // set action to form
            var modalForm = document.getElementById('modal-edit-employee').querySelector('form');
            modalForm.action = "{{ route('employees.update', '') }}/" + json.id;
            modalForm.method = "PUT";
        })
    </script>


    <!-- end section -->
@endsection

<!-- push script -->
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
