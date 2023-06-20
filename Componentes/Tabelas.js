/**
 * Criado: 03/10/2018
 * Modificado: 
 * 
 * Arrays definidos CGeral[15] - Pesquisa gerada pelo campo localizar da tabela
 */
class TabelaHTML extends JSController{
    
    constructor(Caminho){
        
        super(Caminho);
        this.Recipiente = null; //Nome do recipiente que receberá o componente com os dados.
        this.NomeInstancia = null; //Nome do objeto instanciado na memória.
        this.ChavesPrimarias = []; //Array que armazena, de uma determinada instância, as chaves primárias de uma tabela HTML
        this.blitz = "bootstrap"; //Informa com qual blitz o componente mostrará os dados.
        this.DadosEnvio.sendPagina = 1;
        this.DadosEnvio.sendFiltros = [false, false, false];
        /**
         * Variável que armazena as funções anônimas das linhas, células e conteúdo.
         * Obs.: Conteudo é a variável que armazena a função anônima que é executada durante a apresentação da tabela HTML. Está
         * variável esta na função .getLinhas();
         */
        this.Funcoes = {
                            Linhas: false, 
                            Celulas: false, 
                            Conteudo: false,
                            Style: false,
                            ShowIcons: false,
                            Numerador: false,
                            Campo: false
                        };

        /*
         * Ao ser chamada, a função recebe esses paramentros.
         * InstanciaTabela.FuncoesIcones[v.Func](InstanciaTabela, this);
         */
        this.FuncoesIcones = []; //Armazena as funções, criadas manualmente, para a execução dos ícones da tabela HTML, a função recebe os parâmetros Instância da tabela e o próprio objeto 
        this.FuncoesChvExt = []; //Armazena as funções para as chaves extrangeiras. São identificadas pelo numero da função. Esse número vem do ModeloTabela.php que fica no campo.
        this.StatusGeral = [];   //Amazena informações gerais como por exemplo se ja foi buscado os dados no banco. É a variável de estado do objeto.

        //---------------DISPOSITIVO----------------
        var Instancia = this;
        
        let Dispositivo = window.matchMedia("(max-width: 700px)");
        this.__isPhone = Dispositivo.matches;
        Dispositivo.onchange = function(e){
            if(e.matches){
                Instancia.__isPhone = true;
                Instancia.CSSTableGeral.GeralThClass = "THCLASS_NONE_CELL";
                Instancia.CSSTableGeral.GeralTbodyClass = "TBODY_TABLE_CELL";
                Instancia.CSSTableGeral.GeralTrClass = "TR_TABLE_CELL";
                Instancia.CSSTableGeral.GeralTdClass = "TD_TABLE_CELL";
                Instancia.CSSTableGeral.GeralDivClass_Botoes = "FIXA_BARRA_BOTOES_CELL";
                
                Instancia.Refresh();
            }else{
                Instancia.__isPhone = false;
                Instancia.CSSTableGeral.GeralThClass = "THCLASS_VISIBLE_CELL";
                Instancia.CSSTableGeral.GeralTbodyClass = "TBODY_TABLE_PC";
                Instancia.CSSTableGeral.GeralTrClass = "TR_TABLE_PC";
                Instancia.CSSTableGeral.GeralTdClass = "TD_TABLE_PC";
                Instancia.CSSTableGeral.GeralDivClass_Botoes = "FIXA_BARRA_BOTOES_PC";
                
                Instancia.Refresh();
            }
        };
        
        //-----------Tabela Geral--------------------
        let GeralThClass = "",
            GeralTbodyClass = "",
            GeralTrClass = "",
            GeralTdClass = "";
            
        if(this.__isPhone){
            GeralThClass = "THCLASS_NONE_CELL";
            GeralTbodyClass = "TBODY_TABLE_CELL";
            GeralTrClass = "TR_TABLE_CELL";
            GeralTdClass = "TD_TABLE_CELL";
        }else{
            GeralThClass = "THCLASS_VISIBLE_PC";
            GeralTbodyClass = "TBODY_TABLE_PC";
            GeralTrClass = "TR_TABLE_PC";
            GeralTdClass = "TD_TABLE_PC";
        }
        this.CSSTableGeral = {
                                "GeralDivClass":"",
                                "GeralDivClass_Componente":"",
                                "GeralDivClass_Corpo":"",
                                "GeralDivClass_Botoes":"",
                                "GeralTableClass":"table",
                                "GeralTheadClass":"",
                                "GeralThClass":GeralThClass,
                                "GeralTbodyClass":GeralTbodyClass,
                                "GeralTrClass":GeralTrClass,
                                "GeralTdClass":GeralTdClass,
                                "GeralLiClass":"page-item",
                                "GeralAClass":"page-link",
                                "GeralUClass":"pagination",
                                "GeralButtonClass":"btn btn-primary",
                            };
                            
        this.CSSEspefTableBD = [
                                {"Cabecalho":{"thead":"","tr":"","th":"","td":""}},
                                {"Corpo":{"tbody":"","tr":"", "td":""}},
                                {"RodaPe":{}},
                            ];
        
        this.BTIEE = [
                        {"Inserir":{"Class":"btn btn-primary"}},
                        {"Editar":{"Class":"btn btn-primary"}},
                        {"Excluir":{"Class":"btn btn-danger"}}
                    ];       
                    
        this.visibleChavePrimaria = false,
        this.VisibleDetalhesUpdate = true;

        
        this.Configuracao = {
            Tabela: {
                Linha: {
                    Color: "",
                    Fonte: "",
                    Select_Color: false, /*Realiza a mudança de cor da linha ao selecionar um checked. Obs.: Utilize a classe Linha selecionada para realizar essa alteração sempre que a linha deva voltar à cor original.*/ 
                    Unselect_Color: false /*Realiza a mudança de cor da linha ao remover a checked*/
                },
                Celula: {
                    Color: "",
                    Fonte: ""
                }
            },
            
        };
       
        
        this.PageModel = {Inicial: 0, Final: 0};
        
        /**
         * 
         */
        this.FAnonimas = {
            Linha: function(){
                Instancia.Funcoes.Linhas(Instancia, this);
            }, 
            Celulas: function(){
                Instancia.Funcoes.Celulas(Instancia, this);
            }, 
            Conteudo: function(Index, VConteudo, Linha){
                return Instancia.Funcoes.Conteudo(Instancia, Index, VConteudo, Linha);
            },
            Style:function(Index, VConteudo, Linha){
                return Instancia.Funcoes.Style(Instancia, Index, VConteudo, Linha);

            }, 
            ShowIcons: function(Linha, Icone){
                return Instancia.Funcoes.ShowIcons(Instancia, Linha, Icone);
            }, 
            Numerador: function(Linha, Num){
                return Instancia.Funcoes.Conteudo(Instancia, Linha, Num);
            }, 
            GerarCampoForm: function(Campo){
                return  Instancia.Funcoes.Conteudo(Instancia, Campo);
            }
        };
        
        this.ADDSET_FUNCTION_ONLOAD = {
            "SHOW":[],
            "INSERIR":[],
            "ATUALIZAR":[],
            "EXCLUIR":[]
        };
        
         /**
         * Funções executadas após exibição dos dados em componentes.
         * Executa de forma async funções após a exibição do componente tabela ou das caixas de diálogo como inserir, atualizar, excluir
         * Select / Insert / Update
         * Tem um tratador de erro para esses funções, dentro de cada operação
         * 
         * Obs.: Não precisam de retorno.
         */
        this.FUNCOES_ONLOAD = function(){
            let FUNCs = new Map([
                //Funções são inseriridas no momento da instanciação do componente;
            ]);
            return {
                __Exec: async function(CONJUNTO,OBJECT_INSTANCIA_FORMULARIO,OTHER){  //Recebe um objeto {"Evento":..., ?}
                    let isArray = Array.isArray(CONJUNTO);
                    if(isArray){
                        for(let i of CONJUNTO){
                            let isFunc = FUNCs.has(i);
                            if(isFunc){
                                await FUNCs.get(i)(OBJECT_INSTANCIA_FORMULARIO,OTHER);
                            }
                        }
                    }else{
                        for(let i of FUNCs){
                           await i[1](OBJECT_INSTANCIA_FORMULARIO);
                        }
                    }
                    
                    
                },
                /**
                 * Adiciona um funções em um mapa que serão executadas de acordo com um array informado pela função addNomeSET.
                 * @param {type} Operacao - SHOW, INSERIR, ATUALIZAR ou EXCLUIR
                 * @param {type} Nome - Nome da função
                 * @param {type} Função - function(){} vinda do codigo da instancia.
                 * @returns {undefined}
                 */
                add: function(Operacao, Nome, Funcao, tabela){
                    FUNCs.set(Nome,Funcao);
                    if(Operacao === "SHOW"){
                        tabela.ADDSET_FUNCTION_ONLOAD.SHOW.push(Nome);
                        
                    }else if(Operacao === "INSERIR"){
                        tabela.ADDSET_FUNCTION_ONLOAD.INSERIR.push(Nome);
                        
                    }else if(Operacao === "ATUALIZAR"){
                        tabela.ADDSET_FUNCTION_ONLOAD.ATUALIZAR.push(Nome);
                        
                    }else if(Operacao === "EXCLUIR"){
                        tabela.ADDSET_FUNCTION_ONLOAD.EXCLUIR.push(Nome);
                        
                    }
                }
            };
        }();
        
        /**
         * FUNÇÕES QUE SERÃO EXECUTADAS APÓS A REALIZAÇÃO DAS OPERAÇÕES DE INSERIR, ATUALIZAR, EXCLUIR E SHOW
         * AS AÇÕES ENVIAM OS SEUS REPECTIVOS PARÂMETROS
         * ACTION
         * MOMENT
         * OBJECT_INSTACIA_FORMULARIO
         * VALUE
         */
        this.FUNCOES_EVENT = function(){
            let FUNCs = new Map([
                //Inserir as funcoes;
            ]);
            return {
                __Exec: async function(ACTION, MOMENT, OBJECT_INSTANCIA_FORMULARIO, VALUE){  //Recebe um objeto {"Evento":..., ?}
                    try{
                        let isExist = FUNCs.has(ACTION + "_"+ MOMENT);
                        if(isExist){
                            let fnc = FUNCs.get(ACTION + "_"+ MOMENT);
                            return await fnc(ACTION, MOMENT, OBJECT_INSTANCIA_FORMULARIO, VALUE);
                        }else{
                            return true;
                        }
                    }catch(e){
                        Swal.fire({
                            icon: 'error',
                            title: 'Oops...',
                            text: e,
                            //footer: '<a href="">Why do I have this issue?</a>'
                          });
                    }
                    
                     
                },
                add: function(n,f){
                    FUNCs.set(n,f);
                }
            };
        }();
        
    }
    addFunctons_Eventos(Nome,F){
        if(Nome !== null && Nome !== "" && Nome !== undefined && F !== undefined){
            this.FUNCOES_EVENT.add(Nome, F);
        }else{
            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "É necessário um nome e uma função, método: addFunctons_Eventos",
                    //footer: '<a href="">Why do I have this issue?</a>'
                  });
        }
        
    }
    showImagens(Titulo, Path_IMG){
        
        $("body").append(`
                            <div 
                                id="ekkoLightbox-135" 
                                class="ekko-lightbox modal fade in show" 
                                tabindex="-1" 
                                role="dialog" 
                                aria-modal="true" 
                                style="padding-right: 15px; display: block;">
                                    <div 
                                        class="modal-dialog" 
                                        role="document" 
                                        style="display: block; flex: 1 1 1px; max-width: 502px;">
                                            <div 
                                                class="modal-content">
                                                <div class="modal-header">
                                                    <h4 class="modal-title">sample 5 - black</h4>
                                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                        <span aria-hidden="true">×</span>
                                                    </button>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="ekko-lightbox-container" style="height: 468px;">
                                                        <div class="ekko-lightbox-item fade"></div>
                                                        <div class="ekko-lightbox-item fade in show">
                                                            <img src="${Path_IMG}" class="img-fluid" style="width: 100%;"></div>
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer hide" style="display: none;">&nbsp;</div>
                                                </div>
                                            </div>
                                        </div>
                                    <div class="modal-backdrop fade show">
                                </div>`);
        $(".modal-title").html(Titulo);
        $(".close").click(function(e){
            $(".ekko-lightbox").remove();
            $(".modal-backdrop").remove();
        });
        
        $(".ekko-lightbox").click(function(e){
            $(".ekko-lightbox").remove();
            $(".modal-backdrop").remove();
        });
        
    }
    
    addFunctons_LOAD(Operacao, Nome, Funcao){
        if(Operacao !== null && Operacao !== "" && Operacao !== undefined && Nome !== null && Nome !== "" && Nome !== undefined && Funcao !== null && Funcao !== "" && Funcao !== undefined){
            this.FUNCOES_ONLOAD.add(Operacao, Nome, Funcao, this);
        }else{
            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "É necessário uma operação, um nome e uma função, método: addFunctons_Eventos",
                    //footer: '<a href="">Why do I have this issue?</a>'
                  });
        }
        
    }
    
    get isPhone(){
        return this.__isPhone;
    }
   /**
    * Atribui um array contendo os filtros de pesquisa.
    * @type array Fts
    */
    set Filtros(Fts){
        this.DadosEnvio.sendFiltros[0] = (Fts);
    }
    /**
     * Nome da instância que armazenará as informações da tabela HTML
     * @type string
     */
    set Name(Nome){
       this.NomeInstancia = Nome;
    }
    /**
     * Nome do objeto HTML que receberá a tabela HTML
     * @type string
     */
    set setRecipiente(recp){
        this.Recipiente = recp;
    }
    
    set setTabela(T){
        this.DadosEnvio.sendTabelas = T;
    }
    set setProcedure(T){
        this.DadosEnvio.sendProcedure = T;
    }
    
    getValorChave(Linha){
        var CHValores = "", Count = 0, Total = 0;
        
        if(Array.isArray(Linha)){
            Total = this.ResultSet.ChavesPrimarias.length;
            
            for(var ind in Linha){
                if(Total == Count) break;
                
                for(var idx in this.ResultSet.ChavesPrimarias){
                    
                    if(ind == this.ResultSet.ChavesPrimarias[idx]){
                        CHValores += this.ResultSet.ChavesPrimarias[idx] + "@" + Linha[ind] + ";";
                        Count++;
                        break;
                    }
                    
                }
            }
        }
        return CHValores;
    }
    setColorirLinha(L, T){
        let Pai = L.parentNode.parentNode.classList, results = false;
        results = Pai.contains("LinhaSelecionada");
        if(results){
            $(L.parentNode.parentNode).removeClass("LinhaSelecionada");
            $(L.parentNode.parentNode).css("background",this.Configuracao.Tabela.Linha.Unselect_Color);
        }else{
            $(L.parentNode.parentNode).addClass("LinhaSelecionada");
            $(L.parentNode.parentNode).css("background",this.Configuracao.Tabela.Linha.Select_Color);

        }
    }
    
    setSelecionarLinhas(Linha){
        var 
            ChP = Linha.dataset.chaveprimaria,
            Find = this.ChavesPrimarias.indexOf(ChP);
    
        if(Find > -1){
            this.ChavesPrimarias.splice(Find,1);
            this.setColorirLinha(Linha, 0); // 1 - Colorir Linha
        }else{
            this.ChavesPrimarias.push(ChP);
            this.setColorirLinha(Linha, 1); // 1 - Remover cor Linha
        }
        if(this.ChavesPrimarias.length > 0){
            $("#ButtonEditar_" + this.ResultSet.Indexador).removeAttr("disabled");
            $("#ButtonExcluir_" + this.ResultSet.Indexador).removeAttr("disabled");
        }else{
            $("#ButtonEditar_" + this.ResultSet.Indexador).prop("disabled","true");
            $("#ButtonExcluir_" + this.ResultSet.Indexador).prop("disabled","true");
        }
    }
    getTipoConteudo(id2, Valor){
        var TipoCampo = this.ResultSet.Campos[id2][18][0];
        switch (TipoCampo) {
            case "text":
                return "<span>"+ Valor +"</span>";
                break;

            case "image":
                var x = this.ResultSet.Campos[id2][18].width, y = this.ResultSet.Campos[id2][18].height;
                x = x !== "" ? "width: "+ x : "";
                y = y !== "" ? "height: "+ y : "";
                
                return '<image style="'+ x +'; '+ y +'" src="">';
                break;
                
            case "Verify":
                var     caixa = "", v = "";
                    if(/sim|não/i.test(Valor)){
                        return '<input disabled type="checkbox" '+ (/sim/i.test(Valor) ? "checked" : "") +' >';
                    }else if(/certo|errado/i.test(Valor)){//
                        return '<i class="'+ (/certo/i.test(Valor) ? "fa fa-check" : "fa fa-remove") +'" style="font-size:19px"></i>';
                    }else{
                        return 'ErrorVerify';
                    }
                
                break;

            default:
                
                break;
        }
        
    }
    
    getLinhas(){
        
        var 
            LinhasHTML = "", 
                    TR = "", 
                    Html = "", 
                    indx1, 
                    indx2, 
                    Conteudo = "" ,
                    STYLE = "initial",
                    Valor = "", 
                    Check = "",
                    Numerador = "",
                    Edit = false, 
                    ChavePrimaria = "", 
                    eChave = false, 
                    DadosLinhas = null,
                    ShowIcons = "";
            
        DadosLinhas = this.ResultSet;
        
        if(DadosLinhas.Botoes["0"].Inserir || DadosLinhas.Botoes["1"].Editar || DadosLinhas.Botoes["2"].Delete){
           Edit = true;
        }
        
        for(var indx1 in DadosLinhas.ResultDados){
            /**
             * Busca os valores das chaves primárias, se existirem campos chave primária
             */
            ChavePrimaria = this.getValorChave(DadosLinhas.ResultDados[indx1]); 
            /**
             * Caso o usuário tenha permissão para editar a tabela será apresentada a caixa de seleção
             */
            if(Edit){
               Check = "<td  class='"+ this.CSSTableGeral.GeralTdClass + " " + this.CSSEspefTableBD[1].Corpo.td +"'  style='text-align: center; vertical-align: inherit;'><input style='cursor: pointer' type='checkbox'  value='' data-chavePrimaria='" + ChavePrimaria +"' onclick='" + this.NomeInstancia +".setSelecionarLinhas(this)'></td>";
            }
            
            if(DadosLinhas.ContadorLinha){
                var NLinha = parseInt(DadosLinhas.InfoPaginacao.Deslocamento) + parseInt(indx1) + 1;
                //uso para o componente que será visualizado em celular;
                if(this.Funcoes.Numerador != false){
                    NLinha = this.FAnonimas.Numerador(indx1, NLinha);
                }
                Numerador = "<td class='"+ this.CSSTableGeral.GeralTdClass + " " + this.CSSEspefTableBD[1].Corpo.td +"'  style='text-align: center;vertical-align: inherit;'>"+ NLinha +"</td>";
            }
            
            if(DadosLinhas.ShowColumnsIcones[0]){
                ShowIcons = this.gerarLinhasIcones(DadosLinhas.ShowColumnsIcones[1], ChavePrimaria);
                //Criar os ícone, via javascript, pela própria intância
                if(this.Funcoes.ShowIcons != false){
                    ShowIcons = this.FAnonimas.ShowIcons(indx1, ShowIcons);
                }
            }            
            for(indx2 in DadosLinhas.Campos){

                if(DadosLinhas.Campos[indx2][3][0] && !DadosLinhas.Campos[indx2][3][1]){ //chave primaria e se view
                    continue;
                }
                if(DadosLinhas.Campos[indx2][6] == false){ //chave primaria e se view
                    continue;
                } 
                
                Conteudo = DadosLinhas.ResultDados[indx1][DadosLinhas.Campos[indx2][0]];
                
                if(this.Funcoes.Conteudo != false){
                    Valor = this.FAnonimas.Conteudo(indx2, Conteudo, indx1);
                }else{
                    Valor = this.getTipoConteudo(indx2, Conteudo, indx1);
                }
                if(this.Funcoes.Style != false){
                    STYLE = this.FAnonimas.Style(indx2, Conteudo, indx1);
                }
                
                LinhasHTML += "<td class=' "+ this.CSSTableGeral.GeralTdClass+ " " + this.CSSEspefTableBD[1].Corpo.td +" td_"+ DadosLinhas.Indexador+"' style='" + STYLE + "' data-chavePrimaria='" + ChavePrimaria +"' data-Valor='" + Conteudo +"'>"+ Valor +"</td>";
            }

            TR += "<tr class=' "+ this.CSSTableGeral.GeralTrClass+ " " + this.CSSEspefTableBD[1].Corpo.tr  +" tr_"+ DadosLinhas.Indexador+"'>" + Check + Numerador + ShowIcons + LinhasHTML +"</tr>";

            
            LinhasHTML = "";
        }
        Html = TR === null ? "" : "<tbody  class='  "+ this.CSSTableGeral.GeralTbodyClass+ " " + this.CSSEspefTableBD[1].Corpo.tbody +" '>" + TR + "</tbody>" ;
        
        return Html;
    }
    
    setOrdemBy(o, BotaoChamador){
        var Campo = o.dataset.idn, OrBy = BotaoChamador.dataset.tipoordemby, Clss = this.ResultSet.OrdemBy;
        this.DadosEnvio.sendOrdemBY = [Campo, OrBy]
        this.show();
    }
    
    setDefaultOrderBy(Campo, Ordem){
        this.DadosEnvio.sendOrdemBY = [Campo, Ordem]
    }
    
    getCampoExistFiltro(F,V){
        var Filtros = F, Valor = [];
        for(var i in Filtros){
            if(Filtros[i][0] == V){
                Valor[0] = true;
                Valor[1] = i;
                Valor[2] = Filtros[i][2];
                return Valor;
            }
        }
        
        return Valor[0] = false;
    }
    /**
     * Atualiza os arrays já existentes ou não.
     * @param {type} obj
     * @returns {Boolean}
     */
    async setGerarFiltrosCampo(obj){
        if(event.keyCode == 13){
            var Valor = obj.value, getIndex = obj.dataset.idn, CGeral = this.DadosEnvio.sendFiltros[2], Exist = false, Count = 0;
            if(Valor == "") return false;

            
            if(CGeral != false){
                Exist = this.getCampoExistFiltro(CGeral, getIndex);
                if(Exist[0] == true){
                    Count = Exist[1];
                }else{
                    Count = CGeral.length;
                    CGeral.push([Count]);
                }
            }else{
                CGeral = [];
                CGeral.push([]);
            }
            CGeral[Count][0] = getIndex;
            CGeral[Count][1] = "like";
            CGeral[Count][2] = Valor;
            CGeral[Count][3] = 1;
                 
            
            this.DadosEnvio.sendFiltros[2] = CGeral;
            var Atualizar = await this.Atualizar();
            var Mostrar   = await this.show();
        }        
    }
    gerarPopover(p){
        
        var Cabecalho = p.dataset.idn, instancia = this;
        
        if(this.ResultSet.Campos[Cabecalho][20] == false && this.ResultSet.Campos[Cabecalho][15] == false) return false;
        
        let Title = (this.ResultSet.Campos[Cabecalho][20] == true && this.ResultSet.Campos[Cabecalho][15] == true) ? "Filtrar e classificar" : ((this.ResultSet.Campos[Cabecalho][20] == true) ? "Filtrar" : ((this.ResultSet.Campos[Cabecalho][15] == true) ? "Classificar" : ""));
        //p.dataset.animation = true;
        //p.dataset.placement = "left";
        //p.dataset.html = true;
        var ctp = (this.ResultSet.Campos[Cabecalho][20] == true ?
                                '<div class="form-group">'+
                                    '<div class="input-group mb-2">'+
                                        '<div class="input-group-prepend"><div class="input-group-text"><i class="fa fa-search"></i></div></div>'+
                                        '<input type="text" class="form-control" data-idn="'+ Cabecalho +'" id="'+ this.NomeInstancia + "_"+ this.ResultSet.Indexador + "_" + Cabecalho + '">'+
                                    '</div>': "")+
                                    (this.ResultSet.Campos[Cabecalho][15] == true ? '<div style=\"margin-top: 10px; text-align: center\"><button type=\"button\" data-tipoOrdemby=\"asc\" data-ordem=\"crescente\" class=\"btn btn-primary\">ASC <i class=\" fas fa-sort-amount-up\"></i></button> <button type=\"button\"  data-tipoOrdemby=\"desc\"  data-ordem=\"crescente\" class="btn btn-primary\">DESC <i class=\" fas fa-sort-amount-down\"></i></button></div>': "") +
                                '</div>';
        var Content = '<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-header"></h3><div class="popover-body"></div></div>';
                            
 
        var t = $(p).viewPopover({Conteudo: ctp, Titulo: Title, Clear: true})
        $("[data-ordem='crescente']").unbind();
        $("[data-ordem='crescente']").click(function(){
            instancia.setOrdemBy(p, this);
            $(p).popover('hide'); 
        })
        
        $("#" + this.NomeInstancia + "_"+ this.ResultSet.Indexador + "_" + Cabecalho).keyup(function(){
            instancia.setGerarFiltrosCampo(this);
            if(event.keyCode == 13){
                $(p).popover('hide');
            }
        });
    }
    gerarLinhasIcones(Icon, ChavePrimaria){
        
        if(Array.isArray(Icon)){
            var TdI = "", TipoIcone = "";
            for(var i in Icon){
                if(!Icon[i].Visible) continue;
                TipoIcone = Icon[i].Tipo;
                if(TipoIcone == "Font_Awesome"){
                    TdI += "<td  class='"+ this.CSSEspefTableBD[1].Corpo.td +"' style='text-align: center;vertical-align: inherit;'><i data-chavePrimaria='" + ChavePrimaria +"'  class='"+ Icon[i].Icone + " "+ Icon[i].NomeBotao + "_"+ this.ResultSet.Indexador + "' style='font-size:18px; cursor: pointer' title='"+ Icon[i].tooltip +"'></i></td>";
                }else if(TipoIcone == "image"){
                    
                }
            }
            return TdI;
        }
    }
    gerarCabecalhoIcones(ColumnsIcon){
        if(Array.isArray(ColumnsIcon)){
            var ThI = "";
            for(var i in ColumnsIcon){
                if(!ColumnsIcon[i].Visible) continue;
                ThI += "<th class='"+ this.CSSEspefTableBD[0].Cabecalho.th +"' style='text-align: center; vertical-align: inherit;'>"+ ColumnsIcon[i].NomeColuna +"</th>";
            }
            return ThI;
        }
    }
    
    getCabecalho(){
        var 
            indx = null, 
            CabHTML = "", 
            Html = null, 
            GetCabecalho = this.ResultSet, 
            FCampo = "", 
            FFilter = "",
            Ordered = "",
            Numerador = "",
            ShowColunasIcons = "";
        
        if(GetCabecalho.Botoes["0"].Inserir || GetCabecalho.Botoes["1"].Editar || GetCabecalho.Botoes["2"].Delete){
           var Auto = "<th  class='"+ this.CSSTableGeral.GeralThClass + " " + this.CSSEspefTableBD[0].Cabecalho.th +"'  style='text-align: center'>#</th>";
        }else{
            var Auto = "";
        }
        
        if(GetCabecalho.ContadorLinha){
            Numerador = "<th  class='"+ this.CSSTableGeral.GeralThClass +  " " + this.CSSEspefTableBD[0].Cabecalho.th +"'  style='text-align: center'>N°</th>";
        }
        
        if(GetCabecalho.ShowColumnsIcones[0]){
            ShowColunasIcons = this.gerarCabecalhoIcones(GetCabecalho.ShowColumnsIcones[1]);
        }
        
            /**
             * Exibe ou não as chaves primárias. Essa configuração fica configurada por declaração de campos da tabela via php
             * TabelaBD -> nome do banco de dados -> class
             */
            for(indx in GetCabecalho.Campos){
                if(GetCabecalho.Campos[indx][3][0] && !GetCabecalho.Campos[indx][3][1]){
                    continue;
                }
                /**
                 * Exibe ou não o campo atual. Essa configuração fica configurada por declaração de campos da tabela via php
                 * TabelaBD -> nome do banco de dados -> class
                 */
                if(GetCabecalho.Campos[indx][6] == false){
                    continue;
                }
                
                /**
                 * Verifica se foram utilizado filtros. Essa configuração fica configurada por declaração de campos da tabela via php
                 * TabelaBD -> nome do banco de dados -> class
                 */
                
                if(GetCabecalho.Filtros[2] != "false"){
                    if(Array.isArray(GetCabecalho.Filtros[2])){
                        var exist = this.getCampoExistFiltro(GetCabecalho.Filtros[2], GetCabecalho.Campos[indx][0])
                        if(exist[1]){
                            if(exist[2] != "%"){
                                FFilter = ' <i id="FiltroCampo" data-toggle="tooltip" title="Filtro: '+ exist[2] +'" class="fa fa-filter" style="font-size:14px; color: red; cursor: pointer"></i>';
                            }
                            else{
                                FFilter = '';
                            }
                            exist = false;
                        }else{
                            FFilter = "";
                        }
                    }
                }
                if(GetCabecalho.OrdemBy[0] == GetCabecalho.Campos[indx][0]){
                    
                    if(GetCabecalho.OrdemBy[1] == "asc"){
                        Ordered = ' <i id="Ordered" data-toggle="tooltip" title="Crescente" class="fas fa-sort-amount-up" style="font-size:14px; color: red; cursor: pointer"></i>';
                    }else {
                        Ordered = ' <i id="Ordered" data-toggle="tooltip" title="Decrescente" class=" fas fa-sort-amount-down" style="font-size:14px; color: red; cursor: pointer"></i>';
                    }
                }else{
                    Ordered = '';
                }
                FCampo = "<a href='#' onclick='"+ this.NomeInstancia +".gerarPopover(this)' data-OrdemBy='"+ GetCabecalho.OrdemBy[1] +"'  data-idn='"+ GetCabecalho.Campos[indx][0] +"' <span>"+ GetCabecalho.Campos[indx][1] + "</span></a>";

                CabHTML += "<th  class='"+ this.CSSTableGeral.GeralThClass + " " + this.CSSEspefTableBD[0].Cabecalho.th +"'  style='text-align: center'>"+ FCampo + FFilter + Ordered + "</th>";
            
        }

        Html = CabHTML === null ? "" : "<thead  class='  "+ this.CSSTableGeral.GeralTheadClass +  " " + this.CSSEspefTableBD[0].Cabecalho.thead +" '><tr  class='"+ this.CSSEspefTableBD[0].Cabecalho.tr +"'>" + Auto + Numerador + ShowColunasIcons + CabHTML + "</tr></thead>" ;
        
        return Html;
    }
    
    getBotoes(){
        var Bt = "", GetBotoes = this.ResultSet;
        if(GetBotoes.Botoes["0"].Inserir){
            Bt += "<td><center><button id='ButtonInserir_"+ GetBotoes.Indexador + "' class='"+ this.BTIEE[0].Inserir.Class +"'  onclick='"+ this.NomeInstancia + ".showFormularioInserir()'>Inserir</button></center></td>";
        }
        if(GetBotoes.Botoes["1"].Editar){
            Bt += "<td><center><button id='ButtonEditar_"+ GetBotoes.Indexador + "' class='"+ this.BTIEE[1].Editar.Class +"' onclick='"+ this.NomeInstancia + ".showFormularioAtualizar()' disabled='true'>Editar</button></center></td>";
        }
        if(GetBotoes.Botoes["2"].Delete){
            Bt += "<td><center><button id='ButtonExcluir_"+ GetBotoes.Indexador + "' class='"+ this.BTIEE[2].Excluir.Class +"' onclick='"+ this.NomeInstancia + ".JanelaExcluirDados()' disabled='true'>Excluir</button></center></td>";
        }
        
        Bt = "<table class='"+ this.CSSTableGeral.GeralTableClass +"' ><tr class='' >"+ Bt +"</tr></table>";
        
        return Bt;
    }
    /**
     * 
     * @param {type} obj
     * @returns {Boolean}
     */
    async setGerarFiltroBusca(obj){
        this.DadosEnvio.sendFiltros[1] = false
        if(event.keyCode == 13 || event.type == "click"){
            var Valor = obj.value, getResultado = this.ResultSet.Campos, CGeral = [], Count = 0;
            if(Valor == "") return false;

            for(var i in getResultado){
                //var t = this.getCampoExistFiltro(CGeral, i);
                CGeral.push([i]);
                CGeral[i][0] = getResultado[i][0];
                CGeral[i][1] = "like";
                CGeral[i][2] = Valor;
                CGeral[i][3] = 2;
                 
            }
            
            this.DadosEnvio.sendFiltros[1] = CGeral;
            var Atualizar = await this.Atualizar();
            var Mostrar   = await this.show();
            //this.DadosEnvio.sendFiltros[1] = []
        }
    }
    
    async setRemoverFiltros(L){
        this.DadosEnvio.sendFiltros[L] = false;
        await this.Atualizar();
        await this.show();
    }
    
    getInfoPaginacao(){
        var InfPag      = this.ResultSet.InfoPaginacao, 
            Tabela      = "", 
            FindAll     = "",
            TH          = null,
            Refresh     = "";
    
        if(InfPag.ModoPaginacao.Simples){
            TH = "<tr ><th colspan=20>"+ InfPag.TotalLinhas + " Registro(s) - "+ InfPag.TotaldePaginas + " Página(s)</th></tr>";
        }else{
            var Inicio = 1, Fim = 0;
            Inicio = InfPag.Deslocamento + 1;
            Fim = InfPag.Deslocamento + this.ResultSet.ResultDados.length
            
            TH = "<tr><th colspan=20>Página atual: <i class='fa fa-file'></i> "+ InfPag.PaginaAtual +"/"+ InfPag.TotaldePaginas  +"  <br>Registro: "+ Inicio +" até "+ Fim +"</th></tr><tr><th colspan=20>"+ InfPag.TotalLinhas + " Total registro(s) - "+ InfPag.TotaldePaginas + " Página(s)</th></tr>";
        }

        if(InfPag.ModoPaginacao.BRefresh){
            Refresh ='<td style="vertical-align: middle !important;margin: auto" id="TR_BREFRESH"><div style="text-align: center;" id="BREFRESH"><button type="button" class="btn btn-primary" onclick="'+ this.NomeInstancia +'.Refresh()"><i class="fa-duotone fa-arrows-rotate"></i></button></div></td>';
        }
        
        /**
         * Verifica se a tabelaHTML irá exibir a caixa de salto de página
         */
        if(InfPag.ModoPaginacao.Filtros){
            var getFilter = this.ResultSet.Filtros[1], BFlt = ""
            if(getFilter != "false"){
                BFlt = '<button \n\
                                                id="FiltroPequisa" \n\
                                                type="button" \n\
                                                class="btn btn-danger" \n\
                                                data-toggle="tooltip" \n\
                                                data-placement="top" \n\
                                                title="Remove filtro de pesquisa" \n\
                                                onclick="'+ this.NomeInstancia +'.setRemoverFiltros(1)">\n\
                                                    <i \n\
                                                        class="fa fa-filter" \n\
                                                        style="font-size:18px">\n\
                                                    </i>\n\
                                            </button><script>$("#FiltroPequisa").tooltip()</script>'
            }
            if(this.blitz == "bootstrap"){
                FindAll =   "\n\
                                <td>"+
                                    "<form onsubmit='event.preventDefault()' style='display:  inline-flex;width: 100%; margin: 0px'><div class='input-group'>" +
                                        '<div class="input-group-prepend">' +
                                            '<span class="input-group-text">Filtro:</span>' +
                                        '</div>' +
                                        '<input id="INPUT_'+ this.ResultSet.Indexador +'" onkeyup="'+ this.NomeInstancia +'.setGerarFiltroBusca(this)" type="text" class="form-control" placeholder="" name="Filter">' +
                                        '</div> \n\
                                        <div style="margin-left: 2px;width: 141pxmargin-left: 2px;width: 141px;padding-top: 3px">\n\
                                            <button \n\
                                                type="button" \n\
                                                class="btn btn-primary" \n\
                                                onclick="'+ this.NomeInstancia +'.setGerarFiltroBusca(INPUT_'+ this.ResultSet.Indexador +')">\n\
                                                    <i \n\
                                                        class="fa fa-search" \n\
                                                        style="font-size:18px">\n\
                                                    </i>\n\
                                            </button> '+
                                            BFlt +
                                        "</div>" +
                                    "</form>";
            }if(this.blitz == "getmdl.io"){
                
            }

            
        }
        Tabela = "<table class='table' style='margin-bottom:0px'>\n\
                                    <tr>\n\
                                        "+ (InfPag.TituloTabela == false ? "" : "<th colspan='4' style='text-align: center'>"+ InfPag.TituloTabela) +"</th>\n\
                                    </tr>"+ TH + "<tr>"+ FindAll + Refresh +"</tr>"+
                                "</table>";        
        
        return Tabela;
    }
    
    setSaltoPagina(obj){
        if(event.keyCode == 13){
            var Valor = obj.value;
            if(Valor >=1 && Valor <= this.ResultSet.InfoPaginacao.TotaldePaginas)
            this.setIrPagina(Valor);
            
        }
    }
    
    getPaginacao(){
        var CabHTML = "",
        GetResultado    = this.ResultSet,
        Indexador       = GetResultado.Indexador,
        PgAtual         = GetResultado.InfoPaginacao.PaginaAtual,
        PgTotalVisible  = GetResultado.InfoPaginacao.TotalPaginaVisivel,
        PaginacaoTotal = GetResultado.InfoPaginacao.TotaldePaginas,
        Active          = "",
        PBotao        = "",
        UBotao          = "",
        NextPagina      = "",
        RetroPagina     = "",
        FuncNext        = "",
        FuncUltima      = "",
        FuncRetro       = "",
        FuncPrimeira    = "",
        PrimeiraPagina  = "",
        UltimaPagina    = "",
        SaltoPagina     = "";
        
        if(GetResultado.ResultDados.length == 0) return "";
        if((PaginacaoTotal == 1)| (PaginacaoTotal == 0)) return "";
        
        if(PgAtual == 1){
            this.PageModel.Inicial = 1;
            this.PageModel.Final   = PgTotalVisible < PaginacaoTotal ? PgTotalVisible : PaginacaoTotal;
            
        }else if(PgAtual > 1 && PgAtual > this.PageModel.Final && PgAtual <= PaginacaoTotal){
            this.PageModel.Inicial = parseInt(PgAtual);
            this.PageModel.Final = (parseInt(PgAtual) + parseInt(PgTotalVisible)) > PaginacaoTotal ? PaginacaoTotal : (parseInt(PgAtual) + parseInt(PgTotalVisible));
            
        }else if(PgAtual > 1 && PgAtual < this.PageModel.Inicial && PgAtual > 1){
            this.PageModel.Inicial = (parseInt(PgAtual) - parseInt(PgTotalVisible)) > 1 ? (parseInt(PgAtual) - parseInt(PgTotalVisible)) : 1;
            this.PageModel.Final = parseInt(PgAtual);
        }
        
        for(var indx = this.PageModel.Inicial; indx <= this.PageModel.Final; indx++){
            
            if(indx == PgAtual){
                Active = " active ";
            }else{
                Active = "";
            }
            
            CabHTML += "\
                            <li class='"+ this.CSSTableGeral.GeralLiClass + Active +"' onclick='"+ this.NomeInstancia + ".setIrPagina("+ (parseInt(indx)) +")'>\n\
                                <a class='"+ this.CSSTableGeral.GeralAClass +  "' href='javascript:void(0)'>"+ indx +"</a>\n\
                            </li>" ;
        }
        
        if(PgAtual != PaginacaoTotal){
            FuncNext = this.NomeInstancia + ".setIrPagina("+ (parseInt(PgAtual) + 1) +")";
            FuncUltima = this.NomeInstancia + ".setIrPagina("+ (parseInt(PaginacaoTotal)) +")";;
            UBotao = "";
        }else UBotao = " disabled ";

        if(PgAtual != 1){
            FuncRetro = this.NomeInstancia + ".setIrPagina("+ (parseInt(PgAtual) - 1) +")";
            FuncPrimeira = this.NomeInstancia + ".setIrPagina(1)";;
            PBotao = "";
        }else PBotao = " disabled ";
        /*
         * Avança para a próxima página.
         */
        NextPagina = "<li class='"+ this.CSSTableGeral.GeralLiClass + UBotao +" ' onclick='"+ FuncNext +"'>\n\
                    <a class='"+ this.CSSTableGeral.GeralAClass +  "' href='javascript:void(0)'><i class='fa fa-chevron-right' style='font: normal normal normal 17px/1 FontAwesome;/* font-size: initial; */'></i></a>\n\
                </li>";
        /**
         * Volta uma página
         */
        RetroPagina = "<li class='"+ this.CSSTableGeral.GeralLiClass + PBotao +"' onclick='"+ FuncRetro +"'>\n\
            <a class='"+ this.CSSTableGeral.GeralAClass +  "' href='javascript:void(0)'><i class='fa fa-chevron-left'  style='font: normal normal normal 17px/1 FontAwesome;/* font-size: initial; */'></i></a>\n\
        </li>";
        
        /**
         * Leva para a primeira página.
         */
        PrimeiraPagina = "<li class='"+ this.CSSTableGeral.GeralLiClass + PBotao +"' onclick='"+ FuncPrimeira +"'>\n\
            <a class='"+ this.CSSTableGeral.GeralAClass +  "' href='javascript:void(0)'><i class='fa fa-fast-backward'  style='font: normal normal normal 17px/1 FontAwesome;/* font-size: initial; */'></i></a>\n\
        </li>";

        /**
        * Leva para a última página.
        */
        UltimaPagina = "<li class='"+ this.CSSTableGeral.GeralLiClass + UBotao +"' onclick='"+ FuncUltima +"'>\n\
            <a class='"+ this.CSSTableGeral.GeralAClass +  "' href='javascript:void(0)'><i class='fa fa-fast-forward'  style='font: normal normal normal 17px/1 FontAwesome;/* font-size: initial; */'></i></a>\n\
        </li>";
        
        /**
         * Verifica se a tabelaHTML irá exibir a caixa de salto de página
         */
        if(GetResultado.InfoPaginacao.ModoPaginacao.SaltoPagina){
            SaltoPagina = "<div style='display: inline-block; margin-left: 5px'><input onkeyup='"+ this.NomeInstancia +".setSaltoPagina(this)' class='form-control' id='FomControl_"+ GetResultado.Indexador + "' type='number' min=1 max="+ PaginacaoTotal +"><div>";
        }

        /**
         * Monta todos os botões relativos à paginação.
         */
        CabHTML = "<center><div  class=' "+ this.CSSTableGeral.GeralDivClass +" ' id='Rodape" + Indexador + "' style='display: inline-block;'>    \n\
                    <ul class='"+ this.CSSTableGeral.GeralUClass + "'>"+ PrimeiraPagina + RetroPagina + CabHTML + NextPagina + UltimaPagina +"</ul>                   \n\
                </div>"+SaltoPagina+"</center>";
        
        return CabHTML;
    }
    
    setIrPagina(p){
        this.DadosEnvio.sendPagina = p;
        this.show();
    }
    
    setChavesPrimaria(Chvs){
        var Chaves = Chvs || false;
        if(!Chaves) throw "Chaves não foram informadas!";
        this.ChavesPrimarias[0] = Chaves;
    }
    
    /**
     * Quebra as chaves em modo texto para modo array
     * @param {string} Chp
     * @returns {Array|TabelaHTML.getBreakChaves.ChavesArray}
     */
    getBreakChaves(Chp){
        var Quebrar = Chp.substring(0, Chp.length - 1), ChavesArray = [], temp = null;
        Quebrar = Quebrar.split(";");
        for(var i in Quebrar){
            temp = Quebrar[i].split("@");
            ChavesArray.push(temp);
        }
        return ChavesArray;
    }
    /**
     * var y = v.getBreakChaves("0@36;1@337;")
       v.getObterLinhaInteira(y);
     * Busca, através do array de chaves, a linha correspondente à chave primaria e a retorna.
     * @param {string} Chaves
     * @returns {unresolved}
     */
    getObterLinhaInteira(Chaves){
        var Valores = this.ResultSet.ResultDados, vChp1 , vChp2, Fins = false;
        for(var i in Valores){
            for(var idx in Chaves){
                vChp1 = Valores[i][Chaves[idx][0]]; //Busca direto pela chave, sem ficar vasculhando cada campo
                vChp2 = Chaves[idx][1];
                if(vChp1 != vChp2){
                    Fins = false
                    break;
                }else{
                    Fins = true;
                    break;
                }
            }
            if(Fins == true) return Valores[i];
        }
    }
    /**
     * Retorna o valor do campo, representado pelo parâmetro indxCampos, de uma determinada chave primária.
     * @param {array} Chaves
     * @param {int} indxCampos Representa o campo através do index
     * @returns {string} O conteúdo de um campo de uma chave primária
     */
    getFindValor(Chaves, indxCampos){
        var Valores = this.ResultSet.ResultDados, vChp1 , vChp2, Fins = false;
        for(var i in Valores){
            for(var idx in Chaves){
                vChp1 = Valores[i][Chaves[idx][0]]; //Busca direto pela chave, sem ficar vasculhando cada campo
                vChp2 = Chaves[idx][1];
                if(vChp1 != vChp2){
                    Fins = false
                    break;
                }else{
                    Fins = true;
                    break;
                }
            }
            if(Fins == true) return Valores[i][indxCampos];
        }
    }
    
   
    /**
     * Obtém o valor de um campo. Método utilizado para preencher o campo de um formulário.
     * @param {int} indxCampo
     * @returns {String}
     */
    getObterValorCampos(indxCampo){
        var Chps = []
        if(this.ChavesPrimarias.length > 0){
            Chps = this.getBreakChaves(this.ChavesPrimarias[0]);
            return this.getFindValor(Chps, indxCampo);
        }else{
            
        }
    }
    /**
     t.FuncoesChvExt[0] = function(v,p){
            var Dados = new JSController("http://10.56.32.78:8080/blitz/Controlador/");
    
        }   * 
     * Função que é chamada quando no mapeamento de campos em php é especificado o campo como chave estrangeira e a opção func tem o numero da função que será chamada quando for executada. Antes de aparecer a tela.
     * @param {int} NF
     * @returns {TabelaHTML@arr;@call;FuncoesChvExt}
     */
    
