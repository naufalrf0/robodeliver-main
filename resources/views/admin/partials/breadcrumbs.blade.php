<ol class="breadcrumb">
    @php
        $breadcrumbs = \App\Helpers\AdminBreadcrumbs::generate();
    @endphp

    @foreach($breadcrumbs as $breadcrumb)
        @if (!$loop->last)
            <li class="breadcrumb-item">
                <a href="{{ $breadcrumb['url'] }}">{{ $breadcrumb['name'] }}</a>
            </li>
        @else
            <li class="breadcrumb-item active">{{ $breadcrumb['name'] }}</li>
        @endif
    @endforeach
</ol>
