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
               "Regex"          => [Exist=> false, Regx=> ""],
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
               "Regex"          => [Exist=> false, Regx=> ""],
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
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
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
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
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
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
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
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
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
    //private $Privilegios = [["PowerCoin","Select/Insert/Update/Delete"]];
    private $Privilegios = [["blitz","Select/Insert/Update/Delete"]];
    private $TipoPaginacao = ["Simples"=>false, "SaltoPagina"=> true, "Filtros"=>true, "BRefresh"=>true];
    
    public function ModoPaginacao() {
        return $this->TipoPaginacao;
    }
    
    public function getVirtual() {
        return false;
    }

    public function getNomeReal() {
        return "historico";
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
        return "CADASTRAR USUÁRIOS NO SISTEMA";
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
        $ValorPadraoCampos[0] = [Exist=>false, Valor=>"sim"];

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
        switch ($Action) {
            case "AfterInsert":
                
                break;

            default:
                break;
        }
    }
    /*
     * Controla a visibilidade da quantidade de paginas por tabela HTML. Os quadrinho para selecionar página.
     */
    public function getTotalPageVisible() {
       return 1;
    }

    public function validarConteudoCampoRegex(&$Dados) {
        $Name =  $Dados[0]["name"];
        if($Name == "usuario"){
            $Usuario = $Dados[0]["value"];
            $Verify_Field_User = preg_match("/^\w.*@.*\.com.*/i", $Usuario);
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

class cadastrar extends ModeloTabelas{
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
               "Filter"         => false,       
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
               "Regex"          => [Exist=> false, Regx=> ""],
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
                                        "TypeComponente"=>"inputbox",
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
                                        "readonly"=>"",
                                        "style"=>""
                                    ],
               /**
                * Informa ao sistema que o campo deverá, via tabela html, a opção de ordernar o campo.
                */
               "OrdemBY"        => true
           ],
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
               "Regex"          => [Exist=> false, Regx=> ""],
                /**
                 * Subarray - informa se o campo será atualizável
                 */
               "Formulario"     => [
                                        /**
                                         * Informa ao sistema que o campo será atualizável.
                                         */
                                        "Exibir"=> true,
                                        /**
                                         * Texto explicativo que ficará dentro do campo input type text
                                         */
                                        "Placeholder"=> "ola", 
                                        /**
                                         * Tipo de componente que será visualizado no formulário. inputbox, select
                                         */
                                        "TypeComponente"=>"inputbox",
                                        /**
                                         * Usado conjuntamente com o campo anterior. se for select o array se justifica
                                         */
                                        "TypeConteudo"=> ["text"],
                                        /**
                                         * Nome do campo que será exportado para o controller, esse campo deverá ter o nome diferente do nome
                                         * original por motivo de segurança
                                         */
                                        "Name" => "usuario", 
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
                                        "Required" => true,
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
                                        "size"=>"4",
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
                                        "readonly"=> false,
                                        "style"=>""
                                    ],
               /**
                * Informa ao sistema que o campo deverá, via tabela html, a opção de ordernar o campo.
                */
               "OrdemBY"        => true
           ],
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
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "senha", 
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
                                        "style"=>"width: 150px"
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
                                        "TExt" => true,
                                        "Tabela"=> "login",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        "CamposTblExtrangeira"=>[0,2] //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", 
                                        "TypeConteudo"=> ["Administrador","Gerente","Usuario","Bilheteria"], 
                                        "Name" => "TipoUser", 
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
                                        "style"=>"width:50%"
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
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["number"], 
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
                                        "readonly"=>"",
                                        "style"=>""
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
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["number"], 
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
                                        "readonly"=>"",
                                        "style"=>"width:10%" //podemos definir várias configurações de style
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
       
        ];

    private $Privilegios = [["blitz","Select/Insert/Update/Delete"]];
    private $TipoPaginacao = ["Simples"=>false, "SaltoPagina"=> true, "Filtros"=>true, "BRefresh"=>true];
    
    public function ModoPaginacao() {
        return $this->TipoPaginacao;
    }
    
    public function getVirtual() {
        return true;
    }

    public function getNomeReal() {
        return "login";
    }

    public function setNomeTabela() {
        $this->NomeTabela = "login" ;
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
        return 30;
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
        $ValorPadraoCampos[0] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[1] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[2] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[3] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[4] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[5] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[6] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[7] = [Exist=>false, Valor=>"sim"];
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
        switch ($Action) {
            case "AfterInsert":
                
                break;

            default:
                break;
        }
    }

    public function getTotalPageVisible() {
       return 20;
    }

    public function validarConteudoCampoRegex(&$Dados) {

    }

    public function NormalizarFiltro($Tipo) {
        
    }
    /*
     * Função que é executada que poderá ter retornos variados como: array, boolean, json, etc...
     */
    public function getFuncoesGenericas() {
        
    }

}

