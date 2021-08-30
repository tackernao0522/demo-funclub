@php
$brands = App\Models\Brand::latest()->get();
@endphp
<div id="brands-carousel" class="logo-slider wow fadeInUp"></div>
<div class="logo-slider-inner">
    <div id="brand-slider" class="owl-carousel brand-slider custom-carousel owl-theme">
        @foreach($brands as $item)
        <div class="item"> <img style="width: 166px; height: 110px" data-echo="{{ Storage::disk('s3')->url("brands/{$item->brand_image}") }}" src="{{ Storage::disk('s3')->url("brands/{$item->brand_image}") }}" alt=""> </div>
        <!--/.item-->
        @endforeach
    </div>
    <!-- /.owl-carousel #logo-slider -->
</div>
<!-- /.logo-slider-inner -->
</div>