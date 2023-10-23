@include("page-layout.start")
@include("components.nav")

<!-- Banner -->
<section>
    <img src="{{asset('images/banner.jpg')}}" alt="Banner" class="img-fluid">
</section>

<!-- Items -->
<section class="ps-5 pt-5 pe-5">
    <h3 class="text-white link-with-underline">Featured</h3>
    <div class="row">
        <div class="col-12 col-md-6 col-lg-3 mb-5">
            <div class="card rounded-0 bg-secondary">
                <img src="https://dfstudio-d420.kxcdn.com/wordpress/wp-content/uploads/2019/06/digital_camera_photo-1080x675.jpg" class="card-img-top rounded-0" style="height: 250px; object-fit: cover;" alt="Image"> <!-- object-fit: cover prevents the image from shrinking when resizing it by cropping the image -->
                <div class="card-body">
                    <h5 class="card-title text-white link-with-underline">Professional Camera<i class="bi bi-box-arrow-up-right ms-2 fs-6"></i></h5>
                    <div class="d-flex justify-content-between align-items-center"> <!-- justify-content-between to have price on the extreme left and the button on the extreme right align-items-center to make the price be vertically aligned to the center -->
                        <p class="text-white fw-bold m-0">200.99$</p>
                        @if($isAuthenticated)
                            <button type="button" class="btn btn-primary text-white rounded-0"><i class="bi bi-cart-plus"></i></button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
        <div class="col-12 col-md-6 col-lg-3 mb-5">
            <div class="card rounded-0 bg-secondary">
                <img src="https://i.pinimg.com/originals/40/a4/92/40a492b0a148eeafeded44e958edc958.jpg" class="card-img-top rounded-0" style="height: 250px; object-fit: cover;" alt="Image">
                <div class="card-body">
                    <h5 class="card-title text-white link-with-underline">Ocean<i class="bi bi-box-arrow-up-right ms-2 fs-6"></i></h5>
                    <div class="d-flex justify-content-between align-items-center"> <!-- justify-content-between to have price on the extreme left and the button on the extreme right align-items-center to make the price be vertically aligned to the center -->
                        <p class="text-white fw-bold m-0">FREE</p>
                        @if($isAuthenticated)
                            <button type="button" class="btn btn-primary text-white rounded-0"><i class="bi bi-cart-plus"></i></button>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@include("page-layout.end")
