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
                        Users
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-new-user">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            New user
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

    <!-- {{-- modal new user --}} -->
    <x-modal id="modal-new-user">
        <x-slot:title>New User</x-slot:title>
        <form action="{{ route('users.store') }}" method="POST">
            @csrf
            <x-input id="name" name="name" label="Name" placeholder="Name" />
            <x-input id="email" name="email" label="Email" placeholder="Email" type="email" />
            <x-input id="password" name="password" label="Password" placeholder="Password" />
            <x-input id="password_confirmation" name="password_confirmation" label="Password Confirmation"
                placeholder="Password Confirmation" />
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role" placeholder="Pilih Peran">
                    <option value="admin">Admin</option>
                    <option value="user">user</option>
                </select>
            </div>
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-modal>


    {{-- modal edit user --}}
    <x-modal id="modal-edit-user">
        <x-slot:title>Edit</x-slot:title>
        {{ Form::open(array('url' => '/', 'method' => 'PUT', 'class'=>'col-md-12')) }}
            @csrf
            <input type="hidden" name="_method" value="PUT"/>
            <x-input id="name" name="name" label="Name" placeholder="Name" />
            <x-input id="email" name="email" label="Email" placeholder="Email" type="email" />
            <!-- <x-input id="password" name="password" label="Password" placeholder="Password" />
            <x-input id="password_confirmation" name="password_confirmation" label="Password Confirmation"
                placeholder="Password Confirmation" /> -->
            <div class="mb-3">
                <label for="role" class="form-label">Role</label>
                <select class="form-select" id="role" name="role" placeholder="Pilih Peran">
                    <option value="admin">Admin</option>
                    <option value="user">user</option>
                </select>
            </div>
            <!-- <x-input id="role" name="role" label="Role" placeholder="Role" /> -->
            <div class="mb-3">
                <label for="status" class="form-label">Status</label>
                <select class="form-select" id="status" name="status">
                    <option value="active">Active</option>
                    <option value="inactive">Inactive</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Submit</button>
        {{ Form::close()}}
    </x-modal>

    {{-- script --}}
    <script>
        var exampleModal = document.getElementById('modal-edit-user')
        exampleModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var data = button.getAttribute('data-bs-user')
            // console.log(data);
            data = data.replace(/'/g, '"');
            var json = JSON.parse(data);

            var inputName = document.getElementById('modal-edit-user').querySelector('#name');
            var inputEmail = document.getElementById('modal-edit-user').querySelector('#email');
            // var inputPass = document.getElementById('modal-edit-user').querySelector('#password');
            // var inputPassConf = document.getElementById('modal-edit-user').querySelector('#password_confirmation');
            var inputRole = document.getElementById('modal-edit-user').querySelector('#role');
            var inputStatus = document.getElementById('modal-edit-user').querySelector('#status');

            inputName.value = json.name;
            inputEmail.value = json.email;
            // inputPass.value = json.password;
            // inputPassConf.value = json.password_confirmation;
            inputRole.value = json.role;
            inputStatus.value = json.status;

            var modalTitle = exampleModal.querySelector('.modal-title')

            modalTitle.textContent = 'Edit ' + json.name

            // set action to form
            var modalForm = document.getElementById('modal-edit-user').querySelector('form');
            modalForm.action = "/users/" + json.id ;
        })
    </script>
    
    {{-- Delete --}}
        {{-- Delete --}}
        <x-modal id="modal-delete-user" size="sm">
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
            <form action="{{ route('users.destroy', 'id') }}" method="post">
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

        var exampleModal = document.getElementById('modal-delete-user')
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
