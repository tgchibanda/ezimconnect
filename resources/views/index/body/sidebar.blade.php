<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="{{ asset('adminbackend/assets/images/logo-icon.png') }}" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">eZimConnect</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    @if($status === 'active')
    <ul class="metismenu" id="menu">
        <li>
            <a href="{{ route('index.dashboard') }}">
                <div class="parent-icon"><i class='bx bx-cookie'></i>
                </div>
                <div class="menu-title">Dashboard</div>
            </a>
        </li>


        @if($title == 'Admin')
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class='bx bx-home-circle'></i>
                </div>
                <div class="menu-title">Brand</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.brands') }}"><i class="bx bx-right-arrow-alt"></i>All Brands</a>
                </li>
                <li> <a href="{{ route('add.brand') }}"><i class="bx bx-right-arrow-alt"></i>Add Brand</a>
                </li>

            </ul>
        </li>
        <li>
            <a href="javascript:;" class="has-arrow">
                <div class="parent-icon"><i class="bx bx-category"></i>
                </div>
                <div class="menu-title">Category</div>
            </a>
            <ul>
                <li> <a href="{{ route('all.categories') }}"><i class="bx bx-right-arrow-alt"></i>All Categories</a>
                </li>
                <li> <a href="app-chat-box.html"><i class="bx bx-right-arrow-alt"></i>Add Category</a>
                </li>
        </li>
    </ul>

    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">SubCategory</div>
        </a>
        <ul>
            <li> <a href="{{ route('all.subcategories') }}"><i class="bx bx-right-arrow-alt"></i>All SubCategory</a>
            </li>
            <li> <a href="{{ route('add.subcategory') }}"><i class="bx bx-right-arrow-alt"></i>Add SubCategory</a>
            </li>

        </ul>
    </li>
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Manage Shops</div>
        </a>
        <ul>
            <li> <a href="{{ route('inactive.vendors') }}"><i class="bx bx-right-arrow-alt"></i>Inactive Shop</a>
            </li>
            <li> <a href="{{ route('active.vendors') }}"><i class="bx bx-right-arrow-alt"></i>Active Shops</a>
            </li>

        </ul>
    </li>

    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Manage Sliders</div>
        </a>
        <ul>
            <li> <a href="{{ route('all.sliders') }}"><i class="bx bx-right-arrow-alt"></i>All Sliders</a>
            </li>
            <li> <a href="{{ route('add.slider') }}"><i class="bx bx-right-arrow-alt"></i>Add Slider</a>
            </li>

        </ul>
    </li>

    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Banner Manage</div>
        </a>
        <ul>
            <li> <a href="{{ route('all.banners') }}"><i class="bx bx-right-arrow-alt"></i>All Banners</a>
            </li>
            <li> <a href="{{ route('add.banner') }}"><i class="bx bx-right-arrow-alt"></i>Add Banner</a>
            </li>

        </ul>
    </li>


    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Coupon System</div>
        </a>
        <ul>
            <li> <a href="{{ route('all.coupons') }}"><i class="bx bx-right-arrow-alt"></i>All Coupons</a>
            </li>
            <li> <a href="{{ route('add.coupon') }}"><i class="bx bx-right-arrow-alt"></i>Add Coupon</a>
            </li>

        </ul>
    </li>




    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Shipping Area</div>
        </a>
        <ul>
            <li> <a href="{{ route('all.divisions') }}"><i class="bx bx-right-arrow-alt"></i>All Provinces</a>
            </li>
            <li> <a href="{{ route('all.districts') }}"><i class="bx bx-right-arrow-alt"></i>All Towns</a>
            </li>
            <li> <a href="{{ route('all.states') }}"><i class="bx bx-right-arrow-alt"></i>All Suburbs</a>
            </li>

        </ul>
    </li>

    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class='bx bx-cart'></i>
            </div>
            <div class="menu-title">Manage Orders</div>
        </a>
        <ul>
            <li> <a href="{{ route('pending.orders') }}"><i class="bx bx-right-arrow-alt"></i>Pending Orders</a>
            </li>
            <li> <a href="{{ route('admin.confirmed.order') }}"><i class="bx bx-right-arrow-alt"></i>Confirmed Orders</a>
            </li>
            <li> <a href="{{ route('admin.processing.order') }}"><i class="bx bx-right-arrow-alt"></i>Processing Orders</a>
            </li>
            <li> <a href="{{ route('admin.delivered.order') }}"><i class="bx bx-right-arrow-alt"></i>Delivered Orders</a>
            </li>


        </ul>
    </li>

    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Manage Products</div>
        </a>
        <ul>
            <li> <a href="{{ route('all.products') }}"><i class="bx bx-right-arrow-alt"></i>All Products</a>
            </li>
            <li> <a href="{{ route('add.product') }}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
            </li>

        </ul>
    </li>

    <li>
					<a href="javascript:;" class="has-arrow">
						<div class="parent-icon"><i class='bx bx-cart'></i>
						</div>
						<div class="menu-title">Return Orders </div>
					</a>
					<ul>
						<li> <a href="{{ route('return.request') }}"><i class="bx bx-right-arrow-alt"></i>Return Request</a>
						</li>
						<li> <a href="{{ route('complete.return.request') }}"><i class="bx bx-right-arrow-alt"></i>Complete Request</a>
						</li> 
					</ul>
				</li>


    <!-- To delete the below <li>s, these are for vendor  -->
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class='bx bx-cart'></i>
            </div>
            <div class="menu-title">Manage Orders</div>
        </a>
        <ul>
            <li> <a href="{{ route('vendor.orders') }}"><i class="bx bx-right-arrow-alt"></i>Pending Orders</a>
            </li>


        </ul>
    </li>




    @elseif($title == 'Shop')
    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class="bx bx-category"></i>
            </div>
            <div class="menu-title">Manage Products</div>
        </a>
        <ul>
            <li> <a href="{{ route('all.products') }}"><i class="bx bx-right-arrow-alt"></i>All Products</a>
            </li>
            <li> <a href="{{ route('add.product') }}"><i class="bx bx-right-arrow-alt"></i>Add Product</a>
            </li>

        </ul>
    </li>

    <li>
        <a href="javascript:;" class="has-arrow">
            <div class="parent-icon"><i class='bx bx-cart'></i>
            </div>
            <div class="menu-title">Manage Orders</div>
        </a>
        <ul>
            <li> <a href="{{ route('vendor.orders') }}"><i class="bx bx-right-arrow-alt"></i>Pending Orders</a>
            </li>


        </ul>
    </li>

    <li>
        <a href="https://themeforest.net/user/codervent" target="_blank">
            <div class="parent-icon"><i class="bx bx-support"></i>
            </div>
            <div class="menu-title">Support</div>
        </a>
    </li>

    @endif
    </ul>
    @endif
    <!--end navigation-->
</div>