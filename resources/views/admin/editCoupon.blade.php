<!doctype html>
<html lang="en">

<head>
    <title>Sidebar 01</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/style.css') }}">
    <script src="https://kit.fontawesome.com/6cc7b35ba8.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <x-dashboard.admin-navbar active=''></x-admin-navbar>

            <!-- Page Content  -->
            <div id="content" class="p-4 p-md-5">

                <nav class="navbar navbar-expand-lg navbar-light bg-light">
                    <div class="container-fluid">

                        <button type="button" id="sidebarCollapse" class="btn btn-primary ">
                            <i class="fa fa-bars"></i>
                            <span class="sr-only">Toggle Menu</span>
                        </button>
                        <button class="btn btn-dark d-inline-block d-lg-none ml-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <i class="fa fa-bars"></i>
                        </button>

                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="nav navbar-nav ml-auto">
                                <li class="nav-item">
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a class="nav-link" href="route('logout')" onclick="event.preventDefault();
                                                this.closest('form').submit();">
                                            {{ __('Log Out') }}
                                        </a>
                                    </form>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('profile.edit') }}">
                                        {{ __('Profile') }}
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </div>
                </nav>
                <!-- Content -->
                @if (session()->get('mssg'))
                <div class="alert {{session()->get('alert')}} my-5" role="alert">{{session()->get('mssg')}}</div>
                @endif
                <form method="POST" action="{{ route('adminUpdateProduct', ['id' => $product['id']]) }}">
                    @csrf
                    <div class="form-group my-4">
                        <label for="code">Coupon Code</label>
                        <input value="{{ $coupon['code'] }}" type="text" name="code" class="@error('code') is-invalid @enderror form-control" id="code" aria-describedby="coupon code">
                        @error('code')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <label for="type">Coupon Type</label>
                    <select class="form-control form-select" id="type" aria-label="Default select example" name="coupon_type" required> 
                        <option <?php if($coupon['type'] == 'percent') echo 'selected' ?> value="percent">Percent</option>
                        <option <?php if($coupon['type'] == 'flat') echo 'selected' ?> value="flat">Flat</option>
                    </select>

                    <div class="form-group my-4">
                        <label for="amount">Coupon Amount</label>
                        <input value="{{ $coupon['amount'] }}" type="number" name="amount" class="@error('amount') is-invalid @enderror form-control" id="amount" aria-describedby="coupon amount">
                        @error('amount')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <button type="submit" class="btn my-btn my-5">Edit Coupon</button>
                </form>

            </div>
    </div>

    <script src="{{ asset('assets/dashboard/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/popper.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/main.js') }}"></script>
</body>

</html>