<article>
  @foreach($posts as $post)
  <header class="post-info">
    @include('admin.share.modal')
    <h2 class="post-title">{!! nl2br(e( $post->post_title )) !!}</h2>
    <p class="post-date">{{ $post->formatted_post_date }}<span>{{ $post->formatted_post_year }}</span></p>
    <p class="post-cat">カテゴリー：{{ $post->primaryCategory->name }}</p>
  </header>
  <img src="/storage/article-images/{{ $post->post_image_name }}" alt="ライブの様子等">
  <p>{!! nl2br(e( $post->body )) !!}</p>
  <hr>
  @endforeach
</article>
