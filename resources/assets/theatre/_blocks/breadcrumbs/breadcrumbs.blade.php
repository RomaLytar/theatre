<section class="breadcrumbs">
  @if (count($breadcrumbs))
    <ol class="breadcrumbs__list">
      @foreach ($breadcrumbs as $breadcrumb)
        @if ($breadcrumb->url && !$loop->last)
          <li class="breadcrumbs__item"><a href="{{ $breadcrumb->url }}">{{ $breadcrumb->title }}</a></li>
        @else
          <li class="breadcrumbs__item">{{ $breadcrumb->title }}</li>
        @endif
      @endforeach
    </ol>
  @endif

  {{-- Ссылку на YouTube выводить только на странице Видео --}}
  @if(Request::route()->getName() == route('front.videos.index'))
    <a href="https://www.youtube.com/channel/UCbztlaVJexyeXoaluZdEd3g" class="breadcrumbs__youtube-link">Подпишитесь на наш канал в YouTube</a>
  @endif
</section>
