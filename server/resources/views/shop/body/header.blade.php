<header class="header-style-1">

    <!-- ============================================== TOP MENU ============================================== -->
    <div class="top-bar animate-dropdown">
        <div class="container">
            <div class="header-top-inner">
                <div class="cnt-account">
                    <ul class="list-unstyled">
                    @if ( Auth::check() && Auth::user()->role === 'admin' )
                    <li><a href="{{ route('dashboard') }}"><i class="fa fa-cog"></i>ショップダッシュボード</a></li>
                    @endif
                        <li><a href="#"><i class="icon fa fa-user"></i>マイアカウント</a></li>
                        <li><a href="{{ route('wishlist') }}"><i class="icon fa fa-heart"></i>ウイッシュリスト</a></li>
                        <li><a href="{{ route('mycart') }}"><i class="icon fa fa-shopping-cart"></i>マイカート</a></li>
                        <li><a href="{{-- route('checkout') --}}"><i class="icon fa fa-check"></i>チェックアウト</a></li>
                        <li><a href="" type="button" class="btn btn-primary" data-toggle="modal" data-target="#ordertracking"><i class="icon fa fa-check" style="margin-top: 5px"></i>オーダー追跡</a></li>
                        @auth
                        <li><a href="{{ route('user.dashboard') }}"><i class="icon fa fa-user"></i>ユーザープロフィール</a></li>
                        <li><a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"><i class="icon fa fa-lock"></i>ログアウト</a></li>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                        @endauth
                    </ul>
                </div>
                <!-- /.cnt-account -->
                <!-- /.cnt-cart -->
                <div class="clearfix"></div>
            </div>
            <!-- /.header-top-inner -->
        </div>
        <!-- /.container -->
    </div>
    <!-- /.header-top -->
    <!-- ============================================== TOP MENU : END ============================================== -->
    <div class="main-header">
        <div class="container">
            <div class="row">
                <div class="col-xs-12 col-sm-12 col-md-3 logo-holder">
                    {{-- @php
                    $setting = App\Models\SiteSetting::find(1);
                    @endphp --}}
                    <!-- ============================================================= LOGO ============================================================= -->
                    <div class="logo"> <a href="{{ url('/') }}"> <img src="{{-- Storage::disk('s3')->url("siteLogo/{$setting->logo}") --}}" alt="logo"> </a> </div>
                    <!-- /.logo -->
                    <!-- ============================================================= LOGO : END ============================================================= -->
                </div>
                <!-- /.logo-holder -->

                <div class="col-xs-12 col-sm-12 col-md-7 top-search-holder">
                    <!-- /.contact-row -->
                    <!-- ============================================================= SEARCH AREA ============================================================= -->
                    <div class="search-area">
                        <form method="POST" action="{{-- route('product.search') --}}">
                            @csrf
                            <div class="control-group">
                                <ul class="categories-filter animate-dropdown">
                                    <li class="dropdown"> <a class="dropdown-toggle" data-toggle="dropdown" href="category.html">カテゴリー<b class="caret"></b></a>
                                        <ul class="dropdown-menu" role="menu">
                                            <li class="menu-header">Computer</li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Clothing</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Electronics</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Shoes</a></li>
                                            <li role="presentation"><a role="menuitem" tabindex="-1" href="category.html">- Watches</a></li>
                                        </ul>
                                    </li>
                                </ul>
                                <input class="search-field" onfocus="search_result_show()" onblur="search_result_hide()" name="search" id="search" placeholder="Search here..." />
                                <button class="search-button" type="submit"></button>
                            </div>
                        </form>
                        <div id="searchProducts"></div>
                    </div>
                    <!-- /.search-area -->
                    <!-- ============================================================= SEARCH AREA : END ============================================================= -->
                </div>
                <!-- /.top-search-holder -->

                <div class="col-xs-12 col-sm-12 col-md-2 animate-dropdown top-cart-row">
                    <!-- ============================================================= SHOPPING CART DROPDOWN ============================================================= -->

                    <div class="dropdown dropdown-cart"> <a href="#" class="dropdown-toggle lnk-cart" data-toggle="dropdown">
                            <div class="items-cart-inner">
                                <div class="basket"> <i class="glyphicon glyphicon-shopping-cart"></i> </div>
                                <div class="basket-item-count"><span class="count" id="cartQty"> </span></div>
                                <div class="total-price-basket"> <span class="lbl">カート -</span>
                                    <span class="total-price"> <span class="sign"></span>
                                        <span class="value" id="cartSubTotal"> </span> </span>
                                </div>
                            </div>
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <!-- Mini Cart Start with Ajax -->
                                <div id="miniCart">

                                </div>
                                <!-- End Mini Cart Start with Ajax -->
                                <div class="clearfix cart-total">
                                    <div class="pull-right"> <span class="text">合計 :</span>
                                        <span class='price' id="cartSubTotal"> </span>
                                    </div>
                                    <div class="clearfix"></div>
                                    <a href="checkout.html" class="btn btn-upper btn-primary btn-block m-t-20">チェックアウト</a>
                                </div>
                                <!-- /.cart-total-->

                            </li>
                        </ul>
                        <!-- /.dropdown-menu-->
                    </div>
                    <!-- /.dropdown-cart -->

                    <!-- ============================================================= SHOPPING CART DROPDOWN : END============================================================= -->
                </div>
                <!-- /.top-cart-row -->
            </div>
            <!-- /.row -->

        </div>
        <!-- /.container -->

    </div>
    <!-- /.main-header -->

    <!-- ============================================== NAVBAR ============================================== -->
    <div class="header-nav animate-dropdown">
        <div class="container">
            <div class="yamm navbar navbar-default" role="navigation">
                <div class="navbar-header">
                    <button data-target="#mc-horizontal-menu-collapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                        <span class="sr-only">Toggle navigation</span> <span class="icon-bar"></span> <span class="icon-bar"></span> <span class="icon-bar"></span> </button>
                </div>
                <div class="nav-bg-class">
                    <div class="navbar-collapse collapse" id="mc-horizontal-menu-collapse">
                        <div class="nav-outer">
                            <ul class="nav navbar-nav">
                                <li class="active dropdown yamm-fw"> <a href="{{ url('/') }}" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">トップ</a> </li>

                                <!-- Get Category Table Data -->
                                @php
                                $categories = App\Models\Category::orderBy('id','ASC')->get();
                                @endphp

                                @foreach($categories as $category)
                                <li class="dropdown yamm mega-menu"> <a href="home.html" data-hover="dropdown" class="dropdown-toggle" data-toggle="dropdown">{{ $category->category_name }}</a>
                                    <ul class="dropdown-menu container">
                                        <li>
                                            <div class="yamm-content ">
                                                <div class="row">
                                                    <!-- Get SubCategory Table Data -->
                                                    @php
                                                    $subCategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('id','ASC')->get();
                                                    @endphp

                                                    @foreach($subCategories as $subCategory)
                                                    <div class="col-xs-12 col-sm-6 col-md-2 col-menu" style="padding-right: 0">
                                                        <a href="{{ url('subCategory/product/' . $subCategory->id) }}">
                                                            <h2 class="title">{{ $subCategory->subCategory_name }}</h2>
                                                        </a>

                                                        <!-- Get SubSubCategory Table Data -->
                                                        @php
                                                        $subSubCategories = App\Models\SubSubCategory::where('subCategory_id',$subCategory->id)->orderBy('id','ASC')->get();
                                                        @endphp

                                                        @foreach($subSubCategories as $subSubCategory)
                                                        <ul class="links">
                                                            <li><a href="{{ url('subSubCategory/product/' . $subSubCategory->id) }}">{{ $subSubCategory->subSubCategory_name }}</a></li>
                                                        </ul>
                                                        @endforeach
                                                        <!-- end SubSubCategoy Foreach -->
                                                    </div>
                                                    <!-- /.col -->
                                                    @endforeach
                                                    <!-- end SubCategoy Foreach -->

                                                    <div class="col-xs-12 col-sm-6 col-md-4 col-menu banner-image"> <img class="img-responsive" src="{{ asset('frontend/assets/images/banners/top-menu-banner.jpg') }}" alt=""> </div>
                                                    <!-- /.yamm-content -->
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </li>
                                @endforeach
                                <!-- end Category Foreach -->
                                <li> <a href="{{-- route('shop.page') --}}">ショップ</a> </li>
                                <!-- <li class="dropdown  navbar-right special-menu"> <a href="#">今日の特別セール</a> </li> -->
                                <li class="dropdown  navbar-right special-menu"> <a href="{{-- route('home.blog') --}}">ブログ</a> </li>
                            </ul>
                            <!-- /.navbar-nav -->
                            <div class="clearfix"></div>
                        </div>
                        <!-- /.nav-outer -->
                    </div>
                    <!-- /.navbar-collapse -->

                </div>
                <!-- /.nav-bg-class -->
            </div>
            <!-- /.navbar-default -->
        </div>
        <!-- /.container-class -->

    </div>
    <!-- /.header-nav -->
    <!-- ============================================== NAVBAR : END ============================================== -->

    <!-- Order Tracking Modal -->
    <div class="modal fade" id="ordertracking" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">オーダー追跡</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="{{-- route('order.tracking') --}}">
                        @csrf
                        <div class="modal-body">
                            <label for="">請求番号</label>
                            <input type="text" name="code" required="" class="form-control" placeholder="オーダー追跡したい請求番号入力" value="{{-- old('code') --}}">
                        </div>

                        <button type="submit" class="btn btn-danger" style="margin-left: 15px">追跡する</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</header>

<style>
    .search-area {
        position: relative;
    }

    #searchProducts {
        position: absolute;
        top: 100%;
        left: 0;
        width: 100%;
        background: #ffffff;
        z-index: 999;
        border-radius: 8px;
        margin-top: 5px;
    }
</style>

<script>
    function search_result_hide() {
        $("#searchProducts").slideUp();
    }

    function search_result_show() {
        $("#searchProducts").slideDown();
    }
</script>
