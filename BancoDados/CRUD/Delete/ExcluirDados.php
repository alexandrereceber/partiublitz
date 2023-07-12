<?php

/**
 * @author Alexandre José da Silva Marques
 * @Criado: 09/11/2018
 * @filesource
 * 
 */

        
try{
    $ChavesPrimarias    = $DADOS_RECEBIDOS["sendChavesPrimarias"];

    if(!is_array($ChavesPrimarias)){
        throw new Exception("Nenhum dado foi avaliado!");
    }

    if(empty($Tabela)) throw new Exception("Nenhuma tabela foi definida, favor entrar em contato com o administrador.", 1000);
    if(!class_exists($Tabela)) throw new Exception("A classe que representa essa tabela não foi encontrada.", 1001);

    $ExcluirDados = new $Tabela();
    $ExcluirDados->StartClock();
    
    $ExcluirDados->setUsuario("blitz");
    
    if($Sessao && $SessaoTabela){
        $ExcluirDados->setUsuarioLogado($SystemUsuario);
        $ExcluirDados->setIDUsuario($IDUserName);
        $ExcluirDados->setTipoUsuario($TipoUsuario);        
    }else{
        $ExcluirDados->setUsuarioLogado("blitz");
        $ExcluirDados->setIDUsuario("blitz");
        $ExcluirDados->setTipoUsuario("blitz");
    }


    /*
    * Inicia um bloco de transação que é atômico, caso alguma instrução retorne false ou um thrown tudo será desfeito.
    */
    $ExcluirDados->beginTransaction();
    $Result = $ExcluirDados->ExcluirDadosTabela($ChavesPrimarias);

    /*
    * Verifica se ocorreu algum erro em alguma das funções anônimas.
    */
    if($Result == false) {
        $ExcluirDados->rollback();
        throw new PDOException("A instrução SQL para excluir dados retornou erros ou algum erro na transação.", 2001);
    }
    /*
    * Caso não tenha ocorrido nenhuma falha ou erro o sistema será commitado.
    */
    $ExcluirDados->commit();

    $ExcluirDados->EndClock();
    $ResultRequest["Modo"]             = "D";
    $ResultRequest["Error"] = false;
   /**
    * Armazena o tempo gasto com o processamento até esse ponto. Excluir Dados
    */
    $ResultRequest["TempoTotal"]["BancoDados"]   =  $ExcluirDados->getTempoTotal();
    $ResultRequest["TempoTotal"]["SitemaTotal"]  = ConfigSystema::getTimeTotal();

    echo json_encode($ResultRequest);

} catch (Exception $ex) {
    $ResultRequest["Modo"]      = "D";
    $ResultRequest["Error"]     = true;
    $ResultRequest["Codigo"]    = $ex->getCode();
    $ResultRequest["Mensagem"]  = $ex->getMessage();
    $ResultRequest["Tracer"]     = $ex->getTraceAsString();
    $ResultRequest["File"]      = $ex->getFile();

    echo json_encode($ResultRequest);
}

