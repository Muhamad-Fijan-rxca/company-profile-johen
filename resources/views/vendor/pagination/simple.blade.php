@if ($paginator->hasPages())
    <nav>
        {{-- Previous --}}
        @if ($paginator->onFirstPage())
            <span class="pagination-wrap" style="display:inline-flex;gap:8px">
        @else
            <span class="pagination-wrap" style="display:inline-flex;gap:8px">
            <a href="{{ $paginator->previousPageUrl() }}">&laquo; Prev</a>
        @endif

        {{-- Next --}}
        @if ($paginator->hasMorePages())
            <a href="{{ $paginator->nextPageUrl() }}">Next &raquo;</a>
        @endif
        </span>
    </nav>
@endif
