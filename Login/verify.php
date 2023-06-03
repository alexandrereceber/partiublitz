<?php

/* 
 * Verifica o usuário e senha
 * Esquema da tabela que deverá ser criada em todos os banco de dados para o login e cadastro de usuário
 * * 
 * CREATE TABLE `login` (
 `idLogin` int(11) NOT NULL AUTO_INCREMENT,
 `usuario` varchar(50) NOT NULL,
 `senha` varchar(100) NOT NULL,
 `tipousuario` enum('Comum','Gerente','Administrador') NOT NULL,
 `habilitado` bit(1) NOT NULL,
 `tentativa` tinyint(4) NOT NULL,
 `dtCriado` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
 PRIMARY KEY (`idLogin`),
 UNIQUE KEY `usuario` (`usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1
 */


/**
 * Criado: 30/10/2018
 * Modificado: 
 */
/**
 * Recebe todas as requisições referentes ao login.
 * @Autor 04953988612
 */

error_reporting(0);
if(@!include_once "../Config/Configuracao.php"){ //Include que contém configurações padrões do sistema.
    $ResultRequest["Modo"]        = "Include";
    $ResultRequest["Error"]       = true;
    $ResultRequest["Codigo"]      = 14000;
    $ResultRequest["Mensagem"]    = "O arquivo de configuração não foi encontrado.";
    
    echo json_encode($ResultRequest);
    exit;
}; 

/**
 * Inclui o arquivo que contém as classes com o nome das tabelas do banco de dados AcessoBancoDados::get_BaseDados()
 */
if(!@include_once ConfigSystema::get_Path_Systema() . '/BancoDados/TabelasBD/'. AcessoBancoDados::get_BaseDados() .'.php'){
    $ResultRequest["Modo"]        = "Include";
    $ResultRequest["Error"]       = true;
    $ResultRequest["Codigo"]      = 14001;
    $ResultRequest["Mensagem"]    = "A configuração do banco de dados não foi encontrado.";
    
    echo json_encode($ResultRequest); 
    exit;
}

/**
 * Armazena o tempo inicial do processamento.
 */
ConfigSystema::getStartTimeTotal();

$URL            = filter_input(INPUT_GET, "URL");
$Requisicao     = filter_input(INPUT_GET, "Req");
$Metodo         = filter_input(INPUT_GET, "URL");
$SSL            = filter_input(INPUT_GET, "Metodo");
$Usuario        = filter_input(INPUT_POST, "sendUsuario");
$Senha          = md5(filter_input(INPUT_POST, "sendSenha"));
$Dispositivo    = filter_input(INPUT_POST, "sendDispositivo");

//$IP = $_SERVER;
//$myfile = fopen("rastro.txt", "w");
//fwrite($myfile, $_SERVER["REMOTE_ADDR"]);
try {
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

    $SelecionarDados = new login();

    $SelecionarDados->setUsuario("NADA");
    $SelecionarDados->setTipoUsuario("QUALQUER");
    /**
     * Instrução que verifica se o sistema irá autenticar o usuário pelo conjunto usuário e senha ou somente usuário.
     */
    if (ConfigSystema::getValidarSenha()){
        $FiltroCampos = [
                            [
                                [
                                    0=>1,
                                    1=>"=",
                                    2=>$Usuario
                                ],
                                [
                                    0=>2,
                                    1=>"=",
                                    2=>$Senha,
                                    3=> 1
                                ]
                            ]
                        ];
    }else{
        $FiltroCampos = [
                            [
                                [
                                    0=>1,
                                    1=>"=",
                                    2=>$Usuario
                                ]
                            ]
                        ];
    }
    
    $SelecionarDados->setFiltros($FiltroCampos);
    $SelecionarDados->Select();
    $Saida = $SelecionarDados->getArrayDados()[0];

    if($Saida == null){
        if(ConfigSystema::getValidarTentativas()){
            /**
             * Garante que as tentativas, sem sucesso, serão registradas para uso futuro.
             */
            $FiltroCampos = [
                                [
                                    [
                                        0=>1,
                                        1=>"=",
                                        2=>$Usuario
                                    ]
                                ]
                            ];

                $SelecionarDados->setFiltros($FiltroCampos);
                $SelecionarDados->Select();            
                $UserPSError = $SelecionarDados->getArrayDados()[0];
                if($UserPSError == null){
                    throw new Exception("O usuário não existe ou não está habilitado no sistema. Favor entrar em contato com o administrador.", 14004);
                    exit;                   
                }
                /**
                 * Verifica, antes de incrementar mais uma tentativa, se o usuário esta bloqueado.
                 */
                if($UserPSError[5] > ConfigSystema::getTentativasTotal()){
                            throw new Exception("Usuário bloqueado, favor entrar em contato com o administrador.", 14005);
                            exit;
                }

                $Tentativa = ++$UserPSError[5];
                $ChavesAtualizacao = [
                                        [
                                            0=>0, 
                                            1=>$UserPSError[0]]
                                    ];
                
                $Atualizar = [
                                [
                                    "name"=>"Tentativa",
                                    "value"=>$Tentativa]
                            ];
                $Atualizado = $SelecionarDados->AtualizarDadosTabela($ChavesAtualizacao,$Atualizar);
            }
            
        throw new Exception("Usuário ou senha inválidos.", 14006);
        exit;
    }
    /**
     * O sistema validará se o usuário esta habilitado ou não somente se a configuração, abaixo, estiver como true;
     */
    if(ConfigSystema::getValidarHabilitacao())
        if($Saida[4] != 1){
            throw new Exception("O usuário não existe ou não está habilitado no sistema. Favor entrar em contato com o administrador.", 14004);
            exit;
        }
    
    if(ConfigSystema::getValidarTentativas()){
        if($Saida[5] >= ConfigSystema::getTentativasTotal()){
            throw new Exception("Usuário bloqueado, favor entrar em contato com o administrador.", 14005);
            exit;
        }
    }
        
    /**
     * Verifica se houve autenticação e se houve excesso de tentativas.
     */
    if($Saida[5] > 0){
       /**
         * Garante que o contador será zerado, caso o usuário não bloquei por tentativas, ao efetivar o login.
         */
        $FiltroCampos = [
                            [
                                [
                                    0=>1,
                                    1=>"=",
                                    2=>$Usuario
                                ]
                            ]
                        ];

            $SelecionarDados->setFiltros($FiltroCampos);
            $SelecionarDados->Select();            
            $UserPSError = $SelecionarDados->getArrayDados()[0];

            $Tentativa = 0;
            $ChavesAtualizacao = [
                                    [
                                        0=>0, 
                                        1=>$UserPSError[0]]
                                ];

            $Atualizar = [
                            [
                                "name"=>"Tentativa",
                                "value"=>$Tentativa
                            ]
                        ];
            $SelecionarDados->AtualizarDadosTabela($ChavesAtualizacao,$Atualizar);
        }

    $SDados["Active"]   = true;
    $SDados["Cliente_Remoto"] = filter_input(INPUT_SERVER, "REMOTE_ADDR");
    $SDados["IDUsername"] = $Saida[0];
    $SDados["Username"] = $Usuario;
    $SDados["Password"] = $Senha;
    $SDados["Tusuario"] = $Saida[3];
    $SDados["Tempo"]    = time();
    $SDados["Tentativas"] = $Saida[5];
    $SDados["ID"]       = md5($Saida[1]);

    session_save_path( __DIR__ . "/../Account/Sessoes");

    session_id($SDados["ID"]);
    $AbrirSessao = session_start();
    /**
     * Verifica se já existe uma mesma sessão aberta. Caso exista o sistema apaga os dados anteriores;
     */
    $Ativo = $_SESSION[$SDados["ID"]]["Active"];
    $TipoLogin = ConfigSystema::getLoginsSimultaneos();
    
    /**
     * Loga somente em um equipamento
     */
    if($Ativo && $TipoLogin == 0){
        
        
        if(!@include_once ConfigSystema::get_Path_Systema() . '/Account/SDados.php'){
            $ResultRequest["Modo"]        = "Include";
            $ResultRequest["Error"]    = true;
            $ResultRequest["Codigo"]   = 11001;
            $ResultRequest["Mensagem"] = "Error sessão.";

            echo json_encode($ResultRequest); 
            exit;
        }
        $Chave = base64_encode(json_encode($SDados));
             
        $SD = new SessaoDados();
        $SD->setChaves($Chave);  
        
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
        }else{
            $SD->DestruirSessao();
            throw new Exception("Tempo de sessão expirado, favor efetuar login novamente!.", 11004);
        }
        
        $TUsuario = $SD->getTipoUser();
        $isTypeIgual = preg_match("/$TUsuario/i", $URL);
        if(!$isTypeIgual){
            $SD->DestruirSessao();
            $Server = $_SERVER["REMOTE_ADDR"];
            EnviarEmail($Usuario, "", "Usuários não estão sincronizados. $Server");

            throw new Exception("Usuários não estão sincronizados.", 11006);                
        }
    }
    /**
     * Loga em 1 equipamento, sendo a outra sessão derruaba.
     */
    else if($Ativo && $TipoLogin == 1){
        $_SESSION[$SDados["ID"]] = [];
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
    
    $_SESSION[$SDados["ID"]] = json_encode($SDados);
    $Chave = base64_encode(json_encode($SDados));
    
 switch ($Saida[3]) {
     case "Gerente":
         $ResultRequest["Error"] = false;
         $ResultRequest["Modo"] = "Login";
         $ResultRequest["Chave"] = $Chave;
         $ResultRequest["TipoUsuario"] = "Gerente";
         $ResultRequest["Tentativas"] = $SDados["Tentativas"];
         $ResultRequest["Header"] = ConfigSystema::getHttp_Systema(). $Saida[3] ."?s=" . $Chave;
         $ResultRequest["Apelido"] = $Saida[6];
         $ResultRequest["Imagem"] = $Saida[7];
         $ResultRequest["Habilitado"] = $Saida[4] == 1 ? true : false;

         
         echo json_encode($ResultRequest);
         break;

    case "Administrador":
         $ResultRequest["Error"] = false;
         $ResultRequest["Modo"] = "Login";
         $ResultRequest["Chave"] = $Chave;
         $ResultRequest["TipoUsuario"] = "Administrador";
         $ResultRequest["Tentativas"] = $SDados["Tentativas"];
         $ResultRequest["Header"] = ConfigSystema::getHttp_Systema(). $Saida[3] ."?s=" . $Chave;
         $ResultRequest["Apelido"] = $Saida[6];
         $ResultRequest["Imagem"] = $Saida[7];
         $ResultRequest["Habilitado"] = $Saida[4] == 1 ? true : false;


         echo json_encode($ResultRequest);
         break;
     
        case "Comum":
         $ResultRequest["Error"] = false;
         $ResultRequest["Modo"] = "Login";
         $ResultRequest["Chave"] = $Chave;
         $ResultRequest["TipoUsuario"] = "Gerente";
         $ResultRequest["Tentativas"] = $SDados["Tentativas"];
         $ResultRequest["Header"] = ConfigSystema::getHttp_Systema(). $Saida[3] ."?s=" . $Chave;
         $ResultRequest["Apelido"] = $Saida[6];
         $ResultRequest["Imagem"] = $Saida[7];
         $ResultRequest["Habilitado"] = $Saida[4] == 1 ? true : false;


         
         echo json_encode($ResultRequest);
         break;
     
     default:
         session_destroy();
            throw new Exception("Esse usuário foi autenticado, mas não possui nenhum perfil de acesso. Favor entrar em contato com o administrador.", 14007);
         break;
 }


} catch (Exception $ex) {
    $ResultRequest["Modo"]      = "Login";
    $ResultRequest["Error"]     = true;
    $ResultRequest["Codigo"]    = $ex->getCode();
    $ResultRequest["Mensagem"]  = $ex->getMessage();
    $ResultRequest["Tracer"]    = $ex->getTraceAsString();
    $ResultRequest["File"]      = $ex->getFile();

    echo json_encode($ResultRequest);
} 

