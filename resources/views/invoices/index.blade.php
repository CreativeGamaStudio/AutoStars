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
                        Invoice
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <!-- data-bs-target diganti ex #modal-new-nama -->
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-new-invoice">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            New Invoice
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
    <x-modal id="modal-new-invoice">
        <x-slot:title>New Invoice</x-slot:title>
        <form action="{{ route('invoices.store') }}" method="POST">
            @csrf

            <x-input id="invoice_date" name="invoice_date" label="Date" placeholder="Date" type="date"/>
            <x-input id="total" name="total" label="Total" placeholder="Total" type="number" />
            <x-input id="paid" name="paid" label="Paid" placeholder="Paid" type="number" />

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-modal>

    {{-- edit form --}}
    <x-modal id="modal-edit-invoice">
        <x-slot:title>Edit</x-slot:title>
        {{ Form::open(array('url' => '/', 'method' => 'PUT', 'class'=>'col-md-12')) }}
            <input type="hidden" name="_method" value="PUT"/>
            @csrf
            <x-input id="invoice_date" name="invoice_date" label="Date" placeholder="Date" type="date"/>
            <x-input id="total" name="total" label="Total" placeholder="Total" type="number" />
            <x-input id="paid" name="paid" label="Paid" placeholder="Paid" type="number" />

            <button type="submit" class="btn btn-primary">Submit</button>
        {{ Form::close()}}
    </x-modal>

    <x-modal id="modal-delete-invoice" size="sm">
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
            <input id="dataId" type="text"/>
        </div>
        <form action="{{ route('invoices.destroy', 'id') }}" method="post">
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

        var exampleModal = document.getElementById('modal-delete-invoice')
        var modalBodyInput = document.getElementById('id')
        exampleModal.addEventListener('show.bs.modal', function(event) { 
            var button = event.relatedTarget
            var recipient = button.getAttribute('data-bs-ids') 
            console.log(recipient)
            modalBodyInput.value = recipient
        })
    </script>

    {{-- script --}} 
    <script>
        var exampleModal = document.getElementById('modal-edit-invoice')
        exampleModal.addEventListener('show.bs.modal', function(event) {

            try{

            var button = event.relatedTarget
            var data = button.getAttribute('data-bs-item')
            console.log(data);
            data = data.replace(/'/g, '"');
            var json = JSON.parse(data);

            var inputDate = document.getElementById('modal-edit-invoice').querySelector('#invoice_date');
            var inputTotal = document.getElementById('modal-edit-invoice').querySelector('#total');
            var inputPaid = document.getElementById('modal-edit-invoice').querySelector('#paid');

            inputDate.value = json.invoice_date;
            inputTotal.value = json.total;
            inputPaid.value = json.paid;

            var modalTitle = exampleModal.querySelector('.modal-title')

            modalTitle.textContent = 'Edit ' + json.name
            
            // set action to form
            var modalForm = document.getElementById('modal-edit-invoice').querySelector('form');
            modalForm.action = "/invoices/" + json.id ;

                 }catch(e){
                console.log(e);
                 }
            //modalForm.action = "{{ route('invoices.update', '') }}/" + json.id;
            //modalForm.method = "PUT";
        })
    </script>

    <!-- end section -->
@endsection

<!-- push script -->
@push('scripts')
    {{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush
