<!DOCTYPE html>

<html lang="es">

<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="../estilos/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="../estilos/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />
  <title>
    Shool Assistent
  </title>
  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />
  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200|Open+Sans+Condensed:700" rel="stylesheet">
  <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.1/css/all.css" integrity="sha384-fnmOCqbTlWIlj8LyTjo7mOUStjsKC4pOpQbqyi7RrhN7udi9RwhKkMHpvLbHG9Sr" crossorigin="anonymous">
  <!-- CSS Files -->
  <link href="../estilos/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="../estilos/assets/css/now-ui-kit.css?v=1.3.1" rel="stylesheet" />
  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="../estilos/assets/demo/demo.css" rel="stylesheet" />
  <style>
    .buscador{
      padding-top: 5%;
    }
    .cart{
      padding-top: 35%;
    }
    .help{
      padding-top: 12px;
      padding-left: 50%;
    }
    body,div{
      font-family: 'Roboto', ;
      font-size: 'small';
    }

    @media (min-width: 600px) {
      #text{
        color: 'white' !important;
      }

      #boton1Mob{
        display:none;
      }
      #boton2Mob{
        display:none;
      }
      #boton1Web{
        display:block;
      }
      #boton2Web{
        display:block;
      }
      #cart-mobile{
        display:none;
      }
      #help-mobile{
        display:none;
      }
      #carruselWeb1{
        display:block;
      }
      #carruselMobile1{
        display:none;
      }
      #carruselWeb2{
        display:block;
      }
      #carruselMobile2{
        display:none;
      }
      #carruselWeb3{
        display:block;
      }
      #carruselMobile3{
        display:none;
      }
      #nav-web-1{
        display:block;
      }
      #nav-web-2{
        display:block;
      }
      #nav-web-3{
        display:block;
      }
      #nav-mob-1{
        display:none;
      }
      #nav-mob-2{
        display:none;
      }
      #nav-mob-3{
        display:none;
      }
    }

    @media screen and (min-width:0px) and  (max-width: 600px) {
      #text{
        color: 'black' !important;
      }

      #boton1Mob{
        display:block;
      }
      #boton2Mob{
        display:block;
      }
      #boton1Web{
        display:none;
      }
      #boton2Web{
        display:none;
      }

      #cart-web{
        display:none;
      }
      #help-web{
        display:none;
      }

      #cart-mobile{
        display:block;
      }
      #help-mobile{
        display:block;
      }

      #carruselWeb1{
            display:none;
          }
          #carruselMobile1{
            display:block;
          }
          #carruselWeb2{
            display:none;
          }
          #carruselMobile2{
            display:block;
          }
          #carruselWeb3{
            display:none;
          }
          #carruselMobile3{
            display:block;
          }

      #nav-web-1{
        display:none;
      }
      #nav-web-2{
        display:none;
      }
      #nav-web-3{
        display:none;
      }

      #nav-mob-1{
        display:block;
      }
      #nav-mob-2{
        display:block;
      }
      #nav-mob-3{
        display:block;
      }
    }
          
    .btn-icon .fab{
      color:white!important;
    }
      
    .carrito{
      font-family: 'Roboto', sans-serif;
    }

    .btn-primary{
      background-color: #E51C20 !important;
    }

    .card-img-top2 {
      width: 100%;
      height: 35vw;
      object-fit: cover;
    }
     
      
  </style> 
</head>

<body>

  
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary" style="background-color:#664D9C">
        <a class="navbar-brand" href="/">Shool Assistent</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarColor01" aria-controls="navbarColor01" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarColor01">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item active">
                    <a class="nav-link" href="/">Home
                    <span class="sr-only">(current)</span>
                    </a>
                </li>
                <li class="nav-item active">
                    <a class="nav-link" href="/">Login
                    <span class="sr-only">(current)</span>
                    </a>
                </li>
           
            </ul>
        </div>
    </nav>
  
  <!-- End Navbar -->
    @if(Session::has('mensaje'))
    <div class="alert {{ Session::get('alert-class') }} text-center" style="width:100%;margin-top:20px;margin-bottom:20px;">
        {{ Session::get('mensaje') }}
    </div>
        @endif
  <div id="app">
    <main class="py-4" >
        
        @yield('content')
    </main>
  </div>

  <!--Footer-->
  <!--Footer-->
  <footer class="footer " data-background-color="black" style="margin-top:-25px">
    <div class="container">
      <!--Mapas y contacto-->
      <div class="col-md-4">
        <div class="content">
            <div class="row">
            <!-- Acerca De Nosotros-->
            <div class="col-md-12">
                
                <ul class="links-vertical">
                  <li>
                      <a href="{{ url('/') }}#inicio" class="text-muted" style="color:white;">
                      Inicio
                      </a>
                  </li>
                </ul>
            </div>
            
            
            </div>
        </div>
      </div>
      <div class="col-md-4"></div>
      
      
    </div>
  </footer>


  <script src="../estilos/assets/js/core/jquery.min.js" type="text/javascript"></script>
  <script src="../estilos/assets/js/core/popper.min.js" type="text/javascript"></script>
  <script src="../estilos/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
  <!--  Plugin for Switches, full documentation here: http://www.jque.re/plugins/version3/bootstrap.switch/ -->
  <script src="../estilos/assets/js/plugins/bootstrap-switch.js"></script>
  <!--  Plugin for the Sliders, full documentation here: http://refreshless.com/nouislider/ -->
  <script src="../estilos/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>
  <!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
  <script src="../estilos/assets/js/plugins/moment.min.js"></script>
  <!--	Plugin for Tags, full documentation here: https://github.com/bootstrap-tagsinput/bootstrap-tagsinputs  -->
  <script src="../estilos/assets/js/plugins/bootstrap-tagsinput.js"></script>
  <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
  <script src="../estilos/assets/js/plugins/bootstrap-selectpicker.js" type="text/javascript"></script>
  <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
  <script src="../estilos/assets/js/plugins/bootstrap-datetimepicker.js" type="text/javascript"></script>
  <!--  Google Maps Plugin    -->
  <script src="https://maps.googleapis.com/maps/api/js?key=YOUR_KEY_HERE"></script>
  <!-- Control Center for Now Ui Kit: parallax effects, scripts for the example pages etc -->
  <script src="../estilos/assets/js/now-ui-kit.js?v=1.3.1" type="text/javascript"></script> 
  
  <script>
      function scrollToDownload() {

        if ($('.section-download').length != 0) {
          $("html, body").animate({
            scrollTop: $('.section-download').offset().top
          }, 1000);
        }
      }
    </script> 
    <script>
		$(window).scroll(function() {
		    $(".escondido").each(function(){
		      var pos = $(this).offset().top;

		      var winTop = $(window).scrollTop();
		        if (pos < winTop + 600) {
              $(this).removeClass("dis");
		          $(this).addClass("fadeInLeft");
              $(this).addClass("dis1")
		        }
		    });
		  });
	</script>

</body>

</html>
