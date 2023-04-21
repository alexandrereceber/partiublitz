async function Efetuar_Logoff(){
    
    var Dados = new JSController(Padrao.getHostServer() + "/blitz/Logoff/"), Result = "";
    Dados.DadosEnvio.Logoff = true;

    Result = await Dados.Atualizar();
    window.location = "Logar";
    
}

$(".button-Logout").click(async function(){
    Efetuar_Logoff();
});