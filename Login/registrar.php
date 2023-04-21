<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>AdminLTE 3 | Registration Page</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/blitz/Recursos/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/blitz/Recursos/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/blitz/Recursos/dist/css/adminlte.min.css?2">
</head>
<body class="hold-transition register-page"  style="background-image: url('/blitz/Imagens/Fundo/Show.avif'); background-size: 100%">
    <div class="wrapper" style="width: 100%;margin: auto;display: flex;background-image: linear-gradient(#1000fffa, #b400ffa8)">
        <div class="register-box"  style=" margin: auto;">
          <div class="register-logo">
            <a href="#"><b>Blizt</b></a>
          </div>

          <div class="card">
            <div class="card-body register-card-body">
              <p class="login-box-msg">Registrar um novo usuário</p>

              <form onsubmit="EnviarDados(this)">
                <div class="input-group mb-3">
                  <input type="email" class="form-control" placeholder="Email">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-envelope"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input type="password" class="form-control" placeholder="Password">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
                <div class="input-group mb-3">
                  <input type="password" class="form-control" placeholder="Repita o password">
                  <div class="input-group-append">
                    <div class="input-group-text">
                      <span class="fas fa-lock"></span>
                    </div>
                  </div>
                </div>
                <div class="row">
                  <div class="col-8">

                  </div>
                  <!-- /.col -->
                  <div class="col-4">
                    <button type="submit" class="btn btn-primary btn-block">Registrar</button>
                  </div>
                  <!-- /.col -->
                </div>
              </form>
              <a href="/blitz/Logar" class="text-center">Já possuo um usuário.</a>
            </div>
            <!-- /.form-box -->
          </div><!-- /.card -->
        </div>
        <!-- /.register-box -->        
    </div>

<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<!-- jQuery -->
<script src="/blitz/Recursos/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/blitz/Recursos/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/blitz/Recursos/dist/js/adminlte.min.js"></script>

        <script  src="/blitz/Scripts/bootbox/bootbox.js?5s" defer="defer"></script>
        <script src="/blitz/Scripts/jsControlador/jsConstroller.js?<?php echo time();?>" defer="defer"></script>     
        <script src="/blitz/Login/registrar.js?<?php echo time();?>" defer></script>
</body>
</html>
