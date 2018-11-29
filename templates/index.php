<!DOCTYPE html>
<html lang="en">

  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">
    <base href="/">
    
    <title>{% block title %}{% endblock %}</title>

    <!-- Bootstrap core CSS -->
    <link href="templates/assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom styles for this template -->
    <link href="templates/assets/css/shop-item.css" rel="stylesheet">

  </head>

  <body>

    <!-- Navigation -->
    <nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
      <div class="container">
        <a class="navbar-brand" href="#">Start Bootstrap</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="eventos">Eventos<span class="sr-only">(current)</span>
              </a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Menu exemplo</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#">Menu exemplo 2</a>
            </li>
          </ul>
        </div>
      </div>
    </nav>

    <!-- Page Content -->
    <div class="container">

      <div class="row">
        <div class="col-lg-3">
          <h1 class="my-4">Shop Name</h1>
          <div class="list-group">
            <a href="eventos" class="list-group-item active">Eventos</a>
          </div>
          <div class="list-group">
            <a href="#" class="list-group-item ">Menu exemplo</a>
          </div>
          <div class="list-group">
            <a href="#" class="list-group-item ">Menu exemplo 2</a>
          </div>
        </div>
        <!-- /.col-lg-3 -->

        <div class="col-lg-9">
            {% block content %}{% endblock %}
        </div>
        <!-- /.col-lg-9 -->

      </div>

    </div>
    <!-- /.container -->

    <!-- Footer -->
    <footer class="py-5 bg-dark">
      <div class="container">
        <p class="m-0 text-center text-white">Copyright &copy; Your Website 2017</p>
      </div>
      <!-- /.container -->
    </footer>

    <!-- Bootstrap core JavaScript -->
    <script src="templates/assets/vendor/jquery/jquery.min.js"></script>
    <script src="templates/assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  </body>

</html>
