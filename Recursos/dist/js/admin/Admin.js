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
let TABELA_EVENTOS_IMGENS = null;
let TABELA_FESTA_EIMGENS = null;


let TABELA_CADASTRO = null;
let TABELA_PERFIL = null;

let FORMULARIO_EVENTOS = null;
let FORMULARIO_EVENTOS_IMG_BLITZ = null;

let FORMULARIO_LISTAS = null;
let TABELA_LISTAS = null;

let TABELA_LISTA_BENEFICIOS = null;
let TABELA_BENEFICIOS = null;
let TABELA_TIPOSEVENTOS = null;

let FORMULARIO_EVENTOS_LISTAS = null;
let TABELA_EVENTOS_LISTAS = null;
let TABELA_EL = {IDE:null, IDTL:null};

let TABELA_MEMBORS_DAS_LISTAS = null;

let TABELA_ANIVERSARIOS_MEMBROS = null;

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


$("#__SIDEBAR_NAV_ITEM_MEMBROS_CADASTRO").click(function(e){
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
    TABELA_CADASTRO.CSSTableGeral.GeralTableClass = "table";
    TABELA_CADASTRO.show();
    
});

$("#__SIDEBAR_NAV_ITEM_MEMBROS_PERFIL").click(function(e){
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

    TABELA_PERFIL.show();
    
});

