<nav class="menu" data-menu>
  <ul class="menu__list">
    @if(isset($mainMenu))
      @include('pages.theatre._blocks.menu.menu-items', ['items' => $mainMenu->roots(), 'i' => 0])
    @endif
  </ul>
  <div class="menu__second-wrap menu__second-bg ">
    <div class="menu__second-img">
      <img src="/design/img/menu/bg.jpg" alt="">
    </div>
  </div>
</nav>
