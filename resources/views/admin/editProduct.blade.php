<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <title>Otogoto - admin</title>
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
                        <button class="btn btn-dark d-inline-block d-lg-none mr-auto" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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
                <form class="text-right" method="POST" enctype="multipart/form-data" action="{{ route('admin.products.update', ['product' => $product['id']]) }}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group my-4">
                        <label for="product_name">اسم المنتج</label>
                        <input value="{{ $product['name'] }}" type="text" name="name" class="@error('name') is-invalid @enderror form-control" id="product_name" aria-describedby="product name" placeholder="Enter Product Name">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-4">
                        <label for="product_description">وصف المنتج</label>
                        <input value="{{ $product['desc'] }}" type="text" name="desc" class="@error('desc') is-invalid @enderror form-control" id="product_description" aria-describedby="product description" placeholder="Enter Product Description">
                        @error('desc')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-4">
                        <label for="product_price">السعر</label>
                        <input value="{{ $product['price'] }}" type="number" name="price" class="@error('price') is-invalid @enderror form-control" id="product_price" aria-describedby="product price" placeholder="Enter Product Price">
                        @error('price')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-flex flex-sm-row flex-column justify-content-between">
                        <div class="form-grou d-flex flex-column my-4 col-sm-6 input-x" style="padding-left: 0;">
                            <label for="image">صورة المنتج</label>
                            <input type="file" name="image">
                            @error('image')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group my-4 col-sm-6 input-x" style="padding-right: 0;">
                            <img style="max-height: 150px;" alt="logo" src="/images/{{ $product['image'] }}" />
                        </div>
                    </div>

                    <label for="product_description">تصنيف المنتج</label>
                    <select class="form-control form-select" aria-label="Default select example" name="category_id">
                        @foreach($categories as $category)
                        @if ($category['id'] == $product['category_id'])
                        <option selected value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                        @else
                        <option value="{{ $category['id'] }}">{{ $category['name'] }}</option>
                        @endif
                        @endforeach
                    </select>


                    <button type="submit" class="btn my-btn my-5">عدل المنتج</button>
                </form>

            </div>
    </div>

    <script src="{{ asset('assets/dashboard/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/popper.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/main.js') }}"></script>
</body>

</html>