<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <title>Otogoto - super admin</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/style.css') }}">
    <script src="https://kit.fontawesome.com/6cc7b35ba8.js" crossorigin="anonymous"></script>
</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <x-dashboard.super-admin-navbar active='أضف متجر'></x-dashboard.super-admin-navbar>
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
                                        {{ __('تسجيل الخروج') }}
                                    </a>
                                </form>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('profile.edit') }}">
                                    {{ __('الملف الشخصي') }}
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
            <form method="POST" action="{{ route('createStore') }}" class="text-right">
                @csrf
                <div class="form-group my-4">
                    <label for="store_name">اسم المتجر</label>
                    <input type="text" name="name" value="{{ old('name') }}" class="@error('name') is-invalid @enderror form-control" id="store_name" aria-describedby="store name">
                    @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-4">
                    <label for="store_name">رابط المتجر</label>
                    <input type="text" name="url" value="{{ old('url') }}" class="@error('url') is-invalid @enderror form-control" id="url" aria-describedby="store url">
                    @error('url')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-4">
                    <label for="whatsapp">رقم الواتساب</label>
                    <input type="text" name="whatsapp" value="{{ old('whatsapp') }}" class="@error('whatsapp') is-invalid @enderror form-control" id="whatsapp" aria-describedby="whatsapp">
                    @error('whatsapp')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-4">
                    <label for="email">ايميل أدمن المتجر</label>
                    <input type="email" name="email" value="{{ old('email') }}" class="@error('email') is-invalid @enderror form-control" id="email" aria-describedby="email">
                    @error('email')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-4">
                    <label for="password">كلمة السر</label>
                    <input type="password" name="password" class="@error('password') is-invalid @enderror form-control" id="password">
                    @error('password')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <button type="submit" class="btn my-btn mt-3">أضف المتجر</button>
            </form>

        </div>
    </div>

    <script src="{{ asset('assets/dashboard/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/popper.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/main.js') }}"></script>
</body>

</html>