@if (count($breadcrumbs ?? []))
    <div class="breadcrumbs text-sm mx-10">
        <ul>
            @foreach ($breadcrumbs as $breadcrumb)
                @if ($breadcrumb->url && !$loop->last)
                    <li class="breadcrumb-item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
                @else
                    <li class="breadcrumb-item active font-bold">{{ $breadcrumb->title }}</li>
                @endif
            @endforeach
        </ul>
    </div>
@endif
