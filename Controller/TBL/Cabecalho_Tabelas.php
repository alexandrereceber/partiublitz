<?php

if(@!include_once __DIR__ . "/../../Config/Configuracao.php"){ //Include que contém configurações padrões do sistema.
    $ResultRequest["Modo"]        = "Include";
    $ResultRequest["Error"]    = true;
    $ResultRequest["Codigo"]   = 12000;
    $ResultRequest["Mensagem"] = "O arquivo de Configuração não foi encontrado.";
    
    echo json_encode($ResultRequest);
    exit;
}; 

/**
 * Inclui o arquivo que contém as classes com o nome das tabelas do banco de dados AcessoBancoDados::get_BaseDados()
 */
if(!@include_once ConfigSystema::get_Path_Systema() . '/BancoDados/TabelasBD/'. AcessoBancoDados::get_BaseDados() .'.php'){
    $ResultRequest["Modo"]        = "Include";
    $ResultRequest["Error"]    = true;
    $ResultRequest["Codigo"]   = 12001;
    $ResultRequest["Mensagem"] = "A configuração do banco de dados não foi encontrado.";
    
    echo json_encode($ResultRequest); 
    exit;
}

try{
    
    $DADOS_RECEBIDOS = filter_input(INPUT_POST, "DADOS_BUSCA");
    if($DADOS_RECEBIDOS == null){
        throw new Exception("Error de entrada!", 14008);
    }

    $DADOS_RECEBIDOS = json_decode($DADOS_RECEBIDOS, true);
    /**
     * Armazena o tempo inicial do processamento.
     */
    ConfigSystema::getStartTimeTotal();

    /**
     * Verifica se foi enviado, via post, a operação quer será realizada dentro do controllers. 
     * Ex: select, insert, delete, update
     */
    $URL            = filter_input(INPUT_GET, "URL");
    $Requisicao     = filter_input(INPUT_GET, "Req");
    $Metodo         = filter_input(INPUT_GET, "Metodo");
    $ESQUEMA        = filter_input(INPUT_SERVER, "REQUEST_SCHEME");
    $TabelaMD5      = $DADOS_RECEBIDOS["sendTabelas"];
    $Formato        = $DADOS_RECEBIDOS["sendRetorno"]  == "" ? "JSON" : $DADOS_RECEBIDOS["sendRetorno"]; //Atribui um formato padrão
    $Dispositivo    = $DADOS_RECEBIDOS["sendDispositivo"];
    $IPCliente      = filter_input(INPUT_SERVER, "REMOTE_ADDR");
    $Tabela         = TabelaBancoDadosMD5::getMD5ForTabela($TabelaMD5);    //Nome da tabela no banco de dados
    $Operacao       = OperacaoTable::getMD5ForOperacao($DADOS_RECEBIDOS["sendModoOperacao"]);      //CRUD
    
    if(ConfigSystema::getValidarDispositivo()){
        if(!$Dispositivo){
            throw new Exception("O dispositivo utilidado não foi informado.", 14002);
            exit;
                }
        if(!ConfigSystema::getDispositivos($Dispositivo)){
            throw new Exception("O dispositivo utilidado não é válido para esse sistema.", 14003);
            exit;
        }
    }
    
    if(empty($Operacao)) throw new Exception("Nenhuma operação foi definida, favor entrar em contato com o administrador.", 12002);

    
} catch (Exception $ex) {
        $ResultRequest["Modo"]      = "D";
        $ResultRequest["Error"]     = true;
        $ResultRequest["Codigo"]    = $ex->getCode();
        $ResultRequest["Mensagem"]  = $ex->getMessage();
        $ResultRequest["Tracer"]    = $ex->getTraceAsString();
        $ResultRequest["File"]      = $ex->getFile();

        echo json_encode($ResultRequest);
        exit;
}

    
/**
 * Verifise se o sistema está em sessão ou não, isso caso o sistema tenha acesso gerencial, caso não tenha poderá
 * setar a variável de sessão como false. 
 * Sessão => O sistema buscará o usuário e a senha tendo como requisito o login do usuário. 
 * Sem sessão => O sistema busca as informações sem necessidade de usuário ou senha.
 */
$Sessao = ConfigSystema::get_Sessao();
$SessaoTabela = TabelaBancoDadosMD5::getTabelaSessao($TabelaMD5);

/**
 * Para visualização dos dados por usuário e senha tanto a sessão quanto a tabela deverão esta configurados como true;
 */
