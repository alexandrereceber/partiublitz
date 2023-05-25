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

let FORMULARIO_EVENTOS = null;

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
    $("#__CONTENT_WRAPPER_HEADER").show();
    $("#__CONTENT_WRAPPER_HEADER_FLUID_TITULO").html("Gerenciar Eventos");
    $("#__CONTENT_WRAPPER_MAIN_CONTAINER_FLUID_ROW").html(
        `<div class="card card-primary card-tabs" style="width:100%">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-criar-tab" data-toggle="pill" href="#custom-tabs-one-criar" role="tab" aria-controls="custom-tabs-one-criar" aria-selected="false">Criar evento</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-gerenciar-tab" data-toggle="pill" href="#custom-tabs-one-gerenciar" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Gerenciar</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade active show" id="custom-tabs-one-criar" role="tabpanel" aria-labelledby="custom-tabs-one-criar-tab">
                     Lorem ipsum dolor sit amet, consectetur adipiscing elit. Proin malesuada lacus ullamcorper dui molestie, sit amet congue quam finibus. Etiam ultricies nunc non magna feugiat commodo. Etiam odio magna, mollis auctor felis vitae, ullamcorper ornare ligula. Proin pellentesque tincidunt nisi, vitae ullamcorper felis aliquam id. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Proin id orci eu lectus blandit suscipit. Phasellus porta, ante et varius ornare, sem enim sollicitudin eros, at commodo leo est vitae lacus. Etiam ut porta sem. Proin porttitor porta nisl, id tempor risus rhoncus quis. In in quam a nibh cursus pulvinar non consequat neque. Mauris lacus elit, condimentum ac condimentum at, semper vitae lectus. Cras lacinia erat eget sapien porta consectetur.
                  </div>
                  <div class="tab-pane fade" id="custom-tabs-one-gerenciar" role="tabpanel" aria-labelledby="custom-tabs-one-gerenciar-tab">

                  </div>
                </div>
              </div>
            </div>`);
    
    if(FORMULARIO_EVENTOS === null){
        FORMULARIO_EVENTOS = new FormHTML(Padrao.getHostServer() +"/blitz/ControladorTabelas/");
    }    

    $("#custom-tabs-one-criar").html('<div class="col-lg-12 col-12" id="T_CONTEUDO_FORMULARIO" style="height: 100%;overflow: auto"></div>');

    FORMULARIO_EVENTOS.setTabela = "e1f550bec98a7e0f4a256579fbe333ee";
    FORMULARIO_EVENTOS.setRecipiente = "T_CONTEUDO_FORMULARIO";
    FORMULARIO_EVENTOS.setNome_BtSubmit = "Enviar";
    FORMULARIO_EVENTOS.Modo_Operacao = "I";
    let g = {
                Groups: false,
                N_Grupos: 2,
                Columns:  1,
                Titulos: ["Titulo 1 - Bloco1", "Titulo 2 - Bloco2","Titulo 3 - Bloco3"], //Cada índice representa o nome de cada grupo
                Rodapes: ["Rodape 1 - Bloco1", "Rodape 2 - Bloco2","Rodape 3 - Bloco3"], //Cada índice representa o rodapé de cada grupo
                Styles:  [
                            {Style_card_header:"", Style_card_body:"", Style_Rodape:""},
                            {Style_card_header:"", Style_card_body:"", Style_Rodape:""},
                            {Style_card_header:"", Style_card_body:"", Style_Rodape:""},
                        ]
            };
    FORMULARIO_EVENTOS.setGrupos = g;
    FORMULARIO_EVENTOS.show();

//    $("#custom-tabs-one-gerenciar").html('<div class="col-lg-12 col-12" id="T_CONTEUDO_TABELA" style="height: 100%;overflow: auto"></div>');
//    if(TABELA_EVENTOS === null){
//        TABELA_EVENTOS = new TabelaHTML(Padrao.getHostServer() +"/blitz/ControladorTabelas/");
//    }
//    TABELA_EVENTOS.setTabela = "e1f550bec98a7e0f4a256579fbe333ee";
//    TABELA_EVENTOS.setRecipiente = "T_CONTEUDO_TABELA";
//    TABELA_EVENTOS.Name = "TABELA_EVENTOS";
//
//    TABELA_EVENTOS.show();
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

    
    var InstanciarUpload = new ReceberEnviar(Chave,"#T_CONTEUDO",2, Padrao.getHostServer() +"/blitz/ControladorTabelas/", "4812b51890682745102213bd785eb5c0", true, false);
});
