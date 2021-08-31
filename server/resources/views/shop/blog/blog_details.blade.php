@extends('shop.shop_master')

@section('title')
{{ $blogPost->post_blog_title }}
@endsection

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('shop.index') }}">Home</a></li>
                <li class='active'>{{ $blogPost->post_blog_title }}</li>
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="blog-page">
                <div class="col-md-9">
                    <div class="blog-post wow fadeInUp" style="margin-bottom: 50px">
                        <img class="img-responsive" src="{{ Storage::disk('s3')->url("blogs/{$blogPost->post_blog_image}") }}" alt="">
                        <h1>{{ $blogPost->post_blog_title }}</h1>
                        <span class="date-time">{{ Carbon\Carbon::parse($blogPost->created_at)->diffForHumans() }}</span>

                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_inline_share_toolbox"></div>

                        <p>{!! $blogPost->post_blog_details !!}</p>

                        <!-- Go to www.addthis.com/dashboard to customize your tools -->
                        <div class="addthis_inline_share_toolbox"></div>

                    </div>
                </div>
                <div class="col-md-3 sidebar">
                    <div class="sidebar-module-container">
                        <!-- ==============================================CATEGORY============================================== -->
                        <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
                            <h3 class="section-title">ブログカテゴリー</h3>
                            <div class="sidebar-widget-body m-t-10">
                                <div class="accordion">
                                    <div class="accordion-group">
                                        @foreach($blogCategories as $category)
                                        <ul class="list-group">
                                            <a href="{{ url('shop/blog/category/post/' . $category->id) }}">
                                                <li class="list-group-item">{{ $category->blog_category_name }}</li>
                                            </a>
                                        </ul>
                                        @endforeach
                                    </div><!-- /.accordion-group -->
                                </div><!-- /.accordion -->
                            </div><!-- /.sidebar-widget-body -->
                        </div><!-- /.sidebar-widget -->
                        <!-- ============================================== CATEGORY : END ============================================== -->

                        <!-- ============================================== PRODUCT TAGS ============================================== -->
                        @include('shop.common.product_tags')
                        <!-- ============================================== PRODUCT TAGS : END ============================================== -->
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Go to www.addthis.com/dashboard to customize your tools -->
<script type="text/javascript" src="//s7.addthis.com/js/300/addthis_widget.js#pubid=ra-610a3df0f395b76e"></script>

@endsection
