<nav class="navbar bg-primary">
    <div class="container-fluid">
        <a class="navbar-brand text-white" href="#">Get Hardware</a>
        <div class="d-flex">
            <div class="dropdown">
                <button class="btn text-white btn-custom-2 dropdown-toggle" type="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Categories
                </button>
                <ul class="dropdown-menu bg-primary">
                    <li><a class="dropdown-item text-white" href="#">Boards</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-white" href="#">Fans</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><a class="dropdown-item text-white" href="#">GPU</a></li>
                </ul>
            </div>
        </div>
        <div class="d-flex"> <!-- Somehow d-flex aligns the items to the right of the nav -->
            <input type="text" class="form-control custom-input text-white me-2" placeholder="Search">
            <button class="btn btn-custom-1" type="button"><i class="bi bi-search"></i></button>
        </div>
        <div class="dropdown">
            <button class="btn text-white btn-custom-2" data-bs-toggle="dropdown" aria-expanded="false"><i class="bi bi-person-fill"></i></button>
            <ul class="dropdown-menu dropdown-menu-end bg-primary">
                <li><a class="dropdown-item text-white" href="/login">Login<i class="bi bi-box-arrow-in-left ms-2"></i></a></li>
                <li><hr class="dropdown-divider"></li>
                <li><a class="dropdown-item text-white" href="/register">Register<i class="bi bi-person-plus-fill ms-2"></i></a></li>
            </ul>
        </div>
    </div>
</nav>
