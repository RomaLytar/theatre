@if ($paginator->hasPages())
  <section class="pagination">
    <ul class="pagination__list">
      {{-- Previous Page Link --}}
      @if ($paginator->onFirstPage())
        <li class="pagination__item">Предыдущая
          <a class="pagination__link" rel="prev">Предыдущая
            <svg width="10" height="10" fill="#999999">
              <use xlink:href="#icon-arrow-right" />
            </svg>
          </a>
        </li>
      @else
        <li class="pagination__item">
          <a class="pagination__link" href="{{ $paginator->previousPageUrl() }}" rel="prev">Предыдущая
            <svg width="10" height="10" fill="#999999">
              <use xlink:href="#icon-arrow-right" />
            </svg>
          </a>
        </li>
      @endif

      {{-- Pagination Elements --}}
      @foreach ($elements as $element)
        {{-- "Three Dots" Separator --}}
        @if (is_string($element))
          <li class="pagination__item">
            <a class="pagination__link">{{ $element }}</a>
          </li>
        @endif

        {{-- Array Of Links --}}
        @if (is_array($element))
          @foreach ($element as $page => $url)
            @if ($page == $paginator->currentPage())
              <li class="pagination__item" data-active>
                <a class="pagination__link">{{ $page }}</a>
              </li>
            @else
              <li class="pagination__item">
                <a class="pagination__link" href="{{ $url }}">{{ $page }}</a>
              </li>
            @endif
          @endforeach
        @endif
      @endforeach

      {{-- Next Page Link --}}
      @if ($paginator->hasMorePages())
        <li class="pagination__item">
          <a class="pagination__link" href="{{ $paginator->nextPageUrl() }}" rel="next">Следующая
            <svg width="10" height="10" fill="#999999">
              <use xlink:href="#icon-arrow-right" />
            </svg>
          </a>
        </li>
      @else
        <li class="pagination__item">
          <a class="pagination__link" rel="next">Следующая
            <svg width="10" height="10" fill="#999999">
              <use xlink:href="#icon-arrow-right" />
            </svg>
          </a>
        </li>
      @endif
    </ul>
  </section>
@endif
