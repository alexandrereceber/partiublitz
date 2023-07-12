<?php
/**
 * Criado: 26/04/2020
 * Modificado: 
 */
/**
 * Recebe todas as requisições referentes à banco de dados.
 * @Autor 04953988612
 */
if(@!include_once "../../Config/Configuracao.php"){ //Include que contém configurações padrões do sistema.
    $ResultRequest["Erros"]["Modo"]        = "Include";
    $ResultRequest["Erros"][0]             = true;
    $ResultRequest["Erros"][1]             = 3588;
    $ResultRequest["Erros"][2]             = "O arquivo de cabecalho não foi Cabeçaalho. Cabeçalho Geral";
    
    echo json_encode($ResultRequest);
    exit;
};

AmbienteCall::setCall(true);
AmbienteCall::setPageCall("Admin.php");
AmbienteCall::setTypeUser("Administrador");

if(@!include_once ConfigSystema::get_Path_Systema() .  "/Controller/SegurityPages/SecurityPgs.php"){ //Include que contém configurações padrões do sistema.
    $ResultRequest["Erros"]["Modo"]        = "Include";
    $ResultRequest["Erros"][0]             = true;
    $ResultRequest["Erros"][1]             = 3588;
    $ResultRequest["Erros"][2]             = "O arquivo de cabecalho não foi encontrado. Controller";
    
    echo json_encode($ResultRequest);
    exit;
};

echo "<script>var Chave='$sendChave'</script>"
?>
<!DOCTYPE html>
<html lang="en" style="height: auto;" class="">
    <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <title>Adminstrador | Dashboard</title>
      <!-- Logo da blitz -->
      <link rel="shortcut icon" href="/blitz/Imagens/Logo/Logo_blitz.png?3" type="image/jpg">

      <!-- Google Font: Source Sans Pro -->
      <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&amp;display=fallback">
      <!-- Font Awesome -->
      <link rel="stylesheet" href="/blitz/Recursos/plugins/fontawesome-free/css/all.min.css">
      <link rel="stylesheet" href="https://site-assets.fontawesome.com/releases/v6.4.0/css/all.css">
      <!-- Ionicons -->
      <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">


      <link rel="stylesheet" href="/blitz/Recursos/plugins/select2/css/select2.css?s=2">

      <link rel="stylesheet" href="/blitz/Recursos/dist/css/adminlte.min.css?s=4">



      <link rel="stylesheet" href="/blitz/CSS/Componentes/TabelaHTML.css?47">

      <!-- overlayScrollbars -->
      <link rel="stylesheet" href="/blitz/Recursos/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">

      <!<!-- UPLOADFILES -->
      <link rel="stylesheet" href="/blitz/uploadsFiles/css/uploadsCSS.css?04">
      
      
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
        import JSController from "/blitz/Componentes/jsController.js";
        window.JSController = JSController;
    </script>
    
    <script type="module">
        import Tabelas from "/blitz/Componentes/Tabelas.js?s=1";
        window.TabelaHTML = Tabelas;
    </script>     

    <script type="module">
        import Formularios from "/blitz/Componentes/Formularios.js?s=1";
        window.FormHTML = Formularios;
    </script>      
    
