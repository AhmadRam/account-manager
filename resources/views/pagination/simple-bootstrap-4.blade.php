@if ($paginator->hasPages())
    <nav aria-label="Pagination Navigation" role="navigation">
        <ul class="pagination justify-content-center">
            {{-- Previous Page Link --}}
            @if ($paginator->onFirstPage())
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">
                        <i class="fas fa-chevron-right me-1"></i>
                        @lang('pagination.previous')
                    </span>
                </li>
            @else
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->previousPageUrl() }}" rel="prev">
                        <i class="fas fa-chevron-right me-1"></i>
                        @lang('pagination.previous')
                    </a>
                </li>
            @endif

            {{-- Next Page Link --}}
            @if ($paginator->hasMorePages())
                <li class="page-item">
                    <a class="page-link" href="{{ $paginator->nextPageUrl() }}" rel="next">
                        @lang('pagination.next')
                        <i class="fas fa-chevron-left ms-1"></i>
                    </a>
                </li>
            @else
                <li class="page-item disabled" aria-disabled="true">
                    <span class="page-link">
                        @lang('pagination.next')
                        <i class="fas fa-chevron-left ms-1"></i>
                    </span>
                </li>
            @endif
        </ul>
    </nav>
@endif
