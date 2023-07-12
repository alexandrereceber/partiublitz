<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Blitz | Login </title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="/blitz/Recursos/plugins/fontawesome-free/css/all.min.css">
  <!-- icheck bootstrap -->
  <link rel="stylesheet" href="/blitz/Recursos/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="/blitz/Recursos/dist/css/adminlte.min.css?s=1">
  <link rel="stylesheet" href="/blitz/Recursos/dist/css/adminlte_login.min.css">
    <!-- Logo da blitz -->
  <link rel="shortcut icon" href="/blitz/Imagens/Logo/Logo_Blitz.png?2" type="image/jpg">
  <link rel="manifest" href="/blitz/app.webmanifest.json">
  
  
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script type="module">
        import Padroes from "/blitz/Componentes/Padroes.js";
        //Padroes.addload();
        Padroes.addJanela();
        window.Toast = Padroes.addToast();
        window.Swal = Padroes.addswalWithBootstrapButtons();
        window.Padrao = Padroes;
    </script> 
    <script type="module">
        import JSController from "/blitz/Componentes/jsController.js?s=5";
        window.JSController = JSController;
    </script>
    
 
    
</head>
<body class="hold-transition login-page" style="display: block;background-image: url('/blitz/Imagens/Fundo/Show.avif'); background-size: 100%;background-repeat: no-repeat;background-attachment: fixed;background-size: 100% 100%;">
<div class="wrapper" style="position: absolute;width: 100%;margin: auto;display: flex;background-image: linear-gradient(#1000fffa, #b400ffa8); ">
    <div class="login-box" style=" margin: auto;">
        <!-- /.login-logo -->
        <div class="card card-outline card-primary">
          <div class="card-header text-center">
            <a href="#" class="h1"><b>Blizt</b></a>
          </div>
          <div class="card-body">
            <p class="login-box-msg">Insira seu nome de usuário e senha</p>

            <form onsubmit="EnviarDados(this)">
              <div class="input-group mb-3">
                <input  type="number" maxlength="11" pattern="[0-9]{3}\.?[0-9]{3}\.?[0-9]{3}\-?[0-9]{2}" class="form-control" placeholder="CPF">
                <div class="input-group-append">
                  <div class="input-group-text">
                    <span class="fas fa-hashtag"></span>
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

              <div class="row">
                <div class="col-8">

                </div>
                <!-- /.col -->
                <div class="col-4">
                  <button type="submit" class="btn btn-primary btn-block">Logar</button>
                </div>
                <!-- /.col -->
              </div>
            </form>
              <p class="mb-0">
                  <a href="/blitz/Registrar" class="text-center">Registrar novo usuário</a>
              </p>
          </div>
          <!-- /.card-body -->

        </div>
        <!-- /.card -->
</div>
</div>

<!-- /.login-box -->

<!-- jQuery -->
<script src="/blitz/Recursos/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap 4 -->
<script src="/blitz/Recursos/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- AdminLTE App -->
<script src="/blitz/Recursos/dist/js/adminlte.min.js"></script>

<script src="/blitz/Login/verificarLogin.js?<?php echo time();?>" defer></script>
    
</body>
</html>
