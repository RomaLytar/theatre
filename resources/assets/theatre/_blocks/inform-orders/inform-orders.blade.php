<section class="inform-orders">
  <h2 class="inform-orders__title">{{ __('pages.orders') }}</h2>
  <ul class="inform-orders__list">
    @foreach($docs as $doc)
    <a href="{{ $doc->file }}">
    <li>
      <svg width="64" height="64" fill="#333333">
        <use xlink:href="#icon-pdf" />
      </svg>
      <div class="inform-orders__list-descr">
        <p>{{ $doc->translate->title  }}</p>
      </div>
    </li>
    </a>
    @endforeach
  </ul>
</section>

