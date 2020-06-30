<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <link rel="apple-touch-icon" sizes="76x76" href="https://demos.creative-tim.com/marketplace/now-ui-kit-pro/assets/img/apple-icon.png">
  <link rel="icon" type="image/png" href="https://demos.creative-tim.com/marketplace/now-ui-kit-pro/assets/img/favicon.png">
  <meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1" />

  <title>Kasir Online</title>

  <meta content='width=device-width, initial-scale=1.0, maximum-scale=1.0, user-scalable=0, shrink-to-fit=no' name='viewport' />

  <!--     Fonts and icons     -->
  <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,200" rel="stylesheet" />
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" />

  <!-- CSS Files -->
  <link href="https://demos.creative-tim.com/marketplace/now-ui-kit-pro/assets/css/bootstrap.min.css" rel="stylesheet" />
  <link href="https://demos.creative-tim.com/marketplace/now-ui-kit-pro/assets/css/now-ui-kit.css?v=1.2.0" rel="stylesheet" />

  <!-- CSS Just for demo purpose, don't include it in your project -->
  <link href="https://demos.creative-tim.com/marketplace/now-ui-kit-pro/assets/css/demo.css" rel="stylesheet" />

  <!-- Canonical SEO -->
  <link rel="canonical" href="https://www.creative-tim.com/product/now-ui-kit-pro" />
  <!--  Social tags      -->
  <meta name="keywords" content="bootstrap 4, bootstrap 4 uit kit, bootstrap 4 kit, now ui, now ui kit pro, creative tim, html kit, html css template, web template, bootstrap, bootstrap 4, css3 template, frontend, responsive bootstrap template, bootstrap ui kit, responsive ui kit">
  <meta name="description" content="Start your development with a beautiful Bootstrap 4 UI kit.">
  <!-- Schema.org markup for Google+ -->
  <meta itemprop="name" content="Now UI Kit Pro by Creative Tim">
  <meta itemprop="description" content="Start your development with a beautiful Bootstrap 4 UI kit.">
  <meta itemprop="image" content="https://s3.amazonaws.com/creativetim_bucket/products/62/original/opt_nukp_thumbnail.jpg">
  <!-- Twitter Card data -->
  <meta name="twitter:card" content="product">
  <meta name="twitter:site" content="@creativetim">
  <meta name="twitter:title" content="Now UI Kit Pro by Creative Tim">
  <meta name="twitter:description" content="Start your development with a beautiful Bootstrap 4 UI kit.">
  <meta name="twitter:creator" content="@creativetim">
  <meta name="twitter:image" content="https://s3.amazonaws.com/creativetim_bucket/products/62/original/opt_nukp_thumbnail.jpg">
  <meta name="twitter:data1" content="Now UI Kit Pro by Creative Tim">
  <meta name="twitter:label1" content="Product Type">
  <meta name="twitter:data2" content="$69">
  <meta name="twitter:label2" content="Price">
  <!-- Open Graph data -->
  <meta property="fb:app_id" content="655968634437471">
  <meta property="og:title" content="Now UI Kit Pro by Creative Tim" />
  <meta property="og:type" content="article" />
  <meta property="og:url" content="https://demos.creative-tim.com/now-ui-kit-pro/presentation.html" />
  <meta property="og:image" content="https://s3.amazonaws.com/creativetim_bucket/products/62/original/opt_nukp_thumbnail.jpg" />
  <meta property="og:description" content="Start your development with a beautiful Bootstrap 4 UI kit." />
  <meta property="og:site_name" content="Creative Tim" />
