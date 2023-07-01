<?php
/**
 * Criado: 26/04/2020
 * Modificado: 
 */
/**
 * Recebe todas as requisições referentes à banco de dados.
 * @Autor 04953988612
 */
error_reporting(0);
if(@!include_once "../../Config/Configuracao.php"){ //Include que contém configurações padrões do sistema.
    $ResultRequest["Erros"]["Modo"]        = "Include";
    $ResultRequest["Erros"][0]             = true;
    $ResultRequest["Erros"][1]             = 3588;
    $ResultRequest["Erros"][2]             = "O arquivo de cabecalho não foi Cabeçaalho. Cabeçalho Geral";
    
    echo json_encode($ResultRequest);
    exit;
};

AmbienteCall::setCall(true);
AmbienteCall::setPageCall("Comum.php");
AmbienteCall::setTypeUser("Membros");

if(@!include_once ConfigSystema::get_Path_Systema() .  "/Controller/SegurityPages/SecurityPgs.php"){ //Include que contém configurações padrões do sistema.
    $ResultRequest["Erros"]["Modo"]        = "Include";
    $ResultRequest["Erros"][0]             = true;
    $ResultRequest["Erros"][1]             = 3588;
    $ResultRequest["Erros"][2]             = "O arquivo de cabecalho não foi encontrado. Controller";
    
    echo json_encode($ResultRequest);
    exit;
};

echo "<script>var Chave='$sendChave'</script>";

/**
 * Inclui o arquivo que contém as classes com o nome das tabelas do banco de dados AcessoBancoDados::get_BaseDados()
 */
if(!@include_once ConfigSystema::get_Path_Systema() . '/BancoDados/TabelasBD/'. AcessoBancoDados::get_BaseDados() .'.php'){
    $ResultRequest["Modo"]        = "Include";
    $ResultRequest["Error"]    = true;
    $ResultRequest["Codigo"]   = 12001;
    $ResultRequest["Mensagem"] = "A configuração do banco de dados não foi encontrado.";
    
    echo json_encode($ResultRequest); 
    exit;
}
$Nome = "user_profile";
$PERFIL = new $Nome();
$Filtro = [false, false, false];
$PERFIL->setFiltros($Filtro);
$PERFIL->setUsuario("blitz");
$PERFIL->setUsuarioLogado($SystemUsuario);
$PERFIL->setIDUsuario($IDUserName);
$PERFIL->setTipoUsuario($TipoUsuario);
$PERFIL->select();

$Preencheu_Campos = $PERFIL->getFuncoesGenericas();

?>

<!DOCTYPE html>
<html lang="en" style="height: auto;" class=""><head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Usuário | Dashboard</title>
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

  <link rel="stylesheet" href="/blitz/Recursos/dist/css/usuariolte.min.css?3">
  
  <link rel="stylesheet" href="/blitz/CSS/Componentes/TabelaHTML.css?47">
  
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="/blitz/Recursos/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  
  <!<!-- UPLOADFILES -->
  <link rel="stylesheet" href="/blitz/uploadsFiles/css/uploadsCSS.css?04"> 
  
</head>
<body class="sidebar-mini layout-fixed" style="height: auto;">
<?php if($Preencheu_Campos[0] === true){ ?>
    <div class="wrapper" style="height: fit-content;">

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
      <aside class="main-sidebar sidebar-user-primary-usuario elevation-4">
          <div class="Camada_cor">
        <!-- Brand Logo -->
        <div class="Administrar">
            <a href="#" class="brand-link" id="__LOGO">
                <div id="Logo_BLIZ">
                    <img id="IMG_ADMIN" src="/blitz/Imagens/Logo/Logo_blitz_2.png?3" alt="Usuário" class="brand-image img-circle elevation-3" style="opacity: .8">
                </div>
                <div id="Logo_DESC"><span class="brand-text font-weight-light">Usuário</span></div>    
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
                          <i class="fa-light fa-calendar-star"></i>
                          <p>
                            Eventos
                          </p>
                        </a>
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
            <?php if($Preencheu_Campos[1] === false){
                //Não existem eventos;
            }else{ ?>
                <div class="col-md-8" style="
                    display: flow-root;
                    margin: auto;
                ">
                    <!-- Widget: user widget style 1 -->
                    <div class="card card-widget widget-user">
                        <!-- Add the bg color to the header using any of the bg-* classes -->
                        <div class="widget-user-header text-white" style="background: url('<?php echo $Preencheu_Campos[1]["Capa"] ?>') center center; height: 420px">
                          <h3 class="widget-user-username text-right"><?php echo $Preencheu_Campos[1]["Nome"] ?></h3>
                        </div>
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                      <h5 class="description-header">3,200</h5>
                                      <span class="description-text">SALES</span>
                                    </div>
                                    <!-- /.description-block -->
                                </div>
                                <!-- /.col -->
                                <div class="col-sm-6 border-right">
                                    <div class="description-block">
                                      <h5 class="description-header">13,000</h5>
                                      <span class="description-text">FOLLOWERS</span>
                                    </div>
                                  <!-- /.description-block -->
                                </div>
                            </div>
                          <!-- /.row -->
                        </div>
                    </div>
                    <!-- /.widget-user -->
                </div>
             <?php } ?>
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        
        <!-- Main content -->
        <section class="content" id="CONTENT_WRAPPER_MAIN_CONTENT">
          <div class="container-fluid" id="CONTENT_WRAPPER_MAIN_CONTAINER_FLUID" style="height: 100%">
            <!-- Small boxes (Stat box) -->
            <div class="row" id="__CONTENT_WRAPPER_MAIN_CONTAINER_FLUID_ROW" style="height: 100%">

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
<?php } 

