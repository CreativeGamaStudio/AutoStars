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
                    Notes
                </h2>
            </div>
            <!-- Page title actions -->
            <div class="col-auto ms-auto d-print-none">
                <div class="btn-list">
                    <!-- data-bs-target diganti ex #modal-new-nama -->
                    <a href="#" class="btn btn-primary d-none d-sm-inline-block" data-bs-toggle="modal"
                        data-bs-target="#modal-new-note">
                        <!-- Download SVG icon from http://tabler-icons.io/i/plus -->
                        <svg xmlns="http://www.w3.org/2000/svg" class="icon" width="24" height="24" viewBox="0 0 24 24"
                            stroke-width="2" stroke="currentColor" fill="none" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path stroke="none" d="M0 0h24v24H0z" fill="none"></path>
                            <line x1="12" y1="5" x2="12" y2="19"></line>
                            <line x1="5" y1="12" x2="19" y2="12"></line>
                        </svg>
                        New Note
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
<x-modal id="modal-new-note" size="lg">
    <x-slot:title>New Note</x-slot:title>

    <div class="d-none d-print-block">
        <h1 class="text-center"> Nota Pembelian </h1>
    </div>
    <div class="row">
        <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="inputNoPKB" class="mb-2">No. PKB</label>
            <input type="text" class="form-control" id="inputNoPKB" name="no_pkb">
        </div>
        <div class="form-group mb-3">
            <label for="inputNoPolisi" class="mb-2">No. Polisi</label>
            <input type="text" class="form-control" id="inputNoPolisi" name="no_polisi">
        </div>
        <div class="form-group mb-3">
            <label for="inputType" class="mb-2">Type</label>
            <input type="text" class="form-control" id="inputType" name="type">
        </div>
        </div>
        <div class="col-sm-6">
        <div class="form-group mb-3">
            <label for="inputTanggal" class="mb-2">Tanggal</label>
            <input type="datetime-local" class="form-control" id="inputTanggal" name="tanggal">
        </div>
        <div class="form-group mb-3">
            <label for="inputNoRangka" class="mb-2">No Rangka</label>
            <input type="text" class="form-control" id="inputNoRangka" name="no_rangka">
        </div>
        </div>
    </div>
    <div class="row mt-3 bg-gray h-30  d-print-none">
        <div class="card bg-primary-lt">
        <div class="card-body p-3">
            <h3 class="card-title">Tambah Item</h3>
            <button type="button" class="btn btn-icon btn-sm btn-primary"><i class="ti ti-plus"></i> Tambah</button>
        </div>
        </div>
    </div>
    <div class="row mt-3 ">
        <table class="table table-hover table-responsive">
        <thead>
            <tr>
            <th>Barcode</th>
            <th>Kodepart</th>
            <th>Nama Part</th>
            <th>QTY</th>
            <th>Harga</th>
            <th>Jumlah</th>
            <th class="d-print-none">Action</th>
            </tr>
        </thead>

        <tbody>
            <tr>
            <td x-text="color">08201321038</td>
            <td>Kode</td>
            <td>Nama</td>
            <td contenteditable="true">2</td>
            <td>Rp. 1000000</td>
            <td>Rp. 2000000</td>
            <td class="d-print-none">
                <button class="btn btn-icon btn-sm btn-danger"><i class="ti ti-x"></i></button>
            </td>
            </tr>
        </tbody>
        </table>
    </div>


    <x-slot:footer>
        <div class="d-flex">
            <a href="#" class="btn btn-link">Cancel</a>
            <button class="btn btn-primary ms-auto" onclick="printDiv('modal-new-note')">
            <svg xmlns="http://www.w3.org/2000/svg" class="icon icon-tabler icon-tabler-printer" width="44" height="44"
                viewBox="0 0 24 24" stroke-width="1.5" stroke="#ffffff" fill="none" stroke-linecap="round"
                stroke-linejoin="round">
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


