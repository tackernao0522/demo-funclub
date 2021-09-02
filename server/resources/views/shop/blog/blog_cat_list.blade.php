@extends('shop.shop_master')

@section('title')
@foreach($blogPosts as $item)
{{ $item->category->blog_category_name }}
@endforeach
@endsection

@section('content')
<div class="breadcrumb">
    <div class="container">
        <div class="breadcrumb-inner">
            <ul class="list-inline list-unstyled">
                <li><a href="{{ route('shop.index') }}">Home</a></li>
                @foreach($blogPosts as $item)
                <li class='active'>{{ $item->category->blog_category_name }}</li>
                @endforeach
            </ul>
        </div><!-- /.breadcrumb-inner -->
    </div><!-- /.container -->
</div><!-- /.breadcrumb -->

<div class="body-content">
    <div class="container">
        <div class="row">
            <div class="blog-page">
                <div class="col-md-9">
                    @foreach($blogPosts as $blog)
                    <div class="blog-post  wow fadeInUp">
                        <a href="blog-details.html"><img class="img-responsive" src="{{ Storage::disk('s3')->url("blogs/{$blog->post_blog_image}") }}" alt="blog_image"></a>
                        <h1><a href="blog-details.html">{{ $blog->post_blog_title }}</a></h1>
                        <span class="date-time">{{ Carbon\Carbon::parse($blog->created_at)->diffForHumans() }}</span>
                        <p>
                            {!! Str::limit($blog->post_blog_details, 200) !!}
                        </p>

                        <a href="{{ route('blogPost.details', $blog->id) }}" class="btn btn-upper btn-primary read-more">read more</a>
                    </div>
                    @endforeach

                    <div class="clearfix blog-pagination filters-container  wow fadeInUp" style="padding:0px; background:none; box-shadow:none; margin-top:15px; border:none">

                        <div class="text-right">
                            <div class="pagination-container">
                                <ul class="list-inline list-unstyled">
                                    {{ $blogPosts->appends($_GET)->links('vendor.pagination.custom') }}
                                </ul><!-- /.list-inline -->
                            </div><!-- /.pagination-container -->
                        </div><!-- /.text-right -->

                    </div><!-- /.filters-container -->
                </div>
                <div class="col-md-3 sidebar">
                    <div class="sidebar-module-container">
                        <!-- ==============================================CATEGORY============================================== -->
                        <div class="sidebar-widget outer-bottom-xs wow fadeInUp">
                            <h3 class="section-title">ブログカテゴリー</h3>
                            <div class="sidebar-widget-body m-t-10">
                                <div class="accordion">
                                    @foreach($blogCategories as $category)
                                    <ul class="list-group">
                                        <a href="{{ url('shop/blog/category/post/' . $category->id) }}">
                                            <li class="list-group-item">{{ $category->blog_category_name }}</li>
                                        </a>
                                    </ul>
                                    @endforeach
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
@endsection
