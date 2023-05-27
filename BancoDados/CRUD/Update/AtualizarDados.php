<?php

/**
 * @author Alexandre José da Silva Marques
 * @Criado: 09/11/2018
 * @filesource
 * 
 */

try{
    $ChavesPrimarias    = $_REQUEST["sendChavesPrimarias"];
    $Dados              = $_REQUEST["sendCamposAndValores"];
    /*
     * Informa que não será executado a instrução de inserir pré-construída e sim por uma função anônima
     */
    $NG = $_REQUEST["sendAtualizar1N"] == "" ? 1 : "N";

    if(!is_array($ChavesPrimarias) || !is_array($Dados)){
        throw new Exception("Falta Campos");
    }

    if(empty($Tabela)) throw new Exception("Nenhuma tabela foi definida, favor entrar em contato com o administrador.", 4000);
    if(!class_exists($Tabela)) throw new Exception("A classe que representa essa tabela não foi encontrada.", 4001);

    $AtualizarDados = new $Tabela();
    $AtualizarDados->StartClock();
    $AtualizarDados->setUsuario("blitz");
    $AtualizarDados->setUsuarioLogado($SystemUsuario);
    $AtualizarDados->setIDUsuario($IDUserName);
    /*
     * Inicia um bloco de transação que é atômico, caso alguma instrução retorne false ou um thrown tudo será desfeito.
     */
    $AtualizarDados->beginTransaction();
    $Result = $AtualizarDados->AtualizarDadosTabela($ChavesPrimarias, $Dados, $NG);
    /*
     * Verifica se ocorreu algum erro em alguma das funções anônimas.
     */
    if($Result == false) {
        $AtualizarDados->rollback();
        throw new PDOException("A instrução SQL para atualizar dados retornou erros ou algum erro na transação.", 2001);
        
    }
    /*
     * Caso não tenha ocorrido nenhuma falha ou erro o sistema será commitado.
     */
    $AtualizarDados->commit();
    
    $AtualizarDados->EndClock();
    $ResultRequest["Modo"]             = "U";
    $ResultRequest["Error"] = false;
   /**
    * Armazena o tempo gasto com o processamento até esse ponto. Atualizar Dados
    */
    ConfigSystema::getEndTimeTotal();
    $ResultRequest["TempoTotal"]["BancoDados"]   =  $AtualizarDados->getTempoTotal();
    $ResultRequest["TempoTotal"]["SitemaTotal"]  = ConfigSystema::getTimeTotal();

    echo json_encode($ResultRequest);

} catch (Exception $ex) {

    $ResultRequest["Modo"] = "U";
    $ResultRequest["Error"]     = true;
    $ResultRequest["Codigo"]    = $ex->getCode();
    $ResultRequest["Mensagem"]  = $ex->getMessage();
    $ResultRequest["Tracer"]     = $ex->getTraceAsString();
    $ResultRequest["File"]      = $ex->getFile();

    echo json_encode($ResultRequest);
}