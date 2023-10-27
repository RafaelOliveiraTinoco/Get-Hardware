@include("page-layout.start")
<!-- Accordion with the categories -->
<section class="p-5">

    <h1 class="text-white">Categories</h1>

    <div class="accordion mt-5">

        <!-- Accordion to create new categories -->
        <div class="accordion-item" id="accordion-create-categories">
            <!-- Accordion Header -->
            <div class="accordion-header">
                <button type="button" class="accordion-button" data-bs-toggle="collapse" data-bs-target="#collapse-create" aria-expanded="true" aria-controls="collapse-create">New Category</button>
            </div>
            <!-- Accordion Body -->
            <div id="collapse-create" class="accordion-collapse collapse show" data-bs-parent="#accordion-create-categories">
                <div class="accordion-body">
                    <form>
                        @csrf
                        <input type="text" class="form-control custom-input text-white" name="name" placeholder="Category name">
                        <button type="submit" class="btn btn-primary text-white rounded-0 mt-3">Create<i class="bi bi-plus-lg ms-2"></i></button>
                    </form>
                </div>
            </div>
        </div>

        <!-- Accordion to edit category -->
        <div class="accordion-item" id="accordion-category-id">
            <!-- Accordion Header -->
            <div class="accordion-header">
                <button type="button" class="accordion-button collapsed" data-bs-toggle="collapse" data-bs-target="#collapse-category-id" aria-expanded="false" aria-controls="collapse-category-id">CPUs</button>
            </div>
            <!-- Accordion Body -->
            <div id="collapse-category-id" class="accordion-collapse collapse" data-bs-parent="#accordion-category-id">
                <div class="accordion-body">
                    <form id="rename">
                        @csrf
                        <input type="text" class="form-control custom-input text-white" name="name" placeholder="Rename category">
                        <button type="button" class="btn btn-primary text-white rounded-0 mt-3">Rename<i class="bi bi-pencil-fill ms-2"></i></button>
                        <a href="/admin/categories/delete/id" class="btn btn-danger text-white rounded-0 mt-3 ms-2">Delete<i class="bi bi-x-lg ms-2"></i></a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</section>
@include("page-layout.end")
