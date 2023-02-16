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
                        Registration
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <!-- data-bs-target diganti ex #modal-new-nama -->
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-new-registration">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            New Registration
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
    <x-modal id="modal-new-registration">
        <x-slot:title>New Registration</x-slot:title>
        <form action="{{ route('registrations.store') }}" method="POST">
            @csrf
            <x-input id="barcode" name="barcode" label="Barcode" placeholder="Barcode" />
            <x-input id="police_number" name="police_number" label="Police Mumber" placeholder="Police Mumber" />
            <x-input id="date" name="date" label="Date" placeholder="Date" type="date"/>
            <x-input id="odometer" name="odometer" label="Odometer" placeholder="Odometer" type="number"/>
            <x-input id="pkb_flag" name="pkb_flag" label="PKB Flag" placeholder="PKB Flag" type="number"/>
            <x-input id="status" name="status" label="Status" placeholder="Status"/>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-modal>

    <x-modal id="modal-edit-registration">
        <x-slot:title>Edit</x-slot:title>
        <form method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <x-input id="barcode" name="barcode" label="Barcode" placeholder="Barcode" />
            <x-input id="police_number" name="police_number" label="Police Mumber" placeholder="Police Mumber" />
            <x-input id="date" name="date" label="Date" placeholder="Date" type="date"/>
            <x-input id="odometer" name="odometer" label="Odometer" placeholder="Odometer" type="number"/>
            <x-input id="pkb_flag" name="pkb_flag" label="PKB Flag" placeholder="PKB Flag" type="number"/>
            <x-input id="status" name="status" label="Status" placeholder="Status"/>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-modal>

    {{-- script --}} 
    <script>
        var exampleModal = document.getElementById('modal-edit-registration')
        exampleModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var data = button.getAttribute('data-bs-registration')
            data = data.replace(/'/g, '"');
            var json = JSON.parse(data);

            var inputBarcode = exampleModal.getElementById('modal-edit-registration').querySelector('#barcode');
            var inputPolice= document.getElementById('modal-edit-registration').querySelector('#police_number');
            var inputDate = document.getElementById('modal-edit-registration').querySelector('#date');
            var inputOdometer = document.getElementById('modal-edit-registration').querySelector('#odometer');
            var inputPkbFlag = document.getElementById('modal-edit-registration').querySelector('#pkb_flag');
            var inputStatus = document.getElementById('modal-edit-registration').querySelector('#status');

            inputBarcode.value = json.barcode;
            inputPolice.value = json.police_number;
            inputDate.value = json.date;
            inputOdometer.value = json.odometer;
            inputPkbFlag.value = json.pkb_flag;
            inputStatus.value = json.status;

            var modalTitle = exampleModal.querySelector('.modal-title')

            modalTitle.textContent = 'Edit ' + json.name
            
            // set action to form
            var modalForm = document.getElementById('modal-edit-registration').querySelector('form');
            modalForm.action = "{{ route('registrations.update', '') }}/" + json.id;
            modalForm.method = "PUT";
        })
    </script>

    <!-- end section -->
@endsection

<!-- push script -->
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
