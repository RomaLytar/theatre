
{{-- <section class="team">
  <div class="wrap container-fluid">
    {{ $articles->links('pages.theatre._blocks.pagination.pagination') }}
  </div>
  <ul class="team__type">
    @foreach($groups as $group)
      <li><a href="#">{{$group->translate->title}}</a></li>
    @endforeach
  </ul>
  @foreach($groups as $group)
  <div class="team__subtype">
    <p class="team__subtype-title">{{$group->translate->title}}</p>
    <ul class="team__type-list">
      @foreach($group->children_groups as $children_group)
        <li><a href="#group{{$children_group->id}}">{{$children_group->translate->title}}</a></li>
      @endforeach
    </ul>
  </div>
  @endforeach

  @foreach($groups as $group)
    @foreach($group->children_groups as $children_group)
      <div class="team__container" id="group{{$children_group->id}}">
        <h3 class="team__container-title">{{$children_group->translate->title}}</h3>
        <div class="row team__container-list ">
          @foreach($children_group->actors as $actor)
            <div class="col-sm-4">
              @include('pages.theatre._blocks.team.team-card.team-card', ['actor' => $actor])
            </div>
          @endforeach
        </div>
      </div>
    @endforeach
  @endforeach


</section> --}}

{{-- Этот файл сохранен из-за подвязки. И может быть удален за ненадобностью по собственной инициативе и благословления верховного бека - Вовчика. --}}
