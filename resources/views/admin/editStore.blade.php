<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <title>Sidebar 01</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/style.css') }}">
    <script src="https://kit.fontawesome.com/6cc7b35ba8.js" crossorigin="anonymous"></script>
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js" integrity="sha256-/xUj+3OJU5yExlq6GSYGSHk7tPXikynS7ogEvDej/m4=" crossorigin="anonymous"></script>

</head>

<style>
    @media screen and (max-width: 575.5px) {
        .input-x {
            padding: 0 !important;
        }
    }
</style>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <x-dashboard.admin-navbar active='عدل متجرك'></x-admin-navbar>

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
                <h5 class="text-right">تحكم في متجرك</h5>
                <form class="text-right" enctype="multipart/form-data" method="POST" action="{{ route('adminUpdateStore') }}">
                    @csrf
                    <div class="form-group my-4">
                        <label for="store_name">اسم المتجر</label>
                        <input type="text" name="name" value="{{ $store['name'] }}" class="@error('name') is-invalid @enderror form-control" id="store_name" aria-describedby="store name" placeholder="Enter Store Name">
                        @error('name')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-4">
                        <label for="url">رابط المتجر</label>
                        <input type="text" name="url" value="{{ $store['url'] }}" class="@error('name') is-invalid @enderror form-control" id="url" aria-describedby="url" placeholder="Enter Store URL">
                        @error('url')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                        <div id="url-message-danger" class="alert alert-danger mt-1 mb-1 d-none"></div>
                        <div id="url-message-success" class="alert alert-success mt-1 mb-1 d-none"></div>
                    </div>
                    <div class="form-group my-4">
                        <label for="whatsapp">رقم الواتساب</label>
                        <input type="text" name="whatsapp" value="{{ $store['whatsapp'] }}" class="@error('name') is-invalid @enderror form-control" id="whatsapp" aria-describedby="store name" placeholder="Enter Store Name">
                        @error('whatsapp')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="d-flex flex-sm-row flex-column justify-content-between">
                        <div class="form-group my-4 col-sm-6 input-x" style="padding-left: 0;">
                            <label for="color_1">لون القالب الرئيسي</label>
                            <input type="text" id="color_1" name="color_1" value="{{ $store['color_1'] }}" class="@error('color_1') is-invalid @enderror colorpicker form-control" id="whatsapp" aria-describedby="color 1">
                            @error('color_1')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group my-4 col-sm-6 input-x" style="padding-right: 0;">
                            <label for="color_2">لون القالب الثانوي</label>
                            <input type="text" id="color_3" name="color_2" value="{{ $store['color_2'] }}" class="@error('color_2') is-invalid @enderror colorpicker form-control" id="whatsapp" aria-describedby="color 1">
                            @error('color_2')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div class="d-flex flex-sm-row flex-column justify-content-between">
                        <div class="form-group my-4 col-sm-6 input-x" style="padding-left: 0;">
                            <label for="start_time">توقيت افتتاح المتجر</label>
                            <input type="time" id="start_time" name="start_time" value="{{ $store['start_time'] }}" class="@error('start_time') is-invalid @enderror form-control" id="start_time" aria-describedby="start_time">
                            @error('color_1')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group my-4 col-sm-6 input-x" style="padding-right: 0;">
                            <label for="color_2">توقيت اغلاق المتجر</label>
                            <input type="time" id="end_time" name="end_time" value="{{ $store['end_time'] }}" class="@error('end_time') is-invalid @enderror form-control" id="end_time" aria-describedby="end_time">
                            @error('end_time')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <label for="currency">العملة</label>
                    <select id="currency" name="currency" class="form-select form-control" aria-label="Choose currency">
                        <option value="ج.م" <?php if ($store['currency'] == "ج.م") echo 'selected' ?>>ج.م</option>
                        <option value="$" <?php if ($store['currency'] == "$") echo 'selected' ?>>$</option>
                        <option value="€" <?php if ($store['currency'] == "€") echo 'selected' ?>>€</option>
                    </select>

                    <div class="d-flex flex-sm-row flex-column justify-content-between">
                        <div class="form-grou d-flex flex-column my-4 col-sm-6 input-x" style="padding-left: 0;">
                            <label for="whatsapp">شعار المتجر</label>
                            <input type="file" name="logo">
                            @error('logo')
                            <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group my-4 col-sm-6 input-x" style="padding-right: 0;">
                            @if($store['logo'])
                            <img style="max-height: 150px;" alt="logo" src="/images/{{ $store['logo'] }}" />
                            @endif
                        </div>
                    </div>

                    <div class="d-flex flex-column my-4">
                        <label>خيارات التوصيل</label>
                        <div class="d-flex">
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" id="flexCheckChecked" name="dinIn" <?php if ($store['dinIn']) echo "checked" ?>>
                                <label class="form-check-label mr-3" for="flexCheckChecked">
                                    حجز طاولة
                                </label>
                            </div>

                            <div class="form-check mx-5">
                                <input class="form-check-input" type="checkbox" id="flexCheckChecked" name="pickUp" <?php if ($store['pickUp']) echo "checked" ?>>
                                <label class="form-check-label mr-3" for="flexCheckChecked">
                                    استلام من المكان
                                </label>
                            </div>

                            <div class="form-check mx-5">
                                <input class="form-check-input" type="checkbox" id="flexCheckChecked" name="delivery" <?php if ($store['delivery']) echo "checked" ?>>
                                <label class="form-check-label mr-3" for="flexCheckChecked">
                                    توصيل
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-check">
                        <input class="form-check-input" type="checkbox" id="flexCheckChecked" name="displayCards" <?php if ($store['displayCards']) echo "checked" ?>>
                        <label class="form-check-label mr-3" for="flexCheckChecked">
                            أظهر المنتجات علي شكل بطاقات
                        </label>
                    </div>
                    <button type="submit" class="btn my-btn my-5">عدل المتجر</button>

                </form>

                @if ($store['delivery'])
                <form method="POST" class="my-5" action="{{ route('adminAddPlace') }}">
                    @csrf
                    <h6 class="text-right">عدل أو أضف مكان توصيل</h6>
                    <div class="d-flex flex-sm-row flex-column justify-content-between text-right">
                        <div class="form-group my-4 col-sm-6 input-x" style="padding-left: 0;">
                            <label for="deliveryPlaceName">الاسم</label>
                            <input type="text" id="deliveryPlaceName" name="placeName" class="form-control">
                        </div>
                        <div class="form-group my-4 col-sm-6 input-x" style="padding-left: 0;">
                            <label for="deliveryPlacePrice">السعر</label>
                            <input type="number" id="deliveryPlacePrice" name="placePrice" class="form-control">
                        </div>
                    </div>
                    <button style="float: right;" class="mr-3 btn btn-secondary">أدخل</button>
                </form>
                @endif

                @if (count($places))
                <div class="d-flex table-responsive">
                    <table class="table table-bordered ">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">اسم المكان</th>
                                <th scope="col">السعر</th>
                                <th scope="col">خيارات</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($places as $place)
                            <tr>
                                <td>{{ $place['name'] }}</td>
                                <td>{{ $place['price'] }}</td>
                                <td class="d-flex">
                                    <form method="POST" action="{{ route('adminDeletePlace', ['id' => $place['id']]) }}">
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

    <script src="{{ asset('assets/dashboard/js/popper.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/main.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
    <script>
        $('.colorpicker').colorpicker();
    </script>

    <script>
        $(document).ready(function() {
            $("#url").change(function(e) {
                if (e.target.value == '<?php echo $store['url'] ?>') {
                    $('#url-message-success').text("This URL is available.").removeClass('d-none');
                    $('#url-message-danger').addClass('d-none');
                } else {
                    $.ajax(`/stores/checkURL/${e.target.value}`, {
                        success: function(data, status, xhr) {
                            if (data.result) {
                                $('#url-message-success').text("This URL is available.").removeClass('d-none');
                                $('#url-message-danger').addClass('d-none');
                            } else {
                                $('#url-message-danger').text("This URL is not available.").removeClass('d-none');
                                $('#url-message-success').addClass('d-none');
                            }
                        },
                    });
                }
            });
        })
    </script>
</body>

</html>