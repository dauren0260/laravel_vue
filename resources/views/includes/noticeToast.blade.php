@if ($errors->any())
<div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center w-100">
  <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
    <div class="toast-header">
      <strong class="me-auto">訊息通知</strong>
      <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
    </div>
    <div class="toast-body">
        @foreach ($errors->all() as $error)
        {{ $error }} <br>
        @endforeach
      </div>
  </div>
</div>
@elseif(\Session::has("status"))
  <div aria-live="polite" aria-atomic="true" class="d-flex justify-content-center align-items-center w-100">
      <div class="toast" role="alert" aria-live="assertive" aria-atomic="true">
          <div class="toast-header">
          <strong class="me-auto">訊息通知</strong>
          <button type="button" class="btn-close" data-bs-dismiss="toast" aria-label="Close"></button>
          </div>
          <div class="toast-body">
              {!! \Session::get("status") !!}
          </div>
      </div>
  </div>
@endif