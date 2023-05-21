'strict mode';

const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 5000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer);
    toast.addEventListener('mouseleave', Swal.resumeTimer);
  }
})

const swalWithBootstrapButtons = Swal.mixin({
  customClass: {
    confirmButton: 'btn btn-success',
    cancelButton: 'btn btn-danger'
  },
  buttonsStyling: false
});

/* 
 * Implementação personalizada do módulo administrador.
 */

let TABELA_EVENTOS = null;
let TABELA_CADASTRO = null;
let TABELA_PERFIL = null;


$("#__INICIO, #__LOGO").click(function(){
    window.location.reload();
});

$("#__EDITAT_PERFIL").click(function(){
    
});

$("#__SAIR_PERFIL").click(function(){
    Efetuar_Logoff();
});

$("#sidebar-overlay").click(function(e){

    $('[data-widget="pushmenu"]').PushMenu('collapse');
    
});

$("#__CONTROL_SIDERBAR").click(function(e){
   let obj = e;
   let isVisible = $(e.currentTarget.children[1]).css("display");
   if(isVisible === "none"){
       $(e.currentTarget.children[1]).show("slow");
   }else{
       $(e.currentTarget.children[1]).hide("slow");
   }
});

$("#__SIDEBAR_NAV_ITEM_EVENTOS").click(function(e){
    $("#__CONTENT_WRAPPER_HEADER").hide();
    $("#__CONTENT_WRAPPER_MAIN_CONTAINER_FLUID_ROW").html('<div class="col-lg-3 col-12" id="T_CONTEUDO"></div>');
    
    TABELA_EVENTOS
});

$("#__SIDEBAR_NAV_ITEM_CADASTRO").click(function(e){
    $("#__CONTENT_WRAPPER_HEADER").hide();
    $("#__CONTENT_WRAPPER_MAIN_CONTAINER_FLUID_ROW").html('<div class="col-lg-12 col-12" id="T_CONTEUDO" style="height: 100%;overflow: auto"></div>');
    
    if(TABELA_CADASTRO === null){
        TABELA_CADASTRO = new TabelaHTML(Padrao.getHostServer() +"/blitz/ControladorTabelas/");
    }
    TABELA_CADASTRO.setTabela = "83849cf6295498c96deb555e00f4c756";
    TABELA_CADASTRO.setRecipiente = "T_CONTEUDO";
    TABELA_CADASTRO.Name = "TABELA_CADASTRO";
    
    TABELA_CADASTRO.Funcoes.Conteudo = function(a,n,c, linha){
        if(!a.isPhone){
            /**
             * Visualização para computador
             */
            switch (n) {
                case "4":
                    if(c == 1){
                        return '<i class="fa-solid fa-check"></i>';
                    }else{
                        return '<i class="fa-solid fa-xmark"></i>';
                    }
                    break;

                case "5":
                    if(c >= 6){
                        return '<i class="fa-regular fa-lock"></i>';
                    }else{
                        return '<i class="fa-regular fa-lock-open">';
                    }
                    break;  

                case "6":
                case "7":
                    let Data = new Date(c);
                    return Data.toLocaleDateString();
                    break;

                default:
                    return c;
                    break;
            }
        }else{
            /**
             * Visualização para celular
             */
            let NomeCampo = a.ResultSet.Campos[n][1];
            let Campo = null;
            switch (n) {
                case "1":
                    Campo = `<div style='display: flex'><div style='font-weight: bold; margin-right: 4px'>${NomeCampo}:</div> <div style=''>${c}</div> </div>`;
                    return Campo;
                    break;
                    
                case "2":
                    Campo = `<div style='display: flex'><div style='font-weight: bold; margin-right: 4px'>${NomeCampo}:</div> <div style=''>${c}</div> </div>`;
                    return Campo;
                break;
                
                case "3":
                    Campo = `<div style='display: flex'><div style='font-weight: bold; margin-right: 4px'>${NomeCampo}:</div> <div style=''>${c}</div> </div>`;
                    return Campo;
                break;
                    Campo = `<div style='display: flex'><div style='font-weight: bold; margin-right: 4px'>${NomeCampo}:</div> <div style=''>${c}</div> </div>`;
                    return Campo;
                case "4":

                    if(c == 1){
                        let Saida = '<i class="fa-solid fa-check"></i>';
                        Campo = `<div style='display: flex'><div style='font-weight: bold; margin-right: 4px'>${NomeCampo}:</div> <div style=''>${Saida}</div> </div>`;
                        return Campo;
                    }else{
                        let Saida = '<i class="fa-solid fa-xmark"></i>';
                        Campo = `<div style='display: flex'><div style='font-weight: bold; margin-right: 4px'>${NomeCampo}:</div> <div style=''>${Saida}</div> </div>`;
                        return Campo;
                    }
                    break;

                case "5":
                    if(c >= 6){
                        let Saida = '<i class="fa-regular fa-lock"></i>';
                        Campo = `<div style='display: flex'><div style='font-weight: bold; margin-right: 4px'>${NomeCampo}:</div> <div style=''>${Saida}</div> </div>`;
                        return Campo;
                    }else{
                        let Saida = '<i class="fa-regular fa-lock-open"></i>';
                        Campo = `<div style='display: flex'><div style='font-weight: bold; margin-right: 4px'>${NomeCampo}:</div> <div style=''>${Saida}</div> </div>`;
                        return Campo;
                    }
                    break;  

                case "6":
                case "7":
                    let Data = new Date(c);
                    let Saida = Data.toLocaleDateString();
                    Campo = `<div style='display: flex'><div style='font-weight: bold; margin-right: 4px'>${NomeCampo}:</div> <div style=''>${Saida}</div> </div>`;
                    return Campo;
                        
                    break;

                default:
                    return c;
                    break;
            }
        }
        
    };
    TABELA_CADASTRO.CSSTableGeral.GeralDivClass_Botoes = "FIXA_BARRA_BOTOES";
    TABELA_CADASTRO.show();
    
});

