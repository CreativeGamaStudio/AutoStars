@props(['title', 'itemNameHeader', 'itemValueHeader', 'progressItems'])

<div class="card">
    <div class="card-header">
        <h3 class="card-title">{{ $title }}</h3>
    </div>
    <table class="table card-table table-vcenter">
        <thead>
            <tr>
                <th>{{ $itemNameHeader }}</th>
                <th colspan="2">{{ $itemValueHeader }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($progressItems as $item)
            <tr>
                <td>{{ $item['name'] }}</td>
                <td>{{ $item['value'] }}</td>
                <td class="w-50">
                    <div class="progress progress-xs">
                        <div class="progress-bar bg-{{ $item['color'] }}" style="width: {{ $item['percentage'] }}%"></div>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
