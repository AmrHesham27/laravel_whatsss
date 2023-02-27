<!doctype html>
<html lang="ar" dir="rtl">

<head>
    <title>Admin Dasboard</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="{{ asset('assets/dashboard/css/style.css') }}">
    <script src="https://kit.fontawesome.com/6cc7b35ba8.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <link href="https://gitcdn.github.io/bootstrap-toggle/2.2.2/css/bootstrap-toggle.min.css" rel="stylesheet">
    <style>
        .close-search {
            color: white !important;
            display: flex;
            align-items: center;
            justify-content: center
        }
        input.form-control {
          border-radius: 0;
        }
        th, td {
            text-align: center;
        }
    </style>
</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <x-dashboard.admin-navbar active='المنتجات'></x-admin-navbar>

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
                <div class="d-flex flex-column">
                    @if (session()->get('mssg'))
                    <div class="alert {{session()->get('alert')}}" role="alert">{{session()->get('mssg')}}</div>
                    @endif
                    <div class="d-flex">
                        <a class="my-2 btn my-btn" href="{{ route('admin.products.create') }}">أضف منتج</a>
                    </div>

                    <div class="d-flex">
                        <form method="POST" action="{{ route('adminSearchProducts') }}" style="max-width: 300px;">
                            @csrf
                            <div class="form-group my-4 d-flex">
                                <div class="input-group mb-3">
                                    <div class="input-group-append">
                                        <button class="input-group-text" id="basic-addon1" type="submit">
                                            <i class="fas fa-search"></i>
                                        </button>
                                    </div>
                                    <input type="text" name="search" value="{{ $search }}" class="form-control" id="search" aria-describedby="store name" placeholder="ابحث">
                                    @if($type == 'search')
                                    <div class="input-group-prepend">
                                        <a class="input-group-text close-search" href="{{ route('admin.products.index') }}" id="basic-addon2" style="background-color: #dc3545;">
                                            <i class="fa-solid fa-xmark"></i>
                                        </a>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </form>

                    </div>

                </div>

                <div class="d-flex table-responsive">
                    <table class="table table-bordered">
                        <thead class="thead-dark">
                            <tr>
                                <th scope="col">#</th>
                                <th scope="col">اسم المنتج</th>
                                <th scope="col">وصف المنتج</th>
                                <th scope="col">السعر</th>
                                <th scope="col">صورة المنتج</th>
                                <th scope="col">التصنيف</th>
                                <th scope="col">خيارات</th>
                                <th scope="col">التفعيل</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($products as $product)
                            <tr>
                                <th scope="row">{{ $product['id'] }}</th>
                                <td>{{ $product['name'] }}</td>
                                <td>{{ $product['desc'] }}</td>
                                <td>{{ $product['price'] }}</td>
                                <td>
                                    <img style="max-height: 100px;" src="{{ asset('images/' . $product['image'] ) }}" alt="product" />
                                </td>
                                <td>{{ $product['category']['name'] }}</td>

                                <td>
                                    <button class="btn delete-btn" data-toggle="modal" data-target="#deleteModal" form-action="{{ route('admin.products.destroy', [ 'product' => $product['id'] ]) }}">
                                        <i class="fa-solid fa-trash"></i>
                                    </button>
                                    <a class="btn edit-btn" href="{{ route('admin.products.edit', [ 'product' => $product['id'] ]) }}">
                                        <i class="fa-solid fa-pen"></i>
                                    </a>
                                </td>
                                <td>
                                    <form id="toggle-{{ $product['id'] }}" action="{{ route('toggleActivationProduct', ['id' => $product['id']]) }}">
                                        <input class="toggle-event" data="{{ $product['id'] }}" type="checkbox" data-toggle="toggle" data-on="مفعل" data-off="معطل" <?php if ($product['active']) echo 'checked'; ?>>
                                    </form>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="d-flex justify-content-center">
                    {{ $products->appends(['search' => $search])->links() }}
                </div>

                <div class="modal fade" id="deleteModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Are you sure ?</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                                <form id='delete-product-form' method="POST" action="">
                                    @csrf
                                    @method('DELETE')
                                    <button class="btn btn-danger">
                                        Delete
                                    </button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </div>

    <script>
        $(document).ready(function() {
            $('.delete-btn').click(function() {
                var formAction = this.getAttribute("form-action");
                $('#delete-product-form').attr('action', formAction);
            });

            $('.toggle-event').change(function() {
                $(`#toggle-${$(this).attr('data')}`).submit();
            })
        });
    </script>

    <script src="{{ asset('assets/dashboard/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/popper.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/main.js') }}"></script>
    <script src="https://gitcdn.github.io/bootstrap-toggle/2.2.2/js/bootstrap-toggle.min.js"></script>
</body>

</html>