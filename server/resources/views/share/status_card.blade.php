<div class="col-12 offset-2 text-center status-alert" id="status-alert" style="margin: 0 auto; padding-top: 30px; width: 67%">
  @if (session('status'))
  <div class="alert alert-success" role="alert">
    {{ session('status') }}
  </div>
  @endif
</div>