</head>
<body class="login-page" >

  <!-- End Navbar -->
  <div class="page-header" filter-color="orange">
    <div class="page-header-image" style="background-image:url(https://rangkaraya.com/wp-content/uploads/2019/10/toko-besi-baja-cat-beton-plat-bahan-bangunan-distributor-stockist-staticslide1-2.jpg)"></div>
    <div class="content">
      <div class="container">
        <div class="col-md-5 ml-auto mr-auto">
          <div class="card card-login card-plain">
            <form class="form" action="{{route('login')}}" method="post">
              @csrf
              <div class="card-header text-center">
                <div class="logo">
                  <img src="{{asset('/images/logo_depan.png')}}" alt="">
                </div>
              </div><br><br>
              <h6>Silahkan Login</h6>
              <div class="card-body">
                <div class="input-group form-group-no-border input-lg">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="now-ui-icons users_circle-08"></i></span>
                  </div>
                  <input type="email"  name="email" class="form-control" placeholder="Masukkan Email...">
                </div>
                <div class="input-group form-group-no-border input-lg">
                  <div class="input-group-prepend">
                    <span class="input-group-text"><i class="now-ui-icons text_caps-small"></i></span>
                  </div>
                  <input type="password" name="password" class="form-control" placeholder="Masukkan Password...">
                </div>
              </div>
              <div class="card-footer text-center">
                <button type="submit" class="btn btn-primary btn-lg">Masuk</button>
                <a href="{{url('/register')}}" class="btn btn-red btn-lg ">Daftar</a>
                <!-- <a href="#pablo" class="btn btn-primary btn-round btn-lg btn-block">Get Started</a> -->
              </div>

            </form>
          </div>
        </div>
      </div>
    </div>

    <footer class="footer " >
      <div class="container">
        <div class="copyright">
          &copy; <script>document.write(new Date().getFullYear())</script>, Designed by <a href="https://www.invisionapp.com">Invision</a>. Coded by <a href="https://radjaadvertising.com/">Radja Digital Creative</a>.
        </div>
      </div>
    </footer>
  </div>
</body>

<!--   Core JS Files   -->
<script src="https://demos.creative-tim.com/marketplace/now-ui-kit-pro/assets/js/core/jquery.3.2.1.min.js" type="text/javascript"></script>
<script src="https://demos.creative-tim.com/marketplace/now-ui-kit-pro/assets/js/core/popper.min.js" type="text/javascript"></script>
<script src="https://demos.creative-tim.com/marketplace/now-ui-kit-pro/assets/js/core/bootstrap.min.js" type="text/javascript"></script>
<script src="https://demos.creative-tim.com/marketplace/now-ui-kit-pro/assets/js/plugins/moment.min.js"></script>
<script src="https://demos.creative-tim.com/marketplace/now-ui-kit-pro/assets/js/plugins/bootstrap-switch.js"></script>
<script src="https://demos.creative-tim.com/marketplace/now-ui-kit-pro/assets/js/plugins/bootstrap-tagsinput.js"></script>

<script src="https://demos.creative-tim.com/marketplace/now-ui-kit-pro/assets/js/plugins/bootstrap-selectpicker.js" type="text/javascript"></script>
<script src="https://demos.creative-tim.com/marketplace/now-ui-kit-pro/assets/js/plugins/jasny-bootstrap.min.js"></script>

<!--  Plugin for the Sliders, full documentation here: https://refreshless.com/nouislider/ -->
<script src="https://demos.creative-tim.com/marketplace/now-ui-kit-pro/assets/js/plugins/nouislider.min.js" type="text/javascript"></script>

<!--  Plugin for the DatePicker, full documentation here: https://github.com/uxsolutions/bootstrap-datepicker -->
<script src="https://demos.creative-tim.com/marketplace/now-ui-kit-pro/assets/js/plugins/bootstrap-datetimepicker.min.js" type="text/javascript"></script>
<script src="https://demos.creative-tim.com/marketplace/now-ui-kit-pro/assets/js/now-ui-kit.js?v=1.2.0" type="text/javascript"></script>

<script type="text/javascript">
  // Facebook Pixel Code Don't Delete
  !function(f,b,e,v,n,t,s){if(f.fbq)return;n=f.fbq=function(){n.callMethod?
    n.callMethod.apply(n,arguments):n.queue.push(arguments)};if(!f._fbq)f._fbq=n;
    n.push=n;n.loaded=!0;n.version='2.0';n.queue=[];t=b.createElement(e);t.async=!0;
    t.src=v;s=b.getElementsByTagName(e)[0];s.parentNode.insertBefore(t,s)}(window,
      document,'script','//connect.facebook.net/en_US/fbevents.js');

    try{
      fbq('init', '111649226022273');
      fbq('track', "PageView");

    }catch(err) {
      console.log('Facebook Track Error:', err);
    }
  </script>
  </html>

