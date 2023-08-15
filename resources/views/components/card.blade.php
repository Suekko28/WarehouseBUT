<div class="col-12 col-xl-{{ $size ?? '12' }} col-lg-{{ $size ?? '12' }} col-md-{{ $size ?? '12' }} ">
    @if (!empty($back))
        <a href="javascript:;" onclick="history.back(-1)" class="btn btn-sm bg-primary text-light mb-2"><i
                class="fa fa-reply fa-fw me-1"></i>Kembali</a>
    @endif

    @if (!empty($button))
        @forelse ($button as  $key => $item)
            {{-- color  --}}
            {{-- btn bg-primary text-light mb-2 --}}

            {{-- icon --}}
            {{-- <i class="fa fa-list fa-fw me-1"></i> --}}
            <a href="{{ $item['link'] }}" class="{{ $item['class'] ?? 'btn btn-sm bg-primary text-light mb-2' }}">
                {!! $item['icon'] !!}{{ ucwords($item['label']) }}</a>
        @empty
        @endforelse
    @endif
    <div class="card">
        <div class="card-header bg-secondary text-light">
            <span class="header-title">{!! $icon ?? '' !!} {{ $title ?? '' }}</span>
        </div>
        <div class="card-body">
            {{ $slot }}
        </div>
    </div>
</div>
