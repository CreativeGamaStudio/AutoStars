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
                    Order
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <!-- data-bs-target diganti ex #modal-new-nama -->
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                        data-bs-target="#modal-new-order">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        New Order
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
<x-modal id="modal-new-order">
    <x-slot:title>New Order</x-slot:title>
    <form action="{{ route('users.store') }}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="name" class="form-label">Date</label>
            <input type="date" class="form-control" id="date" name="date" placeholder="Date">
        </div>
        <div class="mb-3">
            <label for="order" class="form-label">Orders</label>
            <textarea class="form-control" id="order" name="order" rows="4" placeholder="Order"></textarea>
            <!-- <input type="text" class="form-control" id="address" name="address" placeholder="Address"> -->
        </div>
        <div class="mb-3">
            <label for="complaint" class="form-label">Complaint</label>
            <textarea class="form-control" id="complaint" name="complaint" rows="4" placeholder="Complaint"></textarea>
            <!-- <input type="text" class="form-control" id="address" name="address" placeholder="Address"> -->
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