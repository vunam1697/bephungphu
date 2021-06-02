<header>
    <div class="header-top">
        <div class="container">
            <div class="content" style="position: relative;">
                <div class="row">
                    <div class="col-md-4">
                        <div class="logo">
                        	<a title="{{ @$site_info->site_title }}" href="{{ url('/') }}">
                        		<img src="{{ @$site_info->logo }}" class="img-fluid" alt="{{ @$site_info->site_title }}">
                        	</a>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding-left: 0;">
                        <div class="focus-search">
                            <form action="{{ route('home.search') }}" method="GET">
                                <div class="box-search">
                                    <input type="text" placeholder="Nhập từ khóa tìm kiếm ..." name="q" id="query-search">
                                    <button type="submit" id="icon-search"><i class="fa fa-search" id=""></i></button>
                                </div>
                            </form>
                            <div class="list-search" style="display: none;">
                                
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4" style="padding-left: 0; position: unset;">
                        <div class="header-right">
                            <ul class="list-inline">
                                <li class="list-inline-item">
                                    <a title="" href="javascript:0">Sản phẩm đã xem <i class="fa fa-caret-down"></i></a>
                                    @if (session('product_viewed'))
                                        <div class="hver-seen">
                                            @include('frontend.teamplate.parts-header.products-viewed')
                                        </div>
                                    @endif
                                </li>
                                <li class="list-inline-item">
                                    <a title="Giỏ hàng" href="{{ route('home.cart') }}" class="cart">
                                        <img src="{{ __BASE_URL__ }}/images/cart-hd.png" class="img-fluid" alt="cart"><span>{{ Cart::count() }}</span>
                                    </a>
                                    @if (Cart::count())
                                        <div class="hver-cart">
                                            @include('frontend.teamplate.parts-header.products-cart')
                                        </div>
                                    @endif
                                   
                                </li>
                                <li class="list-inline-item"><a title="" href="tel:{{ @$site_info->hotline }}">Hotline: {{ @$site_info->hotline }}</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-menu">
        <div class="container">
            <div class="content">
                <div class="row">
                    <div class="col-md-3">
                        <div class="menu-left">
                            <div class="cate-menu"><a title="" href="javascript:0"><i class="fa fa-bars"></i>Danh mục sản phẩm</a></div>
                            <ul class="">
                                {{-- {{ url()->current() == url('/') ? 'active' : null }} --}}
                                @include('frontend.teamplate.parts-header.category-list')
                            </ul>
                        </div>
                    </div>
                    <div class="col-md-9">
                        <div class="menu-right">
                            <ul>
                                @foreach ($menuMain as $item)
                                    @if ($item->parent_id == null)
                                        <li><a title="{{ $item->title }}" href="{{ url($item->url) }}">{{ $item->title }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="menu-mobile d-none">
        <div class="container">
            <div class="row">
                <div class="col-md-5 col-6 col-sm-6">
                    <div class="logo"> 
                        <a title="{{ @$site_info->site_title }}" href="{{ url('/') }}">
                        	<img alt="{{ @$site_info->site_title }}" src="{{ @$site_info->logo }}" class="img-fluid avarta-logo" alt="{{ @$site_info->site_title }}">
                        </a>
                    </div>
                </div>
                <div class="col-md-7 col-6 col-sm-6">
                    <div class="right text-right">
                        <div class="search">
                            <form action="{{ route('home.search') }}" method="GET">
                                <input type="text" placeholder="Nhập từ khóa tìm kiếm" name="q">
                                <button type="submit"><i class="fa fa-search"></i></button>
                            </form>
                        </div>
                        <div class="cart">
                            <a title="Giỏ hàng" href="{{ route('home.cart') }}">
                                <img src="{{ __BASE_URL__ }}/images/cart-hd.png" class="img-fluid" alt="cart"><span>{{ Cart::count() }}</span>
                            </a>
                        </div>
                        <div class="header header-iconmenu">
                            <!-- <a title="" href="#menu"><img src="{{ __BASE_URL__ }}/images/bar.png" class="img-fluid" alt="bar"></a> -->
                            <a title="" href="#menu">
                                <i class=""></i>
                                <span>Menu</span>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <nav id="menu">
            <ul>
                @foreach ($menuMainMobile as $item)
                    @if ($item->parent_id == null)
                        @if ($item->class == 'menu-category')
                            <li>
                                <a title="{{ $item->title }}" href="{{ url($item->url) }}">{{ $item->title }}</a>
                                <ul>
                                    @if (count($menuCategory))
                                        @foreach ($menuCategory as $value)
                                            <li>
                                                <a title="{{ $value->title }}" href="{{ url($value->url) }}">{{ $value->title }}</a>
                                                @if (count($value->get_child_cate()))
                                                   <ul>
                                                        @foreach ($value->get_child_cate() as $value2)
                                                            @if($value2->type == 'category')
                                                            <li>
                                                                <a href="{{ url($value2->url) }}">{{ $value2->title }}</a>
                                                            </li>
                                                            @endif
                                                        @endforeach
                                                   </ul> 
                                                @endif
                                            </li>
                                           
                                        @endforeach
                                    @endif

                                </ul>
                            </li>
                        @else
                            <li><a title="{{ $item->title }}" href="{{ url($item->url) }}">{{ $item->title }}</a></li>
                        @endif
                    @endif
                @endforeach
            </ul>
        </nav>
    </div>

    <div class="search-mb">
        <form action="{{ route('home.search') }}" method="GET">
            <input type="text" placeholder="Nhập từ khóa tìm kiếm" class="" name="q">
            <button class=""><i class="fa fa-search"></i></button>
        </form>
    </div>
</header>