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
                        Payment
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">
                        <!-- data-bs-target diganti ex #modal-new-nama -->
                        <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                            data-bs-target="#modal-new-payment">
                            <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                            <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24"
                                viewBox="0 0 24 24" stroke-width="2" stroke="currentColor" fill="none"
                                stroke-linecap="round" stroke-linejoin="round">
                                <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                                <line x1="12" y1="5" x2="12" y2="19"></line>
                                <line x1="5" y1="12" x2="19" y2="12"></line>
                            </svg>
                            New Payment
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
    {{-- <x-modal id="modal-new-payment">
        <x-slot:title>New Payment</x-slot:title>
        <form action="{{ route('payments.store') }}" method="POST">
            @csrf

            <x-input id="date" name="date" label="Date" placeholder="Date" type="date" />
            <x-input id="price" name="price" label="Price" placeholder="Price" type="number" />
            <x-input id="discount" name="discount" label="Discount" placeholder="Discount" type="number" />
            <x-input id="card_number" name="card_number" label="Card Number" placeholder="Card Number" type="text" />
            <x-input id="giro_number" name="giro_number" label="Giro Number" placeholder="Giro Number" type="text" />

            <button type="submit" class="btn btn-primary">Submit</button>
        </form>
    </x-modal> --}}

    {{-- edit form --}}
    <x-modal id="modal-edit-payment">
        <x-slot:title>Edit</x-slot:title>
        {{ Form::open(['url' => '/', 'method' => 'PUT', 'class' => 'col-md-12']) }}
        <input type="hidden" name="_method" value="PUT" />
        @csrf
        <x-input id="date" name="date" label="Date" placeholder="Date" type="date" />
        <x-input id="price" name="price" label="Price" placeholder="Price" type="number" />
        <x-input id="discount" name="discount" label="Discount" placeholder="Discount" type="number" />
        <x-input id="card_number" name="card_number" label="Card Number" placeholder="Card Number" type="text" />
        <x-input id="giro_number" name="giro_number" label="Giro Number" placeholder="Giro Number" type="text" />

        <button type="submit" class="btn btn-primary">Submit</button>
        {{ Form::close() }}
    </x-modal>

    {{-- script edit --}}
    <script>
        var exampleModal = document.getElementById('modal-edit-payment')
        exampleModal.addEventListener('show.bs.modal', function(event) {

            try {

                var button = event.relatedTarget
                var data = button.getAttribute('data-bs-item')
                console.log(data);
                data = data.replace(/'/g, '"');
                var json = JSON.parse(data);

                var inputDate = document.getElementById('modal-edit-payment').querySelector('#date');
                var inputPrice = document.getElementById('modal-edit-payment').querySelector('#price');
                var inputDiscount = document.getElementById('modal-edit-payment').querySelector('#discount');
                var inputCardNumber = document.getElementById('modal-edit-payment').querySelector('#card_number');
                var inputGiroNumber = document.getElementById('modal-edit-payment').querySelector('#giro_number');

                inputDate.value = json.date;
                inputPrice.value = json.price;
                inputDiscount.value = json.discount;
                inputCardNumber.value = json.card_number;
                inputGiroNumber.value = json.giro_number;

                var modalTitle = exampleModal.querySelector('.modal-title')

                modalTitle.textContent = 'Edit ' + json.name

                // set action to form
                var modalForm = document.getElementById('modal-edit-payment').querySelector('form');
                modalForm.action = "/payments/" + json.id;

            } catch (e) {
                console.log(e);
            }
            //modalForm.action = "{{ route('invoices.update', '') }}/" + json.id;
            //modalForm.method = "PUT";
        })
    </script>

    <x-modal id="modal-new-payment" size="lg">
        <x-slot:title>New Payment</x-slot:title>

        <div class="d-none d-print-block">
            <h1 class="text-center"> Payment </h1>
        </div>
        <div class="row d-print-block">
            <div class="col-sm-6">
                <div class="form-group mb-3">
                    <label for="id" class="mb-2">Customer ID</label>
                    <input type="text" class="form-control" id="id" name="id">
                </div>
                <div class="form-group mb-3">
                    <label for="name" class="mb-2">Customer Name</label>
                    <input type="text" class="form-control" id="name" name="name">
                </div>
                <div class="form-group mb-3">
                    <label for="name" class="mb-2">Address</label>
                    <textarea class="form-control" id="name" name="name" rows="2"></textarea>
                </div>
                <div class="form-group mb-3">
                    <label for="phone_number" class="mb-2">Phone Number</label>
                    <input type="number" class="form-control" id="phone_number" name="phone_number">
                </div>
                <div class="form-group mb-3">
                    <label for="date" class="mb-2">Date</label>
                    <input type="datetime-local" class="form-control" id="date" name="date">
                </div>
            </div>
            <div class="col-sm-6">
                <div class="form-group mb-3">
                    <label for="police_number" class="mb-2">Police Number</label>
                    <input type="text" class="form-control" id="police_number" name="police_number">
                </div>
                <div class="form-group mb-3">
                    <label for="type" class="mb-2">Type</label>
                    <input type="text" class="form-control" id="type" name="type">
                </div>
                <div class="form-group mb-3">
                    <label for="merk" class="mb-2">Merk</label>
                    <input type="text" class="form-control" id="merk" name="merk">
                </div>
                <div class="form-group mb-3">
                    <label for="year" class="mb-2">Year</label>
                    <input type="text" class="form-control" id="year" name="year">
                </div>

            </div>
        </div>
        <hr class="hr" />
        <div class="row">
            <div class="col-sm-6">
                <h3>Transaction</h3>
                <div class="mb-3 row">
                    <label for="total" class="mb-2 col-3 col-form-label">Total</label>
                    <div class="col">
                        <input type="text" class="form-control" id="total" name="total">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="discount" class="mb-2 col-3 col-form-label">Discount</label>
                    <div class="col">
                        <input type="text" class="form-control" id="discount" name="discount">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="discount" class="mb-2 col-3 col-form-label">Discount</label>
                    <div class="col">
                        <input type="text" class="form-control" id="discount" name="discount">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="Paid" class="mb-2 col-3 col-form-label">Paid</label>
                    <div class="col">
                        <input type="text" class="form-control" id="paid" name="paid">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="change" class="mb-2 col-3 col-form-label">Change</label>
                    <div class="col">
                        <input type="text" class="form-control" id="change" name="change">
                    </div>
                </div>
            </div>
            <div class="col-sm-6">
                <h3>Payment Type</h3>
                <div class="mb-3 row">
                    <label for="payment_type" class="col-3 col-form-label">Payment Type</label>
                    <div class="col">
                        <select class="form-select" id="payment_type" name="payment_type" placeholder="payment_type">
                            <option value="cash">Cash</option>
                            <option value="debit">Debit</option>
                            <option value="credit">Credit</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="bank" class="col-3 col-form-label">Bank</label>
                    <div class="col">
                        <select class="form-select" id="bank" name="bank" placeholder="bank">
                            <option value="BRI">BRI</option>
                            <option value="BCA">BCA</option>
                            <option value="Mandiri">Mandiri</option>
                            <option value="BSI">BSI</option>
                        </select>
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="card_number" class="mb-2 col-3 col-form-label">Card Number</label>
                    <div class="col">
                        <input type="text" class="form-control" id="card_number" name="card_number">
                    </div>
                </div>
                <div class="mb-3 row">
                    <label for="giro_number" class="mb-2 col-3 col-form-label">Giro Number</label>
                    <div class="col">
                        <input type="text" class="form-control" id="giro_number" name="giro_number">
                    </div>
                </div>
            </div>
        </div>
        <hr class="hr" />
        {{-- <div class="row mt-3 bg-gray h-30  d-print-none">
            <div class="card bg-primary-lt">
                <div class="card-body p-3">
                    <h3 class="card-title">Tambah Item</h3>
                    <button type="button" class="btn btn-icon btn-sm btn-primary"><i class="ti ti-plus"></i>
                        Tambah</button>
                </div>
            </div>
        </div> --}}
        <div class="row mt-3 d-print-block"">
            <table class="table table-hover table-responsive">
                <thead>
                    <tr>
                        <th>Invoices</th>
                        <th>Date</th>
                        <th>Police Number</th>
                        <th>Total</th>
                        <th>Discount</th>
                        <th>Paid</th>
                        <th>Change</th>
                        <th class="d-print-none">Action</th>
                    </tr>
                </thead>

                <tbody>
                    <tr>
                        <td x-text="color">0ada1231218</td>
                        <td>27 March 2023</td>
                        <td>AB 1234 BC</td>
                        {{-- <td contenteditable="true">2</td> --}}
                        <td>Rp. 1000000</td>
                        <td>Rp. 0</td>
                        <td>Rp. 1500000</td>
                        <td>Rp. 500000</td>
                        <td class="d-print-none">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" value="" id="ispaidcheck">
                                <label class="form-check-label" for="flexCheckDefault">
                                    Paid
                                </label>
                            </div>
                            {{-- <button class="btn btn-icon btn-sm btn-danger"><i class="ti ti-x"></i></button> --}}
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>


        <x-slot:footer>
            <div class="d-flex">
                <a href="#" class="btn btn-link">Cancel</a>
                <button class="btn btn-primary ms-auto" onclick="printDiv('modal-new-note')">
                    <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="44"
                        height="44" viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none"
                        stroke-linecap="round" stroke-linejoin="round">
                        <path stroke="none" d="M0 0h24v24H0z" fill="none" />
                        <path d="M17 17h2a2 2 0 0 0 2 -2v-4a2 2 0 0 0 -2 -2h-14a2 2 0 0 0 -2 2v4a2 2 0 0 0 2 2h2" />
                        <path d="M17 9v-4a2 2 0 0 0 -2 -2h-6a2 2 0 0 0 -2 2v4" />
                        <rect x="7" y="13" width="10" height="8" rx="2" />
                    </svg>
                    Cetak
                </button>
            </div>
        </x-slot:footer>
    </x-modal>

    {{-- script --}}
    <script>
        var exampleModal = document.getElementById('modal-edit-payment')
        exampleModal.addEventListener('show.bs.modal', function(event) {
            var button = event.relatedTarget
            var data = button.getAttribute('data-bs-payment')
            data = data.replace(/'/g, '"');
            var json = JSON.parse(data);

            var inputDate = document.getElementById('modal-edit-payment').querySelector('#date');
            var inputPrice = document.getElementById('modal-edit-payment').querySelector('#price');
            var inputDiscount = document.getElementById('modal-edit-payment').querySelector('#discount');
            var inputCardNumber = document.getElementById('modal-edit-payment').querySelector('#card_number');
            var inputGiroNumber = document.getElementById('modal-edit-payment').querySelector('#giro_number');

            inputDate.value = json.date;
            inputPrice.value = json.price;
            inputDiscount.value = json.discount;
            inputCardNumber.value = json.card_number;
            inputGiroNumber.value = json.giro_number;


            var modalTitle = exampleModal.querySelector('.modal-title')

            modalTitle.textContent = 'Edit ' + json.name

            // set action to form
            var modalForm = document.getElementById('modal-edit-payment').querySelector('form');
            modalForm.action = "{{ route('payments.update', '') }}/" + json.id;
            modalForm.method = "PUT";
        })
    </script>

    <x-modal id="modal-delete-payment" size="sm">
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
        <form action="{{ route('payments.destroy', 'id') }}" method="post">
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
        var exampleModal = document.getElementById('modal-delete-payment')
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
    <script>
        function printDiv(divName) {
            var printContents = document.getElementById(divName).innerHTML;
            var originalContents = document.body.innerHTML;
            document.body.innerHTML = printContents;

            window.print();

            document.body.innerHTML = originalContents;
        }
    </script>
@endpush
