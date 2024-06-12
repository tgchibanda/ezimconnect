<article class="row align-items-center hover-up">
    <figure class="col-md-4 mb-0">
        <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"><img src="{{ asset( $item->product_thumbnail ) }}" alt="" /></a>
    </figure>
    <div class="col-md-8 mb-0">
        <h6>
            <a href="{{ url('product/details/'.$item->id.'/'.$item->product_slug) }}"> {!! Str::limit(ucwords(strtolower($item->product_name)), 15) !!} </a>
        </h6>
        <div class="product-rate-cover">
            <div class="product-rate d-inline-block">
                <div class="product-rating" style="width: 90%"></div>
            </div>
            <span class="font-small ml-5 text-muted"> (4.0)</span>
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