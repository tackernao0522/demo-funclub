<div class="font-weight-bold text-center pb-3 pt-3" style="font-size: 24px; background-color: #e4dede">{{$item->name}}</div>
<table class="table table-bordered">
  <tr>
    <th>販売元</th>
    <td>
      {{$item->seller->name}}
    </td>
  </tr>
  @if($item->size)
  <tr>
    <th>サイズ</th>
    <td>{{ $item->size }}</td>
  </tr>
  @endif
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
@if ( Auth::check() && Auth::user()->role === 'admin' )
<a href="{{ route('items.edit', ['item' => $item]) }}" class="btn btn-primary sold_items"><i class="nav-icon fas fa-edit"></i></a>
@if ( $item->status == 1 )
<a href="{{ url('/unactivate_item/' . $item->id) }}" class="btn btn-success items_status">出品停止</a>
@else
<a href="{{ url('/activate_item/' . $item->id) }}" class="btn btn-warning items_status">出品開始</a>
@endif
<a href="#" id="delete" class="btn btn-danger sold_items" data-toggle="modal" data-target="#modal-delete-{{ $item->id }}"><i class="nav-icon fas fa-trash"></i></a>
@include('admin.ec.modal')
@endif
<div class="font-weight-bold text-center pb-3 pt-3" style="font-size: 24px">
  <i class="fas fa-yen-sign"></i>
  <span>{{number_format($item->price)}}(税込)</span>
</div>
