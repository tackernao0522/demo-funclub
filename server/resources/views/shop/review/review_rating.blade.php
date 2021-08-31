@php
$reviewCount = App\Models\Review::where('product_id', $product->id)->where('status', 1)->latest()->get();
$avarage = App\Models\Review::where('product_id', $product->id)->where('status', 1)->avg('rating');
@endphp
<div class="rating">
    @if($avarage == 0)
        評価はまだありません。
    @elseif($avarage == 1 || $avarage < 2) 
        <div>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
        </div>
    @elseif($avarage == 2 || $avarage < 3) 
        <div>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
        </div>
    @elseif($avarage == 3 || $avarage < 4)
        <div>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
            <span class="fa fa-star"></span>
        </div>
    @elseif($avarage == 4 || $avarage < 5)
        <div>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star"></span>
        </div>
    @elseif($avarage == 5 || $avarage < 5)
        <div>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
            <span class="fa fa-star checked"></span>
        </div>
    @endif
</div>
