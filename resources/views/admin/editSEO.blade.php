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
        <x-dashboard.admin-navbar active='محركات البحث'></x-admin-navbar>

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
                <form class="text-right" method="POST" action="{{ route('editSEO') }}">
                    @csrf
                    <div class="form-group my-4">
                        <label for="title">عنوان صفحة المتجر</label>
                        <input value="{{ $title }}" type="text" name="title" class="@error('title') is-invalid @enderror form-control" id="title" aria-describedby="title">
                        @error('title')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="form-group my-4">
                        <label for="title">وصف صفحة المتجر</label>
                        <input value="{{ $description }}" type="text" name="description" class="@error('description') is-invalid @enderror form-control" id="description" aria-describedby="description">
                        @error('description')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn my-btn my-5">عدل</button>
                </form>



                <form method="POST" class="my-5" action="{{ route('adminAddMeta') }}">
                    @csrf
                    <h6 class="text-right">عدل أو أضف Meta Tag</h6>
                    <div class="d-flex flex-sm-row flex-column justify-content-between text-right">
                        <div class="form-group my-4 col-sm-6 input-x" style="padding-left: 0;">
                            <label for="meta_name">الاسم</label>
                            <input type="text" id="meta_name" name="name" class="form-control">
                        </div>
                        <div class="form-group my-4 col-sm-6 input-x" style="padding-left: 0;">
                            <label for="meta_content">المحتوي</label>
                            <input type="text" id="meta_content" name="content" class="form-control">
                        </div>
                    </div>
                    <button style="float: right;" class="mr-3 btn btn-secondary">أدخل</button>
                </form>

                @if (count($metas))
                <div class="d-flex table-responsive text-center">
                    <table class="table table-bordered ">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">الاسم</th>
                                <th scope="col">المحتوي</th>
                                <th scope="col">خيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($metas as $meta)
                            <tr>
                                <td>{{ $meta['name'] }}</td>
                                <td>{{ $meta['content'] }}</td>
                                <td class="d-flex">
                                    <form method="POST" action="{{ route('adminDeleteMeta') }}">
                                        <input hidden name="name" value="{{ $meta['name'] }}">
                                        @csrf
                                        <button class="btn delete-store-btn">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                @endif

            </div>
    </div>

    <script src="{{ asset('assets/dashboard/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/popper.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/main.js') }}"></script>
</body>

</html>