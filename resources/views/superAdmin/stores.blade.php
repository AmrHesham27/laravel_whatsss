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
        <nav id="sidebar">
            <div class="p-4 pt-5">
                <ul class="list-unstyled components mb-5">

                    <li>
                        <a href="/superAdmin">Home</a>
                    </li>

                    <li class="active">
                        <a href="/superAdmin/stores/">Stores</a>
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

                    <button type="button" id="sidebarCollapse" class="btn btn-primary">
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

            <table class="table table-responsive">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Store Name</th>
                        <th scope="col">WhatsappNumber</th>
                        <th scope="col">URL</th>
                        <th scope="col">Subdomain</th>
                        <th scope="col">Is Suspended</th>
                        <th scope="col">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stores as $store)
                    <tr>
                        <th scope="row">{{ $store['id'] }}</th>
                        <td>{{ $store['name'] }}</td>
                        <td>{{ $store['whatsapp'] }}</td>
                        <td>{{ $store['url'] }}</td>
                        <td>{{ $store['subdomain'] }}</td>
                        <td>{{ $store['is_suspended'] ? 'Suspended' : '' }}</td>
                        <td class="d-flex">
                            <a class="btn delete-store-btn">
                                <i class="fa-solid fa-trash"></i>
                            </a>
                            @if ( !$store['is_suspended'] )
                            <form method="POST" action="{{ route('suspendStore', ['id' => $store['id']]) }}">
                                @csrf
                                <button class="btn store-btn">
                                    <i class="fa-solid fa-ban"></i>
                                </button>
                            </form>
                            @else
                            <form method="POST" action="{{ route('unSuspendStore', ['id' => $store['id']]) }}">
                                @csrf
                                <button class="btn store-btn">
                                    <i class="fa-solid fa-ban"></i>
                                </button>
                            </form>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>

    <script src="{{ asset('assets/dashboard/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/popper.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/main.js') }}"></script>
</body>

</html>