@if($lastPage !== 1)
<section class="pagination">
  <ul class="pagination__list">
    @if($currentPage === 1)
        <li class="pagination__item">
          <a class="pagination__link">Предыдущая
            <svg width="10" height="10" fill="#999999">
              <use xlink:href="#icon-arrow-right" />
            </svg>
          </a>
        </li>
    @else
      <li class="pagination__item">
        <a class="pagination__link" href="?page={{ $currentPage-1 }}">Предыдущая
          <svg width="10" height="10" fill="#999999">
            <use xlink:href="#icon-arrow-right" />
          </svg>
        </a>
      </li>
    @endif

    @for($i = 1; $i <= $lastPage; $i++)
      @if($i === $currentPage)
        <li class="pagination__item" data-active>
          <a class="pagination__link">{{ $i }}</a>
        </li>
      @else
        <li class="pagination__item">
          <a class="pagination__link" href="?page={{ $i }}">{{ $i }}</a>
        </li>
      @endif
    @endfor

      @if($currentPage !== $lastPage)
        <li class="pagination__item">
          <a class="pagination__link" href="?page={{ $currentPage+1 }}">Следующая
            <svg width="10" height="10" fill="#999999">
              <use xlink:href="#icon-arrow-right" />
            </svg>
          </a>
        </li>
      @else
        <li class="pagination__item">
          <a class="pagination__link" href="#">Следующая
            <svg width="10" height="10" fill="#999999">
              <use xlink:href="#icon-arrow-right" />
            </svg>
          </a>
        </li>
      @endif
  </ul>
</section>

@endif
