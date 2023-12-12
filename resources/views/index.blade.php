@include("page-layout.start")
@include("components.nav")

<!-- Banner -->
<section>
    <img src="{{asset('images/banner.jpg')}}" alt="Banner" class="img-fluid">
</section>

<!-- Items -->
<section class="ps-5 pt-5 pe-5">
    @foreach($categoriesWithProducts as $category)
        <h3 class="text-white link-with-underline">{{$category->name}}</h3>
        <div class="row">
            @foreach($products as $product)
                @if($product->category_id == $category->id)
                    <div class="col-12 col-md-6 col-lg-3 mb-5">
                        <div class="card rounded-0 bg-secondary">
                            <img src="/api/product-thumbnail/{{$product->product_thumbnail}}" class="card-img-top rounded-0" style="height: 250px; object-fit: cover;" alt="Image"> <!-- object-fit: cover prevents the image from shrinking when resizing it by cropping the image -->
                            <div class="card-body">
                                <h5 class="card-title text-white link-with-underline">{{$product->name}}<i class="bi bi-box-arrow-up-right ms-2 fs-6"></i></h5>
                                <div class="d-flex justify-content-between align-items-center"> <!-- justify-content-between to have price on the extreme left and the button on the extreme right align-items-center to make the price be vertically aligned to the center -->
                                    <p class="text-white fw-bold m-0">{{$product->price}}$</p>
                                    @if($isAuthenticated)
                                        <button type="button" class="btn btn-primary text-white rounded-0"><i class="bi bi-cart-plus"></i></button>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
            @endforeach
        </div>
    @endforeach
</section>
@include("page-layout.end")