else{ ?>  
    
    <div class="wrapper" style="">  
        <div class="content-wrapper" style="min-height: 625px;margin-left: auto;" id="CONTENT_WRAPPER">
          <!-- Content Header (Page header) -->
          <div class="content-header" id="__CONTENT_WRAPPER_HEADER"style="
                background-color: #a600ff;
                text-align: center;
                color: white;
                box-shadow: 5px 4px 8px 5px #d5c9c9;
            ">
            <div class="container-fluid" idcontent_wrapper_header="__CONTENT_WRAPPER_HEADER_FLUID">
              <div class="row mb-2">
                <div class="col-sm-12">
                  <h1 class="m-0" id="__CONTENT_WRAPPER_HEADER_FLUID_TITULO">Favor preencher os campos obrigatórios!</h1>
                </div><!-- /.col -->
              </div><!-- /.row -->
            </div><!-- /.container-fluid -->
          </div>
          <!-- /.content-header -->

          <!-- Main content -->
          <section class="content" id="CONTENT_WRAPPER_MAIN_CONTENT" style="">
            <div class="container-fluid" id="CONTENT_WRAPPER_MAIN_CONTAINER_FLUID" style="height: 100%">
              <!-- Small boxes (Stat box) -->
              <div class="row" id="__CONTENT_WRAPPER_MAIN_CONTAINER_FLUID_ROW" style="height: fit-content;"></div>
              <!-- /.row -->
            </div><!-- /.container-fluid -->
          </section>
          <!-- /.content -->
        </div>



      </div>
    
<?php } ?>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="/blitz/Recursos/plugins/jquery/jquery.min.js"></script>


<!-- AdminLTE App -->

<script src="/blitz/Recursos/dist/js/adminlte.js?s=12"></script>


        
<script src="/blitz/Componentes/viewPopover.js?1"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
<script  src="/blitz/Scripts/jsControlador/jsConstroller.js?1"></script>     
<script  src="/blitz/Componentes/Tabelas.js?s=<?php echo time()?>"></script>  
<script  src="/blitz/Login/Sair.js?q=9"></script>

<!-- Ações personalizadas para o administrador -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

<script  src="/blitz/uploadsFiles/js/tratarFiles.js?56"></script> 

<script src="/blitz/Recursos/plugins/bs-custom-file-input/bs-custom-file-input.js" defer ></script>
<script  src="/blitz/Componentes/Formularios.js?q=92" defer="defer"></script> 

<?php if($Preencheu_Campos[0] === true){ ?>
<script src="/blitz/Recursos/dist/js/comum/Comum.js?s=1"></script>
<?php } else{ ?>  
<script src="/blitz/Recursos/dist/js/comum/Preencher.js?s=4" defer></script>
<?php } ?>

<!-- The Modal -->
  <div class="modal fade" id="myJanelas">
    <div class="modal-dialog">
      <div class="modal-content">
      
        <!-- Modal Header -->
        <div class="modal-header">
          <h4 class="modal-title">Título</h4>
          <button type="button" class="close" data-dismiss="modal">&times;</button>
        </div>
        
        <!-- Modal body -->
        <div class="modal-body">
          
        </div>
        <div class="modal-footer status-footer">
          
        </div>        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn  cancelar" data-dismiss="modal"></button><button type="button" class="btn  ok" data-dismiss="modal"></button>
        </div>
        
      </div>
    </div>
  </div>

</body>
</html>