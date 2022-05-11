
@if (!empty($messages))
<div class="alert alert-{{ $type }} alert-dismissible fade show" role="alert">
  @foreach ($messages as $message)
    {{ $message }} <br>
  @endforeach
  <button type="button" class="close" data-dismiss="alert" aria-label="Close">
    <span aria-hidden="true">&times;</span>
  </button>
</div>
@endif