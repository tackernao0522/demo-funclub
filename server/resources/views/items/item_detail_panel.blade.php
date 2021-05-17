<div class="font-weight-bold text-center pb-3 pt-3" style="font-size: 24px; background-color: #e4dede">{{$item->name}}</div>
<table class="table table-bordered">
  <tr>
    <th>販売元</th>
    <td>
      {{$item->seller->name}}
    </td>
  </tr>
  <tr>
    <th>残在庫数</th>
    <td>{{ $item->stock }}</td>
  </tr>
  <tr>
    <th>カテゴリー</th>
    <td>{{$item->secondaryEcCategory->primaryEcCategory->name}} / {{$item->secondaryEcCategory->name}}</td>
  </tr>
  <tr>
    <th>商品の状態</th>
    <td>{{ $item->condition->name }}</td>
  </tr>
  <tr>
    <th>配送料の負担</th>
    <td>{{ $item->payer->name }}</td>
  </tr>
  <tr>
    <th>配送方法</th>
    <td>{{ $item->delivery->name }}</td>
  </tr>
  <tr>
    <th>発送までの日数</th>
    <td>{{ $item->deliveryTime->name }}</td>
  </tr>
</table>
<img class="card-img-top" src="{{ Storage::disk('s3')->url("item-images/{$item->item_image_name}") }}">

<div class="font-weight-bold text-center pb-3 pt-3" style="font-size: 24px">
  <i class="fas fa-yen-sign"></i>
  <span>{{number_format($item->price)}}</span>
</div>
