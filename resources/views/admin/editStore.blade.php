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
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/css/bootstrap-colorpicker.min.css" rel="stylesheet">
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
        <nav id="sidebar">
            <button class="close-btn">
                <i class="fa-solid fa-xmark"></i>
            </button>
            <div class="p-4 pt-5">
                <ul class="list-unstyled components mb-5">

                    <li>
                        <a href="/admin">Home</a>
                    </li>

                    <li class="active">
                        <a href="/admin/editStore">Edit Store</a>
                    </li>
                </ul>

                <div class="footer">
                    <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                        Copyright &copy;<script>
                            document.write(new Date().getFullYear());
                        </script> All rights reserved | Amr Hesham
                        <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
                    </p>
                </div>

            </div>
        </nav>

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
            <form method="POST" action="{{ route('adminUpdateStore') }}">
                @csrf
                <div class="form-group my-4">
                    <label for="store_name">Store Name</label>
                    <input type="text" name="name" value="{{ $store['name'] }}" class="@error('name') is-invalid @enderror form-control" id="store_name" aria-describedby="store name" placeholder="Enter Store Name">
                    @error('name')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-4">
                    <label for="url">URL</label>
                    <input type="text" name="url" value="{{ $store['url'] }}" class="@error('name') is-invalid @enderror form-control" id="url" aria-describedby="store name" placeholder="Enter Store Name">
                    @error('url')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group my-4">
                    <label for="whatsapp">Whatsapp Number</label>
                    <input type="text" name="whatsapp" value="{{ $store['whatsapp'] }}" class="@error('name') is-invalid @enderror form-control" id="whatsapp" aria-describedby="store name" placeholder="Enter Store Name">
                    @error('whatsapp')
                    <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="d-flex flex-sm-row flex-column justify-content-between">
                    <div class="form-group my-4 col-sm-6 input-x" style="padding-left: 0;">
                        <label for="color_1">Color 1</label>
                        <input type="text" id="color_1" name="color_1" value="{{ $store['color_1'] }}" class="@error('color_1') is-invalid @enderror colorpicker form-control" id="whatsapp" aria-describedby="color 1">
                        @error('color_1')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-4 col-sm-6 input-x" style="padding-right: 0;">
                        <label for="color_2">Color 2</label>
                        <input type="text" id="color_3" name="color_2" value="{{ $store['color_2'] }}" class="@error('color_2') is-invalid @enderror colorpicker form-control" id="whatsapp" aria-describedby="color 1">
                        @error('color_2')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>

                <div class="d-flex flex-sm-row flex-column justify-content-between">
                    <div class="form-group my-4 col-sm-6 input-x" style="padding-left: 0;">
                        <label for="start_time">Start Time</label>
                        <input type="time" id="start_time" name="start_time" value="{{ $store['start_time'] }}" class="@error('start_time') is-invalid @enderror form-control" id="start_time" aria-describedby="start_time">
                        @error('color_1')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="form-group my-4 col-sm-6 input-x" style="padding-right: 0;">
                        <label for="color_2">End Time</label>
                        <input type="time" id="end_time" name="end_time" value="{{ $store['end_time'] }}" class="@error('end_time') is-invalid @enderror form-control" id="end_time" aria-describedby="end_time">
                        @error('end_time')
                        <div class="alert alert-danger mt-1 mb-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <label for="currency">Currency</label>
                <select id="currency" name="currency" class="form-select form-control" aria-label="Choose currency">
                    <option value="E£" <?php if ($store['currency'] == "E£") echo 'selected' ?>>E£</option>
                    <option value="$" <?php if ($store['currency'] == "$") echo 'selected' ?>>$</option>
                    <option value="€" <?php if ($store['currency'] == "€") echo 'selected' ?>>€</option>
                </select>

                <div class="d-flex flex-column my-4">
                    <label>Delivery Options</label>
                    <div class="d-flex">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" id="flexCheckChecked" name="dinIn" <?php if ($store['dinIn']) echo "checked" ?>>
                            <label class="form-check-label" for="flexCheckChecked">
                                Din In
                            </label>
                        </div>

                        <div class="form-check mx-5">
                            <input class="form-check-input" type="checkbox" id="flexCheckChecked" name="pickUp" <?php if ($store['pickUp']) echo "checked" ?>>
                            <label class="form-check-label" for="flexCheckChecked">
                                Pick up
                            </label>
                        </div>
                    </div>
                </div>



                <button type="submit" class="btn my-btn my-4">Edit Store</button>
            </form>

        </div>
    </div>

    <script src="{{ asset('assets/dashboard/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/popper.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/main.js') }}"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-colorpicker/2.5.3/js/bootstrap-colorpicker.min.js"></script>
    <script>
        $('.colorpicker').colorpicker();
    </script>
</body>

</html>