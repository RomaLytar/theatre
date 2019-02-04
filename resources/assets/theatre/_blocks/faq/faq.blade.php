<section class="faq" data-faq>
@foreach($faqCategories as $faqCategory)
    <section class="faq__sect" data-faq-section>
      <h2 class="faq__sect-title">{{ $faqCategory->translate->title }}</h2>
      <ul class="faq__list" data-faq-list>
        @foreach($faqCategory->faqs as $faq)
        <li data-faq-item>
          <button class="faq__list-name" data-faq-btn>
            {{ $faq->translate->title }}
            <span class="faq__list-icon"></span>
          </button>
          <div class="faq__list-descr" data-faq-description>
            {!! $faq->translate->description  !!}
          </div>
        </li>
        @endforeach
      </ul>
    </section>
@endforeach
</section>
