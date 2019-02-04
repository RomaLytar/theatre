<section class="calendar" data-calendar>
  @include('pages.theatre._blocks.calendar.calendar-type.calendar-type')
  <div class="wrap container-fluid">
    <section class="calendar__filter">
      @include('pages.theatre._blocks.filter.filter-calendar')
     </section>
    @include('pages.theatre._blocks.search.search')
    <div class="calendar__events" data-calendar-events></div>
    @include('pages.theatre._blocks.calendar.calendar-month-toggle.calendar-month-toggle')
  </div>
</section>
