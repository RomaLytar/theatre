@if (count($errors) > 0)
  <div class="alert alert-danger">
    <strong>{{ __('messages.whoops') }}!</strong> {{ __('messages.problem_with_input') }}<br><br>
    <ul>
      @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
      @endforeach
    </ul>
  </div>
@endif
