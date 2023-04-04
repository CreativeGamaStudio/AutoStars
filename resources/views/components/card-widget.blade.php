@props([
    'title',
    'value',
    'progress' => 0,
    'progressColor' => 'primary',
    'change' => 0,
    'changeDirection' => 'up',
    'timePeriods' => [
        ['label' => 'Last 7 days', 'active' => true],
        ['label' => 'Last 30 days', 'active' => false],
        ['label' => 'Last 3 months', 'active' => false],
    ],
])

<div class="card">
    <div class="card-body">
        <div class="d-flex align-items-center">
            <div class="subheader">{{ $title }}</div>
            <div class="ms-auto lh-1">
                <div class="dropdown">
                    <a class="dropdown-toggle text-muted" href="#" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">{{ $timePeriods[0]['label'] }}</a>
                    <div class="dropdown-menu dropdown-menu-end">
                        @foreach ($timePeriods as $period)
                            <a class="dropdown-item{{ $period['active'] ? ' active' : '' }}" href="#">{{ $period['label'] }}</a>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
        <div class="h1 mb-3">{{ $value }}</div>
        @if ($change)
            <div class="d-flex mb-2">
                <div>Total</div>
                <div class="ms-auto">
                    <span class="text-{{ $changeDirection == 'up' ? 'green' : 'red' }} d-inline-flex align-items-center lh-1">
                        {{ $change }}% <i class="ti ti-arrow-{{ $changeDirection }}"></i>
                    </span>
                </div>
            </div>
        @endif
        @if ($progress)
            <div class="progress progress-sm">
                <div class="progress-bar bg-{{ $progressColor }}" style="width: {{ $progress }}%" role="progressbar" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100" aria-label="{{ $progress }}% Complete">
                    <span class="visually-hidden">{{ $progress }}% Complete</span>
                </div>
            </div>
        @endif
    </div>
</div>
