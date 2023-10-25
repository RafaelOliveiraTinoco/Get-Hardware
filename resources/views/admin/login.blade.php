@include("page-layout.start")

<!-- Login Form -->
<section class="bg-secondary w-25 position-absolute top-50 start-50 translate-middle p-5">

    <p class="h1 text-white">Admin Panel</p>

    <form method="POST" action="/admin/login">
        <input type="text" class="form-control custom-input mt-3" placeholder="Email" name="Email">
        <input type="password" class="form-control custom-input mt-3" placeholder="Password" name="password">
        <button type="submit" class="btn btn-primary text-white rounded-0 mt-5">Login</button>
    </form>

</section>

@include("page-layout.end")
