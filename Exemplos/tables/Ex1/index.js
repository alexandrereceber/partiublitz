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

/**
 * Modo de visualização padão sem nenhuma configuração especial, somente mapeamento dos campos
 * @type TabelaHTML
 */

var t = new TabelaHTML(Padrao.getHostServer() +"/blitz/ControladorTabelas/");
/**
 * Nome da tabela que esta no formato MD5 no arquivo de configuração Config/Configuracao.php
 * @type String
 */
t.setTabela = "83849cf6295498c96deb555e00f4c779";
t.setRecipiente = "dados";
t.Name = "t";
//t.CSSEspefTableBD[0].Cabecalho.thead = "CabtheadModelHoriz"
//t.CSSEspefTableBD[0].Cabecalho.th = "CabthModelHoriz"
//t.CSSEspefTableBD[0].Cabecalho.td = "CabtdModelHoriz"
//t.CSSEspefTableBD[0].Cabecalho.tr = "CabtrModelHoriz"
//
//t.CSSEspefTableBD[1].Corpo.tbody = "bodytheadModelHoriz"
//t.CSSEspefTableBD[1].Corpo.tr = "bodytrModelHoriz"
//t.CSSEspefTableBD[1].Corpo.td = "bodytdModelHoriz"

//t.GeralTableClass = "";
t.Funcoes.Conteudo = function(a,n,c, linha){
    switch (n) {
        case "3":
            
            return `<div style='display:inline-block; width:30%; text-align: center'>2</div><div style='display:inline-block; width:70%'>1</div>`;
            break;
            
        case "2":
            let ChavePrimaria = a.getValorChave(a.ResultSet.ResultDados[linha]);
            return '<form id="formulario" onsubmit="'+ a.NomeInstancia +'.EnviarFormularioEditar(this)"><div class="bootstrap-switch-on bootstrap-switch bootstrap-switch-wrapper bootstrap-switch-animate" style="width: 86px;">\n\
                        <div class="bootstrap-switch-container" style="width: 126px; margin-left: 0px;">\n\
                            <input type="checkbox" data-chavePrimaria="' + ChavePrimaria +'" defaultChecked="false" defaultValue="0" name="checkin" checked="'+ (c == 1 ? "true" : "false") +'" value="'+ c +'" data-bootstrap-switch="">\n\
                        </div>\n\
                    </div></form>';
            break;
            
        default:
            return c;
            break;
    }
    
}
/*As funções já implementão o async na origem:
 * __Exec: async function(Params, MOMENT, OBJECT_INSTANCIA_FORMULARIO)
 * Instruções são executadas, antes e após a busca dos dados no servidor.
 * BEFORE e AFTER são executadas antes do atualizar() e depois do show();
 * */
/*
 * n = ACTION
 * m = MOMENTO - BEFORE - AFTER
 * p = DADOS
 * q = CAMPOS
 */
t.addFunctons_Eventos("SELECT_AFTER",function(n,m,p,q){
    
   $("input[data-bootstrap-switch]").each(function(e,n){
            $(this).bootstrapSwitch('state', parseInt(this.value));
            $(this).bootstrapSwitch('onSwitchChange', async function(e){
                let yy = $(this).bootstrapSwitch('state');
                let Objeto = p;
                Objeto.DadosEnvio.sendModoOperacao = "1b24931707c03902dad1ae4b42266fd6";
                Objeto.DadosEnvio.sendCamposAndValores = [{name: "chekins", value: (yy == true ? 1 : 0)}];
                Objeto.DadosEnvio.sendChavesPrimarias = Objeto.getBreakChaves(this.dataset.chaveprimaria);
                await Objeto.Atualizar();
                await Objeto.show();
            });
        });
        

   return true;
});


/**
 * O array deve ser feito no local da chamada, caso não coloque, não havera busca por um a sim executar todas
 */
t.addFunctons_LOAD("NOMEQUALQER1",function(n,m){
    alert(1)
});

t.addFunctons_LOAD("NOMEQUALQER2",function(n,m){
    alert(2)
});

t.show();

