
<html lang="es">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!--link rel="shortcut icon" href="../../assets/ico/favicon.ico"-->

    <title>Mattes Enterprise</title>

    <!-- Bootstrap core CSS -->
    <link rel="stylesheet" href="/bootstrap/css/bootstrap.min.css"> 
    <!-- Just for debugging purposes. Don't actually copy this line! -->
    <!--[if lt IE 9]><script src="../../assets/js/ie8-responsive-file-warning.js"></script><![endif]-->

    <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
      <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->

  </head>
<!-- NAVBAR
================================================== -->
<style type="text/css">
  body{
    //background: url('/img/background.png');    
  }

  @media (min-width: 992px) {
    .nav-md{
      position:absolute;
    }
    .paddin-top{
      padding-top:3%;
    }
  }

  @media (max-width: 1538px){
    .logo{
      //margin-left: 6.2%;
    }
  }
  /*margin:2% 0 0 .5%;*/  
</style>
  <body >
  <div class="row">
   <!--div  class="nav-md col-md-4 col-xs-6 col-md-offset-0 col-xs-offset-5">
        <a href="/"><img src="/img/IMG-20140327-WA0002.jpg" width="30%"></a>
    </div--> 
  </div>
   <div class="container paddin-top" style="">

     <div class='logo' style="/margin-left:3.2%;">
     
      <!-- Static navbar -->
      <div class="navbar navbar-inverse" role="navigation">
        <div class="container-fluid">
          <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
              <span class="sr-only">Toggle navigation</span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
              <span class="icon-bar"></span>
            </button>
              <a class="navbar-brand" href="/" style="/color:rgba(255, 100, 230, 0.70);">Mattes Enterprise</a>
          </div>
          <div class="navbar-collapse collapse navbar-inverse-collapse">
            <ul class="nav navbar-nav">
              <li class="active"><a href="/">Inicio</a></li>
              <li><a href="#">Productos</a></li>
              <li><a href="#">Acerca de...</a></li>
              <!--li class="dropdown">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">Dropdown <b class="caret"></b></a>
                <ul class="dropdown-menu">
                  <li><a href="#">Action</a></li>
                  <li><a href="#">Another action</a></li>
                  <li><a href="#">Something else here</a></li>
                  <li class="divider"></li>
                  <li class="dropdown-header">Nav header</li>
                  <li><a href="#">Separated link</a></li>
                  <li><a href="#">One more separated link</a></li>
                </ul>
              </li-->
            </ul>
             <form class="navbar-form navbar-left">
              <input type="text" class="form-control col-lg-8" placeholder="Busca un producto">
            </form>
            <ul class="nav navbar-nav navbar-right">
              @if(Auth::check())
              <li class="active"><a href="/administracion">Administracion</a></li>
              
                <li><a href="{{{URL::route('logout')}}}">Salir</a></li>
              @else
              <li><a href="/">Log In</a></li>
              @endif
              
            </ul>
          </div><!--/.nav-collapse -->
        </div><!--/.container-fluid -->
      </div>

      </div>
      <style type="text/css">
          .myContent{
                margin-top:3%; 
                background-color:white; 
                border-radius:5px;
                border-color: black;
                box-shadow: 0px 0px 10px rgba(30,30,100,0.3);
          }
      </style>

    <div class='myContent panel-body'> 
       
        @yield('content')
    </div>

    


      <!-- FOOTER -->
      <footer style="padding-top:4%;">
        <p class="pull-right"><a href="#">Ir al tope</a></p>
        <p>&copy; 2014 Mattes, Inc. &middot; <a href="#">Privacy</a> &middot; <a href="#">Terms</a></p>
      </footer>

    </div><!-- /.container -->


    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    <script src="/js/jquery-2.0.2.min.js"></script>
    <script src="/bootstrap/js/bootstrap.min.js"></script>
     @yield('scripts')
  </body>
</html>