if($Sessao && $SessaoTabela){

    /**
     * Inclui o arquivo de classe que trata das sessões.
     */
    if(!@include_once ConfigSystema::get_Path_Systema() . '/Account/SDados.php'){
        $ResultRequest["Modo"]        = "Include";
        $ResultRequest["Error"]    = true;
        $ResultRequest["Codigo"]   = 3590;
        $ResultRequest["Mensagem"] = "Error sessão. Controller";

        echo json_encode($ResultRequest); 
        exit;
    }
    //obtém a chave que foi enviado pelo cliente.
    $_KEYS_GET = $DADOS_RECEBIDOS["sendChaves"];
    $_KEYS_POST = $DADOS_RECEBIDOS["enviarChaves"];
    $sendChave = empty($_KEYS_GET) == true ? $_KEYS_POST : substr($_KEYS_GET, 2);

    /**
     * $Dados_Sessao["SDados"]["Chave"]
     * 
     */
    $Dados_Sessao["Chave"] = $sendChave;

    $SD = new SessaoDados();

    try {
        
//        if($ESQUEMA !== "https"){
//            throw new Exception("Somente conexões protegidas.", 11007);
//        }
        
        $SD->setChaves($Dados_Sessao["Chave"]);

        /**
         * Verifica se já existe uma mesma sessão aberta. Caso exista o sistema apaga os dados anteriores;
         */
        $Ativo = $SD->getSessaoAtiva();
        $TipoLogin = ConfigSystema::getLoginsSimultaneos();

        /**
         * Loga somente em um equipamento
         */
        if($Ativo && $TipoLogin == 0){
            if($SD->startSessao()){
                $vd = $SD->Validar_UserName();
                if(!$vd){
                  $SD->DestruirSessao();
                  throw new Exception("Usuário inválido para essa sessão, favor entrar em contato com o administrador!.", 11002);  
                }

                $vt = $SD->ValidarTime();
                if(!$vt){
                      $ResultRequest["Modo"]      = "Login";
                      $ResultRequest["Error"]     = true;
                      $ResultRequest["Codigo"]    = 4055;
                      $ResultRequest["Mensagem"]  = "Usuário já está logado em outro sistema"; 
                      echo json_encode($ResultRequest); 
                      return false;  
                }

                $vts = $SD->ValidarTempoSessao();
                if(!$vts){
                    $ResultRequest["Modo"]      = "Login";
                    $ResultRequest["Error"]     = true;
                    $ResultRequest["Codigo"]    = 4055;
                    $ResultRequest["Mensagem"]  = "Usuário já está logado em outro sistema"; 
                    echo json_encode($ResultRequest); 
                    return false;
                }
                /**
                 * Usuário tentando elevar os privilégios com escalada, digitando o Administrador no lugar do Comum
                 */
                $TUsuario = $SD->getTipoUser();
                $isTypeIgual = preg_match("/$TUsuario/i", $Requisicao);
                if(!$isTypeIgual){
                    $SD->DestruirSessao();
                    throw new Exception("Usuários não estão sincronizados.", 11006);                
                }

            }else{
                $SD->DestruirSessao();
                throw new Exception("Login necessário, favor entrar em contato com o administrador!.", 11005);
            }
        }
        /**
         * Loga em 1 equipamento, sendo a outra sessão derruaba.
         */
        else if($Ativo && $TipoLogin == 1){
            
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
                $isTypeIgual = preg_match("/$TUsuario/i", $Requisicao);
                if(!$isTypeIgual){
                    $SD->DestruirSessao();
                    throw new Exception("Usuários não estão sincronizados.", 11006);                
                }

            }else{
                $SD->DestruirSessao();
                throw new Exception("Login necessário, favor entrar em contato com o administrador!.", 11005);
            }
        }
        /**
         * Loga em qualquer dispositivo sem qualquer tipo de validação.
         */
        else if($Ativo && $TipoLogin == 2){

        }
        /**
         * Destroe a sessão caso esteja sofrente algum tipo de ataque.
         */
        else if($Ativo && $TipoLogin > 2){
            throw new Exception("Tipo de login incorreto", 11006); 
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

            $ResultRequest["Modo"]      = "VL"; //Validação
            $ResultRequest["Error"]     = true;
            $ResultRequest["Codigo"]    = $exc->getCode();
            $ResultRequest["Mensagem"]  = $exc->getMessage();
            $ResultRequest["File"]      = "Cabecalho_Tabelas.php";
            $ResultRequest["Tracer"]    = "Linha 132";
            $ResultRequest["Dominio"]   =   ConfigSystema::getHttp_Systema();
            /**
             * Esse array armazena o endereço da página de login caso o usuário esteja tentando acesso sem esta logado via componente.
             */
            $ResultRequest["Error"][3]             = ConfigSystema::getHttp_Systema();
            echo json_encode($ResultRequest); 
            exit;

        }else{
            echo "<script>alert('". $exc->getMessage() ."'); window.location='". ConfigSystema::getHttp_Systema() ."'</script>";
            exit;
        }
    }


}

