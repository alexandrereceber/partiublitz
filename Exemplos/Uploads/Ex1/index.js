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
var t = new FormHTML(Padrao.getHostServer() +"/blitz/ControladorTabelas/");
/**
 * Nome da tabela que esta no formato MD5 no arquivo de configuração Config/Configuracao.php
 * @type String
 */
t.setTabela = "83849cf6295498c96deb555e00f4c777";
t.setRecipiente = "dados";
t.setNome_BtSubmit = "Enviar";

//t.Configuracoes.card_body.style= "display: flex; "
/*Configuração dos grupos do card, afeta todos os form-group*/
//t.Configuracoes.form_group.style= " margin-right: 15px"

/*Configuração dos grupos do card, afeta cada campo da tabela e é agrupado com a configuração acima*/
//t.Configuracoes.form_group.Campos[0]= "";
//t.Configuracoes.form_group.Campos[1]= "display: inline-block;";
//t.Configuracoes.form_group.Campos[2]= "display: inline-block; margin-left: 10px";
//t.Configuracoes.form_group.Campos[3]= "display: inline-block; margin-left: 10px";
t.Configuracoes.form_group.For_by_Form[0]= "display: grid";
//t.Configuracoes.form_group.Campos[4]= "display: inline-block; margin-left: 10px";
//t.Configuracoes.form_group.Campos[5]= "display: inline-block; margin-left: 10px";
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
t.setGrupos = g;
t.addFunctons_Eventos("Nome", function(e,n,p){
    console.log(e,n,p)
});
//t.setRegistro = 0; //cuidado, sempre é subtraído em 1 dentro do método.
t.Filtros = [[0,"=",5]]
t.Modo_Operacao = "E";

t.show();
 