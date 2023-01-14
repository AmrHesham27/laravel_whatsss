<!doctype html>
<html lang="en">

<head>
  <title>Sidebar 01</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

  <link href="https://fonts.googleapis.com/css?family=Poppins:300,400,500,600,700,800,900" rel="stylesheet">

  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="{{ asset('assets/dashboard/css/style.css') }}">

  <link rel="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css" type="text/css" />
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/modernizr/2.8.3/modernizr.min.js" type="text/javascript"></script>
  <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.2.2/Chart.min.js"></script>
  <script src="https://kit.fontawesome.com/6cc7b35ba8.js" crossorigin="anonymous"></script>

  <style>
    .container {
      max-width: 700px;
    }

    body {
      color: green;
    }

    h2 {
      text-align: center;
      font-family: "Verdana", sans-serif;
      font-size: 1rem;
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
        <div class="p-4 pt-5">
          <ul class="list-unstyled components mb-5">

            <li class="active">
              <a href="/admin">Home</a>
            </li>

            <li>
              <a href="/admin/editStore/">Edit Store</a>
            </li>

          </ul>
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
      <div class="container">
        <h2>Views</h2>
        <div>
          <canvas id="myChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <script>
    var views = <?php echo $views[0] ?>;
    console.log(views);

    var ctx = document.getElementById("myChart").getContext("2d");
    var myChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: [
          new Date(Date.now() - (86400000 * 6)).toJSON().slice(5, 10).replace(/-/g, '/'),
          new Date(Date.now() - (86400000 * 5)).toJSON().slice(5, 10).replace(/-/g, '/'),
          new Date(Date.now() - (86400000 * 4)).toJSON().slice(5, 10).replace(/-/g, '/'),
          new Date(Date.now() - (86400000 * 3)).toJSON().slice(5, 10).replace(/-/g, '/'),
          new Date(Date.now() - (86400000 * 2)).toJSON().slice(5, 10).replace(/-/g, '/'),
          new Date(Date.now() - 86400000).toJSON().slice(5, 10).replace(/-/g, '/'),
          new Date().toJSON().slice(5, 10).replace(/-/g, '/'),
        ],
        datasets: [{
          label: "Total Views Count",
          data: [
            <?php echo $views[6] ?>,
            <?php echo $views[5] ?>,
            <?php echo $views[4] ?>,
            <?php echo $views[3] ?>,
            <?php echo $views[2] ?>,
            <?php echo $views[1] ?>,
            <?php echo $views[0] ?>
          ],
          backgroundColor: "#f8b739",
        }, ],
      },
    });
  </script>

  <script src="{{ asset('assets/dashboard/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/dashboard/js/popper.js') }}"></script>
  <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/dashboard/js/main.js') }}"></script>
</body>

</html>