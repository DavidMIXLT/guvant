@if ($paginator->hasPages())
    <ul class="pagination" role="navigation">
        {{-- Previous Page Link --}}
        @if ($paginator->onFirstPage())
            <li class="page-item disabled" data-href="unique" aria-disabled="true" aria-label="@lang('pagination.previous')">
                <span class="page-link last" aria-hidden="true">&lsaquo;</span>
            </li>
        @else
            <li class="page-item">
                <span class="page-link last" data-href="{{ $paginator->previousPageUrl() }}" rel="prev" aria-label="@lang('pagination.previous')">&lsaquo;</span>
            </li>
        @endif

        {{-- Pagination Elements --}}
        @foreach ($elements as $element)
            {{-- "Three Dots" Separator --}}
            @if (is_string($element))
                <li class="page-item disabled" aria-disabled="true"><span class="page-link">{{ $element }}</span></li>
            @endif

            {{-- Array Of Links --}}
            @if (is_array($element))
                @foreach ($element as $page => $url)
                    @if ($page == $paginator->currentPage())
                        <li class="page-item active currentPage" aria-current="page"><span class="page-link" >{{ $page }}</span></li>
                    @else
                        <li class="page-item"><span class="page-link" data-href="{{ $url }}">{{ $page }}</span></li>
                    @endif
                @endforeach
            @endif
        @endforeach

        {{-- Next Page Link --}}
        @if ($paginator->hasMorePages())
            <li class="page-item">
                <span class="page-link next" data-href="{{ $paginator->nextPageUrl() }}" aria-label="@lang('pagination.next')">&rsaquo;</span>
            </li>
        @else
            <li class="page-item disabled" aria-disabled="true" aria-label="@lang('pagination.next')">
            <span class="page-link next" data-href="{{$paginator->url($paginator->lastPage() + 1)}}" aria-hidden="true">&rsaquo;</span>
            </li>
        @endif
    </ul>
@endif