$("#__SIDEBAR_SUBMENU_NAV_ITEM_FESTAS_VIEW").click(function(e){
    $("#__CONTENT_WRAPPER_HEADER").hide();
    $("#__CONTENT_WRAPPER_MAIN_CONTAINER_FLUID_ROW").html('<div class="col-lg-12 col-12" id="T_CONTEUDO" style="height: 100%;overflow: auto"></div>');
    
    if(TABELA_FESTA_EIMGENS === null){
        TABELA_FESTA_EIMGENS = new TabelaHTML(Padrao.getHostServer() +"/blitz/ControladorTabelas/");
    }
    TABELA_FESTA_EIMGENS.setTabela = "0cdfc60825ce8e9cb6e78f0cb28a3f61";
    TABELA_FESTA_EIMGENS.setRecipiente = "T_CONTEUDO";
    TABELA_FESTA_EIMGENS.Name = "TABELA_FESTA_EIMGENS";
    TABELA_FESTA_EIMGENS.Funcoes.Conteudo = function(a,n,c, linha){
        switch (n) {
        case "4":
            let Servidor = Padrao.getHostServer();
            return `<img src="${c}" style="width: 150px"/>`;
            break;
        default:
            return c;
            break;
    }
    }
    TABELA_FESTA_EIMGENS.addFunctons_LOAD("ATUALIZAR","MUDARFOR_SELECT2",async function(n,p){

        $(".SELECTD2_" + n.ResultSet.Indexador).select2({
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
    TABELA_FESTA_EIMGENS.show();

});

$("#__SIDEBAR_SUBMENU_NAV_ITEM_FESTAS_UPLOAD").click(function(e){
    $("#__CONTENT_WRAPPER_HEADER").hide();
    $("#__CONTENT_WRAPPER_MAIN_CONTAINER_FLUID_ROW").html('<div class="col-lg-12 col-12" id="T_CONTEUDO" style="height: 100%;overflow: auto;"></div>');

    

    if(FORMULARIO_EVENTOS_IMG_BLITZ === null){
        FORMULARIO_EVENTOS_IMG_BLITZ = new FormHTML(Padrao.getHostServer() +"/blitz/ControladorTabelas/");
    }    
    var InstanciarUpload = new ReceberEnviar(Chave,"#T_CONTEUDO",4, Padrao.getHostServer() +"/blitz/ControladorTabelas/", "4812b51890682745102213bd785eb5c0", true, false, "FORM", FORMULARIO_EVENTOS_IMG_BLITZ);
    
    FORMULARIO_EVENTOS_IMG_BLITZ.setTabela = "4812b51890682745102213bd785eb5c0";
    FORMULARIO_EVENTOS_IMG_BLITZ.setRecipiente = "CONTENT_FORM_IMAGENS";
    FORMULARIO_EVENTOS_IMG_BLITZ.setNome_BtSubmit = "Enviar";
    FORMULARIO_EVENTOS_IMG_BLITZ.Modo_Operacao = "V";
    FORMULARIO_EVENTOS_IMG_BLITZ.visible_Title = true;
    FORMULARIO_EVENTOS_IMG_BLITZ.Configuracoes.div_content_section.style = "margin-top: 10px"
    let g = {
                Groups: false
            };
    FORMULARIO_EVENTOS_IMG_BLITZ.setGrupos = g;
    FORMULARIO_EVENTOS_IMG_BLITZ.show();

});

$("#__SIDEBAR_NAV_ITEM_EVENTOS_GERENCIAR").click(async function(e){
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
    /**
     * O nome que será informado como parâmetro não altera em nada, pois o nome que será tratada vem da função chamadora.
     * Ex.:
     * let s = this.FUNCOES_ONLOAD.__Exec("UPDATE","BEFORE", this, Campos);
     * a = UPDATE
     * B = BEFORE
     * C = OBJETO DATASET
     * D = CAMPOS OU NULL
     * Ob.: O retorno true ou false é muito importante para a continuidade das funcionalidades.
     */
    FORMULARIO_EVENTOS.addFunctons_Eventos("FUNCAO_ALL",function(a,b,c,d){
        return true;
    });
    
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
    await FORMULARIO_EVENTOS.show();

    $("#custom-tabs-one-gerenciar").html('<div class="col-lg-12 col-12" id="T_CONTEUDO_TABELA" style="height: 100%;overflow: auto"></div>');
    if(TABELA_EVENTOS === null){
        TABELA_EVENTOS = new TabelaHTML(Padrao.getHostServer() +"/blitz/ControladorTabelas/");
    }
    TABELA_EVENTOS.setTabela = "e1f550bec98a7e0f4a256579fbe333ee";
    TABELA_EVENTOS.setRecipiente = "T_CONTEUDO_TABELA";
    TABELA_EVENTOS.Name = "TABELA_EVENTOS";
    TABELA_EVENTOS.setDefaultOrderBy(11,"DESC");
    TABELA_EVENTOS.FuncoesIcones[0] = function(a,b,c){
        debugger;
        let Linha = a.getObterLinhaInteira(a.getBreakChaves(b.dataset.chaveprimaria));
    };
    TABELA_EVENTOS.addFunctons_LOAD("ATUALIZAR","MUDARFOR_SELECT2",async function(n,p){

        $(".SELECTD2_" + n.ResultSet.Indexador).select2({
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
    

    await TABELA_EVENTOS.show();
});

$("#__SIDEBAR_SUBMENU_NAV_ITEM_EVENTOS_IMG").click(function(e){
    $("#__CONTENT_WRAPPER_HEADER").show();
    $("#__CONTENT_WRAPPER_HEADER_FLUID_TITULO").html("Imagem do evento");
    $("#__CONTENT_WRAPPER_MAIN_CONTAINER_FLUID_ROW").html('<div class="col-lg-12 col-12" id="T_CONTEUDO" style="height: 100%;overflow: auto"></div>');
    
    var InstanciarUpload = new ReceberEnviar(Chave,"#T_CONTEUDO",2, Padrao.getHostServer() +"/blitz/ControladorTabelas/", "abda7fb4369ce84c67c12e0e98e59e75", false, true);
    
    
});

$("#__SIDEBAR_SUBMENU_NAV_ITEM_EVENTOS_VIEW").click(function(e){
    $("#__CONTENT_WRAPPER_HEADER").hide();
    $("#__CONTENT_WRAPPER_MAIN_CONTAINER_FLUID_ROW").html('<div class="col-lg-12 col-12" id="T_CONTEUDO" style="height: 100%;overflow: auto"></div>');
    
    if(TABELA_EVENTOS_IMGENS === null){
        TABELA_EVENTOS_IMGENS = new TabelaHTML(Padrao.getHostServer() +"/blitz/ControladorTabelas/");
    }
    TABELA_EVENTOS_IMGENS.setTabela = "abda7fb4369ce84c67c12e0e98e59e75";
    TABELA_EVENTOS_IMGENS.setRecipiente = "T_CONTEUDO";
    TABELA_EVENTOS_IMGENS.Name = "TABELA_EVENTOS_IMGENS";
    TABELA_EVENTOS_IMGENS.Funcoes.Conteudo = function(a,n,c, linha){
        switch (n) {
        case "3":
            let Servidor = Padrao.getHostServer();
            return `<img src="${c}" style="width: 150px"/>`;
            break;
        default:
            return c;
            break;
    }
    }
    TABELA_EVENTOS_IMGENS.addFunctons_LOAD("ATUALIZAR","MUDARFOR_SELECT2",async function(n,p){

        $(".SELECTD2_" + n.ResultSet.Indexador).select2({
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
    TABELA_EVENTOS_IMGENS.show();

});

$("#__SIDEBAR_SUBMENU_NAV_ITEM_LISTAS_GERENCIAR").click(async function(e){
    $("#__CONTENT_WRAPPER_HEADER").show();
    $("#__CONTENT_WRAPPER_HEADER_FLUID_TITULO").html("Gerenciar Listas");
    $("#__CONTENT_WRAPPER_MAIN_CONTAINER_FLUID_ROW").html(
        `<div class="card card-primary card-tabs" style="width:100%">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-criar-tab" data-toggle="pill" href="#custom-tabs-one-criar" role="tab" aria-controls="custom-tabs-one-criar" aria-selected="false">Criar listas</a>
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
    
    if(FORMULARIO_LISTAS === null){
        FORMULARIO_LISTAS = new FormHTML(Padrao.getHostServer() +"/blitz/ControladorTabelas/");
    }    

    $("#custom-tabs-one-criar").html('<div class="col-lg-12 col-12" id="T_CONTEUDO_FORMULARIO" style="height: 100%;overflow: auto"></div>');

    FORMULARIO_LISTAS.setTabela = "624c6fd80de356ec39f31f3d36bdbfa4";
    FORMULARIO_LISTAS.setRecipiente = "T_CONTEUDO_FORMULARIO";
    FORMULARIO_LISTAS.setNome_BtSubmit = "Enviar";
    FORMULARIO_LISTAS.Modo_Operacao = "I";
    FORMULARIO_LISTAS.FUNCAO_GERARCAMPOS = function(i){
        return "<div>aqui</div>";
    };
    /**
     * O nome que será informado como parâmetro não altera em nada, pois o nome que será tratada vem da função chamadora.
     * Ex.:
     * let s = this.FUNCOES_ONLOAD.__Exec("UPDATE","BEFORE", this, Campos);
     * a = UPDATE
     * B = BEFORE
     * C = OBJETO DATASET
     * D = CAMPOS OU NULL
     * Ob.: O retorno true ou false é muito importante para a continuidade das funcionalidades.
     */
    FORMULARIO_LISTAS.addFunctons_Eventos("FUNCAO_ALL",function(a,b,c,d){
        return true;
    });
    
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
    FORMULARIO_LISTAS.setGrupos = g;
    await FORMULARIO_LISTAS.show();

    $("#custom-tabs-one-gerenciar").html('<div class="col-lg-12 col-12" id="T_CONTEUDO_TABELA" style="height: 100%;overflow: auto"></div>');
    
    if(TABELA_LISTAS === null){
        TABELA_LISTAS = new TabelaHTML(Padrao.getHostServer() +"/blitz/ControladorTabelas/");
    }
    TABELA_LISTAS.setTabela = "624c6fd80de356ec39f31f3d36bdbfa4";
    TABELA_LISTAS.setRecipiente = "T_CONTEUDO_TABELA";
    TABELA_LISTAS.Name = "TABELA_LISTAS";
    TABELA_LISTAS.setDefaultOrderBy(8,"DESC");
    
    TABELA_LISTAS.FuncoesIcones[0] = function(a,b,c){
        debugger;
        let Linha = a.getObterLinhaInteira(a.getBreakChaves(b.dataset.chaveprimaria));
    };
    TABELA_LISTAS.addFunctons_Eventos("SELECT_AFTER",async function(n,p,a){
        a.ResultSet.Botoes[0].Inserir = false;
        
    });
    TABELA_LISTAS.addFunctons_Eventos("UPDATE_BEFORE",async function(n,p,a,b){
       let Linha = a.getObterLinhaInteira(a.getBreakChaves(a.ChavesPrimarias[0]));
       let isNumeric = parseInt(b[2].value);
       if(Number.isNaN(isNumeric)){
           b[2].value = Linha[3];
       }
       
       return true;
    });
    
    
    TABELA_LISTAS.addFunctons_LOAD("ATUALIZAR","MUDARFOR_SELECT2",async function(n,p){

        $(".SELECTD2_" + n.ResultSet.Indexador).select2({
                maximumSelectionLength: 30,
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
    

    await TABELA_LISTAS.show();
});

$("#__SIDEBAR_SUBMENU_NAV_ITEM_LISTAS_TIPOEVENTO").click(function(e){
    $("#__CONTENT_WRAPPER_HEADER").hide();
    $("#__CONTENT_WRAPPER_MAIN_CONTAINER_FLUID_ROW").html('<div class="col-lg-12 col-12" id="T_CONTEUDO" style="height: 100%;overflow: auto"></div>');
    
    if(TABELA_TIPOSEVENTOS === null){
        TABELA_TIPOSEVENTOS = new TabelaHTML(Padrao.getHostServer() +"/blitz/ControladorTabelas/");
    }
    TABELA_TIPOSEVENTOS.setTabela = "153a59adeab5516e9a0ee9369a14b374";
    TABELA_TIPOSEVENTOS.setRecipiente = "T_CONTEUDO";
    TABELA_TIPOSEVENTOS.Name = "TABELA_TIPOSEVENTOS";
    
    TABELA_TIPOSEVENTOS.Funcoes.Conteudo = function(a,n,c, linha){
        if(!a.isPhone){
            /**
             * Visualização para computador
             */
            switch (n) {
                case "4":
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
                default:
                    return c;
                    break;
            }
        }
        
    };
    TABELA_TIPOSEVENTOS.CSSTableGeral.GeralTableClass = "table";
    TABELA_TIPOSEVENTOS.show();
    
});

$("#__SIDEBAR_NAV_ITEM_EVENTOS_LISTAS").click(async function(e){
    $("#__CONTENT_WRAPPER_HEADER").show();
    $("#__CONTENT_WRAPPER_HEADER_FLUID_TITULO").html("Gerenciar listas dos eventos");
    $("#__CONTENT_WRAPPER_MAIN_CONTAINER_FLUID_ROW").html(
        `<div class="card card-primary card-tabs" style="width:100%">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-criar-tab" data-toggle="pill" href="#custom-tabs-one-criar" role="tab" aria-controls="custom-tabs-one-criar" aria-selected="false">Escolha</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" id="custom-tabs-one-gerenciar-tab" data-toggle="pill" href="#custom-tabs-one-gerenciar" role="tab" aria-controls="custom-tabs-one-profile" aria-selected="false">Membros</a>
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
    
    if(FORMULARIO_EVENTOS_LISTAS === null){
        FORMULARIO_EVENTOS_LISTAS = new FormHTML(Padrao.getHostServer() +"/blitz/ControladorTabelas/");
    }    

    $("#custom-tabs-one-criar").html('<div class="col-lg-12 col-12" id="T_CONTEUDO_FORMULARIO" style="height: 100%;overflow: auto"></div>');

    FORMULARIO_EVENTOS_LISTAS.setTabela = "9021dbc259ddcc6f4caa3df638e0edd5";
    FORMULARIO_EVENTOS_LISTAS.setRecipiente = "T_CONTEUDO_FORMULARIO";
    FORMULARIO_EVENTOS_LISTAS.setNome_BtSubmit = "Enviar";
    FORMULARIO_EVENTOS_LISTAS.Modo_Operacao = "V";
    /**
     * O nome que será informado como parâmetro não altera em nada, pois o nome que será tratada vem da função chamadora.
     * Ex.:
     * let s = this.FUNCOES_ONLOAD.__Exec("UPDATE","BEFORE", this, Campos);
     * a = UPDATE
     * B = BEFORE
     * C = OBJETO DATASET
     * D = CAMPOS OU NULL
     * Ob.: O retorno true ou false é muito importante para a continuidade das funcionalidades.
     */
    FORMULARIO_EVENTOS_LISTAS.addFunctons_Eventos("FUNCAO_ALL",function(a,b,c,d){
        return true;
    });
    
    let g = {
                Groups: true,
                N_Grupos: 1,
                Columns:  0,
                Titulos: ["Selecione um evento", "Selecione um tipo de lista do evento selecionado"], //Cada índice representa o nome de cada grupo
                Rodapes: ["Serão exibidos, somente eventos que estejam ativos.", "Serão exibidos, somente listas que estejam ativas."], //Cada índice representa o rodapé de cada grupo
                Styles:  [
                            {Style_card_header:"", Style_card_body:"", Style_Rodape:""},
                            {Style_card_header:"", Style_card_body:"", Style_Rodape:""},
                            {Style_card_header:"", Style_card_body:"", Style_Rodape:""},
                        ]
            };
    FORMULARIO_EVENTOS_LISTAS.setGrupos = g;
    FORMULARIO_EVENTOS_LISTAS.visible_Title = true;
    
    
    FORMULARIO_EVENTOS_LISTAS.FUNCAO_EVENTS_SELECTED2 = function(e){
        let ix = this.ResultSet.Indexador;
        $("#INPUT_" + ix +"_PNome").removeAttr('readonly');
        
        
        if(e.currentTarget.dataset.Campo === "PEvento"){
            TABELA_EL.IDE = e.params.data.id;
            let SELECTD2 = $(".SELECTD2");
            for(let i of SELECTD2){
                let Name = i.name;
                if(Name === "PTipoEvento"){
                    $(i).prop("disabled", false);
                    break;
                }
                FORMULARIO_EVENTOS_LISTAS.Filter_Selected2[1] = [0,"=",e.params.data.id,1];
            }
            return true;
        }

        if(e.currentTarget.dataset.Campo === "PTipoEvento"){
            TABELA_EL.IDTL = e.params.data.id;
            
            //TABELA_MEMBORS_DAS_LISTAS
    
            if(TABELA_MEMBORS_DAS_LISTAS === null){
                TABELA_MEMBORS_DAS_LISTAS = new TabelaHTML(Padrao.getHostServer() +"/blitz/ControladorTabelas/");
            }
            TABELA_MEMBORS_DAS_LISTAS.setTabela = "d557c3d5f36eef6a65b4d323462486fc";
            TABELA_MEMBORS_DAS_LISTAS.setRecipiente = "T_CONTEUDO_TABELA";
            TABELA_MEMBORS_DAS_LISTAS.Name = "TABELA_MEMBORS_DAS_LISTAS";

            TABELA_MEMBORS_DAS_LISTAS.Funcoes.Conteudo = function(a,n,c, linha){
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
                        default:
                            return c;
                            break;
                    }
                }

            };
            TABELA_MEMBORS_DAS_LISTAS.CSSTableGeral.GeralTableClass = "table";
            TABELA_MEMBORS_DAS_LISTAS.addFunctons_Eventos("INSERIR_BEFORE",async function(n,p,a,c){
                let IDE = {name: null, value: null};
                IDE.name = "Pide";
                IDE.value = TABELA_EL.IDE;

                let IDTL = {name: null, value: null};
                IDTL.name = "Pidtl";
                IDTL.value = TABELA_EL.IDTL;

                c.unshift(IDTL);
                c.unshift(IDE);

                return true;

            });
            TABELA_MEMBORS_DAS_LISTAS.addFunctons_Eventos("INSERIR_ERROR",async function(n,p,a,c){
                if(c.Error){
                    let isDuplicate = c.Mensagem.indexOf("1062") === -1 ? false : true;
                    if(isDuplicate){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: "Esse convidado, já existe nesta lista!",
                            //footer: '<a href="">Why do I have this issue?</a>'
                        });

                        return true;
                    }
                    let isCadastro = c.Mensagem.indexOf("1452") === -1 ? false : true;
                    if(isCadastro){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: "Esse convidado não está cadastrado no sistema!",
                            //footer: '<a href="">Why do I have this issue?</a>'
                        });

                        return true;
                    }
                }else{

                }
            });
            TABELA_MEMBORS_DAS_LISTAS
            TABELA_MEMBORS_DAS_LISTAS.show();
        }
        
    };
    await FORMULARIO_EVENTOS_LISTAS.show();

    $("#custom-tabs-one-gerenciar").html('<div class="col-lg-12 col-12" id="T_CONTEUDO_TABELA" style="height: 100%;overflow: auto"></div>');
    
    
    
});

$("#__SIDEBAR_SUBMENU_NAV_ITEM_ANIVERSARIOS_MEMBROS").click(async function(e){
    $("#__CONTENT_WRAPPER_HEADER").show();
    $("#__CONTENT_WRAPPER_HEADER_FLUID_TITULO").html("Lista dos aniversariantes");
    $("#__CONTENT_WRAPPER_MAIN_CONTAINER_FLUID_ROW").html(
        `<div class="card card-primary card-tabs" style="width:100%">
              <div class="card-header p-0 pt-1">
                <ul class="nav nav-tabs" id="custom-tabs-one-tab" role="tablist">
                  <li class="nav-item">
                    <a class="nav-link active" id="custom-tabs-one-criar-tab" data-toggle="pill" href="#custom-tabs-one-criar" role="tab" aria-controls="custom-tabs-one-criar" aria-selected="false">Aniversariantes</a>
                  </li>
                </ul>
              </div>
              <div class="card-body">
                <div class="tab-content" id="custom-tabs-one-tabContent">
                  <div class="tab-pane fade active show" id="custom-tabs-one-criar" role="tabpanel" aria-labelledby="custom-tabs-one-criar-tab">
aa
                  </div>

                </div>
              </div>
            </div>`);
            //TABELA_MEMBORS_DAS_LISTAS
            
        $("#custom-tabs-one-criar").html('<div class="col-lg-12 col-12" id="T_CONTEUDO_TABELA" style="height: 100%;overflow: auto">ola</div>');

            if(TABELA_ANIVERSARIOS_MEMBROS === null){
                TABELA_ANIVERSARIOS_MEMBROS = new TabelaHTML(Padrao.getHostServer() +"/blitz/ControladorTabelas/");
            }
            TABELA_ANIVERSARIOS_MEMBROS.setTabela = "5c2f4f601f3ac102cc8f9cc0d0f52c08";
            TABELA_ANIVERSARIOS_MEMBROS.setRecipiente = "T_CONTEUDO_TABELA";
            TABELA_ANIVERSARIOS_MEMBROS.Name = "TABELA_ANIVERSARIOS_MEMBROS";

            TABELA_ANIVERSARIOS_MEMBROS.Funcoes.Conteudo = function(a,n,c, linha){
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
                        default:
                            return c;
                            break;
                    }
                }

            };
            TABELA_ANIVERSARIOS_MEMBROS.CSSTableGeral.GeralTableClass = "table";
            TABELA_ANIVERSARIOS_MEMBROS.addFunctons_Eventos("SELECT_ERROR",async function(n,p,a,c){
                return false;
            });
            TABELA_ANIVERSARIOS_MEMBROS.addFunctons_Eventos("INSERIR_BEFORE",async function(n,p,a,c){
                return false;
            });
            TABELA_ANIVERSARIOS_MEMBROS.addFunctons_Eventos("INSERIR_ERROR",async function(n,p,a,c){
                return false;
            });
            
           await TABELA_ANIVERSARIOS_MEMBROS.show();    
   
    
    
});