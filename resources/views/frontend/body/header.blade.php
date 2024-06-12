<header class="header-area header-style-1 header-height-2">
    <div class="mobile-promotion">
        <span>Grand opening, <strong>up to 15%</strong> off all items. Only <strong>3 days</strong> left</span>
    </div>
    <div class="header-top header-top-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="row align-items-center">
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info">
                        <ul>

                            <li><a href="page-account.html">My Cart</a></li>
                            <li><a href="shop-wishlist.html">Checkout</a></li>
                            <li><a href="shop-order.html">Order Tracking</a></li>
                        </ul>
                    </div>
                </div>
                <div class="col-xl-6 col-lg-4">
                    <div class="text-center">
                        <div id="news-flash" class="d-inline-block">
                            <ul>
                                <li>100% Secure delivery without contacting the courier</li>
                                <li>Supper Value Deals - Save more with coupons</li>
                                <li>Trendy 25silver jewelry, save up 35% off today</li>
                            </ul>
                        </div>
                    </div>
                </div>
                <div class="col-xl-3 col-lg-4">
                    <div class="header-info header-info-right">
                        <ul>
                            <li>Need help? Call Us: <strong class="text-brand"> + 61459825176</strong></li>

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="header-middle header-middle-ptb-1 d-none d-lg-block">
        <div class="container">
            <div class="header-wrap">
                <div class="logo logo-width-1">
                    <a href="/"><img src="{{ asset('frontend/assets/imgs/theme/logo.png') }}" alt="logo" /></a>
                </div>
                <div class="header-right">
                    <div class="search-style-2">
                        <form action="{{ route('product.search') }}" method="post">
                            @csrf
                            <select class="select-active">
                                <option>All Categories</option>
                            </select>
                            <input onfocus="search_result_show()" onblur="search_result_hide()" name="search" id="search" placeholder="Search for items..." />
                            <div id="searchProducts"></div>
                        </form>
                    </div>
                    <div class="header-action-right">
                        <div class="header-action-2">
                            <div class="search-location">
                                <form action="#">
                                    <select class="select-active">
                                        <option>Your Location</option>
                                    </select>
                                </form>
                            </div>

                            <div class="header-action-icon-2">
                                <a href="{{ route('compare') }}">
                                    <img class="svgInject" alt="Nest" src="{{ asset('frontend/assets/imgs/theme/icons/icon-compare.svg')}}" />
                                </a>
                                <a href="{{ route('compare') }}"><span class="lable ml-0">Compare</span></a>
                            </div>
                            <div class="header-action-icon-2">
                                <a href="{{ route('wishlist') }}">
                                    <img class="svgInject" alt="Nest" src="{{ asset('frontend/assets/imgs/theme/icons/icon-heart.svg') }}" />
                                    <span class="pro-count blue" id="wishQty">0</span>
                                </a>
                                <a href="{{ route('wishlist') }}"><span class="lable">Wishlist</span></a>
                            </div>




                            <div class="header-action-icon-2">
                                <a class="mini-cart-icon" href="{{ route('mycart') }}">
                                    <img alt="Nest" src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                    <span class="pro-count blue" id="cartQty">0</span>
                                </a>
                                <a href="{{ route('mycart') }}"><span class="lable">Cart</span></a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                    <!--   // mini cart start with ajax -->
                                    <div id="miniCart">

                                    </div>

                                    <!--   // End mini cart start with ajax -->
                                    <div class="shopping-cart-footer">
                                        <div class="shopping-cart-total">
                                            <h4>Total <span id="cartSubTotal"></span></h4>
                                        </div>
                                        <div class="shopping-cart-button">
                                            <a href="{{ route('mycart') }}" class="outline">View cart</a>
                                            <a href="{{ route('mycart') }}">Checkout</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="header-action-icon-2">
                                <a href="page-account.html">
                                    <img class="svgInject" alt="Nest" src="{{ asset('frontend/assets/imgs/theme/icons/icon-user.svg') }}" />
                                </a>

                                @Auth
                                <a href=""><span class="lable ml-0">Account</span></a>
                                <div class="cart-dropdown-wrap cart-dropdown-hm2 account-dropdown">
                                    <ul>
                                        <li>
                                            <a href="{{ route('dashboard') }}"><i class="fi fi-rs-user mr-10"></i>My Account</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('dashboard') }}"><i class="fi fi-rs-location-alt mr-10"></i>Order Tracking</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('dashboard') }}"><i class="fi fi-rs-label mr-10"></i>My Voucher</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('wishlist') }}"><i class="fi fi-rs-heart mr-10"></i>My Wishlist</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('dashboard') }}"><i class="fi fi-rs-settings-sliders mr-10"></i>Setting</a>
                                        </li>
                                        <li>
                                            <a href="{{ route('index.logout') }}"><i class="fi fi-rs-sign-out mr-10"></i>Sign out</a>
                                        </li>
                                    </ul>
                                </div>

                                @else
                                <a href="{{ route('login') }}"><span class="lable ml-0">Login</span></a>
                                <span class="lable" style="margin-left: 4px; margin-right: 4px;"> | </span>
                                <a href="{{ route('register') }}"><span class="lable ml-0">Register</span></a>
                                @endauth


                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>







    @php
    $categories = App\Models\Category::orderBy('category_name','ASC')->get();
    @endphp
    <div class="header-bottom header-bottom-bg-color sticky-bar">
        <div class="container">
            <div class="header-wrap header-space-between position-relative">
                <div class="logo logo-width-1 d-block d-lg-none">
                    <a href="/"><img src="{{ asset('frontend/assets/imgs/theme/logo.png') }}" alt="logo" /></a>
                </div>
                <div class="header-nav d-none d-lg-flex">
                    <div class="main-categori-wrap d-none d-lg-block">
                        <a class="categories-button-active" href="#">
                            <span class="fi-rs-apps"></span> All Categories
                            <i class="fi-rs-angle-down"></i>
                        </a>
                        <div class="categories-dropdown-wrap categories-dropdown-active-large font-heading">
                            <div class="d-flex categori-dropdown-inner">
                                <ul>
                                    @foreach($categories as $item)
                                    <li>
                                        <a href="{{ url('product/category/'.$item->id.'/'.$item->category_slug) }}"> <img src="{{ asset( $item->category_image ) }}" alt="" /> {{ $item->category_name }} </a>
                                    </li>
                                    @endforeach
                                </ul>
                                <ul class="end">
                                    @foreach($categories as $item)
                                    <li>
                                        <a href="{{ url('product/category/'.$item->id.'/'.$item->category_slug) }}"> <img src="{{ asset( $item->category_image ) }}" alt="" /> {{ $item->category_name }} </a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                            <div class="more_slide_open" style="display: none">
                                <div class="d-flex categori-dropdown-inner">
                                    <ul>
                                        <li>
                                            <a href=""> <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-1.svg') }}" alt="" />Milks and Dairies</a>
                                        </li>
                                        <li>
                                            <a href=""> <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-2.svg') }}" alt="" />Clothing & beauty</a>
                                        </li>
                                    </ul>
                                    <ul class="end">
                                        <li>
                                            <a href=""> <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-3.svg') }}" alt="" />Wines & Drinks</a>
                                        </li>
                                        <li>
                                            <a href=""> <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-4.svg') }}" alt="" />Fresh Seafood</a>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="more_categories"><span class="icon"></span> <span class="heading-sm-1">Show more...</span></div>
                        </div>
                    </div>
                    <div class="main-menu main-menu-padding-1 main-menu-lh-2 d-none d-lg-block font-heading">
                        <nav>
                            <ul>

                                <li>
                                    <a class="active" href="/">Home </a>

                                </li>
                                <li>
                                    @php
                                    $categories = App\Models\Category::orderBy('id','ASC')->limit(6)->get();
                                    @endphp

                                    @foreach($categories as $category)
                                <li>
                                    <a href="{{ url('product/category/'.$category->id.'/'.$category->category_slug) }}">{{ $category->category_name }} <i class="fi-rs-angle-down"></i></a>

                                    @php
                                    $subcategories = App\Models\SubCategory::where('category_id',$category->id)->orderBy('subcategory_name','ASC')->get();
                                    @endphp

                                    <ul class="sub-menu">
                                        @foreach($subcategories as $subcategory)
                                        <li><a href="{{ url('product/subcategory/'.$subcategory->id.'/'.$subcategory->subcategory_slug) }}">{{ $subcategory->subcategory_name }}</a></li>
                                        @endforeach
                                    </ul>
                                </li>
                                @endforeach
                                </li>


                            </ul>
                        </nav>
                    </div>
                </div>


                <div class="hotline d-none d-lg-flex">
                    <img src="{{ asset('frontend/assets/imgs/theme/icons/icon-headphone.svg') }}" alt="hotline" />
                    <span style="font-size: 13px; line-height: 1.5;">
                        +61 459825176 <br>
                        +263 774674580

                    </span>
                </div>
                <div class="header-action-icon-2 d-block d-lg-none">
                    <div class="burger-icon burger-icon-white">
                        <span class="burger-icon-top"></span>
                        <span class="burger-icon-mid"></span>
                        <span class="burger-icon-bottom"></span>
                    </div>
                </div>
                <div class="header-action-right d-block d-lg-none">
                    <div class="header-action-2">
                        <div class="header-action-icon-2">
                            <a href="{{ route('wishlist') }}">
                                <img alt="Nest" src="{{ asset('frontend/assets/imgs/theme/icons/icon-heart.svg') }}" />
                                <span class="pro-count white" id="mobilewishQty">0</span>
                            </a>
                        </div>
                        <div class="header-action-icon-2">
                            <a class="mini-cart-icon" href="{{ route('mycart') }}">
                                <img alt="Nest" src="{{ asset('frontend/assets/imgs/theme/icons/icon-cart.svg') }}" />
                                <span class="pro-count white" id="mobilecartQty">0</span>
                            </a>
                            <div class="cart-dropdown-wrap cart-dropdown-hm2">
                                <div id="mobileminiCart">

                                </div>

                                <div class="shopping-cart-footer">
                                    <div class="shopping-cart-total">
                                        <h4>Total <span id="cartSubTotal"></span></h4>
                                    </div>
                                    <div class="shopping-cart-button">
                                        <a href="{{ route('mycart') }}" class="outline">View cart</a>
                                        <a href="{{ route('mycart') }}">Checkout</a>
                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>
