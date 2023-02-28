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
                        Service
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <!-- data-bs-target diganti ex #modal-new-nama -->
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-new-service">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            New Service
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
    <x-modal id="modal-new-service">
        <x-slot:title>New Service</x-slot:title>
        <form action="{{ route('services.store') }}" method="POST">
            @csrf
            <x-input id="name" name="name" label="Name" placeholder="Name" />
            <x-input id="cost" name="cost" label="Cost" placeholder="Cost" type="number" />

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-modal>

    <!-- x-modal item -->
    <!-- 1. ganti modal id
            2. sesuaikan form -->
    {{-- edit form --}}
    <x-modal id="modal-edit-service">
        <x-slot:title>Edit</x-slot:title>
        {{ Form::open(['url' => '/', 'method' => 'PUT', 'class' => 'col-md-12']) }}
        <input type="hidden" name="_method" value="PUT" />
        @csrf
        <x-input id="name" name="name" label="Name" placeholder="Name" type="text" />
        <x-input id="cost" name="cost" label="Cost" placeholder="Cost" type="number" />

        <button type="submit" class="btn btn-primary">Submit</button>
        {{ Form::close() }}
    </x-modal>

    {{-- script edit --}}
    <script>
        var exampleModal = document.getElementById('modal-edit-service')
        exampleModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var data = button.getAttribute('data-bs-item')
            console.log(data);
            data = data.replace(/'/g, '"');
            var json = JSON.parse(data);;

            var inputName = document.getElementById('modal-edit-service').querySelector('#name');
            var inputCost = document.getElementById('modal-edit-service').querySelector('#cost');

            inputName.value = json.name;
            inputCost.value = json.cost;

            var modalTitle = exampleModal.querySelector('.modal-title')

            modalTitle.textContent = 'Edit ' + json.name

            // set action to form
            var modalForm = document.getElementById('modal-edit-service').querySelector('form');
            modalForm.action = "/services/" + json.id;
        })
    </script>

    <x-modal id="modal-delete-service" size="sm">
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
        <form action="{{ route('services.destroy', 'id') }}" method="post">
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
        var exampleModal = document.getElementById('modal-delete-service')
        var modalBodyInput = document.getElementById('id')
        exampleModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var recipient = button.getAttribute('data-bs-ids')
            console.log(recipient)
            modalBodyInput.value = recipient
        })
    </script>

    

    <!-- end section -->
@endsection

<!-- push script -->
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
