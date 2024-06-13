@extends('frontend.master_dashboard')
@section('main')

@section('title')
eZimConnect
@endsection

@include('frontend.home.home_slider')

<!--End hero slider-->
@include('frontend.home.home_features_category')

<!--End category slider-->
@include('frontend.home.home_banner')
<!--End banners-->


@include('frontend.home.home_new_products')

<!--Products Tabs-->



@include('frontend.home.home_features_products')


<!--End Best Sales-->

<!-- Start Skip Category -->

<!--End Skip Category -->
</div>


























<section class="section-padding mb-30">
    <div class="container">
        <div class="row">
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay="0">
                <h4 class="section-title style-1 mb-30 animated animated"> Hot Deals </h4>
                <div class="product-list-small animated animated">

                    @foreach($hot_deals as $item)
                    @include('components.article', ['item' => $item])
                    <!--end article card-->
                    @endforeach



                </div>
            </div>




            <div class="col-xl-3 col-lg-4 col-md-6 mb-md-0 wow animate__animated animate__fadeInUp" data-wow-delay=".1s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Offer </h4>
                <div class="product-list-small animated animated">


                    @foreach($special_offer as $item)
                    @include('components.article', ['item' => $item])
                    <!--end article card-->
                    @endforeach



                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-lg-block wow animate__animated animate__fadeInUp" data-wow-delay=".2s">
                <h4 class="section-title style-1 mb-30 animated animated">Recently added</h4>
                <div class="product-list-small animated animated">


                    @foreach($new as $item)
                    @include('components.article', ['item' => $item])
                    <!--end article card-->
                    @endforeach



                </div>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-6 mb-sm-5 mb-md-0 d-none d-xl-block wow animate__animated animate__fadeInUp" data-wow-delay=".3s">
                <h4 class="section-title style-1 mb-30 animated animated"> Special Deals </h4>
                <div class="product-list-small animated animated">


                    @foreach($special_deals as $item)
                    @include('components.article', ['item' => $item])
                    <!--end article card-->
                    @endforeach




                </div>
            </div>
        </div>
    </div>
</section>
<!--End 4 columns-->



<!--Vendor List -->

@include('frontend.home.home_vendor_list')

<!--End Vendor List -->

@endsection