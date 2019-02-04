
@if(isset($actors))
<section class="team-members-vertical">
    @if($has_title)
    <h2 class="team-members-vertical__title">{{ $title }}</h2>
    @endif
    <div class="row team-members-vertical__container">
        @foreach($actors as $actor)
        <div class="{{ (isset($actorsTroupe)) ? 'col-6 col-sm-6 col-md-3 col-xl-3 d-flex team-members-vertical__actor-troupe' : 'col-md-6 col-xl-3 d-flex ' }} align-items-stretch">
            @include('pages.theatre._blocks.team.team-card-vertical.team-card-vertical-orchestra', [
            'actor' => $actor
            ])
        </div>
        @endforeach
    </div>
</section>
@endif
