/* 
 * Date 11/07/2020
 * Cria formulários de preenchimento com base em uma base de dados
 */

class FormHTML extends JSController{
    
    constructor(Caminho){
        
        super(Caminho);
        this.Registro = -1;
        this.Nome_Submit = null; //Rótulo do botão de envio do formulário.
        this.Recipiente = null; //Nome do recipiente que receberá o componente com os dados.
        this.NomeInstancia = null; //Nome do objeto instanciado na memória.
        this.ResultSet = []; //Array que armazena, de uma determinada instância, as chaves primárias de uma tabela HTML
        this.blitz = "bootstrap"; //Informa com qual blitz o componente mostrará os dados.
        this.DadosEnvio.sendPagina = 1;
        this.DadosEnvio.sendModoOperacao = "1b24931707c03902dad1ae4b42266fd6";
        this.ChavesPrimarias = [];
        
        //this.DadosEnvio.sendFiltros = [false, false, false];
        
        /*Configuração das partes do formulário*/
        this.Configuracoes = {
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
        }else{
            Swal.fire({
                    icon: 'error',
                    title: 'Oops...',
                    text: "Escolher uma operação!",
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
        let TratarResposta = null;
        
        let Modo_Original = this.DadosEnvio.sendModoOperacao;
        this.DadosEnvio.sendModoOperacao = "ab58b01839a6d92154c615db22ea4b8f";
        TratarResposta = await this.Atualizar(true);
        this.DadosEnvio.sendModoOperacao = Modo_Original;
        
        if(TratarResposta.Error != false){
            this.TratarErros(TratarResposta);
            return false;
        }else{
            this.ResultSet = TratarResposta;
            this.CriarFormulario();
            this.getValor_Campos(this.Registro);
            
            
        }
    }
    
    /* Gera os campos representados na classe Table no servidor.
     * Cria os campos em forma de formulário para preenchimento.
     * @returns {Generator|FormHTML.gerar_CAMPOSFormGrups.BaseGROUPS|String}
     */
    gerar_CAMPOSFormGrups(){
        let CAMPOS = this.ResultSet.Campos;
        /*
         * Representa os campos da classe que tem como componente o inputbox
         * @type String
         */
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
        /*
         * Representa os campos da classe que tem como componente o select
         * @type String
         */      
        let BaseGroup_Select = '<div class="form-group"  style="'+ this.Configuracoes.form_group.style +';{ROTULO_style_por_campo};">'+
                                      '<label for="{ROTULO_id}">{ROTULO_Nome}</label>'+
                                      '<select class="form-control {ROTULO_SELECTD2}" \n\
                                            style="{ROTULO_style}" \n\
                                            id="SELECT_'+ this.ResultSet.Indexador +'_{ROTULO_id}"\n\
                                            name="{ROTULO_id}" \n\
                                            aria-hidden="true">'+
                                            '{ROTULO_ITENS}'+
                                      '</select>'+
                                '</div>';
        
        
        let BaseGROUPS = "", Count = 0;;
        
        for(let i of CAMPOS){
            let Keys          = i[3]
            , Label           = i[1]
            , Placeholder     = i[8].Placeholder
            , FNome           = i[8].Name
            , Componente      = i[8].TypeComponente
            , Tipo_Conteudo   = i[8].TypeConteudo
            , Required        = i[8].Required == true ? "required='true'" : ""
            , Title           = i[8].Titles
            , Patterns        = i[8].Patterns != "" ? "pattern='"+ i[8].Patterns + "'" : ""
            , Leitura         = i[8].readonly == true ? "readonly" : ""
            , Maxlength       = i[8].maxlength
            , Max             = i[8].max
            , Min             = i[8].min
            , Size            = i[8].size
            , Style           = i[8].style
            , Opcoes          = null;
            
            if(Componente === "inputbox"){
                    if(i[8].Exibir){
                        
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
                }else if(i[8].TypeComponente === "select"){
                    if(i[8].Exibir){
                            /* Chave estrangeira
                          * Verifica se o campo faz referência a outro campo.
                          */
                         if(!i[19].TExt){
                             Tipo_Conteudo.forEach(function(v,i,p){
                                 Opcoes += "<option selected>"+ v +"</option>";
                             });                        
                         }


                         BaseGROUPS += BaseGroup_Select
                                                             .replace(/{ROTULO_Nome}/ig, Label)
                                                             .replace(/{ROTULO_id}/ig, FNome)
                                                             .replace(/{ROTULO_required}/ig, Required)
                                                             .replace(/{ROTULO_leitura}/ig, Leitura)
                                                             .replace(/{ROTULO_size}/ig, Size)
                                                             .replace(/{ROTULO_style}/ig, Style)
                                                             .replace(/{ROTULO_style_por_campo}/ig, this.Configuracoes.form_group.Campos[Count] + ";" + this.Configuracoes.form_group.For_by_Form[Count])
                                                             .replace(/{ROTULO_ITENS}/ig, Opcoes);
                         if(i[19].TExt){
                             BaseGROUPS = BaseGROUPS.replace(/{ROTULO_SELECTD2}/ig, "SELECTD2");
                         }else{
                             BaseGROUPS = BaseGROUPS.replace(/{ROTULO_SELECTD2}/ig, "");
                         }
                    }
                    
            }
        }
        
        
        return BaseGROUPS;
    }
    
    /* -1 para levar em conta o zero do array
     * Atributo que representa o registro a ser representado no formulário. 
     */
    set setRegistro(n){
        this.Registro = n - 1;
    }
        
    async update(F, o){
       let rsp = await o.Enviar_Update(F);
       if(rsp){
            await this.show(); //Somente após a atualização de todas as linhas;
            Toast.fire({
                icon: 'success',
                title: 'Os dados foram salvos.'
              })
       }else{
           
       }
    }
    async inserir(F, o){
       let rsp = await o.Enviar_Inserir(F);

       if(rsp){
           
            await this.show(); //Somente após a atualização de todas as linhas;
            Toast.fire({
                icon: 'success',
                title: 'Os dados foram salvos.'
              })
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
        
        var TratarResposta = "";
        
        event.preventDefault();
        var Campos = [];
        Campos = $(F.currentTarget).serializeArray();
        this.DadosEnvio.sendCamposAndValores = Campos;
        this.DadosEnvio.sendModoOperacao = "1b24931707c03902dad1ae4b42266fd6"
        ;
        this.DadosEnvio.sendChavesPrimarias = this.getBreakChaves(this.ChavesPrimarias);
        
        TratarResposta = await this.Atualizar();
        
        if(TratarResposta.Error != false){
            this.TratarErros(TratarResposta);
            return false;
        }else{
            return true;
        }
    }
    async Enviar_Inserir(F){
        
        var TratarResposta = "";
        
        event.preventDefault();
        var Campos = [];
        Campos = $(F.currentTarget).serializeArray();
        this.DadosEnvio.sendCamposAndValores = Campos;
        this.DadosEnvio.sendModoOperacao = "5a59ffc82a16fc2b17daa935c1aed3e9";
        
        TratarResposta = await this.Atualizar(false);
        
        if(TratarResposta.Error != false){
            this.TratarErros(TratarResposta);
            return false;
        }else{
            return true;
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
    
    async obter_Valor_RESULTADO(o){
        let RESULT = this.ResultSet.ResultDados;
        return RESULT[this.Registro][0];
    }  
    
    getValor_Campos(n){
        try{
            let CAMPOS = this.ResultSet.Campos,
                RESULT = this.ResultSet.ResultDados,
                Total  = RESULT.length,
                o = this;
            if(this.DadosEnvio.sendModoOperacao === "5a59ffc82a16fc2b17daa935c1aed3e9"){
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
                                   let idx = RESULT[n][CAMPOS[i][19].CamposTblExtrangeira[0]];
                                   let valor = RESULT[n][CAMPOS[i][19].CamposTblExtrangeira[2]];
                                   
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
                        text: "O registro não foi encontrado",
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
        let Tabela_Original = null, ModoOperacao_Original = null;
       /*
        * Tabelas e modo de operação originais, pois usa-se o mesmo controle para mais de uma funcionalidade
        */ 
        Tabela_Original = this.DadosEnvio.sendTabelas;
        ModoOperacao_Original = this.DadosEnvio.sendModoOperacao;
        
        this.DadosEnvio.sendTabelas = Config_FOREGIN.Tabela;
        
        
        if(!_TERM){
            this.DadosEnvio.Filtros  = [[Config_FOREGIN.IdxCampoVinculado,"=",_TERM]];            
        }else{
            this.DadosEnvio.Filtros  = [false, false, false];
        }

        this.DadosEnvio.sendPagina = options.data.Prox_pagina;
        /*
         * Restabelecimento das operações originais;
         */
        this.DadosEnvio.sendModoOperacao = "ab58b01839a6d92154c615db22ea4b8f";
        TratarResposta = await this.Atualizar(false);
        
        this.DadosEnvio.sendTabelas =  Tabela_Original;
        this.DadosEnvio.sendModoOperacao = ModoOperacao_Original;
        
        if(TratarResposta.Error != false){
            this.TratarErros(TratarResposta);
            return false;
        }else{
            TratarResposta.Dados_Campo_Foreign = Config_FOREGIN; //Envia os dados para criar a tabela da chave estrangeria no componente;
            return TratarResposta;
        }
    }
    
    CriarFormulario(){
        let o = this;
        let BaseFormulario =  '<section class="content">'+
                        '<div class="container-fluid">'+
                          '<div class="row">'+
                            '<div class="col-md-12">'+
                              '<!-- jquery validation -->'+
                              '<div class="card card-primary">'+
                                '<div class="card-header">'+
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
                                    '<button type="submit" class="btn btn-primary">'+ this.Nome_Submit + '</button>'+
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
              
        $("#" + this.Recipiente).html(BaseFormulario);
        
        if(this.DadosEnvio.sendModoOperacao == "1b24931707c03902dad1ae4b42266fd6"){
            
            $("#FORM_" + this.ResultSet.Indexador).submit(function(e){
                event.preventDefault();
                o.confirme_Atualizacao(e);
            });
        }else{
            $("#FORM_" + this.ResultSet.Indexador).submit(function(e){
                event.preventDefault();
                o.confirme_Insercao(e);
            });
        }
;
        
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
                        
                        if(Pagina_Atual <= Total_Pagina){
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
    }
}
