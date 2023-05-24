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
    //TABELA_CADASTRO.CSSTableGeral.GeralDivClass_Botoes = "FIXA_BARRA_BOTOES_CELL";
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
        $(".SELECTD2_" + n.ResultSet.Indexador).select2({
                templateSelection: function (data) {
                  if (data.id === '') { // adjust for custom placeholder values
                    return 'Custom styled placeholder text';
                  }

                  return data.text;
                },
                matcher: function(params, data){
                    let g = params;
                    return data.text;
                },
                ajax: {
                    data: function (params) {
                        let o = this;
                          params.search= params.term || null;
                          params.type= 'public';
                          params.objecto= o;
                          params.Prox_pagina= params.page || 1;

                        // Query parameters will be ?search=[term]&type=public
                        return params;
                      },
                    transport: function (params, success, failure) {
                      
                        let BDados = new Promise(function(Resolve, Reject) {
                        // Busca os dados no banco de dados e utiliza das configurações da tabela .php para obter os dados de foreign
                            async function buscarDados() {
                                let rst = await n.getValor_CHV_FOREIGN(params);
                                if(rst === false){
                                    Reject();  // when error
                                }else{
                                    Resolve(rst); // when successful
                                }
                            }
                            //Chama a função async e libera o código.
                            buscarDados();

                        });

                        //Caso os dados ocorra sucesso na busca dos dados
                        BDados.then(
                                    function(value){
                                        success(value);
                                    },
                                    
                                    function(error){
                                        failure(error);
                                    }
                                );


                  },
                    processResults: function (data, params) {
                        
                        let Pagina_Atual = parseInt(data.InfoPaginacao.PaginaAtual);
                        let Total_Pagina = data.InfoPaginacao.TotaldePaginas;
                        let Mais_Pagina = false;
                        let result_objecto = {id:0,text:null};
                        let RST_DADOS = [];
                        
                        if(Total_Pagina <= Pagina_Atual){
                            Mais_Pagina = false;
                        }else{
                            Mais_Pagina = true;
                        }
                        for(let i of data.ResultDados){
                            let result_data = Object.create(result_objecto);
                            result_data.id = i[data.Dados_Campo_Foreign.CamposTblExtrangeira[0]];
                            result_data.text = i[data.Dados_Campo_Foreign.CamposTblExtrangeira[1]];;
                            RST_DADOS.push(result_data);
                            
                        }
                        let p = {"results": RST_DADOS,
                            "pagination": {
                              "more": Mais_Pagina
                            }};

                        
                        return p;
                      }
                }

              });
    });

    TABELA_PERFIL.show();
    
});

$("#__SIDEBAR_SUBMENU_NAV_ITEM_UPLOAD").click(function(e){
    $("#__CONTENT_WRAPPER_HEADER").hide();
    $("#__CONTENT_WRAPPER_MAIN_CONTAINER_FLUID_ROW").html('<div class="col-lg-12 col-12" id="T_CONTEUDO" style="height: 100%;overflow: auto;"></div>');
    //$("#T_CONTEUDO").load( Padrao.getHostServer() + "/blitz/uploadsFiles/Admin_Upload.php?s=1");
    
    var InstanciarUpload = new ReceberEnviar(Chave,"#T_CONTEUDO",2, Padrao.getHostServer() +"/blitz/ControladorTabelas/", "4812b51890682745102213bd785eb5c0", true, false);
})