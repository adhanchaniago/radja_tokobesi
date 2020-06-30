<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>Login</title>
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 3.3.7 -->
  <link rel="stylesheet" href="/adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/adminlte/bower_components/font-awesome/css/font-awesome.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="/adminlte/bower_components/Ionicons/css/ionicons.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/adminlte/dist/css/AdminLTE.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="/adminlte/plugins/iCheck/square/blue.css">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  <style type="text/css">
  img {
   width: 250px;
   height: 120px;
 }
 small{
  font-size: 30px;
}
</style>
</head>

<body>
  <div class="login-box">
    <div class="login-logo">
      <div class="pull-center image">
        <img src="{{ asset('/images/logo_depan.png') }}" class="user-image" alt="User Image">
      </div><br>
      <small><i>The Large<br>Indonesian Iron Store</i></small>
    </div>
    <!-- /.login-logo -->
    <div style="margin-top: -25px;" class="login-box-body">
      <p class="login-box-msg">Masukkan Username (Owner & Admin)</p>

      <form action="{{route('login')}}" method="post">
        @csrf
        <div class="form-group has-feedback">
          <input type="email" class="form-control" name="email" placeholder="Email">
          <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>
        <div class="form-group has-feedback">
          <input type="password" class="form-control" name="password" placeholder="Password">
          <span class="glyphicon glyphicon-lock form-control-feedback"></span>
        </div>

        @if (Route::has('password.request'))
        <a class="btn btn-link" href="#">
          {{ __('Lupa Password?') }}
        </a>
        @endif

        <div class="row">
          <div class="col-xs-8">

          </div>
          <!-- /.col -->
          <div class="col-xs-4">
            <button type="submit" class="btn btn-primary btn-block btn-flat">Masuk</button>
          </div>
          <!-- /.col -->
        </div>
      </form>
      <!-- /.social-auth-links -->

      <div class="social-auth-links text-center">
      <!--   <p>- Atau -</p>
        <a href="{{ url('/auth/facebook') }}" class="btn btn-block btn-social btn-facebook btn-flat"><i class="fa fa-facebook"></i> Sign in using
        Facebook</a> -->
         <!--  <a href="{{ url('/auth/github') }}" class="btn btn-block btn-social btn-github btn-flat"><i class="fa fa-github"></i> Sign in using
         Github</a> -->
       </div>
     </div>
     <!-- /.login-box-body -->
   </div>

   <!-- jQuery 3 -->
   <script src="/adminlte/bower_components/jquery/dist/jquery.min.js"></script>
   <!-- Bootstrap 3.3.7 -->
   <script src="/adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
   <!-- SlimScroll -->
   <script src="/adminlte/bower_components/jquery-slimscroll/jquery.slimscroll.min.js"></script>
   <!-- FastClick -->
   <script src="/adminlte/bower_components/fastclick/lib/fastclick.js"></script>
   <!-- AdminLTE App -->
   <script src="/adminlte/dist/js/adminlte.min.js"></script>
   <!-- AdminLTE for demo purposes -->
   <script src="/adminlte/dist/js/demo.js"></script>
   <script>
    $(function () {
      $('input').iCheck({
        checkboxClass: 'icheckbox_square-blue',
        radioClass: 'iradio_square-blue',
        increaseArea: '20%' /* optional */
      });
    });
    if (window.location.hash && window.location.hash == '#_=_') {
      if (window.history && history.pushState) {
        window.history.pushState("", document.title, window.location.pathname);
      } else {
            // Prevent scrolling by storing the page's current scroll offset
            var scroll = {
              top: document.body.scrollTop,
              left: document.body.scrollLeft
            };
            window.location.hash = '';
            // Restore the scroll offset, should be flicker free
            document.body.scrollTop = scroll.top;
            document.body.scrollLeft = scroll.left;
          }
        }
      </script>
    </body>
    </html>

