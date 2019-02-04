<div class="menu-list">
    @include('layouts.components.admin-menu-svg')
    <ul id="menu-content" class="menu-content collapse out" id="accordion">
        @guest
            <li><a href="{{ route('login') }}">
              <svg width="20" height="20">
                <use xlink:href="#enter" />
              </svg>
              {{__('admin.login')}}</a>
            </li>
            <li><a href="{{ route('register') }}">
              <svg width="20" height="20">
                <use xlink:href="#reg" />
              </svg>
              {{__('admin.register')}}</a>
            </li>
        @else
          <li><a href="{{ url('/admin/dashboard') }}">
              <svg width="20" height="20">
                <use xlink:href="#control-panel" />
              </svg>
            {{__('admin.dashboard')}}</a>
          </li>
          <li>
            <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse1" aria-expanded="false" aria-controls="collapse1">
              <svg width="20" height="20">
                <use xlink:href="#content" />
              </svg>
              Контент
            </a>
            <div id="collapse1" class="panel-collapse collapse second-menu" role="tabpanel" aria-labelledby="heading1">
              @can('home-page-list')
                <a href="{{ url('/admin/homepage') }}">
                  <svg width="20" height="20">
                    <use xlink:href="#edit-main-page" />
                  </svg>
                {{__('admin.editHomePage')}}</a>
              @endcan
              @can('performance-list')
                <a href="{{ route('performance.index') }}">
                <svg width="20" height="20">
                  <use xlink:href="#performance" />
                </svg>
                {{__('admin.performances')}}</a>
              @endcan
              @can('festival-list')
                  <a href="{{ route('festival.index') }}">
                    <svg width="20" height="20">
                      <use xlink:href="#festival" />
                    </svg>
                {{__('admin.festivals')}}</a>
              @endcan
              @can('actor-list')
                  <a href="{{ route('actor.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#actors"/>
                            </svg>
                            {{__('admin.actors')}}</a>
                    @endcan
                    @can('article-list')
                        <a href="{{ route('articles.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#news"/>
                            </svg>
                            {{ __('admin.articles') }}</a>
                    @endcan
                    @can('faq-list')
                        <a href="{{ route('faqs.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#faq"/>
                            </svg>
                            {{ __('admin.faqs') }}</a>
                    @endcan
                    @can('e-book-list')
                        <a href="{{ route('ebooks.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#ebook"/>
                            </svg>
                            {{ __('admin.ebooks') }}</a>
                    @endcan
                    @can('doc-list')
                        <a href="{{ route('documentations.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#doc"/>
                            </svg>
                            {{ __('admin.documentations') }}</a>
                    @endcan

                    @can('service-list')
                        <a href="{{ route('services.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#services"/>
                            </svg>
                            </i>{{ __('admin.services') }}</a>
                    @endcan
                    @can('project-list')
                        <a href="{{ route('projects.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#projects"/>
                            </svg>
                            {{ __('admin.projects') }}</a>
                    @endcan
                    @can('program-list')
                        <a href="{{ route('programs.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#programs"/>
                            </svg>
                            {{ __('admin.programs') }}</a>
                    @endcan
                    @can('banner-list')
                        <a href="{{ route('banners.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#banners"/>
                            </svg>
                            {{ __('admin.banners') }}</a>
                    @endcan
                    @can('vacancy-list')
                        <a href="{{ route('vacancies.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#vacancies"/>
                            </svg>
                            {{ __('admin.vacancies') }}</a>
                    @endcan
                    @can('album-list')
                        <a href="{{ route('albums.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#photo"/>
                            </svg>
                            {{ __('admin.albums') }}</a>
                    @endcan
                    @can('video-list')
                        <a href="{{ route('videos.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#video"/>
                            </svg>
                            {{ __('admin.videos') }}</a>
                    @endcan
                    @can('partner-list')
                        <a href="{{ route('partners.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#partners"/>
                            </svg>
                            {{ __('admin.partners') }}</a>
                    @endcan
                    @can('page-list')
                        <a href="{{ route('pages.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#pages"/>
                            </svg>
                            {{ __('admin.pages') }}</a>
                    @endcan

                    @can('menu-item-list')
                        <a href="{{ route('menu.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#menu"/>
                            </svg>
                            {{ __('admin.menuMain') }}</a>
                    @endcan
                </div>
            </li>
            <li>
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse2" aria-expanded="false"
                   aria-controls="collapse2">
                    <svg width="20" height="20">
                        <use xlink:href="#users-setting"/>
                    </svg>
                    Дії з користувачами
                </a>
                <div id="collapse2" class="panel-collapse collapse second-menu" role="tabpanel"
                     aria-labelledby="heading2">
                    @can('feed-back-list')
                        <a href="{{ route('messages.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#messages"/>
                            </svg>
                            {{ __('admin.messages') }}
                        </a>
                    @endcan
                    @can('subscriber-list')
                        <a href="{{ route('subscribers.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#subscribers"/>
                            </svg>
                            {{ __('admin.subscribers') }}</a>
                    @endcan
                    @can('user-list')
                        <a href="{{ route('users.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#users"/>
                            </svg>
                            {{ __('admin.users') }}</a>
                    @endcan
                </div>
            </li>
            <li>
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse3" aria-expanded="false"
                   aria-controls="collapse3">
                    <svg width="20" height="20">
                        <use xlink:href="#settings"/>
                    </svg>
                    Налаштування
                </a>
                <div id="collapse3" class="panel-collapse collapse second-menu" role="tabpanel"
                     aria-labelledby="heading3">
                    @can('hall-list')
                        <a href="{{ route('halls.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#halls"/>
                            </svg>
                            {{ __('admin.hall_plans') }}</a>
                    @endcan
                    @can('setting-list')
                        <a href="{{ route('settings.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#settings"/>
                            </svg>
                            {{ __('admin.settings') }}
                        </a>
                    @endcan
                    @can('ticket-designer-manage')
                        <a href="{{ route('tickets-designer.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#ticket-design"/>
                            </svg>
                            Шаблони квитків</a>
                    @endcan
                    @can('translation-list')
                        <a href="{{ url('admin/translations') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#translations"/>
                            </svg>
                            Переклади</a>
                    @endcan
                    @can('report-list')
                        <a href="{{ route('reports.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#report"/>
                            </svg>
                            Звіти
                        </a>
                    @endcan
                </div>
            </li>
            <li>
                <a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse4" aria-expanded="false"
                   aria-controls="collapse4">
                    <svg width="20" height="20">
                        <use xlink:href="#prices"/>
                    </svg>
                    Комерцiя
                </a>
                <div id="collapse4" class="panel-collapse collapse second-menu" role="tabpanel"
                     aria-labelledby="heading4">
                    @can('tickets-sold')
                        <a href="{{ route('cash-box.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#tickets"/>
                            </svg>
                            {{__('admin.ticketsSell')}}</a>
                    @endcan
                    @can('price-pattern-list')
                        <a href="{{ route('price-patterns.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#prices"/>
                            </svg>
                            Цінові шаблони</a>
                    @endcan
                    @can('hall-price-pattern-list')
                        <a href="{{ route('hall-price-patterns.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#prices-hall"/>
                            </svg>
                            Цінові шаблони залів</a>
                    @endcan
                    @can('distributor-list')
                        <a href="{{ route('distributors.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#distributors"/>
                            </svg>
                            Дистриб'ютори</a>
                    @endcan
                    @can('ticket-activation')
                        <a href="{{ route('concierge.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#consierge"/>
                            </svg>
                            Компостування квитків</a>
                    @endcan
                    {{--@can('donation-list')--}}
                        <a href="{{ route('donations.index') }}">
                            <svg width="20" height="20">
                                <use xlink:href="#prices"/>
                            </svg>
                            Пожертви</a>
                    {{--@endcan--}}
                </div>
            </li>
            <li>
                <a href="{{ route('profile.edit') }}">
                    <svg width="20" height="20">
                        <use xlink:href="#account"/>
                    </svg>
                    Мій профіль</a>
            </li>
            <li>
                <a href="{{ route('logout') }}"
                   onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                    <svg width="20" height="20">
                        <use xlink:href="#icon-logout"/>
                    </svg>
                    Ви ввійшли як <b>{{ Auth::user()->login }}</b>, {{ __('admin.logout') }}
                </a>
                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                    @csrf
                </form>
            </li>
        @endguest
    </ul>
</div>
