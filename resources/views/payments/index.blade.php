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
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
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
<x-modal id="modal-new-payment">
    <x-slot:title>New Payment</x-slot:title>
    <form action="{{ route('payments.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" placeholder="Date">
        </div>
        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" class="form-control" id="price" name="price" placeholder="Price">
        </div>
        <div class="mb-3">
            <label for="discount" class="form-label">Discount</label>
            <input type="number" class="form-control" id="discount" name="discount" placeholder="discount">
        </div>
        <div class="mb-3">
            <label for="card_number" class="form-label">Card Number</label>
            <input type="number" class="form-control" id="card_number" name="card_number" placeholder="Card Number">
        </div>
        <div class="mb-3">
            <label for="giro_number" class="form-label">Giro Number</label>
            <input type="number" class="form-control" id="giro_number" name="giro_number" placeholder="Giro Number">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</x-modal>

<!-- end section -->
@endsection

<!-- push script -->
@push('scripts')
{{ $dataTable->scripts(attributes: ['type' => 'module']) }}
@endpush