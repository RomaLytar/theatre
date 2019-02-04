<div class="social" data-social>
  <ul class="social__list">
    @if(setting(session('locale') . '.' . 'facebook') !== null)
      <li>
        <span class="visually-hidden">Facebook</span>
        <a href="{{ setting(session('locale') . '.' . 'facebook') }}">
          <svg width="22" height="22" fill="#666">
            <use xlink:href="#icon-facebook"/>
          </svg>
        </a>
      </li>
    @endif
    @if(setting(session('locale') . '.' . 'twitter') !== null)
      <li>
        <span class="visually-hidden">Twitter</span>
        <a href="{{ setting(session('locale') . '.' . 'twitter') }}">
          <svg width="22" height="22" fill="#666">
            <use xlink:href="#icon-twitter"/>
          </svg>
        </a>
      </li>
    @endif
    @if(setting(session('locale') . '.' . 'instagram') !== null)
      <li>
        <span class="visually-hidden">Instagram</span>
        <a href="{{ setting(session('locale') . '.' . 'instagram') }}">
          <svg width="22" height="22" fill="#666">
            <use xlink:href="#icon-instagram"/>
          </svg>
        </a>
      </li>
    @endif
    @if(setting(session('locale') . '.' . 'youtube') !== null)
      <li>
        <span class="visually-hidden">YouTube</span>
        <a href="{{ setting(session('locale') . '.' . 'youtube') }}">
          <svg width="22" height="22" fill="#666">
            <use xlink:href="#icon-youtube"/>
          </svg>
        </a>
      </li>
    @endif
  </ul>
</div>
