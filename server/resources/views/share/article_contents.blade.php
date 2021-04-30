<article>
  @foreach($posts as $post)
  @include('admin.share.modal')
  <header class="post-info">
    <h2 class="post-title">{!! nl2br(e( $post->post_title )) !!}</h2>
    <p class="post-date">{{ $post->formatted_post_date }}<span>{{ $post->formatted_post_year }}</span></p>
    <p class="post-cat">カテゴリー：{{ $post->primaryCategory->name }}</p>
  </header>
  <img src="{{ Storage::disk('s3')->url("article-images/{$post->post_image_name}") }}" alt="ライブの様子等">
  <p>{!! nl2br(e( $post->body )) !!}</p>
  <hr>
  @endforeach
  <div class="d-flex justify-content-center mt-2 pt-1">
    @if ( Auth::check() && Auth::user()->role === 'admin' )
    <div class="mr-2" style="margin-top: -7px">
      <button class="btn btn-primary" type="button" onclick="history.back()">Back</button>
    </div>
    @else
    <div class="mr-2" style="margin-top: -1px">
      <button class="btn btn-primary" type="button" onclick="history.back()">Back</button>
    </div>
    @endif
    {{ $posts->links('vendor.pagination.original') }}
  </div>
</article>
