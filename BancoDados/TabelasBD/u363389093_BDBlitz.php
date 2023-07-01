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
class login extends ModeloTabelas{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Campos =  [
           
            [
              /**
               * Esse índice é utilizado em todo o sistema, através dele o sistema pode buscar o nome, real do campo,
               * e outras informações.
               */
               "Index"          => 0,
               /**
                * Nome real do campo dentro da tabela no banco de dados. É utilizado pelo sistema para criar as intruções
                * SQL de CRUD.
                */
               "Field"          => "idLogin",
                
                "FieldFunc"=>[false,null],
               /**
                * É o nome que será utilizado no sistema como label ou sejá o nome que será exibido dentro da página.
                * Muito utilizado na formação dos campos de insersão e edição HTML.
                */
               "CodNome"        => "idLogin",
                /**
                 * Tipo de conteúdo e de campo que será utilizado para edição ou visualização dentro dos componentes
                 * Js na página WEB via HTML. Atualmente está mapeado o text e imagem no componente tableHTML. Mas os componentes poderão
                 * ser implementados com qualquer tipo, desde que cada um trate-os.
                 */
               "TypeConteudo"   => ["text"],
                /**
                 * Habilita ou não o uso de filtro pelo campo. [true|false]
                 */
               "Filter"         => [],       
                /**
                 * Informa ao sistema que o campo atual é uma chave primária e se ela será exibida ou não ao usuário.
                 */
               "Key"            => [true, false],
                /**
                 * Informa ao sistema que esse campo possue uma chave extrangeira vinculada.
                 */
               "ChvExt"         => [    
                                        /**
                                         * TExt - Tabela Extrangeira
                                         * Informa ao sistema que o campo atual possue uma tabela extrangeira.
                                         */
                                        "TExt" => false,
                                        /**
                                         * Nome da tabela extrangeira.
                                         */
                                        "Tabela"=> "",
                                        /**
                                         * Índice do campo da tabela extrangeira que está vinculado à este campo.
                                         */
                                        "IdxCampoVinculado"=> 0, 
                                        /**
                                         * Índice da função que representa esta relação.
                                         */
                                        "Funcao"=> 0,
                                        /**
                                         * Nome do botão que será exibido na tabela HTML.
                                         */
                                        "NomeBotao"=> ""
                                    ],
                /**
                 * Campo com funções ainda não definidos.
                 */
               "Mask"           => false,
                /**
                 * Informa ao sistema se o campo será editável ou não.
                 */
               "Editar"         => false,
                /**
                 * Informa se o campo será visível na tabela HTML.
                 */
               "Visible"        => true,
                /**
                 * Campo com utilização futura. Apesar do regexr ser implementado via método dentro de cada class.
                 */
               "Regex"          => ["Exist"=> false, "Regx"=> ""],
                /**
                 * Subarray - informa se o campo será atualizável
                 */
               "Formulario"     => [
                                        /**
                                         * Informa ao sistema que o campo será atualizável.
                                         */
                                        "Exibir"=> false,
                                        /**
                                         * Texto explicativo que ficará dentro do campo input type text
                                         */
                                        "Placeholder"=> "", 
                                        /**
                                         * Tipo de componente que será visualizado no formulário. inputbox, select
                                         */
                                        "TypeComponente"=>"",
                                        /**
                                         * Usado conjuntamente com o campo anterior.
                                         */
                                        "TypeConteudo"=> ["text"],
                                        /**
                                         * Nome do campo que será exportado para o controller, esse campo deverá ter o nome diferente do nome
                                         * original por motivo de segurança
                                         */
                                        "Name" => "", 
                                        /**
                                         * Regex do campo input text
                                         */
                                        "Patterns"=> "",
                                        /**
                                         * Informação que será exibida quando o cursor fixa em cima do componente.
                                         */
                                        "Titles" => "",
                                        /**
                                         * Campo terá preenchimento obrigatório.
                                         */
                                        "Required" => "",
                                        /**
                                         * Tamanho do campo
                                         */
                                        "width" => "50px",
                                        "height"=>"",
                                        /**
                                         * Salto dos números na caixa do tipo number
                                         */
                                        "step"=>"",
                                        /**
                                         * 
                                         */
                                        "size"=>"",
                                        /**
                                         * Número mínimo dentro da caixa do tipo number
                                         */
                                        "min"=>"",
                                        /**
                                         * Número máximo dentro da caixa do tipo number
                                         */
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        /**
                                         * Autofocus
                                         */
                                        "autofocus"=> true,
                                        "checked"=>"",
                                        "dirname"=>"",
                                        /**
                                         * Campo será somente leitura
                                         */
                                        "readonly"=>""
                                    ],
               /**
                * Informa ao sistema que o campo deverá, via tabela html, a opção de ordernar o campo.
                */
               "OrdemBY"        => true
           ]   ,
            [
              /**
               * Esse índice é utilizado em todo o sistema, através dele o sistema pode buscar o nome, real do campo,
               * e outras informações.
               */
               "Index"          => 1,
               /**
                * Nome real do campo dentro da tabela no banco de dados. É utilizado pelo sistema para criar as intruções
                * SQL de CRUD.
                */
               "Field"          => "usuario",
               /**
                * É o nome que será utilizado no sistema como label ou sejá o nome que será exibido dentro da página.
                * Muito utilizado na formação dos campos de insersão e edição HTML.
                */
               "CodNome"        => "Usuário",
                /**
                 * Tipo de conteúdo e de campo que será utilizado para edição ou visualização dentro dos componentes
                 * Js na página WEB via HTML. Atualmente está mapeado o text e imagem no componente tableHTML. Mas os componentes poderão
                 * ser implementados com qualquer tipo, desde que cada um trate-os.
                 */
               "TypeConteudo"   => ["text"],
                /**
                 * Habilita ou não o uso de filtro pelo campo. [true|false]
                 */
               "Filter"         => [],       
                /**
                 * Informa ao sistema que o campo atual é uma chave primária e se ela será exibida ou não ao usuário.
                 */
               "Key"            => [false, false],
                /**
                 * Informa ao sistema que esse campo possue uma chave extrangeira vinculada.
                 */
               "ChvExt"         => [    
                                        /**
                                         * TExt - Tabela Extrangeira
                                         * Informa ao sistema que o campo atual possue uma tabela extrangeira.
                                         */
                                        "TExt" => false,
                                        /**
                                         * Nome da tabela extrangeira.
                                         */
                                        "Tabela"=> "",
                                        /**
                                         * Índice do campo da tabela extrangeira que está vinculado à este campo.
                                         */
                                        "IdxCampoVinculado"=> 0, 
                                        /**
                                         * Índice da função que representa esta relação.
                                         */
                                        "Funcao"=> 0,
                                        /**
                                         * Nome do botão que será exibido na tabela HTML.
                                         */
                                        "NomeBotao"=> ""
                                    ],
                /**
                 * Campo com funções ainda não definidos.
                 */
               "Mask"           => false,
                /**
                 * Informa ao sistema se o campo será editável ou não.
                 */
               "Editar"         => false,
                /**
                 * Informa se o campo será visível na tabela HTML.
                 */
               "Visible"        => true,
                /**
                 * Campo com utilização futura. Apesar do regexr ser implementado via método dentro de cada class.
                 */
               "Regex"          => ["Exist"=> false, "Regx"=> ""],
                /**
                 * Subarray - informa se o campo será atualizável
                 */
               "Formulario"     => [
                                        /**
                                         * Informa ao sistema que o campo será atualizável.
                                         */
                                        "Exibir"=> false,
                                        /**
                                         * Texto explicativo que ficará dentro do campo input type text
                                         */
                                        "Placeholder"=> "", 
                                        /**
                                         * Tipo de componente que será visualizado no formulário. inputbox, select
                                         */
                                        "TypeComponente"=>"",
                                        /**
                                         * Usado conjuntamente com o campo anterior.
                                         */
                                        "TypeConteudo"=> ["text"],
                                        /**
                                         * Nome do campo que será exportado para o controller, esse campo deverá ter o nome diferente do nome
                                         * original por motivo de segurança
                                         */
                                        "Name" => "username", 
                                        /**
                                         * Regex do campo input text
                                         */
                                        "Patterns"=> "",
                                        /**
                                         * Informação que será exibida quando o cursor fixa em cima do componente.
                                         */
                                        "Titles" => "",
                                        /**
                                         * Campo terá preenchimento obrigatório.
                                         */
                                        "Required" => "",
                                        /**
                                         * Tamanho do campo
                                         */
                                        "width" => "50px",
                                        "height"=>"",
                                        /**
                                         * Salto dos números na caixa do tipo number
                                         */
                                        "step"=>"",
                                        /**
                                         * 
                                         */
                                        "size"=>"",
                                        /**
                                         * Número mínimo dentro da caixa do tipo number
                                         */
                                        "min"=>"",
                                        /**
                                         * Número máximo dentro da caixa do tipo number
                                         */
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        /**
                                         * Autofocus
                                         */
                                        "autofocus"=> true,
                                        "checked"=>"",
                                        "dirname"=>"",
                                        /**
                                         * Campo será somente leitura
                                         */
                                        "readonly"=>""
                                    ],
               /**
                * Informa ao sistema que o campo deverá, via tabela html, a opção de ordernar o campo.
                */
               "OrdemBY"        => true
           ]   ,
            [
               "Index"          => 2,                                   //Ordem dos campos
               "Field"          => "senha",                       //Nome original do campo (String)
               "CodNome"        => "Senha",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["texto"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> 0, 
                                        "NomeBotao"=> ""
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "password", 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 3,                                   //Ordem dos campos
               "Field"          => "tipousuario",                       //Nome original do campo (String)
               "CodNome"        => "TipoUsuario",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["texto"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> 0, 
                                        "NomeBotao"=> ""
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "", 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 4,                                   //Ordem dos campos
               "Field"          => "habilitado",                       //Nome original do campo (String)
               "CodNome"        => "Habilitado",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["texto"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> 0, 
                                        "NomeBotao"=> ""
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "Habilitado", 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 5,                                   //Ordem dos campos
               "Field"          => "tentativa",                       //Nome original do campo (String)
               "CodNome"        => "Tentativas",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["texto"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> 0, 
                                        "NomeBotao"=> ""
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "Tentativa", 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],

      
        ];
    private $Privilegios = [["Todos","Select/Update/Insert"]];
    private $TipoPaginacao = ["Simples"=>false, "SaltoPagina"=> true, "Filtros"=>true, "BRefresh"=>true];
    
    public function ModoPaginacao() {
        return $this->TipoPaginacao;
    }
    
    public function getVirtual() {
        return false;
    }

    public function getNomeReal() {
        return "";
    }

    public function setNomeTabela() {
        $this->NomeTabela = __CLASS__ ;
    }

    public function getCampos() {
        return $this->Campos;
    }

    public function getPrivilegios() {
        return $this->Privilegios;
    }

    public function getTituloTabela() {
        return "CADASTRO DE USUÁRIOS NO SISTEMA";
    }

    public function getLimite() {
        return 1;
    }

    public function getMostrarContador() {
        return true;
    }

    public function showColumnsIcones() {
        $Habilitar = false;
        $Icones = [
                        //["NomeColuna"=> "<i class='fa fa-bluetooth' style='font-size:20px'></i>","NomeBotao"=>"Localizar", "Icone" => "fa fa-search", "Func" => 0, "Tipo" => "Bootstrap", "tooltip"=> "busca"]
                    ];
        $ShowColumns[0] = $Habilitar;
        $ShowColumns[1] = $Icones;
        
        return $ShowColumns;
        
    }
    /**
     * A idéia do método é possibilitar o retorno de valor padrão baseado em qualquer outro método.
     * @param int $idx
     * @return boolean
     */
    public function getValorPadrao($idx) {
        $ValorPadraoCampos[0] = ["Exist"=>false, Valor=>"sim"];

        return $ValorPadraoCampos[$idx];
    }

    public function getPrivBD() {
        
    }
    /**
     * Método muito importante para o sistema. 
     * Através deste método, podemos criar os filtros padrões de cada campo.
     * O método foi criado com o intuito de se poder criar qualquer tipo de filtro padrão.
     * Ex.: $Filtro[0] = ["like","%fd%"]
     */
    public function getFiltrosCampo() {
        
    }

    public function Jobs($Tipo, &$ConjuntoDados, $Action, $Resultado) {
        switch ($Tipo) {
            case "InserirDadosTabela":
                
                switch ($Action) {
                    case "AfterInsert":
                        $USER = $ConjuntoDados[0]["value"];
                        $this->query("INSERT INTO perfil (idp) values ($USER)");
                        return true;
                        
                        break;

                    default:
                        break;
                }
                
                break;

            default:
                break;
        }
        
        return true;
    }
    /*
     * Controla a visibilidade da quantidade de paginas por tabela HTML. Os quadrinho para selecionar página.
     */
    public function getTotalPageVisible() {
       return 1;
    }

    public function validarConteudoCampoRegex(&$Dados) {
        $Name =  $Dados[0]["name"];
        if($Name == "username"){
            $Usuario = $Dados[0]["value"];
            $Verify_Field_User = preg_match("/^[0-9]{3}\.?[0-9]{3}\.?[0-9]{3}\-?[0-9]{2}/i", $Usuario);
            if($Verify_Field_User == 0){ //Tudo que começa com 91__ é um tipo de tentativa de acesso não autorizada.
                throw new Exception("Regra de criação de usuário não determinada!", 9100);           
            }else{
                return true;
            }            
        }else return true;

    }

    public function NormalizarFiltro($Tipo) {
        
    }
    /*
     * Função que é executada que poderá ter retornos variados como: array, boolean, json, etc...
     */
    public function getFuncoesGenericas() {
        
    }

}

class adm_cadastro extends ModeloTabelas{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Campos =  [
           
            [
               "Index"          => 0,                                   //Ordem dos campos
               "Field"          => "idLogin",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "idLogin",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [true, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "idLogin",
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 1],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 1,                                   //Ordem dos campos
               "Field"          => "usuario",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Usuário",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "usuario",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 2,                                   //Ordem dos campos
               "Field"          => "senha",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Senha",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "password",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 3,                                   //Ordem dos campos
               "Field"          => "tipousuario",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Tipo",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "lista",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //se não houve uma função, atribuir null. Executa uma função antes de apresentar os valores na lista do componente select
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null // Importante! o primeiro  -- Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", //o Campo conteúdo TypeConteudo - só será utilizado se não houver uma tabela estrangeira
                                        "TypeConteudo"=> ["Administrador","Gerente","Produtor","Membros"], 
                                        "Name" => "TUSER",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 2], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 4,                                   //Ordem dos campos
               "Field"          => "habilitado",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Habilitado",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> 0, 
                                        "NomeBotao"=> ""
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["number"], 
                                        "Name" => "HAB", 
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 1],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"0",
                                        "max"=>"1",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>"" //podemos definir várias configurações de style
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 5,                                   //Ordem dos campos
               "Field"          => "tentativa",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Tentativas",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> 0, 
                                        "NomeBotao"=> ""
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["number"], 
                                        "Name" => "Valor", 
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 2],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"0",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>"" //podemos definir várias configurações de style
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 6,                                   //Ordem dos campos
               "Field"          => "dtLogin",                       //Nome original do campo (String)
               "FieldFunc"      => [true,'DATE_FORMAT(dtLogin, "%Y-%m-%d %H:%i")'],
               "CodNome"        => "Login",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> 0, 
                                        "NomeBotao"=> ""
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["datetime-local"], 
                                        "Name" => "LOGin", 
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 2],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>"" //podemos definir várias configurações de style
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 7,                                   //Ordem dos campos
               "Field"          => "dtCriado",                       //Nome original do campo (String)
               "FieldFunc"      => [true,'DATE_FORMAT(dtCriado, "%Y-%m-%d %H:%i")'],
               "CodNome"        => "Criado",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> 0, 
                                        "NomeBotao"=> ""
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "dtCriado", 
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 2],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>"" //podemos definir várias configurações de style
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
        ];

