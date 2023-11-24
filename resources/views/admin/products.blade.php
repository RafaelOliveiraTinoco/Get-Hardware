@include("page-layout.start")

<!-- Accordion with products -->
<section class="p-5">

    <h1 class="text-white">Products</h1>

    <div class="accordion mt-5">

        <!-- Accordion to create new product -->
        <div class="accordion-item" id="accordion-new-product">
            <!-- Accordion header -->
            <div class="accordion-header">
                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapse-new-product" aria-expanded="true" aria-controls="collapse-new-product">New product</button>
            </div>

            <!-- Accordion body -->
            <div id="collapse-new-product" class="accordion-collapse collapse show" data-bs-parent="#accordion-new-product">
                <div class="accordion-body">

                    <form action="/admin/products/create" method="POST" enctype="multipart/form-data"> <!-- enctype="multipart/form-data" for file upload -->

                        @csrf

                        <!-- Name -->
                        <label for="new-product-name" class="form-label">Name</label>
                        <input type="text" class="form-control custom-input text-white" id="new-product-name" name="name" required>

                        <!-- Description -->
                        <label for="new-product-description" class="form-label mt-3">Description</label>
                        <textarea class="form-control custom-textarea text-white" id="new-product-description" name="description" rows="3" required></textarea>

                        <!-- Categories -->
                        <label for="new-product-category" class="form-label mt-3">Category</label>
                        <select class="form-select custom-input text-white" id="new-product-category" name="category" required>
                            <option value="-1"></option>
                            @foreach($categories as $category)
                                <option value="{{$category->id}}">{{$category->name}}</option>
                            @endforeach()
                        </select>

                        <div class="row">

                            <div class="col-md-6">
                                <label for="new-product-price" class="form-label mt-3">Price</label>
                                <input type="number" class="form-control custom-input text-white" id="new-product-price" name="price" required min="0.01" step="0.01" oninput="updateFinalPriceLabel('new-product-price', 'new-product-discount', 'new-product-final-price')">
                            </div>

                            <div class="col-md-6">
                                <label for="new-product-discount" class="form-label mt-3">Discount: 0%</label>
                                <input type="range" class="form-range" id="new-product-discount" name="discount" required min="0" max="100" step="1" value="0" oninput="updateFinalPriceLabel('new-product-price', 'new-product-discount', 'new-product-final-price')">
                            </div>
                        </div>

                        <label id="new-product-final-price" class="form-label mt-3">Final price: </label>

                        <!-- File inputs -->
                        <div class="row">

                            <div class="col-md-6">
                                <label class="form-label mt-3" for="new-product-thumbnail">Product thumbnail</label>
                                <input type="file" class="form-control custom-input text-white" id="new-product-thumbnail" name="thumbnail" oninput="productDisplayThumbnail('new-product-thumbnail', 'new-product-display-thumbnail-container')" required>
                                <!-- Display uploaded images -->
                                <div class="d-flex flex-wrap pt-3" id="new-product-display-thumbnail-container"></div>
                            </div>

                            <div class="col-md-6">
                                <label class="form-label mt-3" for="new-product-images">Product images</label>
                                <input type="file" class="form-control custom-input text-white" id="new-product-images" name="images[]" oninput="productDisplayImages('new-product-images', 'new-product-display-images-container')" multiple required>
                                <!-- Display uploaded images -->
                                <div class="d-flex flex-wrap pt-3" id="new-product-display-images-container"></div>
                            </div>

                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-primary text-white rounded-0 mt-3">Create<i class="bi bi-plus-lg ms-2"></i></button>
                        </div>

                    </form>

                </div>
            </div>
        </div>

        <!-- Accordion Items for products -->
        @foreach ($products as $product)
        @if($product != null)
            <div class="accordion-item" id="accordion-product-{{$product->id}}">
                <!-- Accordion header -->
                <div class="accordion-header d-flex">
                    <img src="/api/product-thumbnail/{{$product->product_thumbnail}}" style="height: 75px; width: 75px; object-fit: cover;">
                    <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapse-product-{{$product->id}}" aria-expanded="false" aria-controls="collapse-product-{{$product->id}}">{{$product->name}}</button>
                </div>

                <!-- Accordion body -->
                <div id="collapse-product-{{$product->id}}" class="accordion-collapse collapse" data-bs-parent="#accordion-product-{{$product->id}}">
                    <div class="accordion-body">

                        <form action="/admin/products/edit/{{$product->id}}" method="POST" enctype="multipart/form-data" id="form-product-{{$product->id}}"> <!-- enctype="multipart/form-data" for file upload -->

                            @csrf

                            <!-- Name -->
                            <label for="product-{{$product->id}}-name" class="form-label">Name</label>
                            <input type="text" class="form-control custom-input text-white" id="product-{{$product->id}}-name" name="name" value="{{$product->name}}" required disabled>

                            <!-- Description -->
                            <label for="product-{{$product->description}}-description" class="form-label mt-3">Description</label>
                            <textarea class="form-control custom-textarea text-white" id="product-{{$product->id}}-description" name="description" rows="3" required disabled>{{$product->description}}</textarea>

                            <!-- Categories -->
                            <label for="product-{{$product->id}}-category" class="form-label mt-3">Category</label>
                            <select class="form-select custom-input text-white" id="product-{{$product->id}}-category" name="category" required disabled>
                                <option value="-1"></option>
                                @foreach($categories as $category)
                                    <option value="{{$category->id}}" {{$category->id == $product->category_id ? "selected" : ""}}>{{$category->name}}</option>
                                @endforeach
                            </select>

                            <div class="row">

                                <div class="col-md-6">
                                    <label for="product-{{$product->id}}-price" class="form-label mt-3">Price</label>
                                    <input type="number" class="form-control custom-input text-white" id="product-{{$product->id}}-price" name="price" required min="0.01" step="0.01" oninput="updateFinalPriceLabel('product-{{$product->id}}-price', 'product-{{$product->id}}-discount', 'product-{{$product->id}}-final-price')" value="{{$product->price}}" disabled>
                                </div>

                                <div class="col-md-6">
                                    <label for="product-{{$product->id}}-discount" class="form-label mt-3">Discount: {{$product->discount}}%</label>
                                    <input type="range" class="form-range" id="product-{{$product->id}}-discount" name="discount" required min="0" max="100" step="1" oninput="updateFinalPriceLabel('product-{{$product->id}}-price', 'product-{{$product->id}}-discount', 'product-{{$product->id}}-final-price')" value="{{$product->discount}}" disabled>
                                </div>
                            </div>

                            <label id="product-{{$product->id}}-final-price" class="form-label mt-3">Final price: {{round($product->price * (1 - ($product->discount/100)), 2)}}$</label>

                            <!-- File inputs -->
                            <div class="row">

                                <div class="col-md-6">
                                    <label class="form-label mt-3" for="product-{{$product->id}}-thumbnail">Product thumbnail</label>
                                    <input type="file" class="form-control custom-input text-white" id="product-{{$product->id}}-thumbnail" name="thumbnail" oninput="productDisplayThumbnail('product-{{$product->id}}-thumbnail', 'product-{{$product->id}}-display-thumbnail-container')" disabled>
                                    <!-- Display uploaded images -->
                                    <div class="d-flex flex-wrap pt-3" id="product-{{$product->id}}-display-thumbnail-container">
                                        <img src="/api/product-thumbnail/{{$product->product_thumbnail}}" class="img-thumbnail mt-3 me-3" style="height: 200px; object-fit: cover;">
                                    </div>
                                </div>

                                <div class="col-md-6">
                                    <label class="form-label mt-3" for="product-{{$product->id}}-images">Product images</label>
                                    <input type="file" class="form-control custom-input text-white" id="product-{{$product->id}}-images" name="images[]" oninput="productDisplayImages('product-{{$product->id}}-images', 'product-{{$product->id}}-display-images-container')" multiple disabled>
                                    <input type="text" value='{"images":[]}' name="imagesToDelete" id="product-{{$product->id}}-images-to-delete" disabled hidden>
                                    <!-- Display product images -->
                                    <div class="d-flex flex-wrap pt-3">
                                        @foreach($product->images as $image)
                                            <div class="position-relative mt-3 me-3 show-btn-hover">
                                                <img src="/api/product-image/{{$image->image}}" class="img-thumbnail" style="height: 200px; object-fit: cover;" id="{{$image->id}}">
                                                <button type="button" class="btn btn-danger position-absolute top-0 end-0 mt-2 me-2 text-white" disabled onclick="markImageToDelete('{{$image->id}}', 'product-{{$product->id}}-images-to-delete', this)"><i class="bi bi-trash-fill"></i></button>
                                            </div>
                                        @endforeach
                                    </div>
                                    <!-- Display uploaded images -->
                                    <div class="d-flex flex-wrap pt-3" id="product-{{$product->id}}-display-images-container"></div>
                                </div>

                            </div>

                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary text-white rounded-0 mt-3" disabled>Save<i class="bi bi-floppy-fill ms-2"></i></button>
                                <button type="button" onclick="window.location.href = '/admin/products/delete/{{$product->id}}'" class="btn btn-danger text-white rounded-0 mt-3 ms-2" disabled>Delete product<i class="bi bi-x-lg ms-2"></i></button>
                            </div>

                        </form>
                        <div class="d-flex justify-content-end">
                            <div class="form-check pt-3">
                                <input type="checkbox" class="form-check-input" oninput="toggleForm('form-product-{{$product->id}}')" id="form-toggle-{{$product->id}}">
                                <label class="form-check-label" for="form-toggle-{{$product->id}}">Edit mode</label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
        @endforeach

    </div>

</section>

@include("page-layout.end")
