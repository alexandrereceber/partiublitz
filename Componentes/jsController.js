

class JSController{
    constructor(Caminho){
        /**
         * Armazena os campos e dados que serão enviados para o servidor.
         */
        this.DadosEnvio = {};
        /**
         * Endereço do servidor
         */
        this.URL = Caminho;
        /**
         * Método de envio de dados.
         */
        this.TypeEnvio = "POST";
        /**
         * //Tipo de conteúdo geral. Essa variável poderá ser configurada nas outras classes
         */
        this.TipoConteudo = "application/x-www-form-urlencoded"; 
        this.ProcessarDados = true; //Configuração do ajax.
        
        this.ResultSet = {}
        /**
         * Variável de uso geral e local, seus dados não são enviado para o servidor. 
         * O campo Load é utilizado para configurar se o ícone load será exibido e várias outras configurações,
         * vindas de outras classes.
         * Background: sync - Significa que o carregamento será protegido por uma tela e bloqueia qualquer outra função ajax.
         * Background async - sisnifica que o carregamento não serão precedido de uma tela e não haverá bloqueio de outra funções ajax.
         */
        this.Config = {Load: true, Background: false};
        
        /**
         * Verifica a existência de uma chave secreta. É um prototype
         */
        this.DadosEnvio.enviarChaves = this.Chaves();
        this.Modo_enctype = "multipart/form-data";
        this.Modo_Async = true;
        this.Enviar_Dada = "";
        this.TipoConteudo = "application/x-www-form-urlencoded";
        this.data_Type = false;
        
    }
    
    set setProcessarDados(n){
        this.ProcessarDados = n;
    }
    set TipoEnvio(type){
        this.TypeEnvio = type;
    }
    set Modoenctype(n){
        this.Modo_enctype = n;
    }
    set ModoAsync(n){
        this.Modo_Async = n;
    }
    set EnviarDada(n){
        this.Enviar_Dada = n;
    }
    set Tipo_Conteudo(n){
        this.TipoConteudo = n;
    }
    set Tipo_dataType(n){
        this.data_Type = n;
    }
    
    
    async Atualizar(p = true){ //p -> persistência = significa que os dados que foram buscandos no servidor não ficará na variável ResultSet, podendo ser usada para buscar informações temporárias, não é para usar com componentes que irão fazer interação com o banco de dados. essa solução foi utilizada para os campos select2
       try{
            const Dados_Brutos = new FormData();
            let DADOS = JSON.stringify(this.DadosEnvio);
            Dados_Brutos.append("DADOS_BUSCA",DADOS);
            
             const VAR_DADOS = {
                 method: 'POST',
                 body: Dados_Brutos,
             };
            Padrao.addload();
            const Pull_Server = await fetch(this.URL, VAR_DADOS)
                    .then(Saida => {
                            return Saida.text();
                        })
                    .then(DADOS => {
                        Padrao.removeLoad();
                        return DADOS;
                    });
                    
            let ResultadoDados = JSON.parse(Pull_Server);
            if(ResultadoDados.Error !== false){
                return ResultadoDados;
            }else{
                if(ResultadoDados.Modo === "S"){
                    if(p){
                        this.ResultSet = ResultadoDados;
                    }
                }
                return ResultadoDados; //Retorna para todas as operaÃ§Ãµes se ocorreram erros, caso tenha acontecido
                                         //a instruÃ§Ã£o que chamou e esta esperando podera ter acesso aos dados do eros
                                         //pela variÃ¡vel glocal this.ResultSet
            }
       }catch(e){
           
       }
       
       
    }

}
JSController.prototype.Chaves = function(){
    try {
        return Chave;
    } catch (e) {
        return null;
    }

}

export default JSController;