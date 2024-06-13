<article class="row align-items-center hover-up">
    <figure class="col-md-4 mb-0">
        <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"><img src="{{ asset( $item->product_thumbnail ) }}" alt="" /></a>
    </figure>
    <div class="col-md-8 mb-0">
        <h6>
            <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"> {!! Str::limit(ucwords(strtolower($item->product_name)), 15) !!} </a>
        </h6>
        @php

        $reviewcount = App\Models\Review::where('product_id',$item->id)->where('status',1)->latest()->get();

        $avarage = App\Models\Review::where('product_id',$item->id)->where('status',1)->avg('rating');
        @endphp

        <div class="product-rate-cover">
            <div class="product-rate d-inline-block">
                @if($avarage == 0)

                @elseif($avarage == 1 || $avarage < 2) <div class="product-rating" style="width: 20%">
            </div>
            @elseif($avarage == 2 || $avarage < 3) <div class="product-rating" style="width: 40%">
        </div>
        @elseif($avarage == 3 || $avarage < 4) <div class="product-rating" style="width: 60%">
    </div>
    @elseif($avarage == 4 || $avarage < 5) <div class="product-rating" style="width: 80%">
        </div>
        @elseif($avarage == 5 || $avarage < 5) <div class="product-rating" style="width: 100%">
            </div>
            @endif
            </div>
            <span class="font-small ml-5 text-muted"> ({{count($reviewcount)}})</span>
            </div>
            @if($item->discount_price == NULL)
            <div class="product-price">
                <span>${{ $item->selling_price }}</span>

            </div>

            @else
            <div class="product-price">
                <span>${{ $item->discount_price }}</span>
                <span class="old-price">${{ $item->selling_price }}</span>
            </div>
            @endif
            </div>
</article>