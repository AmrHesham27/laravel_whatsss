<!doctype html>
<html lang="ar" dir="rtl">

<head>
  <title>Otogoto - super admin</title>
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

    .cards-container {
      display: flex;
      flex-direction: row;
      justify-content: space-between;
      margin-bottom: 50px;
    }

    .cards-container>.card {
      width: 30%;
    }

    @media screen and (max-width: 876px) {
      .cards-container>.card {
        min-width: 200px;
      }

      .cards-container {
        flex-wrap: wrap;
      }

      .cards-container>.card {
        width: 48%;
        margin-bottom: 30px;
      }

      .cards-container:first-child {
        margin-top: 0 !important;
      }
    }

    @media screen and (max-width: 576px) {
      .cards-container {
        flex-direction: column;
      }

      .cards-container>.card {
        width: 100%;
        margin-bottom: 30px;
      }

      .cards-container:first-child {
        margin-top: 0 !important;
      }
    }
  </style>
</head>

<body>

  <div class="wrapper d-flex align-items-stretch">
    <x-dashboard.super-admin-navbar active='الصفحة الرئيسية'></x-dashboard.super-admin-navbar>


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
      <div class="cards-container">
            <div class="card">
              <div class="card-header">
                <h2>المتاجر</h2>
              </div>
              <div class="card-body d-flex flex-column align-items-center">
                <i class="fa-solid fa-box" style="color: #f8b739; font-size: 40px;"></i>
                <span class="my-2">{{ $stores_count }}</span>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h2>المنتجات</h2>
              </div>
              <div class="card-body d-flex flex-column align-items-center">
                <i class="fa-solid fa-boxes-stacked" style="color: #f8b739; font-size: 40px;"></i>
                <span class="my-2">{{ $products_count }}</span>
              </div>
            </div>

            <div class="card">
              <div class="card-header">
                <h2>المشاهدات</h2>
              </div>
              <div class="card-body d-flex flex-column align-items-center">
                <i class="fa-solid fa-eye" style="color: #f8b739; font-size: 40px;"></i>
                <span class="my-2">{{ $views[0] }}</span>
              </div>
            </div>
          </div>

      <div class="container">
        <h2>المشاهدات</h2>
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
          new Date(Date.now() - (86400000 * 6)).toJSON().slice(5, 10).replace(/-/g, '/'),
          new Date(Date.now() - (86400000 * 5)).toJSON().slice(5, 10).replace(/-/g, '/'),
          new Date(Date.now() - (86400000 * 4)).toJSON().slice(5, 10).replace(/-/g, '/'),
          new Date(Date.now() - (86400000 * 3)).toJSON().slice(5, 10).replace(/-/g, '/'),
          new Date(Date.now() - (86400000 * 2)).toJSON().slice(5, 10).replace(/-/g, '/'),
          new Date(Date.now() - 86400000).toJSON().slice(5, 10).replace(/-/g, '/'),
          new Date().toJSON().slice(5, 10).replace(/-/g, '/'),
        ],
        datasets: [{
          label: "مشاهدات كل المتاجر",
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