//    
//    async setFExecuteChv(NF, Objeto){
//       return await this.FuncoesChvExt[NF](this, NF);
//    }
    
    /**
     * Cria um campo especial para as chaves extrangeiras.
     * @param {array} Campo
     * @returns {undefined}
     */
    
//    async getCamposChaveExtrangeira(Campo, Valor){
//        var 
//            Template = "", 
//            Label = "", 
//            FNome = "", 
//            Tipo = "",
//            Leitura = "",
//            Botao = "",
//            Func = "",
//            Required = "";
//                
//    Label           = Campo[1];
//    FNome           = Campo[8].Name;
//    Tipo            = Campo[8].TypeConteudo;
//    Leitura         = Campo[8].readonly == true ? "readonly" : "";
//    Botao           = Campo[19].NomeBotao;
//    Required        = Campo[8].Required == true ? "required='true'" : "";
//    /**
//     * Campo muito importante para o sistema de chave extrangeira, fica configurado lá no arquivo de php. Caso
//     * seu valor seja false, significa que os dados da tabela extrangeira foram incorporados ao dados da tabela atual.
//     * e que estão localizados no campo DadosTblExt pra tratamento.
//     */
//    Func            = Campo[19].Funcao; 
//    
//    if(this.blitz == "bootstrap"){
//        if(Campo[8].TypeComponente == "button"){
//
//                Template = ' \n\
//                                <div class="input-group mb-3">' +
//                                    '<div class="input-group-prepend">' +
//                                        '<span class="input-group-text">'+ Label +':</span>' +
//                                    '</div>' +
//                                    '<input '+ Required +' type="'+ Tipo +'" '+ Leitura +' class="form-control" name="'+ FNome +'" value="'+ Valor +'"><button type="button" onclick="'+ this.NomeInstancia +'.setFExecuteChv('+ Func +', this)" class="btn btn-primary Bt_ChvExt_'+ this.ResultSet.Indexador +'">'+ Botao +'</button>' +
//                                '</div>';
//                return Template;
//        }   
//            
//        if(Campo[8].TypeComponente == "select"){
//                if(Func !== false){
//                    Template = ' \n\
//                                    <div class="input-group mb-3">' +
//                                        '<div class="input-group-prepend">' +
//                                            '<span class="input-group-text">'+ Label +':</span>' +
//                                        '</div>' +
//                                        '<select  '+ Required +'  class="form-control"  name="'+ FNome +'" >'+ 
//
//                                            await this.setFExecuteChv(Func) 
//
//                                        +'</select>' +
//                                    '</div>';
//                    
//                }else{
//                    Template = ' \n\
//                                    <div class="input-group mb-3">' +
//                                        '<div class="input-group-prepend">' +
//                                            '<span class="input-group-text">'+ Label +':</span>' +
//                                        '</div>' +
//                                        '<select  '+ Required +'  class="form-control"  name="'+ FNome +'" >'+ 
//
//                                            await this.getSelectChExtrangeira(Campo, Valor) 
//
//                                        +'</select>' +
//                                    '</div>';
//                    
//                }
//                return Template;
//            }  
//    }
//                    
//                    
//}

/**
 * Método que gera as opções da caixa de select para as janalas do botão inserir e editar
 * @param {Array} Dados
 * @param {Text} Valor
 * @returns {String}
 */

//    async getSelectChExtrangeira(Dados, Valor){
//        let Selects = '<option value=""></option>',
//            Selected = '';
//
//        for (var i in Dados[19].DadosTblExt) {
//            for(var c in Dados[19].DadosTblExt[i]){
//                
//                if(c == Dados[19].IdxCampoVinculado) continue;
//                
//                Selected = Dados[19].DadosTblExt[i][Dados[19].IdxCampoVinculado] == Valor ? "selected" : "";
//                
//                Selects += '<option '+ Selected + ' value="'+ Dados[19].DadosTblExt[i][Dados[19].IdxCampoVinculado] + '">'+ Dados[19].DadosTblExt[i][c] + '</option>';
//            }
//        }
//       
//        return Selects;
//    }
    
    
    /**
     * Cria um formulário com os campos que podem ser enviado.
     * @param {array} Campo Representa o conjunto de atributos de uma campo para formulários.
     * @param {string} Modo
     * @returns {String}
     */
    async getGrupoCamposblitz(Campo, Modo){
        var 
            Template = "", 
            Valor = "", 
            Label = "", 
            Placeholder = "", 
            FNome = "", 
            Tipo = "",
            Multiple = "",
            Required = "", 
            Title = "", 
            Patterns = "",
            Leitura = "",
            Opcoes = "",
            Estilo = "",
            Tamanho = "",
            Max = "",
            Min = "",
            MaxLength = "",
            IDX = "";
        
        if(Modo == "Atualizar" && !Campo[19].TExt){
            Valor = this.getObterValorCampos(Campo[0]);
        }
        //Chave extrangeira.
        //if(Campo[19].TExt){
        //    Valor = Modo == "Atualizar" ? this.getObterValorCampos(Campo[0]) : ""; //IdxCampoVinculado -> Vem do banco de dados e é o vínculo entre a chave extrangeira
        //    return await this.getCamposChaveExtrangeira(Campo, Valor);
        //}
        Label           = Campo[1];
        Placeholder     = Campo[8].Placeholder;
        FNome           = Campo[8].Name;
        Tipo            = Campo[8].TypeConteudo[0];
        Multiple        = Campo[8].Multiple == true ? "multiple='multiple'" : "";
        Required        = Campo[8].Required == true ? "required='true'" : "";
        Title           = Campo[8].Titles;
        Patterns        = Campo[8].Patterns;
        Leitura         = Campo[8].readonly == true ? "readonly" : "";
        Estilo          = Campo[8].style;
        Tamanho         = Campo[8].size;
        Max             = Campo[8].max;
        Min             = Campo[8].min;
        MaxLength       = Campo[8].maxlength;
        IDX             = Campo[0];
        
        if(this.blitz == "bootstrap"){
            
           
            if(Campo[8].TypeComponente == "inputbox"){
                
                //TabelaBD - Campos valores padrões, devem ter uma definição para cada uma
                if(Campo[2].Exist && Modo != "Atualizar"){
                    Valor = Campo[2].Valor;
                    if(Campo[2].Readonly){
                        Leitura = "readonly";
                    }
                }
                
                Template =`<div class="form-group" >`+
                                `<label for="${Label}">${Label}</label>`+
                                `<input `+
                                        `title="${Title}" `+
                                        `style="${Estilo}" `+
                                        `size="${Tamanho}" `+
                                        `max="${Max}" `+
                                        `min="${Min}" `+
                                        `maxlength="${MaxLength}" `+
                                        `${Leitura} `+
                                        `${Required} `+
                                        `${Patterns} `+
                                        `type="${Tipo}" `+
                                        `name="${FNome}" `+
                                        `class="form-control" `+
                                        `id="INPUT_`+ this.ResultSet.Indexador +`_${Label}" `+
                                        `value="${Valor}" `+
                                        `placeholder="${Placeholder}">`+
                            `</div>`;

                return Template;
            }
            
            if(Campo[8].TypeComponente == "select"){
                
                Tipo = Campo[8].TypeConteudo;
                
                if(!Campo[19].TExt){

                    Tipo.forEach(function(v,i,p){
                        var S = v == Valor ? "selected" : "";
                        Opcoes += "<option "+ S +" >"+ v +"</option>";
                    })
                    
                    Template = `<div class="form-group">`+
                                      `<label for="${Label}">${Label}</label>`+
                                      `<select class="form-control" `+
                                            `title="${Title}" `+
                                            `style="${Estilo}" `+
                                            `id="SELECT_`+ this.ResultSet.Indexador +`_${Label}" `+
                                            ` ${Required} ` +
                                            `name="${FNome}" `+
                                            `data-Campo="${Label}" `+
                                            `data-IDX="${IDX}" `+
                                            `aria-hidden="true"> `+
                                            `${Opcoes}`+
                                      `</select>`+
                                `</div>`;

                    return Template;
                }else{
                    
                    Valor = this.getObterValorCampos(Campo[19].CamposTblExtrangeira[3]);
                    Opcoes += `<option selected >${Valor}</option>`;
                    Template = `<div class="form-group">`+
                                      `<label for="${Label}">${Label}</label>`+
                                      `<select class="form-control SELECTD2_`+ this.ResultSet.Indexador +`" `+
                                            `${Multiple} `+
                                            `title="${Title}" `+
                                            `style="${Estilo}" `+
                                            `id="SELECT_`+ this.ResultSet.Indexador +`_${Label}" `+
                                            ` ${Required} ` +
                                            `name="${FNome}" `+
                                            `data-Campo="${Label}" `+
                                            `data-IDX="${IDX}" `+
                                            `aria-hidden="true"> `+
                                            `${Opcoes}`+
                                      `</select>`+
                                `</div>`;
            
                    return Template;
                }

            }           
            
            if(Campo[8].TypeComponente == "textarea"){
                Label           = Campo[1];
                Placeholder     = Campo[8].Placeholder;
                FNome           = Campo[8].Name;
                Tipo            = Campo[8].TypeConteudo[0];
                Required        = Campo[8].Required;
                Title           = Campo[8].Titles;
                Patterns        = Campo[8].Patterns;
                Leitura         = Campo[8].readonly == true ? "readonly" : "";
                
                if(!Campo[19].TExt){
                    
                    if(Campo[2].Exist && Modo != "Atualizar"){
                        Valor = Campo[2].Valor;
                    } 
                    Template = '<div class="form-group" >'+ 
                                    '<label for="'+ Label + '">'+ Label + '</label>'+
                                    '<textarea '+ Required +' title="'+ Title +'"  '+ Patterns +' class="form-control" '+ Leitura +' placeholder="'+ Placeholder +'" name="'+ FNome +'" rows=7>'+ Valor +'</textarea>' +
                                '</div>';
                        
                return Template;
                
                }else{
                    
                    Valor = this.getObterValorCampos(Campo[19].CamposTblExtrangeira[3]);
                    Template = '<div class="form-group" >'+ 
                                    '<label for="'+ Label + '">'+ Label + '</label>'+
                                    '<textarea '+ Required +' title="'+ Title +'"  '+ Patterns +' class="form-control" '+ Leitura +' placeholder="'+ Placeholder +'" name="'+ FNome +'"  rows=7>'+ Valor +'</textarea>' +
                                '</div>';
                        
                return Template;
                }

                
            }
            if(Campo[8].TypeComponente == "funcao"){
                if(this.Funcoes.Campo !== false){
                    Template = await this.FAnonimas.GerarCampoForm(Campo);
                    return Template;                    
                }else{
                    Template = "Esse campo é gerado por funções anônima que não foi definida.";
                    return Template;
                }

            }
            
        }else if(this.blitz == "getcmdl.io"){
            
        }
        
        return Template;
    }
    
    async obter_FOREING(data){
        let Value_CAMPOS = this.ResultSet.Campos,
            IDX_Atual = null;
    
        IDX_Atual = data.objecto[0].dataset.idx || null;
        if(IDX_Atual == null) throw 7000;
        for(let i of Value_CAMPOS){
            if(i[0] == IDX_Atual){
                return i[19];
            }
        }
        
    }
    
    async getValor_CHV_FOREIGN(options){
        let TratarResposta = null
           ,Config_FOREGIN = null
           ,_TERM = null
           , _FUNC = null;
           try{
               Config_FOREGIN = await this.obter_FOREING(options.data);
           }catch(e){
               this.TratarErros({Codigo: e});
               return false;
           }
           
        _TERM = options.data.search == null ? true : options.data.search;
        _FUNC = Config_FOREGIN.Funcao;
        if(_FUNC !== false){
            this.FUNCOES_FOREIGN[_FUNC](options);
        }
        let Tabela_Original = null, ModoOperacao_Original = null, Ordem_Original = null;
       /*
        * Tabelas e modo de operação originais, pois usa-se o mesmo controle para mais de uma funcionalidade
        */ 
        Tabela_Original = this.DadosEnvio.sendTabelas;
        ModoOperacao_Original = this.DadosEnvio.sendModoOperacao;
        Ordem_Original = this.DadosEnvio.sendOrdemBY;
        
        this.DadosEnvio.sendTabelas = Config_FOREGIN.Tabela;
        this.DadosEnvio.sendOrdemBY = null;
        
        let Filtros_TOLD = [];
        Filtros_TOLD[0] = this.DadosEnvio.sendFiltros[0];
        Filtros_TOLD[1] = this.DadosEnvio.sendFiltros[1];
        Filtros_TOLD[2] = this.DadosEnvio.sendFiltros[2];
        
        this.DadosEnvio.sendFiltros[0] = false;
        this.DadosEnvio.sendFiltros[1] = false;
        this.DadosEnvio.sendFiltros[2] = false;
        
        if(_TERM !== true){
            this.DadosEnvio.sendFiltros[0]  = [[Config_FOREGIN.CamposTblExtrangeira[1],"like",_TERM]];            
        }else{
            this.DadosEnvio.sendFiltros[0]  = false;
        }

        this.DadosEnvio.sendPagina = options.data.Prox_pagina;
        /*
         * Restabelecimento das operações originais;
         */
        this.DadosEnvio.sendModoOperacao = "ab58b01839a6d92154c615db22ea4b8f";
        TratarResposta = await this.Atualizar(false);
        
        this.DadosEnvio.sendTabelas =  Tabela_Original;
        this.DadosEnvio.sendModoOperacao = ModoOperacao_Original;
        this.DadosEnvio.sendOrdemBY = Ordem_Original;
        
        this.DadosEnvio.sendFiltros[0] = this.DadosEnvio.sendFiltros[0];
        this.DadosEnvio.sendFiltros[1] = Filtros_TOLD[1];
        this.DadosEnvio.sendFiltros[2] = Filtros_TOLD[2];
        
        if(TratarResposta.Error != false){
            this.TratarErros(TratarResposta);
            return false;
        }else{
            TratarResposta.Dados_Campo_Foreign = Config_FOREGIN; //Envia os dados para criar a tabela da chave estrangeria no componente;
            return TratarResposta;
        }
    }
    /**
     * 
     * @param {array} Erros
     * @returns {void}
     */
    TratarErros(Erros){
        switch(Erros.Codigo){
            case 12006:
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: Erros.Mensagem,
                    //footer: '<a href="">Why do I have this issue?</a>'
                  });
                window.location = Erros.Dominio;
                break;
            default:
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: Erros.Mensagem,
                    //footer: '<a href="">Why do I have this issue?</a>'
                  });
                break;
        }
    }
//####################MÓDULO INSERIR###########################    

    /**
     * Envia em forma de array os campos e seus valores para armazenamento no banco de dados.
     * @param {objeto} F
     * @returns {Boolean}
     */
    async EnviarFormularioInserir(F){
        var TratarResposta = "";
        
        event.preventDefault();
        var Campos = [];
        Campos = $(F).serializeArray();
        let rst = await this.FUNCOES_EVENT.__Exec("INSERIR","BEFORE", this, Campos);
        
        if(rst === true){
            this.DadosEnvio.sendCamposAndValores = Campos;
        
            TratarResposta = await this.inserir();
            
            if(TratarResposta.Error !== false){
                this.TratarErros(TratarResposta, "Inserir");
                await this.FUNCOES_EVENT.__Exec("INSERIR","AFTER", this, TratarResposta);
                return false;
            }else{
                F.reset();
                await this.FUNCOES_EVENT.__Exec("INSERIR","AFTER", this, true);
            }

            await this.show();

            Toast.fire({
                icon: 'success',
                title: 'Os dados foram inseridos.'
              });
              
        }else{
            await this.FUNCOES_EVENT.__Exec("INSERIR","AFTER", this, false);
        }
        
    }
    /**
     * Obtém os campos que comporão o formulário para envio dos dados.
     * @returns {String}
     */
    async getCamposInserir(){
        var Campos = "", GetResultado = this.ResultSet;
        
        for(var indx in GetResultado.Campos){
            if(GetResultado.Campos[indx][8].Exibir !== true) continue; 
            Campos += await this.getGrupoCamposblitz(GetResultado.Campos[indx], "Inserir");
        }
        Campos = "<form onsubmit='"+ this.NomeInstancia +".EnviarFormularioInserir(this)'>"+ Campos+ "<button class='btn btn-primary btn-block'>Inserir</button></form>";
        return Campos;
    }
    /**
     * Obtém as informações para a criação da janela inserir dados.
     * @returns {void}
     */
    async showFormularioInserir(){
        var FormsCampos = await this.getCamposInserir();
        let o = this;
        var Janela = {
                                    Janela: {Nome: "myJanelas", Tipo: "modal-lg", Tamanho: "30vw"},
                                    Header: {Title: "Inserir", CorTexto: "white", backgroundcolor: "#007bff"}, 
                                    Body: {Conteudo: FormsCampos, Scroll: true}, 
                                    Footer: {
                                                Cancelar: {Nome: "Cancelar", classe: "" , Visible: "none", Funcao: false}, 
                                                Aceitar: {Nome: "Close", classe: "" , Visible: "block", Funcao: false},
                                                Status: {Display: false, Conteudo: ""}
                                            },
                                    Modal: {backdrop: true,keyboard: true}
                                };
            this.CustomJanelaModal(Janela);
            this.FUNCOES_ONLOAD.__Exec(this.ADDSET_FUNCTION_ONLOAD["INSERIR"], this);
    }
    /**
     * Método assíncrono que envia os dados para inserção.
     * @returns {TabelaHTML@call;Atualizar}
     */
    async inserir(){
        
        this.DadosEnvio.sendModoOperacao = "5a59ffc82a16fc2b17daa935c1aed3e9";
        return await this.Atualizar();
        
    }
    
//####################FIM MÓDULO INSERIR###########################    
//
//####################MÓDULO ATUALIZAR###########################    
    async EnviarFormularioEditar(F){
        try{
            var TratarResposta = "";
        
            event.preventDefault();
            var Campos = [];
            Campos = $(F).serializeArray();
            let rst = await this.FUNCOES_EVENT.__Exec("UPDATE","BEFORE", this, Campos);

            if(rst === true){
                this.DadosEnvio.sendCamposAndValores = Campos;
                this.DadosEnvio.sendChavesPrimarias = this.getBreakChaves(this.ChavesPrimarias[0]);

                TratarResposta =  await this.atualizar();
                
                if(TratarResposta.Error !== false){
                    this.TratarErros(TratarResposta);
                    
                    await this.FUNCOES_EVENT.__Exec("UPDATE","AFTER", this, TratarResposta);
                    return false;
                }else{
                    
                    await this.FUNCOES_EVENT.__Exec("UPDATE","AFTER", this, true);
                    
                    let Diferenca = this._TotalRegistroUpdate - this.ChavesPrimarias.length + 1;
                    $("#ContadorRegistro").html(Diferenca);

                    this.ChavesPrimarias.splice(0,1);
                    if(this.ChavesPrimarias.length > 0){
                        var FormsCampos = await this.getCamposAtualizar();
                        $(".modal-body").html(FormsCampos);
                        /**
                         * Após a atualização do primeiro registro é executado novamente, para os campos gerados, as funções da funcion Atualizar
                         */
                         this.FUNCOES_ONLOAD.__Exec(this.ADDSET_FUNCTION_ONLOAD["ATUALIZAR"], this);
                         
                    }else{
                        $("#ButtonEditar_" + this.ResultSet.Indexador).prop("disabled","true");
                        $("#ButtonExcluir_" + this.ResultSet.Indexador).prop("disabled","true");

                        $("#myJanelas").modal('hide');

                        await this.show(); //Somente após a atualização de todas as linhas;

                        Toast.fire({
                            icon: 'success',
                            title: 'Os dados foram atualizados.'
                          });
                    }
                }
            }else{
                await this.FUNCOES_EVENT.__Exec("UPDATE","AFTER", this, false);
            }
        }catch(e){
            
        }
        
        
    }
    
    async getCamposAtualizar(){
        var Campos = "", GetResultado = this.ResultSet, DetalhesUpdate = "";
        
        for(var indx in GetResultado.Campos){
            if(GetResultado.Campos[indx][8].Exibir !== true) continue;
            Campos += await this.getGrupoCamposblitz(GetResultado.Campos[indx], "Atualizar");
        }
        
        if(Campos != ""){
            Campos = "<form onsubmit='"+ this.NomeInstancia +".EnviarFormularioEditar(this)'>"+ Campos + "<button class='btn btn-success btn-block'>Atualizar</button></form>";
        } else return false;
        
        return Campos;
    }

    async showFormularioAtualizar(){
        var FormsCampos = await this.getCamposAtualizar();
            if(FormsCampos == false) {
                Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "<i class='fa fa-check-square-o' style='font-size:36px;'></i> Não há campos para serem editados.",
                    //footer: '<a href="">Why do I have this issue?</a>'
                  });
                return false;
            }
            this._TotalRegistroUpdate = this.ChavesPrimarias.length;
            let Status = "<div style='font-style: italic;font-family: monospace;'><span><b>Registro(s)</b></span> <span id='ContadorRegistro'>:0</span><span> / "+ this.ChavesPrimarias.length +"</span></div>";
        let o = this;
        var Janela = {
                                    Janela: {Nome: "myJanelas", Tipo: "modal-lg", Tamanho: "48em"},
                                    Header: {Title: "Editar", CorTexto: "white", backgroundcolor: "#5cb85c"}, 
                                    Body: {Conteudo: FormsCampos, Scroll: true}, 
                                    Footer: {
                                                Cancelar: {Nome: "Cancelar", classe: "" , Visible: "none", Funcao: function(){var o}}, 
                                                Aceitar: {Nome: "Close", classe: "btn-danger" , Visible: "block", Funcao: function(){var o}},
                                                Status: {Display: true, Conteudo: Status}
                                            },
                                    Modal: {backdrop: true,keyboard: true}
                                };

        this.CustomJanelaModal(Janela);
        this.FUNCOES_ONLOAD.__Exec(this.ADDSET_FUNCTION_ONLOAD["ATUALIZAR"], this);
    }
    
    /**
     * 
     * @returns {TabelaHTML@call;Atualizar}
     */
    async atualizar(){
        this.DadosEnvio.sendModoOperacao = "1b24931707c03902dad1ae4b42266fd6";
        this.ChavesEnvio = this.getBreakChaves(this.ChavesPrimarias[0]);
        return await this.Atualizar();
    }
//####################FIM MÓDULO EDITAR###########################    
    async showJanela(Janela){
            this.CustomJanelaModal(Janela);        
    }
//################################################################
    /**
     * 
     * @returns {Boolean}
     */
    async show(){
        var TratarResposta = null;
        this.DadosEnvio.sendModoOperacao = "ab58b01839a6d92154c615db22ea4b8f";
        
        await this.FUNCOES_EVENT.__Exec("SELECT","BEFORE", this, null);
        TratarResposta = await this.Atualizar();
        await this.FUNCOES_EVENT.__Exec("SELECT","AFTER", this, null);
        
        if(TratarResposta.Error !== false){
            this.TratarErros(TratarResposta);
            return false;
        }
        
        var 
            cabecalho = null,
            Linhas = null,
            ComponentCompleto = null,
            Indexador = 0,
            NomeTabela = "",
            Botoes = "",
            Paginacao = "",
            InfoP = "",
            InstanciaTabela = this;
        
        Indexador   = this.ResultSet.Indexador;
        NomeTabela  = this.ResultSet.NomeTabela;
        Linhas      = this.getLinhas();
        cabecalho   = this.getCabecalho();
        Botoes      = this.getBotoes();
        Paginacao   = this.getPaginacao();
        InfoP       = this.getInfoPaginacao();
        this.ChavesPrimarias = []; //Na mudança de página todas as chaves selecionadas são excluídas.
        
        ComponentCompleto = "\n\
            <div class=' "+ this.CSSTableGeral.GeralDivClass + " " + this.CSSTableGeral.GeralDivClass_Componente +" ' id='Componente_" + Indexador + "'>                  \n\
                <div class='' id='Cabecalho_" + Indexador + "'>                                         \n\
                        "+ InfoP +"                                                                     \n\
                </div>                                                                                  \n\
                                                                                                        \n\
                <div  class='  "+ this.CSSTableGeral.GeralDivClass  + " " + this.CSSTableGeral.GeralDivClass_Corpo +" ' id='Corpo_" + Indexador + "'>                 \n\
                    <table class='"+ this.CSSTableGeral.GeralTableClass +"' id='"+ NomeTabela +"'>                    \n\
                        "+ cabecalho +"                                                                 \n\
                        "+ Linhas +"                                                                    \n\
                    </table>                                                                            \n\
                </div>                                                                                  \n\
                <div class=' "+ this.CSSTableGeral.GeralDivClass  + " " + this.CSSTableGeral.GeralDivClass_Botoes +" ' id='Botoes_" + Indexador + "'>"+ Botoes + "</div>" 
                     + Paginacao ;
        $("#" + this.Recipiente).html(ComponentCompleto);
        //$("*").popover('hide');
        $(".tooltip").remove();
        
        if(this.Funcoes.Linhas != false){
            $(".tr_" + this.ResultSet.Indexador).click(this.FAnonimas.Linha).css("cursor","pointer");
            $(".tr_" + this.ResultSet.Indexador).hover(function(){
                $(this).css("background-color","#557775");
            }, function(){
                $(this).css("background-color","initial");
            })
        }
        if(this.Funcoes.Celulas != false){
            $(".td_" + this.ResultSet.Indexador).click(this.FAnonimas.Celulas).css("cursor","pointer");
            $(".td_" + this.ResultSet.Indexador).hover(function(){
                $(this).css("background-color","#557775");
            }, function(){
                $(this).css("background-color","initial");
            });
        }
        
        if(this.ResultSet.ShowColumnsIcones[0]){
            this.ResultSet.ShowColumnsIcones[1].forEach(function(v, i, p){
                var o = v;
                $("." + v.NomeBotao + "_" + InstanciaTabela.ResultSet.Indexador).click(function(){
                     InstanciaTabela.FuncoesIcones[v.Func](InstanciaTabela, this);
                });
            });
        }
        
        
        
        
        this.FUNCOES_ONLOAD.__Exec(this.ADDSET_FUNCTION_ONLOAD["SHOW"], this);
    }
    
    /**
     * Atualiza a tabela
     * @returns {void}
     */
    async Refresh(){
        this.show();
    }
    
    async excluir(){
        var Chaves = [], Quebradas = [], TratarResposta = null;
        for (var i in this.ChavesPrimarias) {
            Quebradas.push(this.getBreakChaves(this.ChavesPrimarias[i]));
        }
        this.DadosEnvio.sendModoOperacao = "1570ef32c1a283e79add799228203571";
        this.DadosEnvio.sendChavesPrimarias = Quebradas;
        
        let rst = await this.FUNCOES_EVENT.__Exec("DELETE","BEFORE", this);
        
        if(rst === true){
            TratarResposta = await this.Atualizar();
        
            if(TratarResposta.Error != false){
                this.TratarErros(TratarResposta, "Excluir");
                await this.FUNCOES_EVENT.__Exec("SELECT","AFTER", this, TratarResposta);
                return false;
            }else{
                await this.FUNCOES_EVENT.__Exec("DELETE","AFTER", this, true);
                
                this.show();
                
                Toast.fire({
                    icon: 'success',
                    title: 'Os dados foram excluídos.'
                  });
            }
        }else{
            await this.FUNCOES_EVENT.__Exec("DELETE","AFTER", this, false);
        }
        
    }
    /**
     * Exclui as linhas selecionadas na tabela HTML
     * @returns {TabelaHTML@call;Atualizar}
     */
    JanelaExcluirDados(){
        var Mensagem = "<h4>Tem certeza que deseja excluir o(s) registro(s) selecionado(s)?</h4>";//<h4><span class='glyphicon glyphicon-trash'></span> </h4>
        //this.r;
        var o = this;
        var Janela = {
                                    Janela: {Nome: "myJanelas", Tipo: "modal-sm", Tamanho: "400px"},
                                    Header: {Title: "<i class='fa fa-trash-o' style='font-size:36px'></i> Excluir", CorTexto: "white", backgroundcolor: "#dc3545"}, 
                                    Body:   {Conteudo: Mensagem}, 
                                    Footer: {
                                                Cancelar: {Nome: "Não", classe: "btn-success" , Color: "white" ,Visible: "block", Funcao: function(){var o}}, 
                                                Aceitar: {Nome: "Excluir", classe: "btn-danger" , Color:"white", Visible: "block", Funcao: function(){o.excluir();$("#myJanelas").modal('hide');}},
                                                Status: {Display: true, Conteudo: ""}
                                            },
                                    Modal: {keyboard: false}
                                };
            this.CustomJanelaModal(Janela);        
            this.FUNCOES_ONLOAD.__Exec(this.ADDSET_FUNCTION_ONLOAD["EXCLUIR"], this);
    }
    /**
     * Seta os valores para a criação de uma janela bootstrap.
     * @param {object} o
     * @returns {void}
     */
    CustomJanelaModal(o){
        var Componentes = o; /*{
                                    Janela: {Nome: "myJanelas", Tipo: false, Tamanho: "300px"},
                                    Header: {Title: "Excluir", CorTexto: "", backgroundcolor: "#5cb85c"}, 
                                    Body: {Conteudo: Mensagem, Scroll: true}, 
                                    Footer: {
                                                Cancelar: {Nome: "nao", Visible: "none", Funcao: function(){}}, 
                                                Aceitar: {Nome: "Close", Visible: "block", Funcao: function(){}},
                                                Status: {Display: false, Conteudo: ""}
                                            },
                                    Modal: {backdrop: false,keyboard: true}
                                };

                        };*/
        
        if(Componentes.Janela.Tipo != false){
            $(".modal-dialog").removeClass("modal-sm").removeClass("modal-lg");
            $(".modal-dialog").addClass(Componentes.Janela.Tipo);
            $(".modal-dialog").css("width","inherit");
        }

        if(Componentes.Janela.Tamanho  != false){
            $(".modal-dialog").css("width",Componentes.Janela.Tamanho);
            $(".modal-dialog").css("max-width","100%");
        }
        
        $(".modal-header").css("background-color", Componentes.Header.backgroundcolor);
        $(".modal-title").html(Componentes.Header.Title);
        $(".modal-title").css("color", Componentes.Header.CorTexto);
        
        if(Componentes.Body.Scroll){
            $(".modal-dialog").addClass("modal-dialog-scrollable");
        }else{
            $(".modal-dialog").removeClass("modal-dialog-scrollable");
        }
        
        $(".modal-body").html(Componentes.Body.Conteudo);

        if(Componentes.Footer.Status.Display == false){
            $(".modal-footer").css("display","none");
        }else{
            $(".modal-footer").css("display","inherit");
            $(".status-footer").html(Componentes.Footer.Status.Conteudo);
        }
        
        $(".cancelar").css("display", Componentes.Footer.Cancelar.Visible);
        $(".cancelar").html(Componentes.Footer.Cancelar.Nome);
        $(".cancelar").unbind();
        $(".cancelar").click(Componentes.Footer.Cancelar.Funcao);
        $(".cancelar").addClass(Componentes.Footer.Cancelar.classe);
        
        $(".ok").css("display", Componentes.Footer.Aceitar.Visible);
        $(".ok").html(Componentes.Footer.Aceitar.Nome);
        $(".ok").unbind();
        if(Componentes.Footer.Aceitar.Nome == "Excluir"){
            $(".ok").click(Componentes.Footer.Aceitar.Funcao); 
            
        }else{
            $(".ok").click(function(){
                $("#myJanelas").modal('hide');
            });            
        }

        $(".fechar").click(function(){
            $("#myJanelas").modal('hide');
        });
        $(".btn-success").click(function(){
            //$("#myJanelas").modal('hide');
        }); 
        
        $(".ok").addClass(Componentes.Footer.Aceitar.classe);
        
        $("#" + Componentes.Janela.Nome).modal('show');
        
    }
    
    /**
     * Método que limpa as variáveis da classe que poderá ser utilizada para outra trabela.
     * @return {undefined}
     */
    Destroy(){
        this.Recipiente = null; //Nome do recipiente que receberá o componente com os dados.
        this.NomeInstancia = null; //Nome do objeto instanciado na memória.
        this.ChavesPrimarias = []; //Array que armazena, de uma determinada instância, as chaves primárias de uma tabela HTML
        this.blitz = "bootstrap"; //Informa com qual blitz o componente mostrará os dados.
        this.DadosEnvio.sendPagina = 1;
        this.DadosEnvio.sendFiltros = [false, false, false];
        /**
         * Variável que armazena as funções anônimas das linhas, células e conteúdo.
         * Obs.: Conteudo é a variável que armazena a função anônima que é executada durante a apresentação da tabela HTML. Está
         * variável esta na função .getLinhas();
         */
        this.Funcoes = null;

        /*
         * Ao ser chamada, a função recebe esses paramentros.
         * InstanciaTabela.FuncoesIcones[v.Func](InstanciaTabela, this);
         */
        this.FuncoesIcones = []; //Armazena as funções, criadas manualmente, para a execução dos ícones da tabela HTML, a função recebe os parâmetros Instância da tabela e o próprio objeto 
        this.FuncoesChvExt = []; //Armazena as funções para as chaves extrangeiras. São identificadas pelo numero da função. Esse número vem do ModeloTabela.php que fica no campo.
        this.StatusGeral = [];   //Amazena informações gerais como por exemplo se ja foi buscado os dados no banco. É a variável de estado do objeto.
        
        this.CSSTableGeral = null;

        this.visibleChavePrimaria = false,
        this.VisibleDetalhesUpdate = true;

        this.Configuracao = null;
        
        this.PageModel = {Inicial: 0, Final: 0};
        var Instancia = this;
        /**
         * 
         */
        this.FAnonimas = null;
    }
}

