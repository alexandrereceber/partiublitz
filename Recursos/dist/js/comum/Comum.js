'strict mode';


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

/* 
 * Implementação personalizada do módulo administrador.
 */

let TSTE = null;

if(TSTE === null){
    TSTE = new FormHTML(Padrao.getHostServer() +"/blitz/ControladorTabelas/");
}    
$("#__CONTENT_WRAPPER_MAIN_CONTAINER_FLUID_ROW").html('<div class="col-lg-12 col-12" id="T_CONTEUDO" style="height: 100%;overflow: auto;"></div>');

TSTE.setTabela = "6fa996b30e72b07d1a84794ba2437a26";
TSTE.setRecipiente = "T_CONTEUDO";
TSTE.setNome_BtSubmit = "Salvar";
TSTE.Modo_Operacao = "E";
TSTE.visible_Title = true;
TSTE.Configuracoes.div_content_section.style = "margin-top: 10px";
let g = {
            Groups: false
        };
        
TSTE.addFunctons_Eventos("VERIFICAR_PREENCHIMENTO", function(a,b,c,d){
    switch(a){
        case "UPDATE":
            if(b === "AFTER"){
                if(d === true){
                    window.location.reload();
                }
            }
            break;
    }
    
    return true;
});

TSTE.setGrupos = g;
TSTE.show();