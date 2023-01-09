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
  <style>
    .container {
      max-width: 700px;
    }

    body {
      text-align: center;
      color: green;
    }

    h2 {
      text-align: center;
      font-family: "Verdana", sans-serif;
      font-size: 30px;
    }
  </style>
</head>

<body>

  <div class="wrapper d-flex align-items-stretch">
    <nav id="sidebar">
      <div class="p-4 pt-5">
        <ul class="list-unstyled components mb-5">

          <li class="active">
            <a href="/superAdmin">Home</a>
          </li>

          <li>
            <a href="/superAdmin/stores/">Stores</a>
          </li>
        </ul>

        <div class="footer">
          <p><!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. -->
            Copyright &copy;<script>
              document.write(new Date().getFullYear());
            </script> All rights reserved | Amr Hesham
            <!-- Link back to Colorlib can't be removed. Template is licensed under CC BY 3.0. --></p>
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
              <li class="nav-item active">
                <a class="nav-link" href="/superAdmin/">Home</a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="/superAdmin/stores/">Stores</a>
              </li>
            </ul>
          </div>
        </div>
      </nav>
      <!-- Content -->
      <div class="container">
        <h2>Stores</h2>
        <div>
          <canvas id="myChart"></canvas>
        </div>
      </div>
    </div>
  </div>

  <script>
    var ctx = document.getElementById("myChart").getContext("2d");
    var myChart = new Chart(ctx, {
      type: "line",
      data: {
        labels: [
          "Monday",
          "Tuesday",
          "Wednesday",
          "Thursday",
          "Friday",
          "Saturday",
          "Sunday",
        ],
        datasets: [
          {
            label: "Stores Count",
            data: [2, 2, 5, 5, 2, 1, 10],
            backgroundColor: "#f8b739",
          },
        ],
      },
    });
  </script>

  <script src="{{ asset('assets/dashboard/js/jquery.min.js') }}"></script>
  <script src="{{ asset('assets/dashboard/js/popper.js') }}"></script>
  <script src="{{ asset('assets/dashboard/js/bootstrap.min.js') }}"></script>
  <script src="{{ asset('assets/dashboard/js/main.js') }}"></script>
</body>

</html>