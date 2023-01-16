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

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>

    <style>
        .close-search {
            color: white !important;
            display: flex;
            align-items: center;
            justify-content: center
        }
    </style>
</head>

<body>

    <div class="wrapper d-flex align-items-stretch">
        <nav id="sidebar">
            <div class="nav-body">
                <button class="close-btn">
                    <i class="fa-solid fa-xmark"></i>
                </button>
                <div class="p-4 pt-5 nav-body">
                    <ul class="list-unstyled components mb-5">

                        <li>
                            <a href="/superAdmin">Home</a>
                        </li>

                        <li class="active">
                            <a href="/superAdmin/stores/">Stores</a>
                        </li>

                        <li>
                            <a href="/superAdmin/stores/add">Add Store</a>
                        </li>
                    </ul>
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
            <div class="d-flex flex-column">
                <div>
                    <a class="my-2 btn my-btn" href="/superAdmin/stores/add">Add Store</a>
                </div>

                <div class="d-flex">
                    <form method="GET" action="{{ route('searchStores') }}" style="max-width: 300px;">
                        @csrf
                        <div class="form-group my-4 d-flex">
                            <input type="text" name="search" value="{{ $search }}" class="form-control" id="search" aria-describedby="store name" placeholder="Search">
                            @if($type == 'search')
                            <a class="btn btn-danger mx-2 close-search" href="{{ route('superAdminStores') }}">x</a>
                            @endif
                        </div>
                    </form>

                </div>

            </div>

            <div class="d-flex">
                <table class="table table-responsive table-bordered">
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
                                <a class="btn delete-store-btn" form-action="{{ route('deleteStore', ['id' => $store['id']]) }}" data-toggle="modal" data-target="#exampleModal">
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
            <div class="d-flex justify-content-center">
                {{ $stores->appends(['search' => $search])->links() }}
            </div>

            <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
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
                            <form id='delete-store-form' method="POST" action="">
                                @csrf
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
        $('.delete-store-btn').click(function() {
            var formAction = this.getAttribute("form-action");
            $('#delete-store-form').attr('action', formAction);
        });
    </script>

    <script src="{{ asset('assets/dashboard/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/popper.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('assets/dashboard/js/main.js') }}"></script>
</body>

</html>