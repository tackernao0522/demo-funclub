@if ( Auth::check() && Auth::user()->role === 'admin' )
<div class="d-flex justify-content-center" style="margin-bottom: 10px">
  <a href="/cartItems">
    <i class="fa fa-shopping-cart" aria-hidden="true"></i>カートの中身を見る
  </a>
</div>
@elseif ( Auth::check() && Auth::user()->role === 'premium' )
<div class="d-flex justify-content-center">
  <a href="/cartItems">
    <i class="fa fa-shopping-cart" aria-hidden="true"></i>カートの中身を見る
  </a>
</div>
@endif
<nav class="navbar navbar-light bg-light item-search" style="max-width: 65%; margin: 0 auto">
  <form class="form-inline my-2 my-lg-0" style="margin: 0 auto">
    <div class="input-group-prepend">
      <select class="custom-select" name="category" style="border-color: black !important">
        <option value="">全て</option>
        @foreach ($categories as $category)
        <option value="primary:{{$category->id}}" class="font-weight-bold" {{ $defaults['category'] == "primary:" . $category->id ? 'selected' : ''}}>{{$category->name}}</option>
        @foreach ($category->secondaryEcCategories as $secondary)
        <option value="secondary:{{$secondary->id}}" {{ $defaults['category'] == "secondary:" . $secondary->id ? 'selected' : ''}}>　{{$secondary->name}}</option>
        @endforeach
        @endforeach
      </select>
    </div>
    <input class="form-control mr-sm-2" type="text" name="keyword" value="{{$defaults['keyword']}}" placeholder="キーワード検索" aria-label="Search" style="height: 37px; border-color: black">
    @if (( Auth::check() && Auth::user()->role === 'admin' ))
    <button class="btn btn-success my-2 my-sm-0 contact-search" type="submit" style="height: 35px; line-height: 10px; width: 50px; font-size: 11px; margin-left: 0">検索</button>
    @else
    <button class="btn btn-success my-2 my-sm-0 contact-search" type="submit" style="height: 35px; line-height: 10px; width: 50px; font-size: 11px">検索</button>
    @endif
  </form>
</nav>