    private $Privilegios = [["Administrador","Select/Insert/Update/Delete"]];
    private $TipoPaginacao = ["Simples"=>false, "SaltoPagina"=> true, "Filtros"=>true, "BRefresh"=>true];
    
    public function ModoPaginacao() {
        return $this->TipoPaginacao;
    }
    /*
     * Informa que a tabela que está sendo trabalhada é uma view
     */
    public function getVirtual() {
        return false;
    }
    /*
     * Informa o nome da tabela na qual as operações de INSERT, UPDATE, e DELETE vão atuar
     */
    public function getNomeReal() {
        return "adm_cadastro";
    }
    /*
     * Nome da tabela para a instrução SELECT
     */
    public function setNomeTabela() {
        $this->NomeTabela = __CLASS__;   
    }

    public function getCampos() {
        return $this->Campos;
    }

    public function getPrivilegios() {
        return $this->Privilegios;
    }

    public function getTituloTabela() {
        return "USUÁRIOS CADASTRADOS NO SISTEMA";
    }

    public function getLimite() {
        return 10;
    }

    public function getMostrarContador() {
        return true;
    }

    public function showColumnsIcones() {
        $Habilitar = false;
        $Icones = [
                        //["NomeColuna"=> "<i class='fa fa-bluetooth' style='font-size:20px'></i>","NomeBotao"=>"Localizar", "Icone" => "fa fa-search", "Func" => 0, "Tipo" => "Bootstrap", "tooltip"=> "busca"]
                    ];
        $ShowColumns[0] = $Habilitar;
        $ShowColumns[1] = $Icones;
        
        return $ShowColumns;
        
    }
    /**
     * A idéia do método é possibilitar o retorno de valor padrão baseado em qualquer outro método.
     * @param int $idx
     * @return boolean
     */
    public function getValorPadrao($idx) {
        $ValorPadraoCampos[0] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[1] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[2] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[3] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[4] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[5] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[6] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[7] = ["Exist"=>false, Valor=>"sim"];
        
        return $ValorPadraoCampos[$idx];
    }

    public function getPrivBD() {
        
    }
    /**
     * Método muito importante para o sistema. 
     * Através deste método, podemos criar os filtros padrões de cada campo.
     * O método foi criado com o intuito de se poder criar qualquer tipo de filtro padrão.
     */
    public function getFiltrosCampo() {
        
    }

    public function Jobs($Tipo, &$ConjuntoDados, $Action, $Resultado) {
        switch ($Tipo) {
            case "InserirDadosTabela":
                
                switch ($Action) {
                    case "AfterInsert":
                        $USER = $ConjuntoDados[0]["value"];
                        $this->query("INSERT INTO perfil (idp) values ($USER)");
                        return true;
                        
                        break;

                    default:
                        break;
                }
                
                break;
            
            case "AtualizarDadosTabela":
                switch ($Action) {
                    case "BeforeUpdate":
                        $Total = strlen($ConjuntoDados[1]["value"]);
                        if($Total != 32 && $Total != 0){
                            $MD5_Password = md5($ConjuntoDados[1]["value"]);
                            $ConjuntoDados[1]["value"] = $MD5_Password;
                        }
                

                        break;

                    default:
                        break;
                }
                
            break;
            
            default:
                break;
        }
        
        return true;

    }

    public function getTotalPageVisible() {
       return 20;
    }

    public function validarConteudoCampoRegex(&$Dados) {
        return true;
    }

    public function NormalizarFiltro($Tipo) {
        
    }
    /*
     * Função que é executada que poderá ter retornos variados como: array, boolean, json, etc...
     */
    public function getFuncoesGenericas() {
        return true;
    }

}

class adm_perfil extends ModeloTabelas{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Campos =  [
           
            [
               "Index"          => 0,                                   //Ordem dos campos
               "Field"          => "idp",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "CPF",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [true, true],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "idPERFIL",
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 1],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 1,                                   //Ordem dos campos
               "Field"          => "Nome",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Nome",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PNome",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 2,                                   //Ordem dos campos
               "Field"          => "Sobrenome",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Sobrenome",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PSobrenome",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 3,                                   //Ordem dos campos
               "Field"          => "Nasc",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Nasc",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "lista",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //se não houve uma função, atribuir null. Executa uma função antes de apresentar os valores na lista do componente select
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null // Importante! o primeiro  -- Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", //o Campo conteúdo TypeConteudo - só será utilizado se não houver uma tabela estrangeira
                                        "TypeConteudo"=> ["date"], 
                                        "Name" => "PNasc",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 2], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 4,                                   //Ordem dos campos
               "Field"          => "Cel",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Cel",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> 0, 
                                        "NomeBotao"=> ""
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["number"], 
                                        "Name" => "PCEL", 
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 1],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"0",
                                        "max"=>"1",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>"" //podemos definir várias configurações de style
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 5,                                   //Ordem dos campos
               "Field"          => "Email",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Email",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> 0, 
                                        "NomeBotao"=> ""
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PEMAIL", 
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 2],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"0",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>"" //podemos definir várias configurações de style
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 6,                                   //Ordem dos campos
               "Field"          => "Nivel",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Nível",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> 0, 
                                        "NomeBotao"=> ""
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["number"], 
                                        "Name" => "PNivel", 
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 2],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>"" //podemos definir várias configurações de style
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 7,                                   //Ordem dos campos
               "Field"          => "Descricao",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Descricao",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> 0, 
                                        "NomeBotao"=> ""
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => false,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PDescricao", 
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 2],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>"" //podemos definir várias configurações de style
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 8,                                   //Ordem dos campos
               "Field"          => "foto",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "foto",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> 0, 
                                        "NomeBotao"=> ""
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "Pfoto", 
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 2],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>"" //podemos definir várias configurações de style
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 9,                                   //Ordem dos campos
               "Field"          => "Login",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Login",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         * Tabela1 - idLogin -> Usuario
                                         *               0        1
                                         * 
                                         * Tabela 2 - idLogin -> Foto
                                         *               1         2
                                         */
                                        "CamposTblExtrangeira"=>[0,1,1,2]
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PLogin", 
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 2],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>"" //podemos definir várias configurações de style
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
        ];

    private $Privilegios = [["Administrador","Select/Insert/Update/Delete"]];
    private $TipoPaginacao = ["Simples"=>false, "SaltoPagina"=> true, "Filtros"=>true, "BRefresh"=>true];
    
    public function ModoPaginacao() {
        return $this->TipoPaginacao;
    }
    /*
     * Informa que a tabela que está sendo trabalhada é uma view
     */
    public function getVirtual() {
        return false;
    }
    /*
     * Informa o nome da tabela na qual as operações de INSERT, UPDATE, e DELETE vão atuar
     */
    public function getNomeReal() {
        return "adm_cadastro";
    }
    /*
     * Nome da tabela para a instrução SELECT
     */
    public function setNomeTabela() {
        $this->NomeTabela = __CLASS__;   
    }

    public function getCampos() {
        return $this->Campos;
    }

    public function getPrivilegios() {
        return $this->Privilegios;
    }

    public function getTituloTabela() {
        return "PERFIL DOS USUÁRIOS CADASTRADOS NO SISTEMA";
    }

    public function getLimite() {
        return 10;
    }

    public function getMostrarContador() {
        return true;
    }

    public function showColumnsIcones() {
        $Habilitar = false;
        $Icones = [
                        //["NomeColuna"=> "<i class='fa fa-bluetooth' style='font-size:20px'></i>","NomeBotao"=>"Localizar", "Icone" => "fa fa-search", "Func" => 0, "Tipo" => "Bootstrap", "tooltip"=> "busca"]
                    ];
        $ShowColumns[0] = $Habilitar;
        $ShowColumns[1] = $Icones;
        
        return $ShowColumns;
        
    }
    /**
     * A idéia do método é possibilitar o retorno de valor padrão baseado em qualquer outro método.
     * @param int $idx
     * @return boolean
     */
    public function getValorPadrao($idx) {
        $ValorPadraoCampos[0] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[1] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[2] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[3] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[4] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[5] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[6] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[7] = ["Exist"=>false, Valor=>"sim"];
        
        return $ValorPadraoCampos[$idx];
    }

    public function getPrivBD() {
        
    }
    /**
     * Método muito importante para o sistema. 
     * Através deste método, podemos criar os filtros padrões de cada campo.
     * O método foi criado com o intuito de se poder criar qualquer tipo de filtro padrão.
     */
    public function getFiltrosCampo() {
        
    }

    public function Jobs($Tipo, &$ConjuntoDados, $Action, $Resultado) {
        switch ($Tipo) {
            case "AtualizarDadosTabela":
                switch ($Action) {
                    case "BeforeUpdate":
                        /**
                         * Altera a senha de texto para hash
                         */
                        $MD5_Password = md5($ConjuntoDados[1]["value"]);
                        $ConjuntoDados[1]["value"] = $MD5_Password;
                        
                        /**
                         * Log de segurança
                         */
                        $ConjuntoDados[6]["name"] = "PLogin";
                        $ConjuntoDados[6]["value"] = $this->UsuarioLogin;
                        
                        break;

                    default:
                        break;
                }
                break;

            default:
                break;
        }
        
        return true;
    }

    public function getTotalPageVisible() {
       return 20;
    }

    public function validarConteudoCampoRegex(&$Dados) {
        return true;
    }

    public function NormalizarFiltro($Tipo) {
        
    }
    /*
     * Função que é executada que poderá ter retornos variados como: array, boolean, json, etc...
     */
    public function getFuncoesGenericas() {
        return true;
    }

}

