<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <link rel="stylesheet" href="/css/styles.css" />

    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css"
        integrity="sha384-gH2yIJqKdNHPEq0n4Mqa/HGKIhSkIHeL5AyhkYV8i59U5AR6csBvApHHNl/vI1Bx" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.2/css/all.min.css"
        integrity="sha512-1sCRPdkRXhBV2PBLUdRb4tMg1w2YPf37qatUFeS7zlBy7jJI8Lf4VHwWfZZfpXtYSLy85pkm9GaYVYMfw5BC1A=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"
        integrity="sha512-894YE6QWD5I59HgZOGReFYm4dnWc1Qt5NtvYSaNcOP+u1T9qYdvdihz0PPSiiqn/+/3e7Jo4EaG7TubfWGUrMQ=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.1/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-/bQdsTh/da6pkI1MST/rWKFNjaCP5gBSY4sEBT38Q/9RBh9AH40zEOg7Hlq2THRZ"
        crossorigin="anonymous"></script>

</head>

<body>
    <div class="bg-light">
        <div class="container">
            <div class="row py-4">
                <div class="col-sm-3 fs-2 fw-bold d-flex align-items-center">
                    <a href="/" class="text-decoration-none text-dark">
                        <span class="text-danger mx-2"><i class="fa-solid fa-computer"></i></span> <span>Gadget
                            Shop</span>
                    </a>
                </div>

                <div class="col-sm-6 d-flex align-items-center justify-content-center">
                        {!! Form::open(array('route' => 'search','method'=>'POST','class' => 'input-group d-flex align-items-center justify-content-center')) !!}
                            {!! Form::text('search', null, array('placeholder' => 'Search our Store','class' => 'form-control rounded-start')) !!}
                            <button class="btn btn-danger" type="submit" id="button-addon2"><i class="fa-solid fa-search"></i></button>
                        {!! Form::close() !!}
                </div>
                @php $totalQuantity = 0 @endphp
                @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                @php $totalQuantity = $totalQuantity + $details['quantity'] @endphp
                @endforeach
                @endif

                <div class="col-sm-3 d-flex justify-content-end align-items-center">
                    <button type="button" class="btn btn-dark mx-3" data-bs-toggle="offcanvas"
                        data-bs-target="#offcanvasRight" aria-controls="offcanvasRight">
                        <i class="fa-solid fa-basket-shopping"></i> Basket <span
                            class="badge text-bg-danger">{{$totalQuantity }}</span>
                    </button>

                    <div class="btn-group">
                        <button type="button" class="btn btn-dark dropdown-toggle" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            <i class="fa-solid fa-user"></i> Account
                        </button>

                        <ul class="dropdown-menu">
                            @guest
                            @if (Route::has('login'))
                            <li><a class="dropdown-item" href="{{ route('login') }}">Sign In</a></li>
                            @endif

                            @if (Route::has('register'))
                            <li><a class="dropdown-item" href="{{ route('register') }}">Register</a></li>
                            @endif
                            @else
                            <li><a class="dropdown-item" href="{{ route('account') }}">My Account</a></li>
                            <li><a class="dropdown-item" href="{{ route('orders') }}">Orders</a></li>

                            @if (Auth::user()->can('user-list') || Auth::user()->can('role-list') ||
                            Auth::user()->can('product-list'))
                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <h6 class="dropdown-header">Admin Options</h6>
                            </li>
                            @endif

                            @can('user-list')
                            <li><a class="dropdown-item" href="{{ route('users.index') }}">Manage Users</a></li>
                            @endcan

                            @can('role-list')
                            <li><a class="dropdown-item" href="{{ route('roles.index') }}">Manage Roles</a></li>
                            @endcan

                            @can('product-list')
                            <li><a class="dropdown-item" href="{{ route('products.index') }}">Manage Products</a></li>
                            @endcan

                            @can('order-list')
                            <li><a class="dropdown-item" href="{{ route('orders.index') }}">Manage Orders</a></li>
                            @endcan

                            <li>
                                <hr class="dropdown-divider">
                            </li>

                            <li>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('logout-form').submit();">Logout
                                </a>
                            </li>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                            @endguest
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-light pb-2">
        <div class="container">
            <div class="row fs-5">
                <div class="col d-flex justify-content-center">
                    <a href="/computers"
                        class="{{ (request()->is('computers*')) ? 'fw-semibold' : '' }} text-decoration-none text-dark"><i
                            class="fa-solid fa-desktop"></i> Computers</a>
                </div>

                <div class="col d-flex justify-content-center">
                    <a href="/laptops"
                        class="{{ (request()->is('laptops*')) ? 'fw-semibold' : '' }} text-decoration-none text-dark"><i
                            class="fa-solid fa-laptop"></i> Laptops</a>
                </div>

                <div class="col d-flex justify-content-center">
                    <a href="/mobiles"
                        class="{{ (request()->is('mobiles*')) ? 'fw-semibold' : '' }} text-decoration-none text-dark"><i
                            class="fa-solid fa-mobile"></i> Mobile Phones</a>
                </div>

                <div class="col d-flex justify-content-center">
                    <a href="/televisions"
                        class="{{ (request()->is('televisions*')) ? 'fw-semibold' : '' }} text-decoration-none text-dark"><i
                            class="fa-solid fa-tv"></i> Televisions</a>
                </div>
            </div>
        </div>
    </div>

    <div class="bg-light border-top border-bottom">
        <div class="container ">
            <div class="row fs-5 py-3">
                <div class="col-sm-4 border-end d-flex justify-content-center">
                    <span><i class="fa-solid fa-comment text-danger mx-2"></i> Speak to our experts to help you shop
                    </span>
                </div>

                <div class="col-sm-4 border-end d-flex justify-content-center">
                    <span><i class="fa-solid fa-truck text-danger mx-2"></i> Same or next day delivery available</span>
                </div>

                <div class="col-sm-4 d-flex justify-content-center">
                    <span><i class="fa-solid fa-wallet text-danger mx-2"></i> Fixed monthly payment plans
                        available</span>
                </div>
            </div>
        </div>
    </div>

    <main class="py-3">
        <div class="container">
            @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                <span class="fw-semibold"><i class="fa-solid fa-square-check"></i> Success</span> {{ session('success')
                }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @if(session('danger'))
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <span class="fw-semibold"><i class="fa-solid fa-circle-exclamation"></i> Error</span> {{
                session('danger') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
            @endif

            @yield('content')
        </div>
    </main>

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header bg-light border-bottom">
            <h5 class="offcanvas-title" id="offcanvasRightLabel">Shopping Basket <span class="badge text-bg-danger">
                    {{ $totalQuantity }}
                </span></h5>
            <button type="button" class="btn-close" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>

        <div class="offcanvas-body p-0">
            <div class="d-flex flex-align-start flex-column h-100 w-100">
                <div class="w-100 h-100 mb-auto overflow-y-auto p-3 ">
                    @if(session('cart'))
                    @php $count = 0 @endphp
                    @foreach(session('cart') as $id => $details)
                    <div class="row mb-3 p-3 {{ ++$count%2?"":" bg-light" }}">
                        <div class="col-sm-4">
                            <img src="{{ $details['image'] }}.png" class="img-thumbnail" alt="{{ $details['name'] }}" />
                        </div>

                        <div class="col-sm-8">
                            <h4>{{ $details['name'] }}</h4>
                            <p class="m-0 fw-bold text-danger"> £{{ $details['price'] }}</p>
                            <p> Quantity: <span class="fw-bold">{{ $details['quantity'] }}</span></p>
                        </div>
                    </div>
                    @endforeach
                    @endif
                </div>

                @php $total = 0 @endphp
                @foreach((array) session('cart') as $id => $details)
                @php $total += $details['price'] * $details['quantity'] @endphp
                @endforeach

                <div class="bg-light border-top">
                    <div class="row p-3 m-0">
                        <div class="col-sm-6">
                            <p class="p-0"><span class="fw-bold me-1">Total:</span>£{{ $total }}</p>
                        </div>

                        <div class="col-sm-6 d-flex justify-content-end">
                            <a href="{{ route('cart') }}" class="btn btn-danger btn-block"><i
                                    class="fa-solid fa-cart-shopping"></i> Checkout</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div>
        <div class="container">
            <footer class="d-flex flex-wrap justify-content-between align-items-center py-3 my-4 border-top">
                <p class="col-md-4 mb-0 text-muted">© 2022 Gadget Shop</p>

                <a href="/"
                    class="col-md-4 d-flex align-items-center justify-content-center mb-3 mb-md-0 me-md-auto link-dark text-decoration-none">
                    <span class="text-dark"><i class="fa-solid fa-computer text-danger"></i> Gadget Shop</span>
                </a>

                <ul class="nav col-md-4 justify-content-end list-unstyled d-flex">
                    <li class="ms-3"><a class="text-muted" href="#"><i class="fa-brands fa-twitter"></i></a></li>
                    <li class="ms-3"><a class="text-muted" href="#"><i class="fa-brands fa-facebook"></i></a></li>
                    <li class="ms-3"><a class="text-muted" href="#"><i class="fa-brands fa-instagram"></i></a></li>
                </ul>
            </footer>
        </div>
    </div>

    @yield('scripts')
</body>

</html>