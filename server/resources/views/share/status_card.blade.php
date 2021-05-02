<div class="row article-post">
  <div class="col-8 offset-2">
    @if (session('status'))
    <div class="alert alert-success" role="alert">
      {{ session('status') }}
    </div>
    @endif
  </div>
</div>
