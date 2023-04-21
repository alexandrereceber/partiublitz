<?php
/**
 * Criado: 29/09/2018
 * Modificado: 
 */
/**
 * Recebe todas as requisições referentes à banco de dados.
 * @Autor 04953988612
 */

//ini_set('display_errors',1);
//ini_set('display_startup_erros',1);
error_reporting(0);

if(@!include_once "./Cabecalho_Procedures.php"){ //Include que contém configurações padrões do sistema.
    $ResultRequest["Modo"]        = "Include";
    $ResultRequest["Error"]       = true;
    $ResultRequest["Codigo"]      = 13000;
    $ResultRequest["Mensagem"]    = "O arquivo de configuração não foi encontrado. ";
    
    echo json_encode($ResultRequest);
    exit;
}; 
$Entradas = (filter_input(INPUT_POST, "sendEntradas") == "") ? false : filter_input(INPUT_POST, "sendEntradas");
$ExibirSaida = boolval((filter_input(INPUT_POST, "sendGerarSaida") == "false") ? false : filter_input(INPUT_POST, "sendGerarSaida"));

if($Entradas != "")
    $Entradas = preg_replace("/-/", ",", $Entradas);

try{
    $StoreProcedure = new $Procedure($Entradas);
    $StoreProcedure->StartClock();
    $StoreProcedure->setEntrada($Entradas);
    $StoreProcedure->setUsuario("blitz");
    $StoreProcedure->Execute();
    $StoreProcedure->EndClock();
    

    
    if($ExibirSaida){
        $ResultRequest["Modo"]             = "S";
        $ResultRequest["Error"]             = false;
        $ResultRequest["NomeProcedure"]     = ProcedureBancoDadosMD5::getProcedureForMD5($Procedure);
        $ResultRequest["ResultDados"]       = $StoreProcedure->getArrayDados();
        $ResultRequest["Campos"]            = $StoreProcedure->getInfoCampos();
        $ResultRequest["Formato"]          = "JSON";
        $ResultRequest["Indexador"]         = time();
        $ResultRequest["ChavesPrimarias"]   = [];
        $ResultRequest["Paginacao"]         = ["PaginaAtual"];
        $ResultRequest["InfoPaginacao"]     = $StoreProcedure->getInfoPaginacao();
        $ResultRequest["Botoes"]            = $StoreProcedure->getBotoes();
        $ResultRequest["ContadorLinha"]     = false;
        $ResultRequest["OrdemBy"]           = [false];
        $ResultRequest["Filtros"]           = [[false],[false],[false]];
        $ResultRequest["ShowColumnsIcones"] = $StoreProcedure->showColumnsIcones();
        $ResultRequest["FuncoesGenericas"]  = $StoreProcedure->getFuncoesGenericas();

    }else{
        $ResultRequest["Modo"]             = "FUNC_EXEC";
        $ResultRequest["Error"]             = false;
    }
    
    $ResultRequest["Formato"]           = "JSON";
            
    
   /**
    * Armazena o tempo gasto com o processamento até esse ponto. Select
    */
    ConfigSystema::getEndTimeTotal();
    $ResultRequest["TempoTotal"]["BancoDados"]  = $StoreProcedure->getTempoTotal();
    $ResultRequest["TempoTotal"]["SitemaTotal"] = ConfigSystema::getTimeTotal();
    echo json_encode($ResultRequest);
    
} catch (Exception $ex) {
    $ResultRequest["Modo"]      = "PCD";
    $ResultRequest["Error"]     = true;
    $ResultRequest["Codigo"]    = $ex->getCode();
    $ResultRequest["Mensagem"]  = $ex->getMessage();
    $ResultRequest["Tracer"]    = $ex->getTraceAsString();
    $ResultRequest["File"]      = $ex->getFile();

    echo json_encode($ResultRequest);
}