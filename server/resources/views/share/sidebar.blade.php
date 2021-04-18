<aside>
  <h3 class="sub-title">カテゴリー</h3>
  <ul class="sub-menu">
    @foreach($categories as $category)
    @if ( Auth::check() && Auth::user()->role === 'admin' )
    <li><a href="{{ route('categories.show', $category->id) }}">{{ $category->name }}</a></li>
    @else
    <li><a href="{{ route('news.category', $category->id) }}">{{ $category->name }}</a></li>
    @endif
    @endforeach
  </ul>

  @include('admin.share.sub_title_drop')

  <h3 class="sub-title">{{ $sub_title->sub_title }}</h3>
  <p>{!! nl2br(e( $sub_title->description )) !!}</p>
</aside>
