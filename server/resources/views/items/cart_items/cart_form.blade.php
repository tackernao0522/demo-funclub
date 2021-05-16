@if (Auth::check() && Auth::user()->role === 'admin')
<div class="cart-form item-cart" style="margin-top: -20px">
  <form method="POST" action="{{ route('cart.item') }}" class="form-inline m-1">
    @csrf
    <select name="quantity" class="form-control col-md-2 mr-1">
      <option selected>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
      <option>6</option>
      <option>7</option>
      <option>8</option>
      <option>9</option>
      <option>10</option>
    </select>
    <input type="hidden" name="item_id" value="{{ $item->id }}">
    <button type="submit" class="btn btn-primary col-md-7" style="height: 35px !important; line-height: inherit">カートに入れる</button>
  </form>
</div>
@elseif (Auth::check() && Auth::user()->role === 'premium')
<div class="cart-form item-cart" style="margin-top: -15px">
  <form method="POST" action="{{ route('cart.item', [$item->id]) }}" class="form-inline m-1">
    @csrf
    <select name="quantity" class="form-control col-md-2 mr-1">
      <option selected>1</option>
      <option>2</option>
      <option>3</option>
      <option>4</option>
      <option>5</option>
      <option>6</option>
      <option>7</option>
      <option>8</option>
      <option>9</option>
      <option>10</option>
    </select>
    <input type="hidden" name="item_id" value="{{ $item->id }}">
    <button type="submit" class="btn btn-primary col-md-7" style="height: 35px !important; line-height: inherit">カートに入れる</button>
  </form>
</div>
@endif

