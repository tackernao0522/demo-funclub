@php
$tags_name = App\Models\Product::groupBy('product_tags_name')->select('product_tags_name')->get();
@endphp

<div class="sidebar-widget product-tag wow fadeInUp">
    <h3 class="section-title">商品タグ</h3>
    <div class="sidebar-widget-body outer-top-xs">
        <div class="tag-list">
            @foreach($tags_name as $tag)
            <a class="item active" title="Phone" href="{{ url('product/tag/'.$tag->product_tags_name) }}">{{ $tag->product_tags_name }}</a>
            @endforeach
        </div>
        <!-- /.tag-list -->
    </div>
    <!-- /.sidebar-widget-body -->
</div>
<!-- /.sidebar-widget -->
