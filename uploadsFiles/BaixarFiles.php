<?php
session_cache_expire(600);

if(!@include_once ConfigSystema::get_Path_Systema() . '/uploadsFiles/phpUpfiles/TratarFiles.php'){
    $ResultRequest["Erros"]["Modo"]        = "Include";
    $ResultRequest["Erros"][0]             = true;
    $ResultRequest["Erros"][1]             = 3300;
    $ResultRequest["Erros"][2]             = "Error include. uploadsFiles";

    echo json_encode($ResultRequest); 
    exit;
}
try{
    $Campos = filter_input(INPUT_POST, "CAMPOS");
    /**
     * Caso a sessão esteja ativada, será buscado o nome de usuário logado no sistema para gravações em 
     * pastas separadas.
     */
    $User = $SystemUsuario;
    /**
     * Busca o caminho onde serão armazenado os arquivos.
     */
    $StoreImagens = ConfigSystema::getStoreFiles("DestinoHD");
    
    $Count = 0;
    foreach ($_FILES as $key => $value) {
        
        $upFiles = new uploadsImg($value, $Sessao, $User);
        /**
         * Verifica a forma de armazenamento da imagem. Retorno true storeg(HD), false BD.
         */
        if($upFiles->get_Storeg()){
            $upFiles->PathDestino($StoreImagens); //Seta o caminho da imagem.
            $Cm = $upFiles->CriarDestinoImagem(); //Cria a pasta onde armazenará as imagens
            
            if($Cm){
                $Saida = $upFiles->moverImagens(); //Move os arquivos da pasta temporária para a pasta permanente.
                if($Saida[0]){
                    $CaminhoHTML = $Saida[2];
                    /**
                     * Cadas domínio terá que ser avaliado o tamanho
                     */
                    $CaminhoHTML = substr($CaminhoHTML, 21, strlen($CaminhoHTML));
                    
                    if(!$upFiles->get_Storeg_tabela()) continue;
                    /**
                     * Verifica se o array $Saida já vem com dados.
                     */
                    $NII = null;
                    if(!is_array($Dados)){
                        $nomeImagem = $_POST["NomesImagens"];
                        if($nomeImagem !== null && $nomeImagem !== ""){
                            $NI = preg_split("/,/", $nomeImagem);
                            
                            foreach ($NI as $IKey => $IValue) {
                                if($IValue === $value["name"]){
                                    $NII = $NI[$IKey + 1];
                                    break;
                                }
                            }
                        }else{
                            $NII = substr($Saida[1], 0, strlen($Saida[1]) - 4);                            
                        }
                        
                        $Dados = [
                                    ["name"=>"destino", "value"=>"$CaminhoHTML"],
                                    ["name"=>"idUser", "value"=> $User],
                                    ["name"=>"Nome", "value"=>$NII],
                                ];
                        
                        if($Campos){
                            $Trans_Campos = json_decode($Campos);
                            foreach($Trans_Campos as $Chave => $Valor){
                                $CMP["name"] = $Valor->name;
                                $CMP["value"] = $Valor->value;
                                array_push($Dados,$CMP);
                            }
                        }
                        
                    }else{
                        /**
                         * Existindo um array, que provavelmente será de outros campos, será acrescentado um outro array.
                         */
                        $Dados[0][1] = ["name"=>2, "value"=>"$CaminhoHTML"];  
                    }
        
                    if(empty($Tabela)) throw new Exception("Nenhuma tabela foi definida, favor entrar em contato com o administrador.");

                    /**
                     * Cria um objeto da classe ModeloTabela.php mapeada.
                     */
                    $InserirDados = new $Tabela();
                    /**
                     * Se a sessão for anônima deverá ser devinido um usuario e privilégios de acesso na tabela através
                     * da variável privilegios em cada classe que representa a tabela.
                     */
                    $InserirDados->setUsuario("04953988612");
                    $InserirDados->setTipoUsuario("FULL");
                    $Result = $InserirDados->InserirDadosTabela($Dados);
                    $Dados = NULL;
                    
                    if(!$Result){
                        $Remove = $upFiles->removeArquivo(); //Caso a inserção dos dados tenha falhado o arquivo será removido.
                        if(!$Remove){
                            $FilesErros[$Count][0] = $Saida[1];
                            $FilesErros[$Count][1] = $InserirDados->getErros();
                            $Count++;
                        }
                    }
    
                }else{
                    throw new Exception("Não foi possível mover a imagem, motivo desconhecido. Favor entrar em contato com o administrador. Local: BaixarFiles", 3306);
                }
            }else{
                throw new Exception("Não foi possível criar a pasta de destino no servidor, motivo desconhecido. Favor entrar em contato com o administrador. Local: BaixarFiles", 3305);
            }  
            
        }else{
            
        }
        $Count++;
    }

    
} catch (Exception $ex) {
        $ResultRequest["Modo"]        = "S";
        $ResultRequest["Error"]             = true;
        $ResultRequest["Codigo"]             = $ex->getCode();
        $ResultRequest["Mensagem"]             = $ex->getMessage();

        echo json_encode($ResultRequest); 
        exit;
}

$ResultRequest["Modo"]           = "S";
$ResultRequest["Erros"]          = false;
$ResultRequest["Falhas"][0]      = count($FilesErros) > 0 ? true : false;
$ResultRequest["Falhas"][0]      = $FilesErros;



echo json_encode($ResultRequest); 

?>
