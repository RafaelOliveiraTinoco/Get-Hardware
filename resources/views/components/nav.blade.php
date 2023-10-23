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
                @if($isAuthenticated == false)
                    <li><button type="button" class="dropdown-item text-white" data-bs-toggle="modal" data-bs-target="#loginModal">Login<i class="bi bi-box-arrow-in-left ms-2"></i></button></li>
                    <li><hr class="dropdown-divider"></li>
                    <li><button type="button" class="dropdown-item text-white" data-bs-toggle="modal" data-bs-target="#registerModal">Register<i class="bi bi-person-plus-fill ms-2"></i></button></li>
                @else
                <li><a href="/logout" class="dropdown-item text-white">Logout<i class="bi bi-box-arrow-right ms-2"></i></a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>

<!-- Modal Register Form -->
<section>
    <div class="modal fade" id="registerModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!-- Vertically centered modal -->
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title text-white fs-5" id="exampleModalLabel">Register</h1>
                    <button type="button" class="btn text-white" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>
                <!-- Register Form -->
                <form action="/register" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="text" class="form-control custom-input text-white" placeholder="Name" name="name" required>
                        <input type="email" class="form-control custom-input text-white mt-3" placeholder="Email" name="email" required>
                        <input type="password" class="form-control custom-input text-white mt-3" placeholder="Password" name="password" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary text-white">Register</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>

<!-- Modal Login Form -->
<section>
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <!-- Vertically centered modal -->
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title text-white fs-5" id="exampleModalLabel">Login</h1>
                    <button type="button" class="btn text-white" data-bs-dismiss="modal" aria-label="Close"><i class="bi bi-x-lg"></i></button>
                </div>
                <!-- Register Form -->
                <form action="/login" method="POST">
                    @csrf
                    <div class="modal-body">
                        <input type="email" class="form-control custom-input text-white" placeholder="Email" name="email" required>
                        <input type="password" class="form-control custom-input text-white mt-3" placeholder="Password" name="password" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary text-white">Login</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</section>