$("#__SIDEBAR_NAV_ITEM_PERFIL").click(function(e){
    $("#__CONTENT_WRAPPER_HEADER").hide();
    $("#__CONTENT_WRAPPER_MAIN_CONTAINER_FLUID_ROW").html('<div class="col-lg-12 col-12" id="T_CONTEUDO" style="height: 100%;overflow: auto"></div>');
    
    if(TABELA_PERFIL === null){
        TABELA_PERFIL = new TabelaHTML(Padrao.getHostServer() +"/blitz/ControladorTabelas/");
    }
    TABELA_PERFIL.setTabela = "7095e737a19ed11f0df0f07b7ec84131";
    TABELA_PERFIL.setRecipiente = "T_CONTEUDO";
    TABELA_PERFIL.Name = "TABELA_PERFIL";
    
    TABELA_PERFIL.Funcoes.Conteudo = function(a,n,c, linha){
        if(!a.isPhone){
            /**
             * Visualização para computador
             */
            switch (n) {

                default:
                    return c;
                    break;
            }
        }else{
            /**
             * Visualização para celular
             */
            let NomeCampo = a.ResultSet.Campos[n][1];
            let Campo = null;
            switch (n) {
                case "0":
                    Campo = `<div style='display: flex'><div style='font-weight: bold; margin-right: 4px'>${NomeCampo}:</div> <div style=''>${c}</div> </div>`;
                    return Campo;
                    break;
                    
                case "1":
                    Campo = `<div style='display: flex'><div style='font-weight: bold; margin-right: 4px'>${NomeCampo}:</div> <div style=''>${c}</div> </div>`;
                    return Campo;
                    break;
                    
                case "2":
                    Campo = `<div style='display: flex'><div style='font-weight: bold; margin-right: 4px'>${NomeCampo}:</div> <div style=''>${c}</div> </div>`;
                    return Campo;
                
                case "3":
                    Campo = `<div style='display: flex'><div style='font-weight: bold; margin-right: 4px'>${NomeCampo}:</div> <div style=''>${c}</div> </div>`;
                    return Campo;
                    
                case "4":
                    Campo = `<div style='display: flex'><div style='font-weight: bold; margin-right: 4px'>${NomeCampo}:</div> <div style=''>${c}</div> </div>`;
                    return Campo;
                    
                case "5":
                    Campo = `<div style='display: flex'><div style='font-weight: bold; margin-right: 4px'>${NomeCampo}:</div> <div style=''>${c}</div> </div>`;
                    return Campo;
                      

                case "6":
                    Campo = `<div style='display: flex'><div style='font-weight: bold; margin-right: 4px'>${NomeCampo}:</div> <div style=''>${c}</div> </div>`;
                    return Campo;
                    
                case "7":
                    Campo = `<div style='display: flex'><div style='font-weight: bold; margin-right: 4px'>${NomeCampo}:</div> <div style=''>${c}</div> </div>`;
                    return Campo;

                case "8":
                    Campo = `<div style='display: flex'><div style='font-weight: bold; margin-right: 4px'>${NomeCampo}:</div> <div style=''>${c}</div> </div>`;
                    return Campo;
                    
                case "9":
                    Campo = `<div style='display: flex'><div style='font-weight: bold; margin-right: 4px'>${NomeCampo}:</div> <div style=''>${c}</div> </div>`;
                    return Campo;                    
                default:
                    return c;
                    break;
            }
        }
        
    };
    TABELA_PERFIL.addFunctons_Eventos("UPDATE_BEFORE",async function(ACAO,MOMENTO,OBJETO,CAMPOS_DADOS){
        switch(ACAO){
            case "UPDATE":
                
                switch(MOMENTO){
                    case "BEFORE":
                        
                        break;
                }
                
                
                break;
        }
        return true;
     });

    TABELA_PERFIL.CSSTableGeral.GeralDivClass_Botoes = "FIXA_BARRA_BOTOES";
    
    TABELA_PERFIL.addFunctons_LOAD("ATUALIZAR","MUDARFOR_SELECT2",async function(n,p){
        let g = n;
    });

    TABELA_PERFIL.show();
    
});

$("#__SIDEBAR_SUBMENU_NAV_ITEM_UPLOAD").click(function(e){
    $("#__CONTENT_WRAPPER_HEADER").hide();
    $("#__CONTENT_WRAPPER_MAIN_CONTAINER_FLUID_ROW").html('<div class="col-lg-12 col-12" id="T_CONTEUDO" style="height: 100%;overflow: auto;"></div>');
    $("#T_CONTEUDO").load("http://192.168.15.10/blitz/uploadsFiles/Admin_Upload.php?s=1");
})