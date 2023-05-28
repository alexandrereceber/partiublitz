<?php


/**
 * 
 * @author Alexandre José da Silva Marques
 * @Criado: 09/11/2018
 * @filesource
 * 
 */

try{
    $Dados = $_REQUEST["sendCamposAndValores"];  
    /*
     * Informa que não será executado a instrução de inserir pré-construída e sim por uma função anônima
     */
    $NG = $_REQUEST["sendInserir1N"] == "" ? 1 : "N";  
    
    if(!is_array($Dados)){
        throw new Exception("Falta Campos");
    }

    if(empty($Tabela)) throw new Exception("Nenhuma tabela foi definida, favor entrar em contato com o administrador.");
    if(!class_exists($Tabela)) throw new Exception("A classe que representa essa tabela não foi encontrada.", 2000);
    
    $InserirDados = new $Tabela();

    $InserirDados->StartClock();
    /**
     * Se a sessão for anônima deverá ser devinido um usuario e privilégios de acesso na tabela através
     * da variável privilegios em cada classe que representa a tabela.
     */
    $InserirDados->setUsuario("blitz");
    $InserirDados->setUsuarioLogado($SystemUsuario);
    $InserirDados->setIDUsuario($IDUserName);
    $InserirDados->setTipoUsuario($TipoUsuario);
    /*
     * Inicia um bloco de transação que é atômico, caso alguma instrução retorne false ou um thrown tudo será desfeito.
     */
    $InserirDados->beginTransaction();
    $Result = $InserirDados->InserirDadosTabela($Dados, $NG);
    
    if($Result == false) {
        $InserirDados->rollback();
        throw new PDOException("A instrução SQL para inserir dados retornou erros ou algum erro na transação.", 2001);
        
    }
    /*
     * Verifica se ocorreu algum erro em alguma das funções anônimas.
     */
    $InserirDados->commit();
    
    $InserirDados->EndClock();
    $ResultRequest["Modo"]             = "I";
    $ResultRequest["Error"] = false;
    $ResultRequest["lastId"] = $InserirDados->lastInsertId();

    /**
    * Armazena o tempo gasto com o processamento até esse ponto. Inserir dados
    */
    ConfigSystema::getEndTimeTotal();
    $ResultRequest["TempoTotal"]["BancoDados"]   =  $InserirDados->getTempoTotal();
    $ResultRequest["TempoTotal"]["SitemaTotal"] = ConfigSystema::getTimeTotal();

    echo json_encode($ResultRequest);

} catch (Exception $ex) {
    $ResultRequest["Modo"]      = "I";
    $ResultRequest["Error"]     = true;
    $ResultRequest["Codigo"]    = $ex->getCode();
    $ResultRequest["Mensagem"]  = $ex->getMessage();
    $ResultRequest["Tracer"]     = $ex->getTraceAsString();
    $ResultRequest["File"]      = $ex->getFile();

    echo json_encode($ResultRequest);
}
