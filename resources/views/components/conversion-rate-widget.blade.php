@props([
"title"=> "Widget Title"
])

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="subheader">{{ $title }}</div>
            <div class="ms-auto lh-1"></div>
        </div>
        <div class="h1 mb-3">{{ $conversionRate }}%</div>
        <div class="d-flex mb-2">
            <div>Conversion rate</div>
            <div class="ms-auto">
                <span class="text-{{ $changeDirection == 'up' ? 'green' : 'red' }} d-inline-flex align-items-center lh-1">
                    {{ $percentageChange }}% <i class="ti ti-arrow-{{ $changeDirection }}"></i>
                </span>
            </div>
        </div>
        <div class="progress progress-sm">
            <div class="progress-bar bg-primary" style="width: {{ $conversionRate }}%" role="progressbar" aria-valuenow="{{ $conversionRate }}" aria-valuemin="0" aria-valuemax="100" aria-label="{{ $conversionRate }}% Complete">
                <span class="visually-hidden">{{ $conversionRate }}% Complete</span>
            </div>
        </div>
    </div>
</div>
