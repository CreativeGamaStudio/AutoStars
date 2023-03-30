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
                        Vehicle
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <!-- data-bs-tabel diubah -->
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-new-vehicle">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            New Vehicle
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="container mt-3">
        <div class="card">
            <div class="card-body">
                {{ $dataTable->table() }}
            </div>
        </div>
    </div>

    <!-- {{-- modal new vehicle --}} -->
    <x-modal id="modal-new-vehicle">
        <x-slot:title>New Vehicle</x-slot:title>
        <form action="{{ route('vehicles.store') }}" method="POST">
            @csrf
            <x-input id="plate_number" name="plate_number" label="Plate Number" placeholder="Plate Number" />
            <x-input id="engine_number" name="engine_number" label="Engine Number" placeholder="Engine Number" />
            <x-input id="type" name="type" label="Type" placeholder="Type" />
            <x-input id="color" name="color" label="Color" placeholder="Color" />
            <x-input id="merk" name="merk" label="Merk" placeholder="Merk" />
            <x-input id="year" name="year" label="Year" placeholder="Year" />
        
            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-modal>


    {{-- edit form --}}
    <x-modal id="modal-edit-vehicle">
        <x-slot:title>Edit</x-slot:title>
        {{ Form::open(['url' => '/', 'method' => 'PUT', 'class' => 'col-md-12']) }}
        <input type="hidden" name="_method" value="PUT" />
        @csrf
            <input type="hidden" name="_method" value="PUT"/>
            <x-input id="plate_number" name="plate_number" label="Plate Number" placeholder="Plate Number" />
            <x-input id="engine_number" name="engine_number" label="Engine Number" placeholder="Engine Number" />
            <x-input id="type" name="type" label="Type" placeholder="Type" />
            <x-input id="color" name="color" label="Color" placeholder="Color" />
            <x-input id="merk" name="merk" label="Merk" placeholder="Merk" />
            <x-input id="year" name="year" label="Year" placeholder="Year" />
            <button type="submit" class="btn btn-primary">Submit</button>
        {{ Form::close()}}
    </x-modal>

    {{-- script edit --}}
    <script>
        var exampleModal = document.getElementById('modal-edit-vehicle')
        exampleModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var data = button.getAttribute('data-bs-item')
            console.log(data);
            data = data.replace(/'/g, '"');
            var json = JSON.parse(data);

            var inputPlateNumber = document.getElementById('modal-edit-vehicle').querySelector('#plate_number');
            var inputEngineNumber = document.getElementById('modal-edit-vehicle').querySelector('#engine_number');
            var inputType = document.getElementById('modal-edit-vehicle').querySelector('#type');
            var inputColor = document.getElementById('modal-edit-vehicle').querySelector('#color');
            var inputMerk = document.getElementById('modal-edit-vehicle').querySelector('#merk');
            var inputYear = document.getElementById('modal-edit-vehicle').querySelector('#year');

            inputPlateNumber = json.plate_number;
            inputEngineNumber = json.engine_number;
            inputType = json.type;
            inputColor = json.color;
            inputMerk = json.merk;
            inputYear = json.year;


            var modalTitle = exampleModal.querySelector('.modal-title')

            modalTitle.textContent = 'Edit ' + json.name

            // set action to form
            var modalForm = document.getElementById('modal-edit-vehicle').querySelector('form');
            modalForm.action = "/vehicles/" + json.id;
        })
    </script>
    
    {{-- Delete --}}
    <x-modal id="modal-delete-vehicle" size="sm">
        <x-slot:title>Delete</x-slot:title>
        <div class="modal-body text-center py-4">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon mb-2 text-danger icon-lg" width="24" height="24"
                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                <path d="M12 9v2m0 4v.01"></path>
                <path d="M5 19h14a2 2 0 0 0 1.84 -2.75l-7.1 -12.25a2 2 0 0 0 -3.5 0l-7.1 12.25a2 2 0 0 0 1.75 2.75">
                </path>
            </svg>
            <h3>Are you sure?</h3>
            <div class="text-muted">Apakah anda yakin ingin menghapus data ini?</div>
            {{-- <input id="dataId" type="text"/> --}}
        </div>
        <form action="{{ route('vehicles.destroy', 'id') }}" method="post">
            @csrf
            @method('DELETE')
            <input id="id" name="id" hidden>

            <div class="modal-footer">
                <div class="w-100">
                    <div class="row">
                        <div class="col"><a href="#" class="btn w-100" type="button" data-bs-dismiss="modal">
                                Cancel
                            </a></div>
                        <div class="col">
                            <button class="btn btn-danger w-100" type="submit">
                                Delete
                            </button>
                        </div>
                    </div>
                </div>
            </div>


        </form>
    </x-modal>

    {{-- script delete --}}
    <script>

        var exampleModal = document.getElementById('modal-delete-vehicle')
        var modalBodyInput = document.getElementById('id')
        exampleModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var recipient = button.getAttribute('data-bs-ids')
            console.log(recipient)
            modalBodyInput.value = recipient
        })
    </script>

@endsection

@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush