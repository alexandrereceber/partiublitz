/* 
 * Date 11/07/2020
 * Cria formulários de preenchimento com base em uma base de dados
 */

class FormHTML extends JSController{
    
    constructor(Caminho){
        
        super(Caminho);
        this.Registro = 0; // Sempre será 0, pois no formulário não tem como ver mais de 1 registro, usando apenas o índice 0
        this.Nome_Submit = null; //Rótulo do botão de envio do formulário.
        this.Recipiente = null; //Nome do recipiente que receberá o componente com os dados.
        this.NomeInstancia = null; //Nome do objeto instanciado na memória.
        this.ResultSet = []; //Array que armazena, de uma determinada instância, as chaves primárias de uma tabela HTML
        this.blitz = "bootstrap"; //Informa com qual blitz o componente mostrará os dados.
        this.DadosEnvio.sendPagina = 1;
        this.DadosEnvio.sendModoOperacao = "1b24931707c03902dad1ae4b42266fd6";
        this.ChavesPrimarias = [];
        this.visibleTitulo = false;
        
        this.Groups = {
                        Groups: true,
                        N_Grupos: 1,
                        Columns:  1,
                        Titulos: [], //Cada índice representa o nome de cada grupo
                        Rodapes: [], //Cada índice representa o rodapé de cada grupo
                        /*
                         [
                            {Style_card_header:"red", Style_card_body:"blue", Style_Rodape:"green"}, 
                            {Style_card_header:"red", Style_card_body:"blue", Style_Rodape:"green"},
                            {Style_card_header:"red", Style_card_body:"blue", Style_Rodape:"green"},
                        ]
                         * 
                         */
                        Styles: []
        };
         
        this.DadosEnvio.sendFiltros = [false, false, false];
        
        /*Configuração das partes do formulário*/
        this.Configuracoes = {
                                "div_content_section":{
                                    "style":""
                                },
                                "card_header":{
                                    "style":""
                                },
                                "card_primary":{
                                    "style":""
                                },
                                "card_body":{
                                                "style":""
                                            },
                                "form_group":{
                                                "style":"",
                                                "Campos":{
                                                            0:""
                                                        },
                                                "For_by_Form":{
                                                                0:""
                                                            }
                                            }
                            };
        
        
        this.FUNCOES_FOREIGN = {
            0: function(params){
                alert(9);
            }
        };
        
        this.FUNCAO_GERARCAMPOS = false;
        
        
        /**
         * Funções executadas aopós carregar os dados;
         * Select / Insert / Update
         * Tem um tratador de erro para esses funções, dentro de cada operação
         */
        this.FUNCOES_ONLOAD = function(){
            let FUNCs = new Map([
                //Inserir as funcoes;
            ]);
            return {
                    
                __Exec: async function(ACTION, MOMENT, OBJECT_INSTANCIA_FORMULARIO, OTHER = null){  //Recebe um objeto {"Evento":..., ?}
                    for(let i of FUNCs){
                        let s = await i[1](ACTION, MOMENT, OBJECT_INSTANCIA_FORMULARIO, OTHER);
                        if(!s){
                            return false;
                        }
                    }
                    return true;
                },
                add: function(n,f){
                    FUNCs.set(n,f);
                },
                /**
                 * Função executadas todas as vezes que há inserção ou atualização dos dados.
                 * Será utilizada para executar funções essenciais ou vitais antes de qualquer outra função.
                 * @returns {undefined}
                 */
                Padrao:function(){
                    
                    let f = function (ACTION, MOMENT, OBJECT_INSTANCIA_FORMULARIO, OTHER){
                        
                        switch (ACTION) {
                            case "INSERT":
                                if(MOMENT === "BEFORE"){
                                    
                                }
                                break;

                            case "UPDATE":
                                if(MOMENT === "BEFORE"){

                                }
                                break;

                            default:
                                return true;
                                break;
                        }
                        
                        return true;
                    };
                    
                    FUNCs.set("PADRAO",f);
                }
            };
            
            
        }();
        
        this.FUNCOES_ONLOAD.Padrao();
    }

    
    addFunctons_Eventos(Nome,F){
        if(Nome !== null && Nome !== "" && Nome !== undefined && F !== undefined){
            this.FUNCOES_ONLOAD.add(Nome, F);
        }else{
            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "É necessário um nome e uma função, método: addFunctons_Eventos",
                    //footer: '<a href="">Why do I have this issue?</a>'
                  });
        }
        
    }
    /**
     * Exibi ou não título nas caixa de formulário
     * @type type
     */
    set visible_Title(t){
        this.visibleTitulo = t;
    }
    /**
     * {
            N_Grupos: 1,
            Columns:  1,
            Titulos: [], //Cada índice representa o nome de cada grupo
            Rodapes: [] //Cada índice representa o rodapé de cada grupo
        }
     * @type Objet
     */
    set setGrupos(n){
        this.Groups = n;
    }
    
   /**
    * Atribui um array contendo os filtros de pesquisa.
    * @type array Fts
    */
    set Filtros(Fts){
        this.DadosEnvio.sendFiltros[0] = Fts;
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

    set Modo_Operacao(n){
        if(n == "I"){
            this.DadosEnvio.sendModoOperacao = "5a59ffc82a16fc2b17daa935c1aed3e9";
            this.Nome_Submit = "Inserir";
        }else if(n == "E"){
            this.DadosEnvio.sendModoOperacao = "1b24931707c03902dad1ae4b42266fd6";
            this.Nome_Submit = "Atualizar";
        }else if(n == "V"){
            this.DadosEnvio.sendModoOperacao = "1b24931707c03902dad1aeVISUALIZAR";
            this.Nome_Submit = "view";
        }else{
            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Escolher uma operação, método: Modo_Operacao!",
                    //footer: '<a href="">Why do I have this issue?</a>'
                  });
        }
        
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
                //window.location = Erros.Dominio;
                break;
            case 7000:
                 Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Não foi definido, na tabela, o campo de referência da chave estrangeira!",
                    //footer: '<a href="">Why do I have this issue?</a>'
                  });
                //window.location = Erros.Dominio;
                break;
            
            case 0:
                 Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Usuário existente no sistema.",
                    //footer: '<a href="">Why do I have this issue?</a>'
                  });
                //window.location = Erros.Dominio;
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
    
//####################MÓDULO Select###########################    
    async show(){
        try{
            let TratarResposta = null;
        
            let Modo_Original = this.DadosEnvio.sendModoOperacao;
            this.DadosEnvio.sendModoOperacao = "ab58b01839a6d92154c615db22ea4b8f";
            TratarResposta = await this.Atualizar(true);
            this.DadosEnvio.sendModoOperacao = Modo_Original;

            if(TratarResposta.Error != false){
                this.TratarErros(TratarResposta);
                return false;
            }else{


            }
            
            this.FUNCOES_ONLOAD.__Exec("SELECT","BEFORE", this);
            this.ResultSet = TratarResposta;
            this.CriarFormulario();
            /**
             * Dentro dessa função já é verificado se é insert ou update
             */
            this.getValor_Campos(this.Registro);

            this.FUNCOES_ONLOAD.__Exec("SELECT","AFTER", this); 
            
        }catch(e){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: e,
                //footer: '<a href="">Why do I have this issue?</a>'
              });
        }
            
        
    }
    get_BaseGoup_input(){
        let BaseGroup_input = '<div class="form-group" style="'+ this.Configuracoes.form_group.style +';{ROTULO_style_por_campo}">'+
                                '<label for="{ROTULO_id}">{ROTULO_Nome}</label>'+
                                '<input \n\
                                        style="{ROTULO_style}" \n\
                                        size="{ROTULO_size}" \n\
                                        max="{ROTULO_max}" \n\
                                        min="{ROTULO_min}" \n\
                                        maxlength="{ROTULO_maxlength}" \n\
                                        " {ROTULO_leitura} " \n\
                                        " {ROTULO_required} "  \n\
                                        " {ROTULO_patterns} " \n\
                                        type="{ROTULO_tipo}" \n\
                                        name="{ROTULO_id}" \n\
                                        class="form-control" \n\
                                        id="INPUT_'+ this.ResultSet.Indexador +'_{ROTULO_id}" \n\
                                        placeholder="{ROLTULO_placeholder}">'+
                            '</div>';
        return BaseGroup_input;
    }
    
    get_BaseGroup_Select(){
        let BaseGroup_Select = '<div class="form-group"  style="'+ this.Configuracoes.form_group.style +';{ROTULO_style_por_campo};">'+
                                      '<label for="{ROTULO_id}">{ROTULO_Nome}</label>'+
                                      '<select class="form-control {ROTULO_SELECTD2} " \n\
                                            {ROTULO_MULTIPLE} \n\
                                            style="{ROTULO_style}" \n\
                                            id="SELECT_'+ this.ResultSet.Indexador +'_{ROTULO_id}"\n\
                                            name="{ROTULO_id}" \n\
                                            aria-hidden="true">'+
                                            '{ROTULO_ITENS}'+
                                      '</select>'+
                                '</div>';
        return BaseGroup_Select;
    }

    get_BaseGroup_Textarea(){
        let BaseGroup_Select = '<div class="form-group"  style="'+ this.Configuracoes.form_group.style +';{ROTULO_style_por_campo};">'+ 
                                    '<label for="{ROTULO_id}">{ROTULO_Nome}</label>'+
                                    '<textarea {ROTULO_patterns} {ROTULO_leitura} maxlength="{ROTULO_maxlength} max="{ROTULO_max}" size="{ROTULO_size}" {ROTULO_required} name="{ROTULO_id}" id="SELECT_'+ this.ResultSet.Indexador +'_{ROTULO_id}" class="form-control" rows="3" placeholder="{ROLTULO_placeholder}" style="{ROTULO_style}"></textarea>'+
                                '</div>';
        return BaseGroup_Select;
    }
    
    get_BaseGroup_Imagem(){
        this.Imagem = true;
        let BaseGroup_Imagem = '<div class="form-group"  style="'+ this.Configuracoes.form_group.style +';{ROTULO_style_por_campo};">'+
                                    '<label for="{ROTULO_id}">{ROTULO_Nome}</label>'+
                                    '<div class="input-group">'+
                                      '<div class="custom-file">'+
                                        '<input type="file" class="custom-file-input" \n\
                                                style="{ROTULO_style}" \n\
                                                size="{ROTULO_size}" \n\
                                                max="{ROTULO_max}" \n\
                                                min="{ROTULO_min}" \n\
                                                maxlength="{ROTULO_maxlength}" \n\
                                                " {ROTULO_leitura} " \n\
                                                " {ROTULO_required} "  \n\
                                                " {ROTULO_patterns} " \n\
                                                type="{ROTULO_tipo}" \n\
                                                name="{ROTULO_id}" \n\
                                                class="form-control" \n\
                                                id="IMAGEM_'+ this.ResultSet.Indexador +'_{ROTULO_id}" \n\
                                                placeholder="{ROLTULO_placeholder}">'+
                                        '<label class="custom-file-label" for="{ROTULO_id}">Choose file</label>'+
                                      '</div>'+
                                      '<div class="input-group-append">'+
                                        '<span class="input-group-text">Upload</span>'+
                                      '</div>'+
                                    '</div>';

        return BaseGroup_Imagem;
    }
    /* Gera os campos representados na classe Table no servidor.
     * Cria os campos em forma de formulário para preenchimento.
     * @returns {Generator|FormHTML.gerar_CAMPOSFormGrups.BaseGROUPS|String}
     */
    gerar_CAMPOSFormGrups(BLOCK = false, DIVIS = false){
        let CAMPOS = this.ResultSet.Campos;
                
        let BaseGROUPS = "", Count = 0;;
        
        for(let i of CAMPOS){
            let Keys          = i[3] //Chave primária
            , Label           = i[1]
            , Placeholder     = i[8].Placeholder
            , FNome           = i[8].Name
            , Groups          = i[8].Grupos
            , Componente      = i[8].TypeComponente
            , Tipo_Conteudo   = i[8].TypeConteudo
            , Multiple        = i[8].Multiple === true ? "multiple='multiple'" : ""
            , Required        = i[8].Required === true ? "required='true'" : ""
            , Visible         = i[6]
            , Patterns        = i[8].Patterns !== "" ? "pattern='"+ i[8].Patterns + "'" : ""
            , Leitura         = i[8].readonly === true ? "readonly" : ""
            , Maxlength       = i[8].maxlength
            , Max             = i[8].max
            , Min             = i[8].min
            , Size            = i[8].size
            , Style           = i[8].style
            , Opcoes          = null;
            
            if(Visible === false) continue;
            
            if(i[3][0] !== false){
                if(i[3][0] === true || i[3][1] === false){
                    continue
                }
            }
            
            
            /**
             * Camada usada, tanto para criação de componentes em grupos ou sem grupos
             */
            if(this.Groups.Groups === true){
                if(BLOCK != Groups.N_Grupo || DIVIS != Groups.Divisao){
                    continue;
                }
            }
            //---------------------------------------------------------
            
            if(Componente === "inputbox"){
                    if(i[8].Exibir){
                        /*
                    * Representa os campos da classe que tem como componente o inputbox
                    * @type String
                    */
                    let BaseGroup_input = this.get_BaseGoup_input();

                        BaseGROUPS += BaseGroup_input
                                                        .replace(/{ROTULO_Nome}/ig, Label)
                                                        .replace(/{ROLTULO_placeholder}/ig, Placeholder)
                                                        .replace(/{ROTULO_id}/ig, FNome)
                                                        .replace(/{ROTULO_tipo}/ig, Tipo_Conteudo[0])
                                                        .replace(/{ROTULO_required}/ig, Required)
                                                        .replace(/{ROTULO_patterns}/ig, Patterns)
                                                        .replace(/{ROTULO_leitura}/ig, Leitura)
                                                        .replace(/{ROTULO_maxlength}/ig, Maxlength)
                                                        .replace(/{ROTULO_Max}/ig, Max)
                                                        .replace(/{ROTULO_Min}/ig, Min)
                                                        .replace(/{ROTULO_size}/ig, Size)
                                                        .replace(/{ROTULO_style}/ig, Style)
                                                        .replace(/{ROTULO_style_por_campo}/ig, this.Configuracoes.form_group.Campos[Count])
                    }
                    Count++;
                }
            else if(i[8].TypeComponente === "select"){
                    if(i[8].Exibir){
                            /* Chave estrangeira
                          * Verifica se o campo faz referência a outro campo.
                          */
                         if(!i[19].TExt){
                             Tipo_Conteudo.forEach(function(v,i,p){
                                 Opcoes += "<option selected>"+ v +"</option>";
                             });                        
                         }

                        /*
                         * Representa os campos da classe que tem como componente o select
                         * @type String
                         */      
                        let BaseGroup_Select = this.get_BaseGroup_Select();
                        
                         BaseGROUPS += BaseGroup_Select
                                                             .replace(/{ROTULO_Nome}/ig, Label)
                                                             .replace(/{ROTULO_id}/ig, FNome)
                                                             .replace(/{ROTULO_required}/ig, Required)
                                                             .replace(/{ROTULO_leitura}/ig, Leitura)
                                                             .replace(/{ROTULO_size}/ig, Size)
                                                             .replace(/{ROTULO_style}/ig, Style)
                                                             .replace(/{ROTULO_style_por_campo}/ig, this.Configuracoes.form_group.Campos[Count] + ";" + this.Configuracoes.form_group.For_by_Form[Count])
                                                             .replace(/{ROTULO_ITENS}/ig, Opcoes)
                                                             .replace(/{ROTULO_MULTIPLE}/ig, Multiple);
                         if(i[19].TExt){
                             BaseGROUPS = BaseGROUPS.replace(/{ROTULO_SELECTD2}/ig, "SELECTD2");
                         }else{
                             BaseGROUPS = BaseGROUPS.replace(/{ROTULO_SELECTD2}/ig, "");
                         }
                    }
                    
            }
            else if(i[8].TypeComponente === "imagem"){
            if(i[8].Exibir){
                    let BaseGroup_imagem = this.get_BaseGroup_Imagem();
                    BaseGROUPS += BaseGroup_imagem
                                            .replace(/{ROTULO_Nome}/ig, Label)
                                            .replace(/{ROLTULO_placeholder}/ig, Placeholder)
                                            .replace(/{ROTULO_id}/ig, FNome)
                                            .replace(/{ROTULO_tipo}/ig, Tipo_Conteudo[0])
                                            .replace(/{ROTULO_required}/ig, Required)
                                            .replace(/{ROTULO_patterns}/ig, Patterns)
                                            .replace(/{ROTULO_leitura}/ig, Leitura)
                                            .replace(/{ROTULO_maxlength}/ig, Maxlength)
                                            .replace(/{ROTULO_Max}/ig, Max)
                                            .replace(/{ROTULO_Min}/ig, Min)
                                            .replace(/{ROTULO_size}/ig, Size)
                                            .replace(/{ROTULO_style}/ig, Style)
                                            .replace(/{ROTULO_style_por_campo}/ig, this.Configuracoes.form_group.Campos[Count]);
                    
                }
                
            }
            else if(i[8].TypeComponente === "textarea"){
            if(i[8].Exibir){
                    let BaseGroup_TextArea = this.get_BaseGroup_Textarea();
                    BaseGROUPS += BaseGroup_TextArea
                                            .replace(/{ROTULO_Nome}/ig, Label)
                                            .replace(/{ROLTULO_placeholder}/ig, Placeholder)
                                            .replace(/{ROTULO_id}/ig, FNome)
                                            .replace(/{ROTULO_tipo}/ig, Tipo_Conteudo[0])
                                            .replace(/{ROTULO_required}/ig, Required)
                                            .replace(/{ROTULO_patterns}/ig, Patterns)
                                            .replace(/{ROTULO_leitura}/ig, Leitura)
                                            .replace(/{ROTULO_maxlength}/ig, Maxlength)
                                            .replace(/{ROTULO_Max}/ig, Max)
                                            .replace(/{ROTULO_Min}/ig, Min)
                                            .replace(/{ROTULO_size}/ig, Size)
                                            .replace(/{ROTULO_style}/ig, Style)
                                            .replace(/{ROTULO_style_por_campo}/ig, this.Configuracoes.form_group.Campos[Count]);
                    
                }
                
            }
            else if(i[8].TypeComponente === "funcao"){
                if(this.FUNCAO_GERARCAMPOS !== false){
                    BaseGROUPS += this.FUNCAO_GERARCAMPOS(i);
                }else{
                    BaseGROUPS += "<div>Esse campo é gerado por funções anônima que não foi definida.</div>";
                }
                
            }
            else{
                throw "Não há campo correspondente a esse tipo de dados";
            }
        }
        
        
        return BaseGROUPS;
    }
    
    /* -1 para levar em conta o zero do array
     * Atributo que representa o registro a ser representado no formulário. 
     */
    set setRegistro(n){
        this.Registro = n;
    }
        
    async update(F, o){
       let rsp = await o.Enviar_Update(F);
       if(rsp){
            await this.show(); //Somente após a atualização de todas as linhas;
            Toast.fire({
                icon: 'success',
                title: 'Os dados foram salvos.'
              });
       }else{
           
       }
    }
    async inserir(F, o){
       let rsp = await o.Enviar_Inserir(F);

       if(rsp){
           
            await this.show(); //Somente após a atualização de todas as linhas;
            Toast.fire({
                icon: 'success',
                title: 'Os dados foram inseridos com sucesso.'
              });
       }else{
           
       }
    }    
    confirme_Atualizacao(F){
        let o = this;
        swalWithBootstrapButtons.fire({
        title: 'Salvar..',
        text: "Deseja salvar esses dados?!",
        icon: 'question',
        showCancelButton: true,
        confirmButtonText: 'Sim',
        cancelButtonText: 'Não',
        reverseButtons: true
      }).then((result) => {
        if (result.isConfirmed) {
            
          o.update(F, o);
           
        } else if (
          /* Read more about handling dismissals below */
          result.dismiss === Swal.DismissReason.cancel
        ) {

        }
      })

    }
    confirme_Insercao(F){
        let o = this;
        swalWithBootstrapButtons.fire({
            title: 'Inserir..',
            text: "Deseja inserir esses dados?!",
            icon: 'question',
            showCancelButton: true,
            confirmButtonText: 'Sim',
            cancelButtonText: 'Não',
            reverseButtons: true
        }).then((result) => {
          if (result.isConfirmed) {

            o.inserir(F, o);

          } else if (
            /* Read more about handling dismissals below */
            result.dismiss === Swal.DismissReason.cancel
          ) {

          }
        });

    }
//####################MÓDULO ATUALIZAR###########################    
    async Enviar_Update(F){
        try{
            var TratarResposta = "";
        
            event.preventDefault();
            var Campos = [];
            Campos = $(F.currentTarget).serializeArray();
            this.DadosEnvio.sendCamposAndValores = Campos;
            this.DadosEnvio.sendModoOperacao = "1b24931707c03902dad1ae4b42266fd6";
            this.DadosEnvio.sendChavesPrimarias = this.getBreakChaves(this.ChavesPrimarias);
            
            let s = await this.FUNCOES_ONLOAD.__Exec("UPDATE","BEFORE", this, Campos);
            if(s){
                TratarResposta = await this.Atualizar();

                if(TratarResposta.Error != false){
                    this.TratarErros(TratarResposta);
                    this.FUNCOES_ONLOAD.__Exec("UPDATE","AFTER", this, TratarResposta);
                    return false;
                }else{

                    return true;
                    this.FUNCOES_ONLOAD.__Exec("UPDATE","AFTER", this, null);

                }
            }else{
                Toast.fire({
                    icon: 'success',
                    title: 'Uma ou outra função retornou false.'
                });
            }
            
        }catch(e){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: e,
                //footer: '<a href="">Why do I have this issue?</a>'
              });
        }
            
        
    }
     
    async Enviar_Inserir(F){
        try{
            var TratarResposta = "";
        
            event.preventDefault();
            var Campos = [];
            Campos = $(F.currentTarget).serializeArray();
            this.DadosEnvio.sendCamposAndValores = Campos;
            this.DadosEnvio.sendModoOperacao = "5a59ffc82a16fc2b17daa935c1aed3e9";
            
            let s = await this.FUNCOES_ONLOAD.__Exec("INSERT","BEFORE", this, Campos);
            if(s){
                TratarResposta = await this.Atualizar(false);

                if(TratarResposta.Error != false){
                    this.TratarErros(TratarResposta);
                    this.FUNCOES_ONLOAD.__Exec("INSERT","AFTER", this, TratarResposta);
                    return false;
                }else{
                    this.FUNCOES_ONLOAD.__Exec("INSERT","AFTER", this, null);
                    return true;
                }    
            }else{
                Toast.fire({
                    icon: 'success',
                    title: 'Uma ou outra função retornou false.'
                });                
            }
            

        }catch(e){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: e,
                //footer: '<a href="">Why do I have this issue?</a>'
              });
        }

        
    }    
    async obter_FOREING(data){
        let Value_CAMPOS = this.ResultSet.Campos,
            IDX_Atual = null;
    
        IDX_Atual = data.objecto[0].dataset.IDX || null;
        if(IDX_Atual == null) throw 7000;
        for(let i of Value_CAMPOS){
            if(i[0] == IDX_Atual){
                return i[19];
            }
        }
        
    }
    

    /** INTEGRAÇÃO COM OUTROS COMPONENTES
     * Informa, através de outro componente, as informações para editar ou inserir dados;
     * @Dados type {"SOURCEDADOS": "", }
     */
    set set_SourceDados(Dados){
        let SOURCEDADOS = null, CHAVEPRIMARIA = null, REGISTRO = null, TABELA = null, OPERACAO = null;
        
        SOURCEDADOS = Dados.SOURCEDADOS || null;
        CHAVEPRIMARIA = Dados.CHAVEPRIMARIA || null;
        REGISTRO = Dados.Dados || null;
        TABELA = Dados.Tabela || null;
        OPERACAO = Dados.Operacao || null;
        
        if(TABELA === null || OPERACAO === null){
            throw "Tabela e Modo de Operação não foram informados!";
        }else{
            if(OPERACAO === "1b24931707c03902dad1ae4b42266fd6"){
                if(SOURCEDADOS === null || CHAVEPRIMARIA === null || REGISTRO === null){
                    throw "Base de dados, Chave Primária ou Registro não foram informados.";
                }else{
                    this.ResultSet = SOURCEDADOS;
                    this.ChavePrimaria = CHAVEPRIMARIA;
                    this.Registro = REGISTRO;
                    this.DadosEnvio.sendTabelas = TABELA;
                    this.DadosEnvio.sendModoOperacao = OPERACAO;
                }
                
                
            }else if(OPERACAO === "5a59ffc82a16fc2b17daa935c1aed3e9"){
                this.DadosEnvio.sendTabelas = TABELA;
                this.DadosEnvio.sendModoOperacao = OPERACAO;
            }else{
                throw "Nenhuma operação de CRUD informada.";
            }
            
                
        }
        
        
        
    }
    getValor_Campos(n){
        try{
            let CAMPOS = this.ResultSet.Campos,
                RESULT = this.ResultSet.ResultDados,
                Total  = RESULT.length;
            if(this.DadosEnvio.sendModoOperacao !== "1b24931707c03902dad1aeVISUALIZAR" && this.DadosEnvio.sendModoOperacao !== "5a59ffc82a16fc2b17daa935c1aed3e9"){
                if(RESULT.length == 0 || this.Registro > RESULT.length) {throw "Não há registro para edição ou índice inválido.";}
            }
            if(this.DadosEnvio.sendModoOperacao === "5a59ffc82a16fc2b17daa935c1aed3e9" || this.DadosEnvio.sendModoOperacao === "1b24931707c03902dad1aeVISUALIZAR"){
                for(let i in CAMPOS){
                    if(CAMPOS[i][8].Exibir){
                        if(CAMPOS[i][8].TypeComponente === "inputbox"){
                            let INPUT = $("#INPUT_" + this.ResultSet.Indexador + "_" + CAMPOS[i][8].Name);
                            INPUT[0].dataset["Campo"] = CAMPOS[i][8].Name;
                            INPUT[0].dataset["IDX"] = CAMPOS[i][0];
                        }else if(CAMPOS[i][8].TypeComponente === "select"){
                            let SELECT =  $("#SELECT_" + this.ResultSet.Indexador + "_" + CAMPOS[i][8].Name);
                            SELECT[0].dataset["Campo"] = CAMPOS[i][8].Name;
                            SELECT[0].dataset["IDX"] = CAMPOS[i][0];                        
                        }else if(CAMPOS[i][8].TypeComponente === "select"){
                                                  
                        }

                    }
                };
                return true;
            }else if(this.DadosEnvio.sendModoOperacao === "1b24931707c03902dad1ae4b42266fd6"){
                if(n >= 0){
                    this.ChavesPrimarias = this.getValorChave(RESULT[this.Registro]);
                    for(let i in RESULT[n]){
                        if(CAMPOS[i][8].Exibir){ //Se o campo será visualizado
                            if(CAMPOS[i][8].TypeComponente === "inputbox"){
                                let INPUT = null;
                                INPUT = $("#INPUT_" + this.ResultSet.Indexador + "_" + CAMPOS[i][8].Name).val(RESULT[n][i]);
                               INPUT[0].dataset["Campo"] = CAMPOS[i][8].Name;
                               INPUT[0].dataset["IDX"] = CAMPOS[i][0];
                               INPUT[0].dataset["Keys"] = this.ChavesPrimarias;

                           }else if(CAMPOS[i][8].TypeComponente === "select"){
                               let SELECT =  $("#SELECT_" + this.ResultSet.Indexador + "_" + CAMPOS[i][8].Name);
                               SELECT[0].dataset["Campo"] = CAMPOS[i][8].Name;
                               SELECT[0].dataset["IDX"] = CAMPOS[i][0];
                               SELECT[0].dataset["Keys"] = this.ChavesPrimarias;
                               
                               if(!CAMPOS[i][19].TExt){
                                    for(let ii of SELECT[0].children){
                                        let valor = ii.value;
                                        let conteudo = RESULT[n][i];
                                        if(valor == conteudo){
                                            ii.selected = true;
                                            $(SELECT).val(conteudo);
                                            $(SELECT).trigger('change');

                                            break;
                                        }
                                    }                           
                               }else{
                                   let idx = RESULT[n][CAMPOS[i][19].CamposTblExtrangeira[2]];
                                   let valor = RESULT[n][CAMPOS[i][19].CamposTblExtrangeira[3]];
                                   
                                   var data = {
                                        id: idx,
                                        text: valor
                                    };

                                    var newOption = new Option(data.text, data.id, false, false);
                                    $(SELECT[0]).append(newOption).trigger('change');

                               }

                            }

                        }
                    }
                }else{
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: "O registro não foi encontrado, método: getValor_Campos",
                        //footer: '<a href="">Why do I have this issue?</a>'
                      });
                }
                return true;
            }else{
                return false;
            }    
        }catch(e){
            Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: e,
                        //footer: '<a href="">Why do I have this issue?</a>'
                      });
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
        
        if(TratarResposta.Error != false){
            this.TratarErros(TratarResposta);
            return false;
        }else{
            TratarResposta.Dados_Campo_Foreign = Config_FOREGIN; //Envia os dados para criar a tabela da chave estrangeria no componente;
            return TratarResposta;
        }
    }
    
    getBlocos_one(BLOCK, DIVIS){
        
    }
    getBlocos_two(BLOCK, DIVIS){
        
    }
    CriarBlocos_Groups(){
        let GN = this.Groups.Titulos; //Goup Nome
        let GR = this.Groups.Rodapes; //Goup Rodape
        let TOTAL_GROUPS = this.Groups.N_Grupos;
        let BLOCKS_GROUPS = "";
        
        if( TOTAL_GROUPS === 0) throw "A informação sobre grupos é 0.";
        let Bloks = "";
        
        if(this.visibleTitulo){
            Bloks = '<div class="card card-default">'+
                        '<div class="card-header" style="{CARD_HEARD}">'+
                          '<h3 class="card-title">{TITULO_CARD}</h3>'+
                          '<div class="card-tools">'+
                            '<button type="button" class="btn btn-tool" data-card-widget="collapse">'+
                              '<i class="fas fa-minus"></i>'+
                            '</button>'+
                          '</div>'+
                        '</div>'+
                       ' <!-- /.card-header -->'+
                        '<div class="card-body" style="{CARD_BODY}">'+
                         ' <div class="row">'+
                            '<div class="col-md-6">'+
                                "{BLOCKs_1}"+ //Block 1 do card_Default
                            '</div>'+
                            '<!-- /.col -->'+
                            '<div class="col-md-6">'+
                                "{BLOCKs_2}"+ //Block 2 do card_Default
                           ' </div>'+
                           ' <!-- /.col -->'+
                          '</div>'+
                          '<!-- /.row -->'+
                        '</div>'+
                        '<!-- /.card-body -->'+
                        '<div class="card-footer"  style="{CARD_RODAPE}">'+
                         "{RODAPE_CARD}"+
                        '</div>'+
                    '</div>';
        }else{
            Bloks = '<div class="card card-default">'+
                       ' <!-- /.card-header -->'+
                        '<div class="card-body" style="{CARD_BODY}">'+
                         ' <div class="row">'+
                            '<div class="col-md-6">'+
                                "{BLOCKs_1}"+ //Block 1 do card_Default
                            '</div>'+
                            '<!-- /.col -->'+
                            '<div class="col-md-6">'+
                                "{BLOCKs_2}"+ //Block 2 do card_Default
                           ' </div>'+
                           ' <!-- /.col -->'+
                          '</div>'+
                          '<!-- /.row -->'+
                        '</div>'+
                        '<!-- /.card-body -->'+
                        '<div class="card-footer"  style="{CARD_RODAPE}">'+
                         "{RODAPE_CARD}"+
                        '</div>'+
                    '</div>';
        }
        
            
        let TITULO_CARD = "";
        let RODAPE_CARD = "";
        let BLOCO1 = "";
        let BLOCO2 = "";
        let BLK = Bloks;
        let CARD_HEARD = "";
        let CARD_BODY = "";
        let CARD_RODAPE = "";
        
        for(let i = 0; i <= TOTAL_GROUPS; i++){
            TITULO_CARD = GN[i];
            RODAPE_CARD = GR[i];
            BLOCO1 = this.gerar_CAMPOSFormGrups(i,1);
            BLOCO2 = this.gerar_CAMPOSFormGrups(i,2);
            CARD_HEARD =  this.Groups.Styles[i].Style_card_header;
            CARD_BODY =   this.Groups.Styles[i].Style_card_body;
            CARD_RODAPE = this.Groups.Styles[i].Style_Rodape;
            
            BLK = Bloks.replace(/{TITULO_CARD}/,    TITULO_CARD);
            BLK = BLK.replace(/{RODAPE_CARD}/,      RODAPE_CARD);
            BLK = BLK.replace(/{BLOCKs_1}/,         BLOCO1);
            BLK = BLK.replace(/{BLOCKs_2}/,         BLOCO2);
            BLK = BLK.replace(/{CARD_HEARD}/,       CARD_HEARD);
            BLK = BLK.replace(/{CARD_BODY}/,        CARD_BODY);
            BLK = BLK.replace(/{CARD_RODAPE}/,      CARD_RODAPE);
            
            BLOCKS_GROUPS += BLK;
            
        }   

        return BLOCKS_GROUPS;
    }
    CriarFormulario(){
        let BaseFormulario = null;
        let o = this;
        if(this.Groups.Groups === false){
            if(this.visibleTitulo){
                BaseFormulario =  
                    '<section class="content" style="'+ this.Configuracoes.div_content_section.style +'">'+
                        '<div class="container-fluid">'+
                          '<div class="row">'+
                            '<div class="col-md-12">'+
                              '<!-- jquery validation -->'+
                              '<div class="card card-primary" style="'+ this.Configuracoes.card_primary.style +'">'+
                                '<div class="card-header"  style="'+ this.Configuracoes.card_header.style +'">'+
                                  '<h3 class="card-title">'+ this.ResultSet.InfoPaginacao.TituloTabela +'</h3>'+
                                '</div>'+
                                '<!-- /.card-header -->'+
                                '<!-- form start -->'+
                                '<form id="FORM_'+ this.ResultSet.Indexador +'">'+
                                  '<div class="card-body" style="'+ this.Configuracoes.card_body.style +'">'+
                                  this.gerar_CAMPOSFormGrups()+
                                  '</div>'+
                                  '<!-- /.card-body -->'+
                                  '<div class="card-footer">'+
                                    (this.Nome_Submit !== "view" ? '<button type="submit" class="btn btn-primary">'+ this.Nome_Submit + '</button>' : "")+
                                  '</div>'+
                                '</form>'+
                              '</div>'+
                              '<!-- /.card -->'+
                              '</div>'+
                            '<!--/.col (left) -->'+
                            '<!-- right column -->'+
                            '<div class="col-md-6">'+
                            '</div>'+
                            '<!--/.col (right) -->'+
                         ' </div>'+
                          '<!-- /.row -->'+
                        '</div><!-- /.container-fluid -->'+
                      '</section>';
            }else{
                BaseFormulario =  
                    '<section class="content" style="'+ this.Configuracoes.div_content_section.style +'">'+
                        '<div class="container-fluid">'+
                          '<div class="row">'+
                            '<div class="col-md-12">'+
                              '<!-- jquery validation -->'+
                              '<div class="card card-primary" style="'+ this.Configuracoes.card_primary.style +'">'+
                                '<!-- form start -->'+
                                '<form id="FORM_'+ this.ResultSet.Indexador +'">'+
                                  '<div class="card-body" style="'+ this.Configuracoes.card_body.style +'">'+
                                  this.gerar_CAMPOSFormGrups()+
                                  '</div>'+
                                  '<!-- /.card-body -->'+
                                  '<div class="card-footer">'+
                                    (this.Nome_Submit !== "view" ? '<button type="submit" class="btn btn-primary">'+ this.Nome_Submit + '</button>' : "")+
                                  '</div>'+
                                '</form>'+
                              '</div>'+
                              '<!-- /.card -->'+
                              '</div>'+
                            '<!--/.col (left) -->'+
                            '<!-- right column -->'+
                            '<div class="col-md-6">'+
                            '</div>'+
                            '<!--/.col (right) -->'+
                         ' </div>'+
                          '<!-- /.row -->'+
                        '</div><!-- /.container-fluid -->'+
                      '</section>';
            }
            
        }else{
            if(this.visibleTitulo){
                BaseFormulario = 
                    '<section class="content" style="'+ this.Configuracoes.div_content_section.style +'">'+
                        '<div class="container-fluid">'+
                          '<div class="row">'+
                            '<div class="col-md-12">'+
                              '<!-- jquery validation -->'+
                              '<div class="card card-primary" style="'+ this.Configuracoes.card_primary.style +'">'+
                                '<div class="card-header"  style="'+ this.Configuracoes.card_header.style +'">'+
                                  '<h3 class="card-title">'+ this.ResultSet.InfoPaginacao.TituloTabela +'</h3>'+
                                '</div>'+
                                    '<!-- /.card-header -->'+
                                    '<!-- form start -->'+
                                    '<form id="FORM_'+ this.ResultSet.Indexador +'">'+
                                        '<div class="card-body" style="'+ this.Configuracoes.card_body.style +'">'+
                                                      this.CriarBlocos_Groups() +
                                        '</div>'+
                                  '<!-- /.card-body -->'+
                                  '<div class="card-footer">'+
                                    (this.Nome_Submit !== "view" ? '<button type="submit" class="btn btn-primary">'+ this.Nome_Submit + '</button>' : "")+
                                  '</div>'+
                                '</form>'+
                              '</div>'+
                              '<!-- /.card -->'+
                              '</div>'+
                            '<!--/.col (left) -->'+
                            '<!-- right column -->'+
                            '<div class="col-md-6">'+
                            '</div>'+
                            '<!--/.col (right) -->'+
                         ' </div>'+
                          '<!-- /.row -->'+
                        '</div><!-- /.container-fluid -->'+
                      '</section>';
            }else{
                BaseFormulario = '<section class="content">'+
                        '<div class="container-fluid">'+
                          '<div class="row">'+
                            '<div class="col-md-12">'+
                              '<!-- jquery validation -->'+
                              '<div class="card card-primary">'+
                                    '<!-- form start -->'+
                                    '<form id="FORM_'+ this.ResultSet.Indexador +'">'+
                                        '<div class="card-body" style="'+ this.Configuracoes.card_body.style +'">'+
                                                      this.CriarBlocos_Groups() +
                                        '</div>'+
                                  '<!-- /.card-body -->'+
                                  '<div class="card-footer">'+
                                    (this.Nome_Submit !== "view" ? '<button type="submit" class="btn btn-primary">'+ this.Nome_Submit + '</button>' : "")+
                                  '</div>'+
                                '</form>'+
                              '</div>'+
                              '<!-- /.card -->'+
                              '</div>'+
                            '<!--/.col (left) -->'+
                            '<!-- right column -->'+
                            '<div class="col-md-6">'+
                            '</div>'+
                            '<!--/.col (right) -->'+
                         ' </div>'+
                          '<!-- /.row -->'+
                        '</div><!-- /.container-fluid -->'+
                      '</section>';
            }
            
              
              
        }
        
     
        
        $("#" + this.Recipiente).html(BaseFormulario);
        
        $("[data-card-widget='collapse']").click(function(e){
            let TARGET = $(e.target).attr("class");
            if(TARGET === "fas fa-minus"){
                $(e.target).attr("class","fas fa-plus");
                let COMP = $(e.currentTarget).parent().parent().siblings();
                
                $(COMP[0]).slideUp(500);
            }else{
                $(e.target).attr("class","fas fa-minus");
                let COMP = $(e.currentTarget).parent().parent().siblings();
                
                $(COMP[0]).slideDown(500);
            }
            
            
        }) 
        
        if(this.DadosEnvio.sendModoOperacao === "1b24931707c03902dad1ae4b42266fd6"){
            
            $("#FORM_" + this.ResultSet.Indexador).submit(function(e){
                event.preventDefault();
                o.confirme_Atualizacao(e);
            });
        }else{
            $("#FORM_" + this.ResultSet.Indexador).submit(function(e){
                event.preventDefault();
                o.confirme_Insercao(e);
            });
        };
        
        $(".form-control").keypress(function(e){
            o.FUNCOES_ONLOAD.__Exec("keypress","evento", o, e);
        });
        
      this.selecForeingKey();
        
    }
    
    selecForeingKey(){
        let o = this;
        $(".SELECTD2").select2({
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
                                let rst = await o.getValor_CHV_FOREIGN(params);
                                params.data.OBJECTO_FORMULARIO = o;
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
                        /**
                         * Como os parâmetros são passados por referêcia e são para tratamentos não há a necessidade de retorno
                         OBS.: MUITO IMPORTANTE:
                            ANTES DE USAR A FUNÇÃO ATUALIZAR() DO JSCONTROLE, O COMPONENTE TROCA AS TABELAS DE FORMA MOMENTÂNEA
                            PARA REALIZAR ESSA TAREFA E LOGO DEPOIS VOLTA PARA A TABELA ANTERIOR.
                            POR ISSO, DEVE-SE ATENTAR PARA O FATO DE QUE O COMANDO LOGO ABAIXO CHAMA A FUNÇÃO DE TRATAMENTO
                            COM OS DADOS DA TABELA ORIGINAL NÃO A DOS DADOS DA TABELA ESTRANGEIRA.
                         **/
                        params.OBJECTO_FORMULARIO.FUNCOES_ONLOAD.__Exec("SELECTD2","AFTER", data, params.OBJECTO_FORMULARIO);
                        
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
                },
                maximumSelectionLength: 30

              });
    }
}