<!-- End Header  -->

<style>
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
    function search_result_show() {
        $("#searchProducts").slideDown();
    }

    function search_result_hide() {
        $("#searchProducts").slideUp();
    }
</script>


<div class="mobile-header-active mobile-header-wrapper-style">
    <div class="mobile-header-wrapper-inner">
        <div class="mobile-header-top">
            <div class="mobile-header-logo">
                <a href="/"><img src="{{ asset('frontend/assets/imgs/theme/logo.png') }}" alt="logo" /></a>
            </div>
            <div class="mobile-menu-close close-style-wrap close-style-position-inherit">
                <button class="close-style search-close">
                    <i class="icon-top"></i>
                    <i class="icon-bottom"></i>
                </button>
            </div>
        </div>
        <div class="mobile-header-content-area">
            <div class="mobile-search search-style-3 mobile-header-border">
                <form action="#">
                    <input type="text" placeholder="Search for items…" />
                    <button type="submit"><i class="fi-rs-search"></i></button>
                </form>
            </div>
            <div class="mobile-menu-wrap mobile-header-border">
                <!-- mobile menu start -->
                <nav>
                    <ul class="mobile-menu font-heading">
                        <li class="menu-item-has-children">
                            <a href="/">Home</a>

                        </li>

                        <li class="menu-item-has-children">
                            <a href="">Account</a>
                            <ul class="dropdown">
                                @Auth
                                <li>
                                    <a href="{{ route('dashboard') }}"><i class="fi fi-rs-user mr-10"></i>My Account</a>
                                </li>
                                <li>
                                    <a href="{{ route('dashboard') }}"><i class="fi fi-rs-location-alt mr-10"></i>Order Tracking</a>
                                </li>
                                <li>
                                    <a href="{{ route('dashboard') }}"><i class="fi fi-rs-label mr-10"></i>My Voucher</a>
                                </li>
                                <li>
                                    <a href="{{ route('wishlist') }}"><i class="fi fi-rs-heart mr-10"></i>My Wishlist</a>
                                </li>
                                <li>
                                    <a href="{{ route('dashboard') }}"><i class="fi fi-rs-settings-sliders mr-10"></i>Setting</a>
                                </li>
                                <li>
                                    <a href="{{ route('index.logout') }}"><i class="fi fi-rs-sign-in mr-10"></i>Sign out</a>
                                </li>
                                @else
                                <li>
                                    <a href="{{ route('login') }}"><i class="fi fi-rs-sign-out mr-10"></i>Login</a>
                                </li>
                                <li>
                                    <a href="{{ route('register') }}"><i class="fi fi-rs-settings-sliders mr-10"></i>Register</a>
                                </li>


                                @endauth

                            </ul>
                        </li>




                        <li><a href="{{ route('wishlist') }}">Wishlist</a></li>
                        <li><a href="{{ route('mycart') }}">Cart</a></li>



                    </ul>
                </nav>
                <!-- mobile menu end -->
            </div>
            <div class="mobile-header-info-wrap">

                <div class="single-mobile-header-info">
                    <a href="{{ route('login') }}"><i class="fi-rs-user"></i>Log In / Sign Up </a>
                </div>
                <div class="single-mobile-header-info">
                    <a href="#"><i class="fi-rs-headphones"></i>
                    <span style="font-size: 13px; line-height: 1.5;">
                        +61 459825176 / +263 774674580

                    </span></a>
                </div>
            </div>
            <div class="mobile-social-icon mb-50">
                <h6 class="mb-15">Follow Us</h6>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-facebook-white.svg') }}" alt="" /></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-twitter-white.svg') }}" alt="" /></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-instagram-white.svg') }}" alt="" /></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-pinterest-white.svg') }}" alt="" /></a>
                <a href="#"><img src="{{ asset('frontend/assets/imgs/theme/icons/icon-youtube-white.svg') }}" alt="" /></a>
            </div>
            <div class="site-copyright">Copyright 2022 © Nest. All rights reserved. Powered by eZimConnect.</div>
        </div>
    </div>
</div>