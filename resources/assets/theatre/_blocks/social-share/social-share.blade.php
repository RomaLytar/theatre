<div class="social-share">
  <p class="social-share__text">{{ __('home.share') }}</p>
  <ul class="social-share__list">
    @if(setting(session('locale') . '.' . 'facebook') !== null)
      <li>
        <a href="{{ setting(session('locale') . '.' . 'facebook') }}">
          <span class="visually-hidden">Facebook</span>
          <svg width="22" height="22" fill="#666">
            <use xlink:href="#icon-facebook"/>
          </svg>
        </a>
      </li>
    @endif
    @if(setting(session('locale') . '.' . 'twitter') !== null)
      <li>
        <a href="{{ setting(session('locale') . '.' . 'twitter') }}">
          <span class="visually-hidden">Twitter</span>
          <svg width="22" height="22" fill="#666">
            <use xlink:href="#icon-twitter"/>
          </svg>
        </a>
      </li>
    @endif
    @if(setting(session('locale') . '.' . 'instagram') !== null)
      <li>
        <a href="{{ setting(session('locale') . '.' . 'instagram') }}">
          <span class="visually-hidden">Instagram</span>
          <svg width="22" height="22" fill="#666">
            <use xlink:href="#icon-instagram"/>
          </svg>
        </a>
      </li>
    @endif
    @if(setting(session('locale') . '.' . 'youtube') !== null)
      <li>
        <a href="{{ setting(session('locale') . '.' . 'youtube') }}">
          <span class="visually-hidden">YouTube</span>
          <svg width="22" height="22" fill="#666">
            <use xlink:href="#icon-youtube"/>
          </svg>
        </a>
      </li>
    @endif
  </ul>
</div>
