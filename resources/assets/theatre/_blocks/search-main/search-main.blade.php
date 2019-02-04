<section class="search-main" data-search-main>
  <h3 class="search-main__title"><span class="search-main__title-result" data-search-main-title>{{ __('search-main.search_result') }}</span><span class="search-main__title-result">{{ __('search-main.search') }}</span></h3>
  <form action="" class="search-main__form" data-search-main-form>
    <input class="search-main__form-input" id="search-main" type="text" placeholder="{{ __('search-main.enter_your_query') }}" data-search-main-input>
    <button type="submit" class="btn-more btn-more--gold btn-more--uppercase search-main__submit-btn" data-search-main-btn-submit>{{ __('search-main.go_search') }}</button>
  </form>
  <ul class="search-main__tabs-list" data-search-main-type>
    <li class="search-main__tabs-item"><a href="/search?type=articles" data-serverdata-type="list" data-active>{{ __('search-main.articles') }}</a></li>
    <li class="search-main__tabs-item"><a href="/search?type=performances" data-serverdata-type="list">{{ __('search-main.events') }}</a></li>
    <li class="search-main__tabs-item"><a href="/search?type=media" data-serverdata-type="media">{{ __('search-main.media') }}</a></li>
    <li class="search-main__tabs-item"><a href="/search?type=actors" data-serverdata-type="media">{{ __('search-main.artists') }}</a></li>
  </ul>
  <div class="search-main__result">
    <p class="search-main__answer" data-search-main-answer>{{ __('search-main.no_result') }}</p>
  </div>
  <div class="search-main__result" data-search-main-result>
  </div>
  {{-- <div class="search-main__result" data-search-main-result></div> --}}
  {{-- <div class="search-main__result" data-search-main-result>
     <ul class="search-main__result-list" >
      <li class="search-main__result-item">
        <h2 class="search-main__result-title">
          <a href="#" class="search-main__result-link">Евгений Онегин</a>
        </h2>
        <p class="search-main__descr">5 липня відбулася зустріч керівника області з колективом ХНАТОБу ім. М. В. Лисенка, у рамках якої Ю. О. Світлична ознайомилася з роботою театру. </p>
      </li>
      <li class="search-main__result-item">
        <h2 class="search-main__result-title">
          <a href="#" class="search-main__result-link">Евгений Онегин</a>
        </h2>
        <p class="search-main__descr">5 липня відбулася зустріч керівника області з колективом ХНАТОБу ім. М. В. Лисенка, у рамках якої Ю. О. Світлична ознайомилася з роботою театру. </p>
      </li>
      <li class="search-main__result-item">
        <h2 class="search-main__result-title">
          <a href="#" class="search-main__result-link">Евгений Онегин</a>
        </h2>
        <p class="search-main__descr">5 липня відбулася зустріч керівника області з колективом ХНАТОБу ім. М. В. Лисенка, у рамках якої Ю. О. Світлична ознайомилася з роботою театру. </p>
      </li>
      <li class="search-main__result-item">
        <h2 class="search-main__result-title">
          <a href="#" class="search-main__result-link">Евгений Онегин</a>
        </h2>
        <p class="search-main__descr">5 липня відбулася зустріч керівника області з колективом ХНАТОБу ім. М. В. Лисенка, у рамках якої Ю. О. Світлична ознайомилася з роботою театру. </p>
      </li>
      <li class="search-main__result-item">
        <h2 class="search-main__result-title">
          <a href="#" class="search-main__result-link">Евгений Онегин</a>
        </h2>
        <p class="search-main__descr">5 липня відбулася зустріч керівника області з колективом ХНАТОБу ім. М. В. Лисенка, у рамках якої Ю. О. Світлична ознайомилася з роботою театру. </p>
      </li>
      <li class="search-main__result-item">
        <h2 class="search-main__result-title">
          <a href="#" class="search-main__result-link">Евгений Онегин</a>
        </h2>
        <p class="search-main__descr">5 липня відбулася зустріч керівника області з колективом ХНАТОБу ім. М. В. Лисенка, у рамках якої Ю. О. Світлична ознайомилася з роботою театру. </p>
      </li>
      <li class="search-main__result-item">
        <h2 class="search-main__result-title">
          <a href="#" class="search-main__result-link">Евгений Онегин</a>
        </h2>
        <p class="search-main__descr">5 липня відбулася зустріч керівника області з колективом ХНАТОБу ім. М. В. Лисенка, у рамках якої Ю. О. Світлична ознайомилася з роботою театру. </p>
      </li>
      <li class="search-main__result-item">
        <h2 class="search-main__result-title">
          <a href="#" class="search-main__result-link">Евгений Онегин</a>
        </h2>
        <p class="search-main__descr">5 липня відбулася зустріч керівника області з колективом ХНАТОБу ім. М. В. Лисенка, у рамках якої Ю. О. Світлична ознайомилася з роботою театру. </p>
      </li>
      <li class="search-main__result-item">
        <h2 class="search-main__result-title">
          <a href="#" class="search-main__result-link">Евгений Онегин</a>
        </h2>
        <p class="search-main__descr">5 липня відбулася зустріч керівника області з колективом ХНАТОБу ім. М. В. Лисенка, у рамках якої Ю. О. Світлична ознайомилася з роботою театру. </p>
      </li>
      <li class="search-main__result-item">
        <h2 class="search-main__result-title">
          <a href="#" class="search-main__result-link">Евгений Онегин</a>
        </h2>
        <p class="search-main__descr">5 липня відбулася зустріч керівника області з колективом ХНАТОБу ім. М. В. Лисенка, у рамках якої Ю. О. Світлична ознайомилася з роботою театру. </p>
      </li>
    </ul>
  </div> --}}

  {{-- <div class="search-main__result">
    <ul class="search-main__result-list row">
      <li class="search-main__result-item col-md-6 col-xl-4">
        <a href="#" class="search-main__result-link">
          <h2 class="search-main__result-title">
            Евгений Онегин
          </h2>
          <figure class="search-main__result-img">
            <img src="/uploads/media/538/conversions/1417188244-6075204-www.nevseoboi.com.ua-preview.jpg" alt="">
          </figure>
        </a>
      </li>
      <li class="search-main__result-item col-md-6 col-xl-4">
        <a href="#" class="search-main__result-link">
          <h2 class="search-main__result-title">
            Евгений Онегин
          </h2>
          <figure class="search-main__result-img">
            <img src="/uploads/media/538/conversions/1417188244-6075204-www.nevseoboi.com.ua-preview.jpg" alt="">
          </figure>
        </a>
      </li>
      <li class="search-main__result-item col-md-6 col-xl-4">
        <a href="#" class="search-main__result-link">
          <h2 class="search-main__result-title">
            Евгений Онегин
          </h2>
          <figure class="search-main__result-img">
            <img src="/uploads/media/538/conversions/1417188244-6075204-www.nevseoboi.com.ua-preview.jpg" alt="">
          </figure>
        </a>
      </li>
      <li class="search-main__result-item col-md-6 col-xl-4">
        <a href="#" class="search-main__result-link">
          <h2 class="search-main__result-title">
            Евгений Онегин
          </h2>
          <figure class="search-main__result-img">
            <img src="/uploads/media/538/conversions/1417188244-6075204-www.nevseoboi.com.ua-preview.jpg" alt="">
          </figure>
        </a>
      </li>
      <li class="search-main__result-item col-md-6 col-xl-4">
        <a href="#" class="search-main__result-link">
          <h2 class="search-main__result-title">
            Евгений Онегин
          </h2>
          <figure class="search-main__result-img">
            <img src="/uploads/media/538/conversions/1417188244-6075204-www.nevseoboi.com.ua-preview.jpg" alt="">
          </figure>
        </a>
      </li>
      <li class="search-main__result-item col-md-6 col-xl-4">
        <a href="#" class="search-main__result-link">
          <h2 class="search-main__result-title">
            Евгений Онегин
          </h2>
          <figure class="search-main__result-img">
            <img src="/uploads/media/538/conversions/1417188244-6075204-www.nevseoboi.com.ua-preview.jpg" alt="">
          </figure>
        </a>
      </li>
      <li class="search-main__result-item col-md-6 col-xl-4">
        <a href="#" class="search-main__result-link">
          <h2 class="search-main__result-title">
            Евгений Онегин
          </h2>
          <figure class="search-main__result-img">
            <img src="/uploads/media/538/conversions/1417188244-6075204-www.nevseoboi.com.ua-preview.jpg" alt="">
          </figure>
        </a>
      </li>
      <li class="search-main__result-item col-md-6 col-xl-4">
        <a href="#" class="search-main__result-link">
          <h2 class="search-main__result-title">
            Евгений Онегин
          </h2>
          <figure class="search-main__result-img">
            <img src="/uploads/media/538/conversions/1417188244-6075204-www.nevseoboi.com.ua-preview.jpg" alt="">
          </figure>
        </a>
      </li>
      <li class="search-main__result-item col-md-6 col-xl-4">
        <a href="#" class="search-main__result-link">
          <h2 class="search-main__result-title">
            Евгений Онегин
          </h2>
          <figure class="search-main__result-img">
            <img src="/uploads/media/538/conversions/1417188244-6075204-www.nevseoboi.com.ua-preview.jpg" alt="">
          </figure>
        </a>
      </li>

    </ul>
  </div> --}}
</section>
