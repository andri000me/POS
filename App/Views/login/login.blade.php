<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>AdminLTE 3 | Log in</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ baseUrl('assets/dist/plugins/fontawesome-free/css/all.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{ baseUrl('assets/dist/css/ionicons.min.css')}}">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="{{ baseUrl('assets/dist/plugins/icheck-bootstrap/icheck-bootstrap.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ baseUrl('assets/dist/css/adminlte.min.css')}}">
  <link rel="stylesheet" href="{{ baseUrl('assets/dist/css/styles.css')}}">
  <!-- Google Font: Source Sans Pro -->
  <link href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700" rel="stylesheet">
</head>
<body class="hold-transition login-page login-page-green">
<div class="login-box">
  <div class="login-logo">
    <a href="{{ baseUrl('index2.html')}} ">POS<b>System</b></a>
  </div>
  <!-- /.login-logo -->
  <div class="card">
    <div class="card-body login-card-body">
      <p class="login-box-msg">{{lang("Info.pleaselogin")}}</p>

        {!! formOpen("login/dologin") !!}
        <div class="input-group mb-3">
          {!! formInput(
              ["type" => "text",
              "class" => "form-control",
              "name" => "loginUsername",
              "placeholder"=>lang('Form.user'),
              "autocomplete"=>"off"
              ]
          )!!}
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-envelope"></span>
            </div>
          </div>
        </div>
        <div class="input-group mb-3">
          {!! formInput(
            ["type" => "password",
            "class" => "form-control",
            "name" => "loginPassword",
            "placeholder"=>lang('Form.password')]
        )!!}
          <div class="input-group-append">
            <div class="input-group-text">
              <span class="fas fa-lock"></span>
            </div>
          </div>
        </div>
        <div class="row">
          <div class="col-8">
            <div class="icheck-primary">
              <input type="checkbox" id="remember">
              <label for="remember">
                Remember Me
              </label>
            </div>
          </div>
        </div>
        <div class="row">
          
            <!-- /.col -->
            <div class="col-12">
              <button type="submit" class="btn btn-success btn-block">{{lang('Form.signin')}}</button>
            </div>
            <!-- /.col -->
          </div>
          {!! formClose() !!}

     
      <!-- /.social-auth-links -->

    </div>
    <!-- /.login-card-body -->
  </div>
</div>
<!-- /.login-box -->

<!-- jQuery -->
<script src="{{ baseUrl('assets/dist/plugins/jquery/jquery.min.js')}}"></script>
<!-- Bootstrap 4 -->
<script src="{{ baseUrl('assets/dist/plugins/bootstrap/js/bootstrap.bundle.min.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{ baseUrl('assets/dist/dist/js/adminlte.min.js')}}"></script>

</body>
</html>
