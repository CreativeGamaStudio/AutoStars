@extends('layouts.app')

@section('content')
    <div class="page-header d-print-none">
        <div class="container-xl">
            <div class="row g-2 align-items-center">
                <div class="col">
                    <div class="page-pretitle">
                        Overview
                    </div>
                    <h2 class="page-title">
                        Dashboard
                    </h2>
                </div>
                <!-- Page title actions -->
                <div class="col-auto ms-auto d-print-none">
                    <div class="btn-list">

                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="page-body">
        <div class="container-xl">
            <div class="row row-deck row-cards">
                <div class="col-4">
                    <x-conversion-rate-widget title="Customer" :conversion-rate="75" :percentage-change="10" change-direction="up" />
                </div>
                <div class="col-4">
                    <x-conversion-rate-widget title="Parts" :conversion-rate="90" :percentage-change="9" change-direction="up" />
                </div>
                <div class="col-4">
                    <x-conversion-rate-widget title="Mechanics" :conversion-rate="80" :percentage-change="7" change-direction="down" />
                </div>
                <div class="col-6">
                    <x-conversion-rate-widget title="Service" :conversion-rate="60" :percentage-change="6" change-direction="up" />
                </div>
                <div class="col-6">
                    <x-conversion-rate-widget title="Invoice" :conversion-rate="80" :percentage-change="7" change-direction="down" />
                </div>               
                {{-- <div class="col-4">
                    @php
                        $progressItems = [
                            ['name' => 'AB 2000 PX', 'value' => "Service", 'percentage' => 71.0, 'color' => 'primary'],
                            ['name' => 'AA 1210 AB', 'value' => "Pembayaran", 'percentage' => 35.96, 'color' => 'danger'],
                            ['name' => 'B 1203 PCS', 'value' => "Selesai", 'percentage' => 100, 'color' => 'success'],
                            ['name' => 'AB 3253 BA', 'value' => "Menunggu Antrian", 'percentage' => 0, 'color' => 'success'],
                            ['name' => 'H 4326 XX', 'value' => "Menunggu Antrian", 'percentage' => 0, 'color' => 'success']
                            ];
                    @endphp

                    <x-table-widget title="Waiting List" itemNameHeader="Kendaraan" itemValueHeader="Proses"
                        :progressItems="$progressItems" />

                </div>
                <div class="col-8">
                    @php
                        $progressItems = [
                            ['name' => 'AB 2000 PX', 'value' => "Service", 'percentage' => 71.0, 'color' => 'primary'],
                            ['name' => 'AA 1210 AB', 'value' => "Pembayaran", 'percentage' => 35.96, 'color' => 'danger'],
                            ['name' => 'B 1203 PCS', 'value' => "Selesai", 'percentage' => 100, 'color' => 'success'],
                            ['name' => 'AB 3253 BA', 'value' => "Menunggu Antrian", 'percentage' => 0, 'color' => 'success'],
                            ['name' => 'H 4326 XX', 'value' => "Menunggu Antrian", 'percentage' => 0, 'color' => 'success']
                            ];
                    @endphp

                    <x-table-widget title="Waiting List" itemNameHeader="Kendaraan" itemValueHeader="Proses"
                        :progressItems="$progressItems" />

                </div> --}}
                <div class="col">
                    @php
                        $progressItems = [
                            ['name' => 'AB 2000 PX', 'value' => "Service", 'percentage' => 71.0, 'color' => 'primary'],
                            ['name' => 'AA 1210 AB', 'value' => "Payment", 'percentage' => 35.96, 'color' => 'danger'],
                            ['name' => 'B 1203 PCS', 'value' => "Complete", 'percentage' => 100, 'color' => 'success'],
                            ['name' => 'AB 3253 BA', 'value' => "Waiting Queue", 'percentage' => 0, 'color' => 'success'],
                            ['name' => 'H 4326 XX', 'value' => "Waiting Queue", 'percentage' => 0, 'color' => 'success']
                            ];
                    @endphp

                    <x-table-widget title="Waiting List" itemNameHeader="Kendaraan" itemValueHeader="Proses"
                        :progressItems="$progressItems" />

                </div>
            </div>
        </div>
    </div>
    </div>
@endsection
