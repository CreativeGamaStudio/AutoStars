@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard') }}</div>

                    <div class="card-body">


                        {{-- {{ __('You are logged in!') }} --}}

                    </div>
                </div>
            </div>
        </div>
        <div class="row w-50">
            <div class="col-6">

                <x-conversion-rate-widget title="Customer" :conversion-rate="75" :percentage-change="10" change-direction="up" />
            </div>
            <div class="col-6">
                <x-conversion-rate-widget title="Invoice" :conversion-rate="80" :percentage-change="7" change-direction="down" />

            </div>
        </div>
    </div>
@endsection