class adm_blitzimagens extends ModeloTabelas{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Campos =  [
           
            [
               "Index"          => 0,                                   //Ordem dos campos
               "Field"          => "idi",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "idi",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [true, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => false,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "idimagem",
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 1],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 1,                                   //Ordem dos campos
               "Field"          => "Nome",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Nome",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => false,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "Nome",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 2,                                   //Ordem dos campos
               "Field"          => "idUser",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "idUser",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "idUser",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 3,                                   //Ordem dos campos
               "Field"          => "ide",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Evento",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => true,
                                        "Tabela"=> "adm_eventos",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>[0,1,2,3] //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PIDE",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => true,
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 4,                                   //Ordem dos campos
               "Field"          => "Path",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Caminho",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "destino",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            
        ];

    private $Privilegios = [["Administrador","Select/Insert/Update/Delete"], ["Todos","Insert"]];
    private $TipoPaginacao = ["Simples"=>false, "SaltoPagina"=> true, "Filtros"=>true, "BRefresh"=>true];
    
    public function ModoPaginacao() {
        return $this->TipoPaginacao;
    }
    /*
     * Informa que a tabela que está sendo trabalhada é uma view
     */
    public function getVirtual() {
        return false;
    }
    /*
     * Informa o nome da tabela na qual as operações de INSERT, UPDATE, e DELETE vão atuar
     */
    public function getNomeReal() {
        return "adm_cadastro";
    }
    /*
     * Nome da tabela para a instrução SELECT
     */
    public function setNomeTabela() {
        $this->NomeTabela = __CLASS__;   
    }

    public function getCampos() {
        return $this->Campos;
    }

    public function getPrivilegios() {
        return $this->Privilegios;
    }

    public function getTituloTabela() {
        return "Eventos cadastrados no sistema";
    }

    public function getLimite() {
        return 10;
    }

    public function getMostrarContador() {
        return true;
    }

    public function showColumnsIcones() {
        $Habilitar = false;
        $Icones = [
                        //["NomeColuna"=> "<i class='fa fa-bluetooth' style='font-size:20px'></i>","NomeBotao"=>"Localizar", "Icone" => "fa fa-search", "Func" => 0, "Tipo" => "Bootstrap", "tooltip"=> "busca"]
                    ];
        $ShowColumns[0] = $Habilitar;
        $ShowColumns[1] = $Icones;
        
        return $ShowColumns;
        
    }
    /**
     * A idéia do método é possibilitar o retorno de valor padrão baseado em qualquer outro método.
     * @param int $idx
     * @return boolean
     */
    public function getValorPadrao($idx) {
        $ValorPadraoCampos[0] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[1] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[2] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[3] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[4] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[5] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[6] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[7] = ["Exist"=>false, Valor=>"sim"];
        
        return $ValorPadraoCampos[$idx];
    }

    public function getPrivBD() {
        
    }
    /**
     * Método muito importante para o sistema. 
     * Através deste método, podemos criar os filtros padrões de cada campo.
     * O método foi criado com o intuito de se poder criar qualquer tipo de filtro padrão.
     */
    public function getFiltrosCampo() {
        
    }

    public function Jobs($Tipo, &$ConjuntoDados, $Action, $Resultado) {
        switch ($Tipo) {
            case "AtualizarDadosTabela":
                switch ($Action) {
                    case "BeforeUpdate":

                        break;

                    default:
                        break;
                }
                break;

            default:
                break;
        }
        
        return true;
    }

    public function getTotalPageVisible() {
       return 20;
    }

    public function validarConteudoCampoRegex(&$Dados) {
        return true;
    }

    public function NormalizarFiltro($Tipo) {
        
    }
    /*
     * Função que é executada que poderá ter retornos variados como: array, boolean, json, etc...
     */
    public function getFuncoesGenericas() {
        return true;
    }

}

class adm_Eblitzimagens extends ModeloTabelas{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Campos =  [
           
            [
               "Index"          => 0,                                   //Ordem dos campos
               "Field"          => "idi",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "idi",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [true, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "idimagem",
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 1],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 1,                                   //Ordem dos campos
               "Field"          => "Nome",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Nome",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PNome",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 2,                                   //Ordem dos campos
               "Field"          => "idUser",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "idUser",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => false,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "idUser",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 3,                                   //Ordem dos campos
               "Field"          => "ide",                       //Nome original do campo (String)
               "FieldFunc"      => [true,"(select eventos.Nome from eventos where eventos.ide = adm_Eblitzimagens.ide) as ide"],
               "CodNome"        => "Evento",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => true,
                                        "Tabela"=> "adm_eventos",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>[0,1,2,3] //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PIDE",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => true,
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 4,                                   //Ordem dos campos
               "Field"          => "Path",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Imagem",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "destino",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            
        ];

    private $Privilegios = [["Administrador","Select/Update/Delete"]];
    private $TipoPaginacao = ["Simples"=>false, "SaltoPagina"=> true, "Filtros"=>true, "BRefresh"=>true];
    
    public function ModoPaginacao() {
        return $this->TipoPaginacao;
    }
    /*
     * Informa que a tabela que está sendo trabalhada é uma view
     */
    public function getVirtual() {
        return false;
    }
    /*
     * Informa o nome da tabela na qual as operações de INSERT, UPDATE, e DELETE vão atuar
     */
    public function getNomeReal() {
        return "adm_cadastro";
    }
    /*
     * Nome da tabela para a instrução SELECT
     */
    public function setNomeTabela() {
        $this->NomeTabela = __CLASS__;   
    }

    public function getCampos() {
        return $this->Campos;
    }

    public function getPrivilegios() {
        return $this->Privilegios;
    }

    public function getTituloTabela() {
        return "Imagens cadastrados no sistema";
    }

    public function getLimite() {
        return 10;
    }

    public function getMostrarContador() {
        return true;
    }

    public function showColumnsIcones() {
        $Habilitar = false;
        $Icones = [
                        //["NomeColuna"=> "<i class='fa fa-bluetooth' style='font-size:20px'></i>","NomeBotao"=>"Localizar", "Icone" => "fa fa-search", "Func" => 0, "Tipo" => "Bootstrap", "tooltip"=> "busca"]
                    ];
        $ShowColumns[0] = $Habilitar;
        $ShowColumns[1] = $Icones;
        
        return $ShowColumns;
        
    }
    /**
     * A idéia do método é possibilitar o retorno de valor padrão baseado em qualquer outro método.
     * @param int $idx
     * @return boolean
     */
    public function getValorPadrao($idx) {
        $ValorPadraoCampos[0] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[1] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[2] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[3] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[4] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[5] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[6] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[7] = ["Exist"=>false, Valor=>"sim"];
        
        return $ValorPadraoCampos[$idx];
    }

    public function getPrivBD() {
        
    }
    /**
     * Método muito importante para o sistema. 
     * Através deste método, podemos criar os filtros padrões de cada campo.
     * O método foi criado com o intuito de se poder criar qualquer tipo de filtro padrão.
     */
    public function getFiltrosCampo() {
        
    }

    public function Jobs($Tipo, &$ConjuntoDados, $Action, $Resultado) {
        switch ($Tipo) {
            case "InserirDadosTabela":
                switch ($Action) {
                    case "BeforeInsert":
                        $ConjuntoDados[6]["name"] = "PLogin";
                        $ConjuntoDados[6]["value"] = $this->UsuarioLogin;
                        break;

                    default:
                        break;
                }
                break;

            default:
                break;
        }
        
        return true;
    }

    public function getTotalPageVisible() {
       return 20;
    }

    public function validarConteudoCampoRegex(&$Dados) {
        return true;
    }

    public function NormalizarFiltro($Tipo) {
        
    }
    /*
     * Função que é executada que poderá ter retornos variados como: array, boolean, json, etc...
     */
    public function getFuncoesGenericas() {
        return true;
    }

}

class adm_eventos extends ModeloTabelas{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Campos =  [
           
            [
               "Index"          => 0,                                   //Ordem dos campos
               "Field"          => "ide",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "ide",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [true, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "ideventos",
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 1],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 1,                                   //Ordem dos campos
               "Field"          => "Nome",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Nome",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "Nome do evento", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PNome",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => true,
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 2,                                   //Ordem dos campos
               "Field"          => "Valor",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Valor",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "Valor entrada", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["numeric"], 
                                        "Name" => "PValor",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 3,                                   //Ordem dos campos
               "Field"          => "Data",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Data",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["date"], 
                                        "Name" => "PData",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 4,                                   //Ordem dos campos
               "Field"          => "Descricao",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Descrição",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "Texto que descreva o evento", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PDescricao",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 5,                                   //Ordem dos campos
               "Field"          => "Capa",                       //Nome original do campo (String)
               "FieldFunc"      => [false,"(select blitz_bimagens.Path from blitz_bimagens where blitz_bimagens.idi=Capa) as Capa"],
               "CodNome"        => "Capa",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => true,
                                        "Tabela"=> "adm_imagens_eventos",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>[0,1,5,6] //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => false,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PCapa",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 6,                                   //Ordem dos campos
               "Field"          => "Capa",                       //Nome original do campo (String)
               "FieldFunc"      => [true,"(select imagens_eventos.Nome from imagens_eventos where imagens_eventos.idi=Capa) as NIMG"],
               "CodNome"        => "img",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "adm_imagens_eventos",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>[0,1,5,6] //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => false,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "Pimg",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 7,                                   //Ordem dos campos
               "Field"          => "Capa",                       //Nome original do campo (String)
               "FieldFunc"      => [true,"(select imagens_eventos.Path from imagens_eventos where imagens_eventos.idi=Capa) as NIMG"],
               "CodNome"        => "img",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "adm_imagens_eventos",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>[0,1,5,6] //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => false,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "Pimg",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 8,                                   //Ordem dos campos
               "Field"          => "Ativo",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Ativo",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", 
                                        "TypeConteudo"=> ["Não","Sim"], 
                                        "Name" => "PAtivo",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"0",
                                        "max"=>"1",
                                        "maxlength"=>"1",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 9,                                   //Ordem dos campos
               "Field"          => "Login",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Login",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => false,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PLogin",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 10,                                   //Ordem dos campos
               "Field"          => "dtModify",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "dtModify",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["date"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => false,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PdtModify",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 11,                                   //Ordem dos campos
               "Field"          => "dtCriado",                       //Nome original do campo (String)
               "FieldFunc"      => [true,("DATE_FORMAT(dtCriado,'%d/%m/%Y - %H:%i') as dtCriado")],
               "CodNome"        => "Criado",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PdtCriado",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            
        ];

    private $Privilegios = [["Administrador","Select/Insert/Update/Delete"]];
    private $TipoPaginacao = ["Simples"=>false, "SaltoPagina"=> true, "Filtros"=>true, "BRefresh"=>true];
    
    public function ModoPaginacao() {
        return $this->TipoPaginacao;
    }
    /*
     * Informa que a tabela que está sendo trabalhada é uma view
     */
    public function getVirtual() {
        return false;
    }
    /*
     * Informa o nome da tabela na qual as operações de INSERT, UPDATE, e DELETE vão atuar
     */
    public function getNomeReal() {
        return "";
    }
    /*
     * Nome da tabela para a instrução SELECT
     */
    public function setNomeTabela() {
        $this->NomeTabela = __CLASS__;   
    }

    public function getCampos() {
        return $this->Campos;
    }

    public function getPrivilegios() {
        return $this->Privilegios;
    }

    public function getTituloTabela() {
        return "Eventos Gerenciados";
    }

    public function getLimite() {
        return 10;
    }

    public function getMostrarContador() {
        return true;
    }

    public function showColumnsIcones() {
        $Habilitar = true;
        $Icones = [
                        ["NomeColuna"=> "<i class='fa fa-camera' style='font-size:20px'></i>","NomeBotao"=>"Localizar", "Icone" => "fa fa-camera", "Func" => 0, "Tipo" => "Font_Awesome", "tooltip"=> "Exibir foto","Visible"=>true]
                    ];
        $ShowColumns[0] = $Habilitar;
        $ShowColumns[1] = $Icones;
        
        return $ShowColumns;
        
    }
    /**
     * A idéia do método é possibilitar o retorno de valor padrão baseado em qualquer outro método.
     * @param int $idx
     * @return boolean
     */
    public function getValorPadrao($idx) {
        $ValorPadraoCampos[0] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[1] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[2] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[3] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[4] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[5] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[6] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[7] = ["Exist"=>false, Valor=>"sim"];
        
        return $ValorPadraoCampos[$idx];
    }

    public function getPrivBD() {
        
    }
    /**
     * Método muito importante para o sistema. 
     * Através deste método, podemos criar os filtros padrões de cada campo.
     * O método foi criado com o intuito de se poder criar qualquer tipo de filtro padrão.
     */
    public function getFiltrosCampo() {
        
    }

    public function Jobs($Tipo, &$ConjuntoDados, $Action, $Resultado) {
        switch ($Tipo) {
            case "InserirDadosTabela":
                switch ($Action) {
                    case "BeforeInsert":
                        $ConjuntoDados[6]["name"] = "PLogin";
                        $ConjuntoDados[6]["value"] = $this->UsuarioLogin;
                        break;
                    
                    case "AfterInsert":
                        //ID do evento que acabou de ser criado..
                        $IDEvento = $this->lastInsertId();
                        
                        /**
                         * Pequisa dentro dos tipo de eventos se existe o tipo Evento
                         */
                        $Handle_Tipo_Event = $this->query("SELECT idte from tipo_evento where Nome = 'Eventos'");
                        $Listas_Evento = $Handle_Tipo_Event->fetch(pdo::FETCH_ASSOC);
                        /**
                         * Criar uma lista para cada tipo de vento, lista de 30 reais, 40 reais ...
                         */
                        foreach ($Listas_Evento as $Valor_LE) {
                            $Consulta_TL = "SELECT idtl FROM tipo_listas WHERE Tipo = ${Valor_LE['idte']} AND Ativa = 'Sim'";
                            $Handle_Tipos_Listas = $this->query($Consulta_TL);
                            $Tipos_Listas = $Handle_Tipos_Listas->fetchAll(pdo::FETCH_ASSOC);
                            $Total = count($Tipos_Listas);

                            if($Total === 0){
                                throw new Exception("Não existem listas para Eventos!", 12000);
                            }else{
                                foreach ($Tipos_Listas as $key => $value) {
                                    $Inserir_Tipos_Listas = "INSERT INTO listas_dos_eventos (ide, idtl) values(${IDEvento}, ${value['idtl']})";
                                    $this->query($Inserir_Tipos_Listas);
                                }
                            }

                        }
                        /**
                         * Verifica e cria um lista free para cada evento
                         */
                        $Handle_Tipo_Event = $this->query("SELECT idte from tipo_evento where Nome = 'FREE'");
                        $Listas_Evento_FREE = $Handle_Tipo_Event->fetch(pdo::FETCH_ASSOC);
                        $Total = count($Listas_Evento_FREE);
                        if($Total > 0){
                            $Consulta_TL = "SELECT idtl FROM tipo_listas WHERE Tipo = ${Listas_Evento_FREE['idte']} AND Ativa = 'Sim'";
                            $FREE_HANDLE = $this->query($Consulta_TL);                             
                            $Tipos_Listas_FREE = $FREE_HANDLE->fetchAll(pdo::FETCH_ASSOC);
                            $Total = count($Tipos_Listas_FREE);
                            if($Total !== 0){
                                foreach ($Tipos_Listas_FREE as $value) {
                                    $Inserir_Tipos_FREE = "INSERT INTO listas_dos_eventos (ide, idtl) values(${IDEvento}, ${value['idtl']})";
                                    $this->query($Inserir_Tipos_FREE);
                                }
                            }    
                            
                        }
                        /**
                         * Verifica e cria um lista VIP para cada evento.
                         */
                        $Handle_Tipo_Event = $this->query("SELECT idte from tipo_evento where Nome = 'VIP'");
                        $Listas_Evento_VIP = $Handle_Tipo_Event->fetch(pdo::FETCH_ASSOC);
                        $Total = count($Listas_Evento_VIP);
                        if($Total > 0){
                            $Consulta_TL = "SELECT idtl FROM tipo_listas WHERE Tipo = ${Listas_Evento_VIP['idte']} AND Ativa = 'Sim'";
                            $VIP_HANDLE = $this->query($Consulta_TL);                             
                            $Tipos_Listas_VIP = $VIP_HANDLE->fetchAll(pdo::FETCH_ASSOC);
                            $Total = count($Tipos_Listas_VIP);
                            if($Total !== 0){
                                foreach ($Tipos_Listas_VIP as $value) {
                                    $Inserir_Tipos_VIP = "INSERT INTO listas_dos_eventos (ide, idtl) values(${IDEvento}, ${value['idtl']})";
                                    $this->query($Inserir_Tipos_VIP);
                                }
                            }   
                            
                        }                       
                        
                        
                        break;
                    
                    default:
                        break;
                }
                break;

            default:
                break;
        }
        
        return true;
    }

    public function getTotalPageVisible() {
       return 20;
    }

    public function validarConteudoCampoRegex(&$Dados) {
        return true;
    }

    public function NormalizarFiltro($Tipo) {
        
    }
    /*
     * Função que é executada que poderá ter retornos variados como: array, boolean, json, etc...
     */
    public function getFuncoesGenericas() {
        return true;
    }

}

class adm_imagens_eventos extends ModeloTabelas{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Campos =  [
           
            [
               "Index"          => 0,                                   //Ordem dos campos
               "Field"          => "idi",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "idi",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [true, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "idimagem",
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 1],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 1,                                   //Ordem dos campos
               "Field"          => "Nome",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Nome",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "Nome",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 2,                                   //Ordem dos campos
               "Field"          => "idUser",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "idUser",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => false,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "idUser",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 3,                                   //Ordem dos campos
               "Field"          => "Path",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Imagem",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "destino",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 4,                                   //Ordem dos campos
               "Field"          => "dtCriado",                       //Nome original do campo (String)
               "FieldFunc"      => [true,'DATE_FORMAT(dtCriado, "%d/%m/%Y - %H:%i") as dtCriado'],
               "CodNome"        => "Criado",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "destino",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
        ];

    private $Privilegios = [["Administrador","Select/Update/Delete"], ["Todos","Insert"]];
    private $TipoPaginacao = ["Simples"=>false, "SaltoPagina"=> true, "Filtros"=>true, "BRefresh"=>true];
    
    public function ModoPaginacao() {
        return $this->TipoPaginacao;
    }
    /*
     * Informa que a tabela que está sendo trabalhada é uma view
     */
    public function getVirtual() {
        return false;
    }
    /*
     * Informa o nome da tabela na qual as operações de INSERT, UPDATE, e DELETE vão atuar
     */
    public function getNomeReal() {
        return "adm_cadastro";
    }
    /*
     * Nome da tabela para a instrução SELECT
     */
    public function setNomeTabela() {
        $this->NomeTabela = __CLASS__;   
    }

    public function getCampos() {
        return $this->Campos;
    }

    public function getPrivilegios() {
        return $this->Privilegios;
    }

    public function getTituloTabela() {
        return "Imagens cadastrados no sistema";
    }

    public function getLimite() {
        return 10;
    }

    public function getMostrarContador() {
        return true;
    }

    public function showColumnsIcones() {
        $Habilitar = false;
        $Icones = [
                        //["NomeColuna"=> "<i class='fa fa-bluetooth' style='font-size:20px'></i>","NomeBotao"=>"Localizar", "Icone" => "fa fa-search", "Func" => 0, "Tipo" => "Bootstrap", "tooltip"=> "busca"]
                    ];
        $ShowColumns[0] = $Habilitar;
        $ShowColumns[1] = $Icones;
        
        return $ShowColumns;
        
    }
    /**
     * A idéia do método é possibilitar o retorno de valor padrão baseado em qualquer outro método.
     * @param int $idx
     * @return boolean
     */
    public function getValorPadrao($idx) {
        $ValorPadraoCampos[0] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[1] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[2] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[3] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[4] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[5] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[6] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[7] = ["Exist"=>false, Valor=>"sim"];
        
        return $ValorPadraoCampos[$idx];
    }

    public function getPrivBD() {
        
    }
    /**
     * Método muito importante para o sistema. 
     * Através deste método, podemos criar os filtros padrões de cada campo.
     * O método foi criado com o intuito de se poder criar qualquer tipo de filtro padrão.
     */
    public function getFiltrosCampo() {
        
    }

    public function Jobs($Tipo, &$ConjuntoDados, $Action, $Resultado) {
        switch ($Tipo) {
            case "InserirDadosTabela":
                switch ($Action) {
                    case "BeforeInsert":
                        $ConjuntoDados[6]["name"] = "PLogin";
                        $ConjuntoDados[6]["value"] = $this->UsuarioLogin;
                        break;

                    default:
                        break;
                }
                break;

            default:
                break;
        }
        
        return true;
    }

    public function getTotalPageVisible() {
       return 20;
    }

    public function validarConteudoCampoRegex(&$Dados) {
        return true;
    }

    public function NormalizarFiltro($Tipo) {
        
    }
    /*
     * Função que é executada que poderá ter retornos variados como: array, boolean, json, etc...
     */
    public function getFuncoesGenericas() {
        return true;
    }

}

class adm_tipo_listas extends ModeloTabelas{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Campos =  [
           
            [
               "Index"          => 0,                                   //Ordem dos campos
               "Field"          => "idtl",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "idtl",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [true, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"",
                                        "Multiple"=>false, 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "idListas",
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 1],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 1,                                   //Ordem dos campos
               "Field"          => "Nome",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Nome",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "Nome da lista", 
                                        "TypeComponente"=>"inputbox", 
                                        "Multiple"=>false,
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PNome",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => true,
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 2,                                   //Ordem dos campos
               "Field"          => "Nivel",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Nivel",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "Nível da lista", 
                                        "TypeComponente"=>"inputbox", 
                                        "Multiple"=>false,
                                        "TypeConteudo"=> ["number"], 
                                        "Name" => "PNivel",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => true,
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 3,                                   //Ordem dos campos
               "Field"          => "Tipo",                       //Nome original do campo (String)
               "FieldFunc"      => [false,false],
               "CodNome"        => "Tipo",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => true,
                                        "Tabela"=> "adm_tipo_evento",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>[0,1,3,4] //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => false,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select",
                                        "Multiple"=>false, 
                                        "TypeConteudo"=> ["Aniversário", "Evento"], 
                                        "Name" => "PTipo",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 4,                                   //Ordem dos campos
               "Field"          => "Tipo",                       //Nome original do campo (String)
               "FieldFunc"      => [true,"(select tipo_evento.Nome from tipo_evento where tipo_evento.idte = Tipo) as Tipo"],
               "CodNome"        => "Tipo",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select",
                                        "Multiple"=>false, 
                                        "TypeConteudo"=> ["Aniversário", "Evento"], 
                                        "Name" => "",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 5,                                   //Ordem dos campos
               "Field"          => "Valor",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Valor",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox",
                                        "Multiple"=>false, 
                                        "TypeConteudo"=> ["number"], 
                                        "Name" => "PValor",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"0",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 6,                                   //Ordem dos campos
               "Field"          => "Beneficios",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Beneficios",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "adm_beneficios",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>[0,1,2,2] //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => false,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select",
                                        "Multiple"=>true, 
                                        "TypeConteudo"=> ["Teste1","Alexandre"], 
                                        "Name" => "LBeneficios",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => true,
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 7,                                   //Ordem dos campos
               "Field"          => "Ativa",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Ativa",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select",
                                        "Multiple"=>false,
                                        "TypeConteudo"=> ["Sim","Não"], 
                                        "Name" => "LAtiva",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 8,                                   //Ordem dos campos
               "Field"          => "Login",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Login",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => false,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select",
                                        "Multiple"=>false, 
                                        "TypeConteudo"=> ["Sim","Não"], 
                                        "Name" => "PLogin",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"0",
                                        "max"=>"1",
                                        "maxlength"=>"1",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 9,                                   //Ordem dos campos
               "Field"          => "dtModify",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "dtModify",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => false,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox",
                                        "Multiple"=>false, 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "LdtModify",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 10,                                   //Ordem dos campos
               "Field"          => "dtCriado",                       //Nome original do campo (String)
               "FieldFunc"      => [false,("DATE_FORMAT(dtCriado,'%d/%m/%Y - %H:%i') as dtCriado")],
               "CodNome"        => "Criado",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => false,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox",
                                        "Multiple"=>false, 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PdtCriado",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            
        ];

    private $Privilegios = [["Administrador","Select/Insert/Update/Delete"]];
    private $TipoPaginacao = ["Simples"=>false, "SaltoPagina"=> true, "Filtros"=>true, "BRefresh"=>true];
    
    public function ModoPaginacao() {
        return $this->TipoPaginacao;
    }
    /*
     * Informa que a tabela que está sendo trabalhada é uma view
     */
    public function getVirtual() {
        return false;
    }
    /*
     * Informa o nome da tabela na qual as operações de INSERT, UPDATE, e DELETE vão atuar
     */
    public function getNomeReal() {
        return "";
    }
    /*
     * Nome da tabela para a instrução SELECT
     */
    public function setNomeTabela() {
        $this->NomeTabela = __CLASS__;   
    }

    public function getCampos() {
        return $this->Campos;
    }

    public function getPrivilegios() {
        return $this->Privilegios;
    }

    public function getTituloTabela() {
        return "Configuração das listas dos eventos";
    }

    public function getLimite() {
        return 10;
    }

    public function getMostrarContador() {
        return true;
    }

    public function showColumnsIcones() {
        $Habilitar = false;
        $Icones = [
                        ["NomeColuna"=> "<i class='fa fa-camera' style='font-size:20px'></i>","NomeBotao"=>"Localizar", "Icone" => "fa fa-camera", "Func" => 0, "Tipo" => "Font_Awesome", "tooltip"=> "Exibir foto","Visible"=>true]
                    ];
        $ShowColumns[0] = $Habilitar;
        $ShowColumns[1] = $Icones;
        
        return $ShowColumns;
        
    }
    /**
     * A idéia do método é possibilitar o retorno de valor padrão baseado em qualquer outro método.
     * @param int $idx
     * @return boolean
     */
    public function getValorPadrao($idx) {
        $ValorPadraoCampos[0] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[1] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[2] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[3] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[4] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[5] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[6] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[7] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[8] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[9] = ["Exist"=>false, Valor=>"sim"];
        
        return $ValorPadraoCampos[$idx];
    }

    public function getPrivBD() {
        
    }
    /**
     * Método muito importante para o sistema. 
     * Através deste método, podemos criar os filtros padrões de cada campo.
     * O método foi criado com o intuito de se poder criar qualquer tipo de filtro padrão.
     */
    public function getFiltrosCampo() {
        
    }

    public function Jobs($Tipo, &$ConjuntoDados, $Action, $Resultado) {
        switch ($Tipo) {
            case "AtualizarDadosTabela":
            case "InserirDadosTabela":
                switch ($Action) {
                    case "BeforeUpdate":
                    case "BeforeInsert":
                        $ConjuntoDados[6]["name"] = "PLogin";
                        $ConjuntoDados[6]["value"] = $this->UsuarioLogin;
                        break;
                    
                    default:
                        break;
                }
                break;

            default:
                break;
        }
        
        return true;
    }

    public function getTotalPageVisible() {
       return 20;
    }

    public function validarConteudoCampoRegex(&$Dados) {
        return true;
    }

    public function NormalizarFiltro($Tipo) {
        
    }
    /*
     * Função que é executada que poderá ter retornos variados como: array, boolean, json, etc...
     */
    public function getFuncoesGenericas() {
        return true;
    }

}

class adm_tipo_evento extends ModeloTabelas{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Campos =  [
           
            [
               "Index"          => 0,                                   //Ordem dos campos
               "Field"          => "idte",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "idte",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [true, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"",
                                        "Multiple"=>false, 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "",
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 1],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 1,                                   //Ordem dos campos
               "Field"          => "Nome",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Nome",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "Multiple"=>false,
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PNome",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => true,
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 2,                                   //Ordem dos campos
               "Field"          => "Descricao",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Descrição",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "Descrição do tipo de evento", 
                                        "TypeComponente"=>"textarea",
                                        "Multiple"=>false, 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PDescricao",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 3,                                   //Ordem dos campos
               "Field"          => "dtCriado",                       //Nome original do campo (String)
               "FieldFunc"      => [false,("DATE_FORMAT(dtCriado,'%d/%m/%Y - %H:%i') as dtCriado")],
               "CodNome"        => "Criado",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox",
                                        "Multiple"=>false, 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PdtCriado",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            
        ];

    private $Privilegios = [["Administrador","Select/Insert/Update/Delete"]];
    private $TipoPaginacao = ["Simples"=>false, "SaltoPagina"=> true, "Filtros"=>true, "BRefresh"=>true];
    
    public function ModoPaginacao() {
        return $this->TipoPaginacao;
    }
    /*
     * Informa que a tabela que está sendo trabalhada é uma view
     */
    public function getVirtual() {
        return false;
    }
    /*
     * Informa o nome da tabela na qual as operações de INSERT, UPDATE, e DELETE vão atuar
     */
    public function getNomeReal() {
        return "";
    }
    /*
     * Nome da tabela para a instrução SELECT
     */
    public function setNomeTabela() {
        $this->NomeTabela = __CLASS__;   
    }

    public function getCampos() {
        return $this->Campos;
    }

    public function getPrivilegios() {
        return $this->Privilegios;
    }

    public function getTituloTabela() {
        return "Tipos de eventos";
    }

    public function getLimite() {
        return 10;
    }

    public function getMostrarContador() {
        return true;
    }

    public function showColumnsIcones() {
        $Habilitar = false;
        $Icones = [
                        ["NomeColuna"=> "<i class='fa fa-camera' style='font-size:20px'></i>","NomeBotao"=>"Localizar", "Icone" => "fa fa-camera", "Func" => 0, "Tipo" => "Font_Awesome", "tooltip"=> "Exibir foto","Visible"=>true]
                    ];
        $ShowColumns[0] = $Habilitar;
        $ShowColumns[1] = $Icones;
        
        return $ShowColumns;
        
    }
    /**
     * A idéia do método é possibilitar o retorno de valor padrão baseado em qualquer outro método.
     * @param int $idx
     * @return boolean
     */
    public function getValorPadrao($idx) {
        $ValorPadraoCampos[0] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[1] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[2] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[3] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[4] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[5] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[6] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[7] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[8] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[9] = ["Exist"=>false, Valor=>"sim"];
        
        return $ValorPadraoCampos[$idx];
    }

    public function getPrivBD() {
        
    }
    /**
     * Método muito importante para o sistema. 
     * Através deste método, podemos criar os filtros padrões de cada campo.
     * O método foi criado com o intuito de se poder criar qualquer tipo de filtro padrão.
     */
    public function getFiltrosCampo() {
        
    }

    public function Jobs($Tipo, &$ConjuntoDados, $Action, $Resultado) {
        switch ($Tipo) {
            case "InserirDadosTabela":
                switch ($Action) {
                    case "BeforeInsert":
                        $ConjuntoDados[6]["name"] = "PLogin";
                        $ConjuntoDados[6]["value"] = $this->UsuarioLogin;
                        break;

                    case "AfterInsert":
                        $IDEvento = $this->lastInsertId();
                        
                        break;
                    default:
                        break;
                }
                break;

            default:
                break;
        }
        
        return true;
    }

    public function getTotalPageVisible() {
       return 20;
    }

    public function validarConteudoCampoRegex(&$Dados) {
        return true;
    }

    public function NormalizarFiltro($Tipo) {
        
    }
    /*
     * Função que é executada que poderá ter retornos variados como: array, boolean, json, etc...
     */
    public function getFuncoesGenericas() {
        return true;
    }

}

class adm_select_listas_eventos extends ModeloTabelas{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Campos =  [
           
            [
               "Index"          => 0,                                   //Ordem dos campos
               "Field"          => "ide",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Evento",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => true,
                                        "Tabela"=> "adm_eventos_listas_eventos",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        "CamposTblExtrangeira"=>[0,1] //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select",
                                        "Multiple"=>false, 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PEvento",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 1,                                   //Ordem dos campos
               "Field"          => "idtl",                       //Nome original do campo (String)
               "FieldFunc"      => [false,false],
               "CodNome"        => "Lista",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => true,
                                        "Tabela"=> "adm_listas_dos_eventos",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>[1,2] //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", 
                                        "Multiple"=>false,
                                        "TypeConteudo"=> ["number"], 
                                        "Name" => "PTipoEvento",
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => true,
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>true,
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 2,                                   //Ordem dos campos
               "Field"          => "dtCriado",                       //Nome original do campo (String)
               "FieldFunc"      => [false,false],
               "CodNome"        => "Criado",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox",
                                        "Multiple"=>false, 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PdtCriado",
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 0], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            
        ];

    private $Privilegios = [["Administrador","Select///"]];
    private $TipoPaginacao = ["Simples"=>false, "SaltoPagina"=> true, "Filtros"=>true, "BRefresh"=>true];
    
    public function ModoPaginacao() {
        return $this->TipoPaginacao;
    }
    /*
     * Informa que a tabela que está sendo trabalhada é uma view
     */
    public function getVirtual() {
        return false;
    }
    /*
     * Informa o nome da tabela na qual as operações de INSERT, UPDATE, e DELETE vão atuar
     */
    public function getNomeReal() {
        return "";
    }
    /*
     * Nome da tabela para a instrução SELECT
     */
    public function setNomeTabela() {
        $this->NomeTabela = __CLASS__;   
    }

    public function getCampos() {
        return $this->Campos;
    }

    public function getPrivilegios() {
        return $this->Privilegios;
    }

    public function getTituloTabela() {
        return "Selecione um evento e uma lista";
    }

    public function getLimite() {
        return 1;
    }

    public function getMostrarContador() {
        return true;
    }

    public function showColumnsIcones() {
        $Habilitar = false;
        $Icones = [
                        ["NomeColuna"=> "<i class='fa fa-camera' style='font-size:20px'></i>","NomeBotao"=>"Localizar", "Icone" => "fa fa-camera", "Func" => 0, "Tipo" => "Font_Awesome", "tooltip"=> "Exibir foto","Visible"=>true]
                    ];
        $ShowColumns[0] = $Habilitar;
        $ShowColumns[1] = $Icones;
        
        return $ShowColumns;
        
    }
    /**
     * A idéia do método é possibilitar o retorno de valor padrão baseado em qualquer outro método.
     * @param int $idx
     * @return boolean
     */
    public function getValorPadrao($idx) {
        $ValorPadraoCampos[0] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[1] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[2] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[3] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[4] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[5] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[6] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[7] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[8] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[9] = ["Exist"=>false, Valor=>"sim"];
        
        return $ValorPadraoCampos[$idx];
    }

    public function getPrivBD() {
        
    }
    /**
     * Método muito importante para o sistema. 
     * Através deste método, podemos criar os filtros padrões de cada campo.
     * O método foi criado com o intuito de se poder criar qualquer tipo de filtro padrão.
     */
    public function getFiltrosCampo() {
        
    }

    public function Jobs($Tipo, &$ConjuntoDados, $Action, $Resultado) {
        switch ($Tipo) {
            case "InserirDadosTabela":
                switch ($Action) {
                    default:
                    break;
                }
                break;

            default:
                break;
        }
        
        return true;
    }

    public function getTotalPageVisible() {
       return 1;
    }

    public function validarConteudoCampoRegex(&$Dados) {
        return true;
    }

    public function NormalizarFiltro($Tipo) {
        
    }
    /*
     * Função que é executada que poderá ter retornos variados como: array, boolean, json, etc...
     */
    public function getFuncoesGenericas() {
        return true;
    }

}

class adm_listas_dos_eventos extends ModeloTabelas{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Campos =  [
           
            [
               "Index"          => 0,                                   //Ordem dos campos
               "Field"          => "ide",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Evento",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select",
                                        "Multiple"=>false, 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "Evento",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 1,                                   //Ordem dos campos
               "Field"          => "idtl",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Lista",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "Multiple"=>false,
                                        "TypeConteudo"=> ["number"], 
                                        "Name" => "PTipoEvent",
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => true,
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>true,
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 2,                                   //Ordem dos campos
               "Field"          => "Nome",                       //Nome original do campo (String)
               "FieldFunc"      => [false,false],
               "CodNome"        => "Nome",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox",
                                        "Multiple"=>false, 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PdtCriado",
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 0], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            
        ];

    private $Privilegios = [["Administrador","Select///"]];
    private $TipoPaginacao = ["Simples"=>false, "SaltoPagina"=> true, "Filtros"=>true, "BRefresh"=>true];
    
    public function ModoPaginacao() {
        return $this->TipoPaginacao;
    }
    /*
     * Informa que a tabela que está sendo trabalhada é uma view
     */
    public function getVirtual() {
        return false;
    }
    /*
     * Informa o nome da tabela na qual as operações de INSERT, UPDATE, e DELETE vão atuar
     */
    public function getNomeReal() {
        return "";
    }
    /*
     * Nome da tabela para a instrução SELECT
     */
    public function setNomeTabela() {
        $this->NomeTabela = __CLASS__;   
    }

    public function getCampos() {
        return $this->Campos;
    }

    public function getPrivilegios() {
        return $this->Privilegios;
    }

    public function getTituloTabela() {
        return "Selecione um evento e uma lista";
    }

    public function getLimite() {
        return 20;
    }

    public function getMostrarContador() {
        return true;
    }

    public function showColumnsIcones() {
        $Habilitar = false;
        $Icones = [
                        ["NomeColuna"=> "<i class='fa fa-camera' style='font-size:20px'></i>","NomeBotao"=>"Localizar", "Icone" => "fa fa-camera", "Func" => 0, "Tipo" => "Font_Awesome", "tooltip"=> "Exibir foto","Visible"=>true]
                    ];
        $ShowColumns[0] = $Habilitar;
        $ShowColumns[1] = $Icones;
        
        return $ShowColumns;
        
    }
    /**
     * A idéia do método é possibilitar o retorno de valor padrão baseado em qualquer outro método.
     * @param int $idx
     * @return boolean
     */
    public function getValorPadrao($idx) {
        $ValorPadraoCampos[0] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[1] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[2] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[3] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[4] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[5] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[6] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[7] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[8] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[9] = ["Exist"=>false, Valor=>"sim"];
        
        return $ValorPadraoCampos[$idx];
    }

    public function getPrivBD() {
        
    }
    /**
     * Método muito importante para o sistema. 
     * Através deste método, podemos criar os filtros padrões de cada campo.
     * O método foi criado com o intuito de se poder criar qualquer tipo de filtro padrão.
     */
    public function getFiltrosCampo() {
        
    }

    public function Jobs($Tipo, &$ConjuntoDados, $Action, $Resultado) {
        switch ($Tipo) {
            case "InserirDadosTabela":
                switch ($Action) {
                    case "BeforeInsert":
                        $ConjuntoDados[6]["name"] = "PLogin";
                        $ConjuntoDados[6]["value"] = $this->UsuarioLogin;
                        break;
                    
                    default:
                        break;
                }
                break;

            default:
                break;
        }
        
        return true;
    }

    public function getTotalPageVisible() {
       return 1;
    }

    public function validarConteudoCampoRegex(&$Dados) {
        return true;
    }

    public function NormalizarFiltro($Tipo) {
        
    }
    /*
     * Função que é executada que poderá ter retornos variados como: array, boolean, json, etc...
     */
    public function getFuncoesGenericas() {
        return true;
    }

}

class adm_eventos_listas_eventos extends ModeloTabelas{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Campos =  [
           
            [
               "Index"          => 0,                                   //Ordem dos campos
               "Field"          => "ide",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "ide",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [true, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "ideventos",
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 1],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 1,                                   //Ordem dos campos
               "Field"          => "Nome",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Nome",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "Nome do evento", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PNome",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => true,
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 2,                                   //Ordem dos campos
               "Field"          => "Valor",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Valor",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "Valor entrada", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["numeric"], 
                                        "Name" => "PValor",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 3,                                   //Ordem dos campos
               "Field"          => "Data",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Data",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["date"], 
                                        "Name" => "PData",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 4,                                   //Ordem dos campos
               "Field"          => "Descricao",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Descrição",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "Texto que descreva o evento", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PDescricao",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 5,                                   //Ordem dos campos
               "Field"          => "Capa",                       //Nome original do campo (String)
               "FieldFunc"      => [true,"(select blitz_bimagens.Path from blitz_bimagens where blitz_bimagens.idi=Capa) as Capa"],
               "CodNome"        => "Capa",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => true,
                                        "Tabela"=> "adm_blitzimagens",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>[0,3,1,3] //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PCapa",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 6,                                   //Ordem dos campos
               "Field"          => "Ativo",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Ativo",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", 
                                        "TypeConteudo"=> ["Não","Sim"], 
                                        "Name" => "PAtivo",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"0",
                                        "max"=>"1",
                                        "maxlength"=>"1",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 7,                                   //Ordem dos campos
               "Field"          => "Login",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Login",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => false,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PLogin",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 8,                                   //Ordem dos campos
               "Field"          => "dtModify",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "dtModify",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["date"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => false,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PdtModify",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 9,                                   //Ordem dos campos
               "Field"          => "dtCriado",                       //Nome original do campo (String)
               "FieldFunc"      => [true,("DATE_FORMAT(dtCriado,'%d/%m/%Y - %H:%i') as dtCriado")],
               "CodNome"        => "Criado",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PdtCriado",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            
        ];

    private $Privilegios = [["Administrador","Select/Insert/Update/Delete"]];
    private $TipoPaginacao = ["Simples"=>false, "SaltoPagina"=> true, "Filtros"=>true, "BRefresh"=>true];
    
    public function ModoPaginacao() {
        return $this->TipoPaginacao;
    }
    /*
     * Informa que a tabela que está sendo trabalhada é uma view
     */
    public function getVirtual() {
        return true;
    }
    /*
     * Informa o nome da tabela na qual as operações de INSERT, UPDATE, e DELETE vão atuar
     */
    public function getNomeReal() {
        return "(select * from eventos where eventos.Ativo = 'Sim') as eventos";
    }
    /*
     * Nome da tabela para a instrução SELECT
     */
    public function setNomeTabela() {
        $this->NomeTabela = __CLASS__;   
    }

    public function getCampos() {
        return $this->Campos;
    }

    public function getPrivilegios() {
        return $this->Privilegios;
    }

    public function getTituloTabela() {
        return "Eventos Gerenciados";
    }

    public function getLimite() {
        return 10;
    }

    public function getMostrarContador() {
        return true;
    }

    public function showColumnsIcones() {
        $Habilitar = true;
        $Icones = [
                        ["NomeColuna"=> "<i class='fa fa-camera' style='font-size:20px'></i>","NomeBotao"=>"Localizar", "Icone" => "fa fa-camera", "Func" => 0, "Tipo" => "Font_Awesome", "tooltip"=> "Exibir foto","Visible"=>true]
                    ];
        $ShowColumns[0] = $Habilitar;
        $ShowColumns[1] = $Icones;
        
        return $ShowColumns;
        
    }
    /**
     * A idéia do método é possibilitar o retorno de valor padrão baseado em qualquer outro método.
     * @param int $idx
     * @return boolean
     */
    public function getValorPadrao($idx) {
        $ValorPadraoCampos[0] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[1] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[2] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[3] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[4] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[5] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[6] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[7] = ["Exist"=>false, Valor=>"sim"];
        
        return $ValorPadraoCampos[$idx];
    }

    public function getPrivBD() {
        
    }
    /**
     * Método muito importante para o sistema. 
     * Através deste método, podemos criar os filtros padrões de cada campo.
     * O método foi criado com o intuito de se poder criar qualquer tipo de filtro padrão.
     */
    public function getFiltrosCampo() {
        
    }

    public function Jobs($Tipo, &$ConjuntoDados, $Action, $Resultado) {
        switch ($Tipo) {
            case "InserirDadosTabela":
                switch ($Action) {
                    case "BeforeInsert":
                        $ConjuntoDados[6]["name"] = "PLogin";
                        $ConjuntoDados[6]["value"] = $this->UsuarioLogin;
                        break;
                    
                    case "AfterInsert":
                        //ID do evento que acabou de ser criado..
                        $IDEvento = $this->lastInsertId();
                        
                        /**
                         * Pequisa dentro dos tipo de eventos se existe o tipo Evento
                         */
                        $Handle_Tipo_Event = $this->query("SELECT idte from tipo_evento where Nome = 'Eventos'");
                        $Listas_Evento = $Handle_Tipo_Event->fetch(pdo::FETCH_ASSOC);
                        /**
                         * Criar uma lista para cada tipo de vento, lista de 30 reais, 40 reais ...
                         */
                        foreach ($Listas_Evento as $Valor_LE) {
                            $Consulta_TL = "SELECT idtl FROM tipo_listas WHERE Tipo = ${Valor_LE['idte']} AND Ativa = 'Sim'";
                            $Handle_Tipos_Listas = $this->query($Consulta_TL);
                            $Tipos_Listas = $Handle_Tipos_Listas->fetchAll(pdo::FETCH_ASSOC);
                            $Total = count($Tipos_Listas);

                            if($Total === 0){
                                throw new Exception("Não existem listas para Eventos!", 12000);
                            }else{
                                foreach ($Tipos_Listas as $key => $value) {
                                    $Inserir_Tipos_Listas = "INSERT INTO listas_dos_eventos (ide, idtl) values(${IDEvento}, ${value['idtl']})";
                                    $this->query($Inserir_Tipos_Listas);
                                }
                            }

                        }
                        /**
                         * Verifica e cria um lista free para cada evento
                         */
                        $Handle_Tipo_Event = $this->query("SELECT idte from tipo_evento where Nome = 'FREE'");
                        $Listas_Evento_FREE = $Handle_Tipo_Event->fetch(pdo::FETCH_ASSOC);
                        $Total = count($Listas_Evento_FREE);
                        if($Total > 0){
                            $Consulta_TL = "SELECT idtl FROM tipo_listas WHERE Tipo = ${Listas_Evento_FREE['idte']} AND Ativa = 'Sim'";
                            $FREE_HANDLE = $this->query($Consulta_TL);                             
                            $Tipos_Listas_FREE = $FREE_HANDLE->fetchAll(pdo::FETCH_ASSOC);
                            $Total = count($Tipos_Listas_FREE);
                            if($Total !== 0){
                                foreach ($Tipos_Listas_FREE as $value) {
                                    $Inserir_Tipos_FREE = "INSERT INTO listas_dos_eventos (ide, idtl) values(${IDEvento}, ${value['idtl']})";
                                    $this->query($Inserir_Tipos_FREE);
                                }
                            }    
                            
                        }
                        /**
                         * Verifica e cria um lista VIP para cada evento.
                         */
                        $Handle_Tipo_Event = $this->query("SELECT idte from tipo_evento where Nome = 'VIP'");
                        $Listas_Evento_VIP = $Handle_Tipo_Event->fetch(pdo::FETCH_ASSOC);
                        $Total = count($Listas_Evento_VIP);
                        if($Total > 0){
                            $Consulta_TL = "SELECT idtl FROM tipo_listas WHERE Tipo = ${Listas_Evento_VIP['idte']} AND Ativa = 'Sim'";
                            $VIP_HANDLE = $this->query($Consulta_TL);                             
                            $Tipos_Listas_VIP = $VIP_HANDLE->fetchAll(pdo::FETCH_ASSOC);
                            $Total = count($Tipos_Listas_VIP);
                            if($Total !== 0){
                                foreach ($Tipos_Listas_VIP as $value) {
                                    $Inserir_Tipos_VIP = "INSERT INTO listas_dos_eventos (ide, idtl) values(${IDEvento}, ${value['idtl']})";
                                    $this->query($Inserir_Tipos_VIP);
                                }
                            }   
                            
                        }                       
                        
                        
                        break;
                    
                    default:
                        break;
                }
                break;

            default:
                break;
        }
        
        return true;
    }

    public function getTotalPageVisible() {
       return 20;
    }

    public function validarConteudoCampoRegex(&$Dados) {
        return true;
    }

    public function NormalizarFiltro($Tipo) {
        
    }
    /*
     * Função que é executada que poderá ter retornos variados como: array, boolean, json, etc...
     */
    public function getFuncoesGenericas() {
        return true;
    }

}

class adm_membros_das_listas extends ModeloTabelas{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Campos =  [
           
            [
               "Index"          => 0,                                   //Ordem dos campos
               "Field"          => "ide",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "ide",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [true, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "Pide",
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 1],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 1,                                   //Ordem dos campos
               "Field"          => "idtl",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "idtl",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [true, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "Pidtl",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => true,
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 2,                                   //Ordem dos campos
               "Field"          => "cpf",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "CPF",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [true, true],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["numeric"], 
                                        "Name" => "PCPF",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 3,                                   //Ordem dos campos
               "Field"          => "idLogin",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "idLogin",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["numeric"], 
                                        "Name" => "PLogin",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 4,                                   //Ordem dos campos
               "Field"          => "Checkin",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Checkin",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["number"], 
                                        "Name" => "PCheckin",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 5,                                   //Ordem dos campos
               "Field"          => "dtChekin",                       //Nome original do campo (String)
               "FieldFunc"      => [true,("DATE_FORMAT(dtChekin,'%d/%m/%Y - %H:%i') as dtChekin")],
               "CodNome"        => "Chekin",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["date"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => false,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PdtChekin",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 6,                                   //Ordem dos campos
               "Field"          => "dtCriado",                       //Nome original do campo (String)
               "FieldFunc"      => [true,("DATE_FORMAT(dtCriado,'%d/%m/%Y - %H:%i') as dtCriado")],
               "CodNome"        => "Criado",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PdtCriado",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            
        ];

    private $Privilegios = [["Administrador","Select/Insert/Update/Delete"]];
    private $TipoPaginacao = ["Simples"=>false, "SaltoPagina"=> true, "Filtros"=>true, "BRefresh"=>true];
    
    public function ModoPaginacao() {
        return $this->TipoPaginacao;
    }
    /*
     * Informa que a tabela que está sendo trabalhada é uma view
     */
    public function getVirtual() {
        return false;
    }
    /*
     * Informa o nome da tabela na qual as operações de INSERT, UPDATE, e DELETE vão atuar
     */
    public function getNomeReal() {
        return "";
    }
    /*
     * Nome da tabela para a instrução SELECT
     */
    public function setNomeTabela() {
        $this->NomeTabela = __CLASS__;   
    }

    public function getCampos() {
        return $this->Campos;
    }

    public function getPrivilegios() {
        return $this->Privilegios;
    }

    public function getTituloTabela() {
        return "Eventos Gerenciados";
    }

    public function getLimite() {
        return 10;
    }

    public function getMostrarContador() {
        return true;
    }

    public function showColumnsIcones() {
        $Habilitar = false;
        $Icones = [
                        ["NomeColuna"=> "<i class='fa fa-camera' style='font-size:20px'></i>","NomeBotao"=>"Localizar", "Icone" => "fa fa-camera", "Func" => 0, "Tipo" => "Font_Awesome", "tooltip"=> "Exibir foto","Visible"=>true]
                    ];
        $ShowColumns[0] = $Habilitar;
        $ShowColumns[1] = $Icones;
        
        return $ShowColumns;
        
    }
    /**
     * A idéia do método é possibilitar o retorno de valor padrão baseado em qualquer outro método.
     * @param int $idx
     * @return boolean
     */
    public function getValorPadrao($idx) {
        $ValorPadraoCampos[0] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[1] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[2] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[3] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[4] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[5] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[6] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[7] = ["Exist"=>false, Valor=>"sim"];
        
        return $ValorPadraoCampos[$idx];
    }

    public function getPrivBD() {
        
    }
    /**
     * Método muito importante para o sistema. 
     * Através deste método, podemos criar os filtros padrões de cada campo.
     * O método foi criado com o intuito de se poder criar qualquer tipo de filtro padrão.
     */
    public function getFiltrosCampo() {
        
    }

    public function Jobs($Tipo, &$ConjuntoDados, $Action, $Resultado) {
        switch ($Tipo) {
            case "InserirDadosTabela":
                switch ($Action) {
                    case "BeforeInsert":
                        $ConjuntoDados[6]["name"] = "PLogin";
                        $ConjuntoDados[6]["value"] = $this->UsuarioLogin;
                        break;

                    default:
                        break;
                }
                break;

            default:
                break;
        }
        
        return true;
    }

    public function getTotalPageVisible() {
       return 20;
    }

    public function validarConteudoCampoRegex(&$Dados) {
        return true;
    }

    public function NormalizarFiltro($Tipo) {
        
    }
    /*
     * Função que é executada que poderá ter retornos variados como: array, boolean, json, etc...
     */
    public function getFuncoesGenericas() {
        return true;
    }

}

class user_profile extends ModeloTabelas{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Campos =  [
           
            [
               "Index"          => 0,                                   //Ordem dos campos
               "Field"          => "idp",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "CPF",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [true, true],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "idPERFIL",
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 1],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 1,                                   //Ordem dos campos
               "Field"          => "Nome",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Nome",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "Primeiro nome", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PNome",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => true,
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 2,                                   //Ordem dos campos
               "Field"          => "Sobrenome",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Sobrenome",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PSobrenome",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 3,                                   //Ordem dos campos
               "Field"          => "Nasc",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Nascimento",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "lista",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //se não houve uma função, atribuir null. Executa uma função antes de apresentar os valores na lista do componente select
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null // Importante! o primeiro  -- Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", //o Campo conteúdo TypeConteudo - só será utilizado se não houver uma tabela estrangeira
                                        "TypeConteudo"=> ["date"], 
                                        "Name" => "PNasc",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 2], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => true,
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 4,                                   //Ordem dos campos
               "Field"          => "Cel",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "Celular",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> 0, 
                                        "NomeBotao"=> ""
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "33988617070", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["tel"], 
                                        "Name" => "PCEL", 
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 1],
                                        "Patterns"=> "[0-9]{11}", 
                                        "Titles" => "",
                                        "Required" => true,
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"0",
                                        "max"=>"1",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>"" //podemos definir várias configurações de style
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 5,                                   //Ordem dos campos
               "Field"          => "Email",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "E-mail",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> 0, 
                                        "NomeBotao"=> ""
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["email"], 
                                        "Name" => "PEMAIL", 
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 2],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => true,
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"0",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>"" //podemos definir várias configurações de style
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 6,                                   //Ordem dos campos
               "Field"          => "foto",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "foto",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> 0, 
                                        "NomeBotao"=> ""
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "Pfoto", 
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 2],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>"" //podemos definir várias configurações de style
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
        ];

    private $Privilegios = [["Administrador","Select/Insert/Update/Delete"],["Membros","Select/Update"]];
    private $TipoPaginacao = ["Simples"=>false, "SaltoPagina"=> true, "Filtros"=>true, "BRefresh"=>true];
    
    public function ModoPaginacao() {
        return $this->TipoPaginacao;
    }
    /*
     * Informa que a tabela que está sendo trabalhada é uma view
     */
    public function getVirtual() {
        return false;
    }
    /*
     * Informa o nome da tabela na qual as operações de INSERT, UPDATE, e DELETE vão atuar
     */
    public function getNomeReal() {
        return "";
    }
    /*
     * Nome da tabela para a instrução SELECT
     */
    public function setNomeTabela() {
        $this->NomeTabela = __CLASS__;   
    }

    public function getCampos() {
        return $this->Campos;
    }

    public function getPrivilegios() {
        return $this->Privilegios;
    }

    public function getTituloTabela() {
        return "Completar dados do usuário";
    }

    public function getLimite() {
        return 1;
    }

    public function getMostrarContador() {
        return true;
    }

    public function showColumnsIcones() {
        $Habilitar = false;
        $Icones = [
                        //["NomeColuna"=> "<i class='fa fa-bluetooth' style='font-size:20px'></i>","NomeBotao"=>"Localizar", "Icone" => "fa fa-search", "Func" => 0, "Tipo" => "Bootstrap", "tooltip"=> "busca"]
                    ];
        $ShowColumns[0] = $Habilitar;
        $ShowColumns[1] = $Icones;
        
        return $ShowColumns;
        
    }
    /**
     * A idéia do método é possibilitar o retorno de valor padrão baseado em qualquer outro método.
     * @param int $idx
     * @return boolean
     */
    public function getValorPadrao($idx) {
        $ValorPadraoCampos[0] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[1] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[2] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[3] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[4] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[5] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[6] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[7] = ["Exist"=>false, Valor=>"sim"];
        
        return $ValorPadraoCampos[$idx];
    }

    public function getPrivBD() {
        
    }
    /**
     * Método muito importante para o sistema. 
     * Através deste método, podemos criar os filtros padrões de cada campo.
     * O método foi criado com o intuito de se poder criar qualquer tipo de filtro padrão.
     */
    public function getFiltrosCampo() {
        $Ft = [[[0,"=", $this->UsuarioLogin]]];
        return $Ft;
    }

    public function Jobs($Tipo, &$ConjuntoDados, $Action, $Resultado) {
        switch ($Tipo) {
            case "AtualizarDadosTabela":

                break;

            default:
                break;
        }
        
        return true;
    }

    public function getTotalPageVisible() {
       return 20;
    }

    public function validarConteudoCampoRegex(&$Dados) {
        return true;
    }

    public function NormalizarFiltro($Tipo) {
        
    }
    /*
     * Função que é executada que poderá ter retornos variados como: array, boolean, json, etc...
     */
    public function getFuncoesGenericas() {
        
        $Dados = $this->getArrayDados();
        $PERF = null;
        
        if($Dados[0][1] === null || $Dados[0][3] === null || $Dados[0][4] === null || $Dados[0][5] === null){
            $PERF["Perfil_Concluido"] = false;
            return $PERF;
        }else {
            
            $PERF["Perfil_Concluido"] = true;
            
            //-----------EVENTOS----------------------------
            $query_1 = "select ide, Nome, Valor, Data, Descricao, (select path from imagens_eventos where idi = Capa) as Capa FROM eventos WHERE Ativo = 'Sim' ORDER by data DESC;";
            $EVENTOS = $this->query($query_1);
            
            $PERF["Eventos"] = $EVENTOS->fetch(PDO::FETCH_ASSOC);
            
            // Verifica se existem algum evento
            if($PERF["Eventos"] === false){
                return $PERF;
            }else{
                 //------------------NÍVEL DO USUÁRIO----------------------
                $query_2 = "SELECT Nivel FROM perfil WHERE idp = '$this->UsuarioLogin';";
                $NIVEL = $this->query($query_2);

                $PERF["Nivel"] = $NIVEL->fetch(PDO::FETCH_ASSOC);

                //-----------------------------------------------
                $IDE = $PERF["Eventos"]["ide"];
                $NIL = $PERF["Nivel"]["Nivel"];

                //----------------------------------------
                //Verifica se existe algum lista com o nível do usuário para o evento.
                $query_3 = "SELECT ide, idtl FROM user_nivel_listas_eventos WHERE ide = '$IDE' and Nivel = '$NIL';";
                $LISTAS = $this->query($query_3);

                $PERF["Listas_Eventos"] = $LISTAS->fetch(PDO::FETCH_ASSOC);
                
                //Verifica se existe algums lista já definida para o evento.
                if($PERF["Listas_Eventos"] === false){
                    return $PERF;
                }else{
                    //----------------------------------------
                    //Verifica se o usuário já está cadastrado na lista com o seu nível.
                    $IDTL = $PERF["Listas_Eventos"]["idtl"];
                    $query_3 = "SELECT ide, idtl FROM membros_das_listas WHERE ide = '$IDE' and  idtl = '$IDTL';";
                    $REGISTRADO = $this->query($query_3);

                    $PERF["Lista_no_Nivel"] = $REGISTRADO->fetch(PDO::FETCH_ASSOC); 
                }
                //-----------------------------------------

                return $PERF;
            }
            //---------------------------------------
            
           
        }
        
    }

}

class user_add_list_evento extends ModeloTabelas{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Campos =  [
           
            [
               "Index"          => 0,                                   //Ordem dos campos
               "Field"          => "ide",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "ide",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [true, true],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PIDE",
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 1],
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => "",
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 1,                                   //Ordem dos campos
               "Field"          => "idtl",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "IDTL",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PIDTL",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => true,
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 1,                                   //Ordem dos campos
               "Field"          => "cpf",                       //Nome original do campo (String)
               "FieldFunc"      => [false,null],
               "CodNome"        => "CPF",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => true,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => ["Exist"=> false, "Regx"=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "PCPF",
                                        "Grupos" =>["N_Grupo" => 0, "Divisao" => 1], 
                                        "Patterns"=> "", 
                                        "Titles" => "",
                                        "Required" => true,
                                        "width" => "",
                                        "height"=>"",
                                        "step"=>"",
                                        "size"=>"",
                                        "min"=>"",
                                        "max"=>"",
                                        "maxlength"=>"",
                                        "form"=>"",
                                        "formaction"=>"",
                                        "formenctype"=>"",
                                        "formmethod"=>"",
                                        "formnovalidate"=>"",
                                        "formtarget"=>"",
                                        "align"=>"",
                                        "alt"=>"",
                                        "autocomplete"=>"",
                                        "autofocus"=>"",
                                        "checked"=>"",
                                        "dirname"=>"",
                                        "readonly"=>"",
                                        "style"=>""
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],

        ];

    private $Privilegios = [["Membros","Insert"]];
    private $TipoPaginacao = ["Simples"=>false, "SaltoPagina"=> true, "Filtros"=>true, "BRefresh"=>true];
    
    public function ModoPaginacao() {
        return $this->TipoPaginacao;
    }
    /*
     * Informa que a tabela que está sendo trabalhada é uma view
     */
    public function getVirtual() {
        return false;
    }
    /*
     * Informa o nome da tabela na qual as operações de INSERT, UPDATE, e DELETE vão atuar
     */
    public function getNomeReal() {
        return "";
    }
    /*
     * Nome da tabela para a instrução SELECT
     */
    public function setNomeTabela() {
        $this->NomeTabela = __CLASS__;   
    }

    public function getCampos() {
        return $this->Campos;
    }

    public function getPrivilegios() {
        return $this->Privilegios;
    }

    public function getTituloTabela() {
        return "";
    }

    public function getLimite() {
        return 1;
    }

    public function getMostrarContador() {
        return true;
    }

    public function showColumnsIcones() {
        $Habilitar = false;
        $Icones = [
                        //["NomeColuna"=> "<i class='fa fa-bluetooth' style='font-size:20px'></i>","NomeBotao"=>"Localizar", "Icone" => "fa fa-search", "Func" => 0, "Tipo" => "Bootstrap", "tooltip"=> "busca"]
                    ];
        $ShowColumns[0] = $Habilitar;
        $ShowColumns[1] = $Icones;
        
        return $ShowColumns;
        
    }
    /**
     * A idéia do método é possibilitar o retorno de valor padrão baseado em qualquer outro método.
     * @param int $idx
     * @return boolean
     */
    public function getValorPadrao($idx) {
        $ValorPadraoCampos[0] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[1] = ["Exist"=>false, Valor=>"sim"];
        $ValorPadraoCampos[2] = ["Exist"=>false, Valor=>"sim"];
        
        return $ValorPadraoCampos[$idx];
    }

    public function getPrivBD() {
        
    }
    /**
     * Método muito importante para o sistema. 
     * Através deste método, podemos criar os filtros padrões de cada campo.
     * O método foi criado com o intuito de se poder criar qualquer tipo de filtro padrão.
     */
    public function getFiltrosCampo() {

    }

    public function Jobs($Tipo, &$ConjuntoDados, $Action, $Resultado) {
        switch ($Tipo) {
            case "InserirDadosTabela":
                if($Action === "BeforeInsert"){
                    $ConjuntoDados[2]["name"] = "PCPF";
                    $ConjuntoDados[2]["value"] = $this->UsuarioLogin;
                }
                break;

            default:
                break;
        }
        
        return true;
    }

    public function getTotalPageVisible() {
       return 0;
    }

    public function validarConteudoCampoRegex(&$Dados) {
        return true;
    }

    public function NormalizarFiltro($Tipo) {
        
    }
    /*
     * Função que é executada que poderá ter retornos variados como: array, boolean, json, etc...
     */
    public function getFuncoesGenericas() {

        
    }

}