{{-- <div class="join">
    <button class="join-item btn">1</button>
    <button class="join-item btn btn-active">2</button>
    <button class="join-item btn">3</button>
    <button class="join-item btn">4</button>
  </div> --}}

@if ($paginator->hasPages())
    <nav class="flex justify-center">
        <ul class="join">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li aria-disabled="true" aria-label="@lang('pagination.previous')">
                    <span class="join-item btn btn-disabled" aria-hidden="true">&lsaquo;</span>
                </li>
            @else
                <li>
                    <a class="join-item btn" href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</a>
                </li>
            @endif

            {{-- Pagination Elements --}}
            @foreach ($elements as $element)
                {{-- "Three Dots" Separator --}}
                @if (is_string($element))
                    <li aria-disabled="true"><span class="disabled join-item btn">{{ $element }}</span></li>
                @endif

                {{-- Array Of Links --}}
                @if (is_array($element))
                    @foreach ($element as $page => $url)
                        @if ($page == $paginator->currentPage())
                            <li aria-current="page"><span class="join-item btn btn-active">{{ $page }}</span></li>
                        @else
                            <li><a class="join-item btn" href="{{ $url }}">{{ $page }}</a></li>
                        @endif
                    @endforeach
                @endif
            @endforeach

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li>
                    <a class="join-item btn" href="{{ $paginator->nextPageUrl() }}" rel="next" aria-label="@lang('pagination.next')">&rsaquo;</a>
                </li>
            @else
                <li aria-disabled="true" aria-label="@lang('pagination.next')">
                    <span class="join-item btn btn-disabled" aria-hidden="true">&rsaquo;</span>
                </li>
            @endif
        </ul>
    </nav>
    <small class="flex justify-center mt-3">
        Menampilkan
        {{ $paginator->count() }}
        berita di halaman
        {{ $paginator->currentPage() }}
        dari
        {{ $paginator->lastPage() }}
        halaman
    </small>
@endif
