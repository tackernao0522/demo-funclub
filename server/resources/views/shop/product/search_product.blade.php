{{-- <ul>
    @foreach($products as $item)
    <li><img src="{{ Storage::disk('s3')->url("products/thambnail/{$item->product_thambnail}") }}" alt="商品画像" style="width: 30px; height: 30px"> {{ $item->product_name }} </li>
@endforeach
</ul> --}}

<style>
    body {
        background-color: #eee
    }

    .card {
        background-color: #fff;
        padding: 15px;
        border: none
    }

    .input-box {
        position: relative
    }

    .input-box i {
        position: absolute;
        right: 13px;
        top: 15px;
        color: #ced4da
    }

    .form-control {
        height: 50px;
        background-color: #eeeeee69
    }

    .form-control:focus {
        background-color: #eeeeee69;
        box-shadow: none;
        border-color: #eee
    }

    .list {
        padding-top: 20px;
        padding-bottom: 10px;
        display: flex;
        align-items: center
    }

    .border-bottom {
        border-bottom: 2px solid #eee
    }

    .list i {
        font-size: 19px;
        color: red
    }

    .list small {
        color: #dedddd
    }
</style>

@if ($products->isEmpty())
<h3 class="text-center text-danger">検索した商品はありません。</h3>
@else
<div class="container mt-5">
    <div class="row d-flex justify-content-center ">
        <div class="col-md-6">
            <div class="card">
                @foreach($products as $item)
                <a href="{{ url('product/details/' . $item->id . '/' . $item->product_slug_name) }}">
                    <div class="list border-bottom"> <img src="{{ Storage::disk('s3')->url("products/thambnail/{$item->product_thambnail}") }}" alt="商品画像" style="width: 30px; height: 30px">
                        <div class="d-flex flex-column ml-3" style="margin-left: 10px"> <span> {{ $item->product_name }}</span> <small>¥ {{ number_format($item->selling_price) }}(税込)</small> </div>
                    </div>
                </a>
                @endforeach
            </div>
        </div>
    </div>
</div>
@endif