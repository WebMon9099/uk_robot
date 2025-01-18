@if (isset($product))
    <div class="col-12 col-lg-4 col-md-6 col-sm-6 mb-3 align-items-center">
        <div class="card p-2" style=" box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
            @if ($product->images->isNotEmpty())
                <img src="{{ asset(optional($product->images->first())->image_path) }}"
                    class="my-2 mx-auto h-50 text-center" alt="..." style="width: 50%">
            @else
                <img src="{{ asset('placeholder-image.jpg') }}" class="img-fluid mt-2 h-25" alt="Placeholder Image">
            @endif
            <div class="card-body text-center">
                <h5 class="card-title">{{ $product->name }}</h5>
                <p class="card-text">
                    @include('components.star')
                    (1034 reviews)
                </p>
                <p class="fw-semibold">{{ $product->price }}</p>
                <a href="{{ route('products.details', ['id' => $product->id]) }}" class="btn rounded-4 px-3 text-white"
                    style="background-color: #f2a71b;">View Details</a>
            </div>
        </div>
    </div>
@else
    <div class="col-12 col-lg-3 col-md-6 col-sm-6 mb-3">
        <div class="card" style="width: 18rem; box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px;">
            <img src="{{ asset('/images/product-card-1.png') }}" class="img-fluid mt-2 h-25" alt="...">
            <div class="card-body text-center">
                <h5 class="card-title">Organic honey cola flavour</h5>
                <p class="card-text">
                    @include('components.star')
                    (1034 reviews)
                </p>
                <p class="fw-semibold">$23.99</p>
                <a href="{{ route('products.details') }}" class="btn rounded-4 px-3 text-white"
                    style="background-color: #f2a71b;">Buy Now</a>
            </div>
        </div>
    </div>
@endif