class view_user extends ModeloTabelas{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Campos =  [
           
            [
               "Index"          => 0,                                   //Ordem dos campos
               "Field"          => "idUser",                       //Nome original do campo (String)
               "CodNome"        => "idUser",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["texto"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [true, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => true,
                                        "Tabela"=> "login",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        "CamposTblExtrangeira"=>[0,1] //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "idUser", 
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
                                        "style"=>"width: 150px"
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 1,                                   //Ordem dos campos
               "Field"          => "usuario",                       //Nome original do campo (String)
               "CodNome"        => "Usuário",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["texto"],                           //Tipo de conteudo exibido na tabela HTML
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
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", 
                                        "TypeConteudo"=> null, 
                                        "Name" => "usuario", 
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
                                        "style"=>"width:50%"
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 2,                                   //Ordem dos campos
               "Field"          => "data",                       //Nome original do campo (String)
               "CodNome"        => "Data",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["texto"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> "",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> 0, 
                                        "NomeBotao"=> "",
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["date"], 
                                        "Name" => "date", 
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
               "Field"          => "descricao",                       //Nome original do campo (String)
               "CodNome"        => "descricao",                       //Codnome do campo, o que será visualizado pelo usuário (String)
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
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "descricao", 
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
                                        "style"=>"width:10%" //podemos definir várias configurações de style
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
       
        ];

    private $Privilegios = [["blitz","Select/Insert/Update/Delete"]];
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
        return "user";
    }
    /*
     * Nome da tabela para a instrução SELECT
     */
    public function setNomeTabela() {
        $this->NomeTabela = "view_user";   
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
        return 30;
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
        $ValorPadraoCampos[0] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[1] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[2] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[3] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[4] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[5] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[6] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[7] = [Exist=>false, Valor=>"sim"];
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
        switch ($Action) {
            case "AfterInsert":
                
                break;

            default:
                break;
        }
    }

    public function getTotalPageVisible() {
       return 20;
    }

    public function validarConteudoCampoRegex(&$Dados) {

    }

    public function NormalizarFiltro($Tipo) {
        
    }
    /*
     * Função que é executada que poderá ter retornos variados como: array, boolean, json, etc...
     */
    public function getFuncoesGenericas() {
        
    }

}

class evento extends ModeloTabelas{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Campos =  [
           
            [
               "Index"          => 0,                                   //Ordem dos campos
               "Field"          => "idCompra",                       //Nome original do campo (String)
               "CodNome"        => "idCompra",                       //Codnome do campo, o que será visualizado pelo usuário (String)
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
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "idCompra",
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
                                        "style"=>"width: 150px"
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 1,                                   //Ordem dos campos
               "Field"          => "idPerfil",                       //Nome original do campo (String)
               "CodNome"        => "IPerfil",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => true,
                                        "Tabela"=> "perfil",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>[0,1,1,2] //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "idPerfil",
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
                                        "style"=>"width: 150px"
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 2,                                   //Ordem dos campos
               "Field"          => "perfiles",                       //Nome original do campo (String)
               "CodNome"        => "Perfil",                       //Codnome do campo, o que será visualizado pelo usuário (String)
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
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", 
                                        "TypeConteudo"=> null, 
                                        "Name" => "perfiles",
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
                                        "style"=>"width:50%"
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 3,                                   //Ordem dos campos
               "Field"          => "idLista",                       //Nome original do campo (String)
               "CodNome"        => "Lista",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [false, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => true,
                                        "Tabela"=> "lista",
                                        "IdxCampoVinculado"=> 0, 
                                        "Funcao"=> false,  //se não houve uma função, atribuir null. Executa uma função antes de apresentar os valores na lista do componente select
                                        "NomeBotao"=> "",
                                        /* O primeiro é utilizado pelo componente select como id da chave primária  da tabela estrangeira.
                                         * O segundo é utilizado pelo componente select como a informação que será mostrada no componente referente à chave
                                         * o terceiro é utilizado pelo componente como id da tabela real para mostrar o elemente que está armazenado.
                                         * o quarto é a informação que será apresentada, quando da subquery, que mostra o valor representado pela chave estrangeira, uma vez que a mesma é uma valor mais abstrato.
                                         */
                                        "CamposTblExtrangeira"=>[0,1,3,4] // Importante! o primeiro  -- Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", //o Campo conteúdo TypeConteudo - só será utilizado se não houver uma tabela estrangeira
                                        "TypeConteudo"=> [""], 
                                        "Name" => "idLista",
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
               "Field"          => "NomeLista",                       //Nome original do campo (String)
               "CodNome"        => "Nome Lista",                       //Codnome do campo, o que será visualizado pelo usuário (String)
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
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "NomeLista", 
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
                                        "style"=>"width:10%" //podemos definir várias configurações de style
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 5,                                   //Ordem dos campos
               "Field"          => "Valor",                       //Nome original do campo (String)
               "CodNome"        => "Valor",                       //Codnome do campo, o que será visualizado pelo usuário (String)
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
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "Valor", 
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
                                        "style"=>"width:10%" //podemos definir várias configurações de style
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 6,                                   //Ordem dos campos
               "Field"          => "data",                       //Nome original do campo (String)
               "CodNome"        => "Data",                       //Codnome do campo, o que será visualizado pelo usuário (String)
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
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "data",
                                        "Grupos" =>["N_Grupo" => 2, "Divisao" => 1], 
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
                                        "style"=>"width:10%" //podemos definir várias configurações de style
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 7,                                   //Ordem dos campos
               "Field"          => "Beneficio",                       //Nome original do campo (String)
               "CodNome"        => "Benefícios",                       //Codnome do campo, o que será visualizado pelo usuário (String)
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
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "Beneficio",
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
                                        "style"=>"width:10%" //podemos definir várias configurações de style
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 8,                                   //Ordem dos campos
               "Field"          => "checkin",                       //Nome original do campo (String)
               "CodNome"        => "Chek-in",                       //Codnome do campo, o que será visualizado pelo usuário (String)
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
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "checkin",
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 1], //Funciona no componente Formulário.js 
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
                                        "style"=>"width:10%" //podemos definir várias configurações de style
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 9,                                   //Ordem dos campos
               "Field"          => "imagem",                       //Nome original do campo (String)
               "CodNome"        => "imagem",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["imagem"],                           //Tipo de conteudo exibido na tabela HTML
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
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"imagem", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "imagem",
                                        "Grupos" =>["N_Grupo" => 1, "Divisao" => 1], //Funciona no componente Formulário.js 
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
                                        "style"=>"width:100%" //podemos definir várias configurações de style
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
       
        ];

    private $Privilegios = [["blitz","Select/Insert/Update/Delete"]];
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
        return "compralista";
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
        return 5;
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
        $ValorPadraoCampos[0] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[1] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[2] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[3] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[4] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[5] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[6] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[7] = [Exist=>false, Valor=>"sim"];
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
        switch ($Action) {
            case "AfterInsert":
                
                break;

            default:
                break;
        }
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
        
    }

}

class perfil extends ModeloTabelas{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Campos =  [
           
            [
               "Index"          => 0,                                   //Ordem dos campos
               "Field"          => "idPerfil",                       //Nome original do campo (String)
               "CodNome"        => "IPerfil",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [true, false],                       //Chave primária (boolean)
               "ChvExt"         => [        
                                        "TExt" => false,
                                        "Tabela"=> null,
                                        "IdxCampoVinculado"=> null, 
                                        "Funcao"=> null,  //"null" ou "0" número da função representanda no componente.
                                        "NomeBotao"=> null,
                                        "CamposTblExtrangeira"=>null //Define os campos, pelo index deles onde o primeiro a chave e o segundo qual será visualizado
                                    ],   //Chave estrangeira
               "Mask"           => false,                               // Máscara (String) Contém a máscara que será utilizada pelo campo
               "Editar"         => false,                               //Editável - (boolean)  
               "Visible"        => true,                                //Mostrar na tabela HTML (boolean)
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "idPerfil", 
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
                                        "style"=>"width: 150px"
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 1,                                   //Ordem dos campos
               "Field"          => "nome",                       //Nome original do campo (String)
               "CodNome"        => "Nome",                       //Codnome do campo, o que será visualizado pelo usuário (String)
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
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"inputbox", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "Nomes", 
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
                                        "style"=>"width:50%"
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],

       
        ];

    private $Privilegios = [["blitz","Select/Insert/Update/Delete"]];
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
        return "user";
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
        return 5;
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
        $ValorPadraoCampos[0] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[1] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[2] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[3] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[4] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[5] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[6] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[7] = [Exist=>false, Valor=>"sim"];
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

    /*
     * Com as nova alterações é obrigatorio o retorno de true ou false para a manutenção do rollback;
     */
    public function Jobs($Tipo, &$ConjuntoDados, $Action, $Resultado) {
        switch ($Action) {
            case "BeforeUpdate":
                
                break;
            case "IFA":
                
                break;
            case "AfterInsert":
                
                break;
            default:
                break;
        }
        
        return true;
    }

    public function getTotalPageVisible() {
       return 20;
    }
    /**Campo importante
     * Tem que haver o retorno, mesmo que nenhuma ação aconteça, para não impedir de 
     * @param type $Dados
     * @return boolean
     */
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

class lista extends ModeloTabelas{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Campos =  [
           
            [
               "Index"          => 0,                                   //Ordem dos campos
               "Field"          => "idLista",                       //Nome original do campo (String)
               "CodNome"        => "idLista",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [true, false],                       //Chave primária (boolean)
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
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "idPerfil", 
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
                                        "style"=>"width: 150px"
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 1,                                   //Ordem dos campos
               "Field"          => "nome",                       //Nome original do campo (String)
               "CodNome"        => "Nome",                       //Codnome do campo, o que será visualizado pelo usuário (String)
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
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", 
                                        "TypeConteudo"=> null, 
                                        "Name" => "perfiles", 
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
                                        "style"=>"width:50%"
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],

       
        ];

    private $Privilegios = [["blitz","Select/Insert/Update/Delete"]];
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
        return "user";
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
        return 30;
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
        $ValorPadraoCampos[0] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[1] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[2] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[3] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[4] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[5] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[6] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[7] = [Exist=>false, Valor=>"sim"];
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
        switch ($Action) {
            case "AfterInsert":
                
                break;

            default:
                break;
        }
    }

    public function getTotalPageVisible() {
       return 20;
    }

    public function validarConteudoCampoRegex(&$Dados) {

    }

    public function NormalizarFiltro($Tipo) {
        
    }
    /*
     * Função que é executada que poderá ter retornos variados como: array, boolean, json, etc...
     */
    public function getFuncoesGenericas() {
        
    }

}

class BancoImagens extends ModeloTabelas{
    /**
     * Mapeia os campos da tabela - Muito importante caso se queira visualizar somente campo necessários
     */
    private $Campos =  [
           
            [
               "Index"          => 0,                                   //Ordem dos campos
               "Field"          => "idImagem",                       //Nome original do campo (String)
               "CodNome"        => "idLista",                       //Codnome do campo, o que será visualizado pelo usuário (String)
               "TypeConteudo"   => ["text"],                           //Tipo de conteudo exibido na tabela HTML
               "Filter"         => false,                               //Habilita a visualização da caixa popv para filtro e classificação
               "Key"            => [true, false],                       //Chave primária (boolean)
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
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> true,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", 
                                        "TypeConteudo"=> ["text"], 
                                        "Name" => "idPerfil", 
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
                                        "style"=>"width: 150px"
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],
            [
               "Index"          => 1,                                   //Ordem dos campos
               "Field"          => "nome",                       //Nome original do campo (String)
               "CodNome"        => "Nome",                       //Codnome do campo, o que será visualizado pelo usuário (String)
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
               "Regex"          => [Exist=> false, Regx=> ""],                               //Regex que será utilizada.
               "Formulario"     => [
                                        "Exibir"=> false,
                                        "Placeholder"=> "", 
                                        "TypeComponente"=>"select", 
                                        "TypeConteudo"=> null, 
                                        "Name" => "perfiles", 
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
                                        "style"=>"width:50%"
                                    ],                                  //Informa se o campo fará parte do formulários
               "OrdemBY"        => true
           ],

       
        ];

    private $Privilegios = [["blitz","Select/Insert/Update/Delete"]];
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
        return "user";
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
        return 30;
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
        $ValorPadraoCampos[0] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[1] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[2] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[3] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[4] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[5] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[6] = [Exist=>false, Valor=>"sim"];
        $ValorPadraoCampos[7] = [Exist=>false, Valor=>"sim"];
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
        switch ($Action) {
            case "AfterInsert":
                
                break;

            default:
                break;
        }
    }

    public function getTotalPageVisible() {
       return 20;
    }

    public function validarConteudoCampoRegex(&$Dados) {

    }

    public function NormalizarFiltro($Tipo) {
        
    }
    /*
     * Função que é executada que poderá ter retornos variados como: array, boolean, json, etc...
     */
    public function getFuncoesGenericas() {
        
    }

}