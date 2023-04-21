<?php
/**
 * Possue algumas configurações, muito importantes, sobre o sistema. Exm.: Nome e senha da base de dados, nome do
 * banco de dados que será utilizado pelo sistema e outras configurações.
 */
include_once dirname(__DIR__) ."/../Config/Configuracao.php"; 

/**
 * Inclui o modelo abstrato de uma tabela no banco de dados.
 */
if(@!include_once ConfigSystema::get_Path_Systema() . '/BancoDados/TabelasBD/ModeloTabelas.php'){ 
    $ResultRequest["Erros"]["Modo"]        = "Include";
    $ResultRequest["Erros"][0]             = true;
    $ResultRequest["Erros"][1]             = 7000;
    $ResultRequest["Erros"][2]             = "O arquivo de configuração do modelo de tabela não foi encontrado.";
    
    echo json_encode($ResultRequest);
    exit;
}; 
/**
 * Inclui o modelo abstrato de uma procedure no banco de dados.
 */
if(@!include_once ConfigSystema::get_Path_Systema() . '/BancoDados/TabelasBD/ModeloProcedures.php'){ 
    $ResultRequest["Erros"]["Modo"]        = "Include";
    $ResultRequest["Erros"][0]             = true;
    $ResultRequest["Erros"][1]             = 8000;
    $ResultRequest["Erros"][2]             = "O arquivo de configuração do modelo de procedures não foi encontrado.";
    
    echo json_encode($ResultRequest);
    exit;
}; 

/**
 * Classe que será utilizada para todo o sistema que exija login.
 * Essa classe poderá ser alterada de maneira a se encaixar no modelo atual de login.
 *
 * @author 04953988612
 */
class Teste extends ModeloProcedures{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Saidas = "@Saida, @s2";
    private $Privilegios = [["blitz","Select/Execute"]];
    private $StringSQL = null;
    
//
//    public function getArrayDados() {
//        $Preparacao = parent::query($this->StringSQL);
//        $Preparacao = parent::query("SELECT $this->Saidas");
//        return $Preparacao->fetch();
//    }

    public function Jobs($Tipo, &$ConjuntoDados, $Action, $Resultado) {
        
    }

    public function NormalizarFiltro($Func) {
        
    }

    public function getNomeReal() {
        return __CLASS__;
    }

    public function getPrivBD() {
        return false;
    }

    public function getPrivilegios() {
        return $this->Privilegios;
    }

    public function getVirtual() {
        return false;
    }

    public function setNomeProcedure() {
        $this->NomeProcedures = __CLASS__;
    }

    public function validarConteudoCampoRegex(&$Dados) {
        
    }

    public function getSaidas() {
        return $this->Saidas;
    }

}

class Contagem extends ModeloProcedures{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Saidas = "@ttEquip, @ttCPU, @ttNOT, @ttIMP";
    private $Privilegios = [["blitz","Select/Execute"]];
    private $StringSQL = null;
    
//
//    public function getArrayDados() {
//        $Preparacao = parent::query($this->StringSQL);
//        $Preparacao = parent::query("SELECT $this->Saidas");
//        return $Preparacao->fetch();
//    }

    public function Jobs($Tipo, &$ConjuntoDados, $Action, $Resultado) {
        
    }

    public function NormalizarFiltro($Func) {
        
    }

    public function getNomeReal() {
        return __CLASS__;
    }

    public function getPrivBD() {
        return false;
    }

    public function getPrivilegios() {
        return $this->Privilegios;
    }

    public function getVirtual() {
        return false;
    }

    public function setNomeProcedure() {
        $this->NomeProcedures = __CLASS__;
    }

    public function validarConteudoCampoRegex(&$Dados) {
        
    }

    public function getSaidas() {
        return $this->Saidas;
    }

}