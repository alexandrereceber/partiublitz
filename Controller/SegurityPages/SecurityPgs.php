<?php
/**
 * Date: 09/05/1981
 * Busca as informações relativas à máquina que está sendo requisitada.
 */

$myfile = fopen("rastros.txt", "w");
fwrite($myfile, $_SERVER["REMOTE_ADDR"]);
fclose($myfile);

if(@!include_once __DIR__ . "/../../Config/Configuracao.php"){ //Include que contém configurações padrões do sistema.
    $ResultRequest["Modo"]        = "Include";
    $ResultRequest["Error"]    = true;
    $ResultRequest["Codigo"]   = 11000;
    $ResultRequest["Mensagem"] = "O arquivo de Configuração não foi encontrado.";
    
    echo json_encode($ResultRequest);
    exit;
}; 

/**
 * Armazena o tempo inicial do processamento.
 */
ConfigSystema::getStartTimeTotal();
$URL            = filter_input(INPUT_GET, "URL");
$Requisicao     = filter_input(INPUT_GET, "Req");
$Metodo         = filter_input(INPUT_GET, "Metodo");
$ESQUEMA        = filter_input(INPUT_SERVER, "REQUEST_SCHEME");

/**
 * Verifise se o sistema está em sessão ou não, isso caso o sistema tenha acesso gerencial, caso não tenha poderá
 * setar a variável de sessão como false. 
 * Sessão => O sistema buscará o usuário e a senha tendo como requisito o login do usuário. 
 * Sem sessão => O sistema busca as informações sem necessidade de usuário ou senha.
 */
$Sessao = ConfigSystema::get_Sessao();

/**
 * Para visualização dos dados por usuário e senha tanto a sessão quanto a tabela deverão esta configurados como true;
 */
if($Sessao){

    /**
     * Inclui o arquivo de classe que trata das sessões.
     */
    if(!@include_once ConfigSystema::get_Path_Systema() . '/Account/SDados.php'){
        $ResultRequest["Modo"]        = "Include";
        $ResultRequest["Error"]    = true;
        $ResultRequest["Codigo"]   = 11001;
        $ResultRequest["Mensagem"] = "Error sessão.";

        echo json_encode($ResultRequest); 
        exit;
    }
    //obtém a chave que foi enviado pelo cliente.
    $_KEYS_GET = filter_input(INPUT_GET, "sendChaves");
    $_KEYS_POST = filter_input(INPUT_GET, "enviarChaves");
    
    $sendChave = empty($_KEYS_POST) == true ? substr($_KEYS_GET, 2) : $_KEYS_GET;

    /**
     * $Dados_Sessao["SDados"]["Chave"]
     * 
     */
    $Dados_Sessao["Chave"] = $sendChave;


    try {
        
//        if($ESQUEMA !== "https"){
//            throw new Exception("Somente conexões protegidas.", 11007);
//        }
        
        $SD = new SessaoDados();
        $SD->setChaves($Dados_Sessao["Chave"]);

        if($SD->startSessao()){
            $vd = $SD->Validar_UserName();
            if(!$vd){
              $SD->DestruirSessao();
              throw new Exception("Usuário inválido para essa sessão, favor entrar em contato com o administrador!.", 11002);  
            }

            $vt = $SD->ValidarTime();
            if(!$vt){
              $SD->DestruirSessao();
              throw new Exception("Tempos não estão sincronizados, favor entrar em contato com o administrador!.", 11003);  
            }

            $vts = $SD->ValidarTempoSessao();
            if(!$vts){
                $SD->DestruirSessao();
                throw new Exception("Tempo de sessão expirado, favor efetuar login novamente!.", 11004);
            }
            
            $TUsuario = $SD->getTipoUser();
            if($TUsuario !== $URL){
                $SD->DestruirSessao();
                throw new Exception("Usuários não estão sincronizados.", 11006);                
            }            
            
        }else{
            $SD->DestruirSessao();
            throw new Exception("Login necessário, favor entrar em contato com o administrador!.", 11005);
        }
        /*
         * Todas páginas que utilizarem esse sistema de segurança, obterão o nome de usuario através desta variável.
         */
        $SystemUsuario = $SD->getUsernameChave();
        $IDUserName = $SD->getIDUsername();
        $TipoUsuario = $SD->getTipoUsername();
        
    } catch (Exception $exc) {
        /**
         * O erro é tratado diferente para ambientes diferente como paginas e plugins.
         */
        if(!AmbienteCall::getCall()){

            $ResultRequest["Modo"]        = "VL"; //Validação
            $ResultRequest["Error"]    = true;
            $ResultRequest["Codigo"]   = $exc->getCode();
            $ResultRequest["Mensagem"] = $exc->getMessage();
            $ResultRequest["File"] =  "";            
            $ResultRequest["Tracer"] =  "";
            $ResultRequest["Dominio"] = ConfigSystema::getHttp_Systema();
            /**
             * Esse array armazena o endereço da página de login caso o usuário esteja tentando acesso sem esta logado via componente.
             */
            $ResultRequest["Error"][3]             = ConfigSystema::getHttp_Systema();
            echo json_encode($ResultRequest); 
            exit;

        }else{
            $Codigo = "
             <!DOCTYPE html>
                <html lang='en'>
                <head>
                  <meta charset='utf-8'>
                  <meta name='viewport' content='width=device-width, initial-scale=1'>

                  <title>Error</title>
                </head>
                <body></body>
                
                <script src='https://cdn.jsdelivr.net/npm/sweetalert2@11'></script>
                <script>
                        Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '". $exc->getMessage() . "',
                      }).then(ok => {window.location = '". ConfigSystema::getHttp_Systema() . "Logar'})
                      </script>
                </html>   ";
            
            echo $Codigo;
            //echo "<script>alert('". $exc->getMessage() ."'); window.location='". ConfigSystema::getHttp_Systema() . "Logar" ."'</script>";
            exit;
        }
    }


}