</head>
<body class="sidebar-mini layout-fixed" style="height: auto;">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button">
            <i class="fas fa-bars"></i>
        </a>
      </li>
      
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
      <li class="nav-item">
        <a class="nav-link" data-widget="fullscreen" href="#" role="button">
          <i class="fas fa-expand-arrows-alt"></i>
        </a>
      </li>
      <li class="nav-item">
        <a class="nav-link" data-widget="control-sidebar" data-controlsidebar-slide="true" href="#" role="button" >
          <i class="fas fa-th-large"></i>
        </a>
      </li>
      <li class="nav-item dropdown" id="__CONTROL_SIDERBAR">
        <a class="nav-link" data-toggle="dropdown" href="#" aria-expanded="false">
          <i class="far fa-user-circle" style="font-size: +17px"></i>
        </a>
        <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right" style="left: inherit; right: 0px;">
          <span class="dropdown-item dropdown-header">Perfil</span>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item" id="__EDITAT_PERFIL">
            <i class="far fa-edit"></i> Editar
            <span class="float-right text-muted text-sm">Alterar perfil</span>
          </a>
          <div class="dropdown-divider"></div>
          <a href="#" class="dropdown-item" id="__SAIR_PERFIL">
            <i class="fas fa-sign-out-alt"></i> Sair
            <span class="float-right text-muted text-sm">Sair do sistema</span>
          </a>
        </div>
      </li>   
    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
      <div class="Camada_cor">
    <!-- Brand Logo -->
    <div class="Administrar">
        <a href="#" class="brand-link" id="__LOGO">
            <div id="Logo_BLIZ">
                <img id="IMG_ADMIN" src="/blitz/Imagens/Logo/Logo_blitz_2.png?3" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
            </div>
            <div id="Logo_DESC"><span class="brand-text font-weight-light">Administrador</span></div>    
        </a>

    </div>

    <!-- Sidebar -->
    
        <div class="sidebar os-host os-theme-light os-host-resize-disabled os-host-scrollbar-horizontal-hidden os-host-scrollbar-vertical-hidden os-host-transition"><div class="os-resize-observer-host observed"><div class="os-resize-observer" style="left: 0px; right: auto;"></div></div><div class="os-size-auto-observer observed" style="height: calc(100% + 1px); float: left;"><div class="os-resize-observer"></div></div><div class="os-content-glue" style="margin: 0px -8px; width: 249px; height: 567px;"></div><div class="os-padding"><div class="os-viewport os-viewport-native-scrollbars-invisible"><div class="os-content" style="padding: 0px 8px; height: 100%; width: 100%;">
          <!-- Sidebar user panel (optional) -->
          <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="info">
              <a href="#" class="d-block"><?php echo $SystemUsuario; ?></a>
            </div>
          </div>

          <!-- Sidebar Menu -->
          <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
              <!-- Add icons to the links using the .nav-icon class
                   with font-awesome or any other icon font library -->

                <li class="nav-item">
                    <a href="#" class="nav-link">
                      <i class="nav-icon far fa-user"></i>
                      <p>
                        Membros
                        <i class="fas fa-angle-left right"></i>
                      </p>
                    </a>
                    <ul class="nav nav-treeview" style="display: none; margin-left: 20px">
                      <li class="nav-item" >
                        <a href="#" class="nav-link" id="__SIDEBAR_NAV_ITEM_MEMBROS_CADASTRO">
                          <i class="fas fa-user-plus"></i>
                          <p style="margin-left: 5px">
                                Cadastro
                          </p>
                        </a>
                      </li>
                      <li class="nav-item" >
                        <a href="#" class="nav-link" id="__SIDEBAR_NAV_ITEM_MEMBROS_PERFIL">
                          <i class="fas fa-user-edit"></i>
                          <p  style="margin-left: 5px">Perfil</p>
                        </a>
                      </li>
                      <!-- SubMENU -->
                        
                    </ul>
                  </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa-solid fa-party-horn"></i>
                    <p style="margin-left: 5px">
                       Festas 
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="display: none; margin-left: 20px">
                    <li class="nav-item" id="__SIDEBAR_SUBMENU_NAV_ITEM_FESTAS_VIEW">
                      <a href="#" class="nav-link">
                        <i class="fa-solid fa-eye"></i>
                        <p style="margin-left: 5px">Visualizar</p>
                      </a>
                    </li>
                    <li class="nav-item" id="__SIDEBAR_SUBMENU_NAV_ITEM_FESTAS_UPLOAD">
                      <a href="#" class="nav-link">
                        <i class="fa-solid fa-upload"></i>
                        <p  style="margin-left: 5px">Upload</p>
                      </a>
                    </li>
                  </ul>
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon far fa-calendar-plus"></i>
                    <p style="margin-left: 5px">
                       Eventos 
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="display: none; margin-left: 20px">
                    <li class="nav-item" id="__SIDEBAR_NAV_ITEM_EVENTOS_GERENCIAR">
                      <a href="#" class="nav-link">
                        <i class="fa-solid fa-rectangles-mixed"></i>
                        <p style="margin-left: 5px">Gerenciar</p>
                      </a>
                    </li>
                    <li class="nav-item" id="__SIDEBAR_NAV_ITEM_EVENTOS_LISTAS">
                      <a href="#" class="nav-link">
                        <i class="fa-solid fa-clipboard-list"></i>
                        <p style="margin-left: 5px">Listas</p>
                      </a>
                    </li>
                    <li class="nav-item" id="__SIDEBAR_SUBMENU_NAV_ITEM_EVENTOS_VIEW">
                      <a href="#" class="nav-link">
                        <i class="fa-solid fa-eye"></i>
                        <p  style="margin-left: 5px">Visualizar</p>
                      </a>
                    </li>
                    <li class="nav-item" id="__SIDEBAR_SUBMENU_NAV_ITEM_EVENTOS_IMG">
                      <a href="#" class="nav-link">
                        <i class="fa-solid fa-upload"></i>
                        <p  style="margin-left: 5px">Imagens</p>
                      </a>
                    </li>
                  </ul>
                </li>

                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa-light fa-cake-candles fa-list-dropdown"></i>
                    <p style="margin-left: 5px">
                       Aniversariantes 
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="display: none; margin-left: 20px">
                    <li class="nav-item" id="__SIDEBAR_SUBMENU_NAV_ITEM_ANIVERSARIOS_GLISTAS">
                      <a href="#" class="nav-link">
                        <i class="fa-solid fa-clipboard-list-check"></i>
                        <p style="margin-left: 5px">Gerenciar</p>
                      </a>
                    </li>
                    
                  </ul>
                  <ul class="nav nav-treeview" style="display: none; margin-left: 20px">
                    <li class="nav-item" id="__SIDEBAR_SUBMENU_NAV_ITEM_ANIVERSARIOS_MEMBROS">
                      <a href="#" class="nav-link">
                        <i class="fa-solid fa-people-group"></i>
                        <p style="margin-left: 5px">Semana</p>
                      </a>
                    </li>
                    
                  </ul>
                  <ul class="nav nav-treeview" style="display: none; margin-left: 20px">
                    <li class="nav-item" id="__SIDEBAR_SUBMENU_NAV_ITEM_ANIVERSARIOS_HOJE">
                      <a href="#" class="nav-link">
                        <i class="fa-duotone fa-balloons"></i>
                        <p style="margin-left: 5px">Hoje</p>
                      </a>
                    </li>
                    
                  </ul>
                  <ul class="nav nav-treeview" style="display: none; margin-left: 20px">
                    <li class="nav-item" id="__SIDEBAR_SUBMENU_NAV_ITEM_ANIVERSARIOS_EXEC_ROT">
                      <a href="#" class="nav-link">
                        <i class="fa-solid fa-gears"></i>
                        <p style="margin-left: 5px">Rotina</p>
                      </a>
                    </li>
                    
                  </ul>
                    
                </li>
                <li class="nav-item">
                  <a href="#" class="nav-link">
                    <i class="nav-icon fa-regular fa-list-dropdown"></i>
                    <p style="margin-left: 5px">
                       Listas 
                      <i class="fas fa-angle-left right"></i>
                    </p>
                  </a>
                  <ul class="nav nav-treeview" style="display: none; margin-left: 20px">
                    <li class="nav-item" id="__SIDEBAR_SUBMENU_NAV_ITEM_LISTAS_GERENCIAR">
                      <a href="#" class="nav-link">
                        <i class="fa-solid fa-rectangles-mixed"></i>
                        <p style="margin-left: 5px">Gerenciar</p>
                      </a>
                    </li>
                    <li class="nav-item" id="__SIDEBAR_SUBMENU_NAV_ITEM_LISTAS_TIPOEVENTO">
                      <a href="#" class="nav-link">
                        <i class="fa-brands fa-stack-overflow"></i>
                        <p style="margin-left: 5px">Tipos Eventos</p>
                      </a>
                    </li>
                    
                  </ul>
                </li>

            </ul>
          </nav>
          <!-- /.sidebar-menu -->
        </div></div></div><div class="os-scrollbar os-scrollbar-horizontal os-scrollbar-unusable"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="width: 100%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar os-scrollbar-vertical os-scrollbar-unusable"><div class="os-scrollbar-track"><div class="os-scrollbar-handle" style="height: 100%; transform: translate(0px, 0px);"></div></div></div><div class="os-scrollbar-corner"></div></div>    
    </div>
    
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper" style="min-height: 511px;" id="CONTENT_WRAPPER">
    <!-- Content Header (Page header) -->
    <div class="content-header" id="__CONTENT_WRAPPER_HEADER">
      <div class="container-fluid" idCONTENT_WRAPPER_HEADER="__CONTENT_WRAPPER_HEADER_FLUID">
        <div class="row mb-2">
          <div class="col-sm-12">
            <h1 class="m-0" id="__CONTENT_WRAPPER_HEADER_FLUID_TITULO">Dashboard</h1>
          </div><!-- /.col -->
          <!-- /.col -->
        </div><!-- /.row -->
      </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content" id="CONTENT_WRAPPER_MAIN_CONTENT">
      <div class="container-fluid" id="CONTENT_WRAPPER_MAIN_CONTAINER_FLUID" style="height: 100%">
        <!-- Small boxes (Stat box) -->
        <div class="row" id="__CONTENT_WRAPPER_MAIN_CONTAINER_FLUID_ROW" style="height: 100%">
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-info">
              <div class="inner">
                <h3>150</h3>

                <p>New Orders</p>
              </div>
              <div class="icon">
                <i class="ion ion-bag"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-success">
              <div class="inner">
                <h3>53<sup style="font-size: 20px">%</sup></h3>

                <p>Bounce Rate</p>
              </div>
              <div class="icon">
                <i class="ion ion-stats-bars"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-warning">
              <div class="inner">
                <h3>44</h3>

                <p>User Registrations</p>
              </div>
              <div class="icon">
                <i class="ion ion-person-add"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
          <div class="col-lg-3 col-6">
            <!-- small box -->
            <div class="small-box bg-danger">
              <div class="inner">
                <h3>65</h3>

                <p>Unique Visitors</p>
              </div>
              <div class="icon">
                <i class="ion ion-pie-graph"></i>
              </div>
              <a href="#" class="small-box-footer">More info <i class="fas fa-arrow-circle-right"></i></a>
            </div>
          </div>
          <!-- ./col -->
        </div>
        <!-- /.row -->

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer" id="CONTENT_WRAPPER_MAIN_FOOTER">
    <strong>Copyright © 2014-2023 <a href="#">Alexandre Marques</a>.</strong>
    Todos os direitos reservados.
    <div class="float-right d-none d-sm-inline-block">
      <b>Versão</b> 1.0.0
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark" style="top: 57px; height: 568px; display: none;">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
<div id="sidebar-overlay"></div></div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/blitz/Recursos/plugins/jquery/jquery.min.js"></script>


<!-- AdminLTE App -->

<script src="/blitz/Recursos/dist/js/adminlte.js?s=12"></script>


        
<script src="/blitz/Componentes/viewPopover.js?1"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
   
 
<script  src="/blitz/Login/Sair.js?q=9"></script>

<!-- Ações personalizadas para o administrador -->

<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script  src="/blitz/uploadsFiles/js/tratarFiles.js?56"></script> 

<script src="/blitz/Recursos/plugins/bs-custom-file-input/bs-custom-file-input.js"></script>

<script src="/blitz/Recursos/dist/js/admin/Admin.js?s=185"></script>

  

</body>
</html>