/* 
 * Envia os dados para verificar se o usuário esta ou não cadastrado no sistema.
 */
const Toast = Swal.mixin({
  toast: true,
  position: 'top-end',
  showConfirmButton: false,
  timer: 5000,
  timerProgressBar: true,
  didOpen: (toast) => {
    toast.addEventListener('mouseenter', Swal.stopTimer);
    toast.addEventListener('mouseleave', Swal.resumeTimer);
  }
})


    
async function EnviarDados(obj){
    event.preventDefault();
    var Campos = $(obj).serializeArray(), 
        sendUsuario = "", 
        sendSenha = "", 
        BtsendContraSenha = "", 
        sendContraSenha = "",
        SiteEnvioDados = "";
    
    sendUsuario       = obj[0].value == "" ? true : false;
    sendSenha         = obj[1].value == "" ? true : false;
    sendContraSenha   = obj[2].value == "" ? true : false;
    
       
    if(sendUsuario || (obj[0].value.length !== 11)){
        if(obj[0].value.length !== 11){
            obj[0].focus();
            //data.message = "Usuário necessário."
            Toast.fire({
                icon: 'error',
                title: 'É necessário 11 posições.'
              });
        }else{
            obj[0].focus();
            //data.message = "Usuário necessário."
            Toast.fire({
                icon: 'error',
                title: 'Usuário necessário.'
              });
        }
             
        return false;
    }
    
    if(sendSenha){
        obj[1].focus();
        //data.message = "senha necessário."
        Toast.fire({
            icon: 'error',
            title: 'senha necessário.'
          })       
        return false;
    }
    
    if(sendContraSenha){
        obj[2].focus();
        //data.message = "Repita a senha novamente!"
        Toast.fire({
            icon: 'error',
            title: 'Repita a senha novamente!'
          })        
        return false;
    }
    if(!(obj[2].value == obj[1].value)){
        obj[2].focus();
        obj[2].value = "";

        //data.message = "Os 2 campos de senha estão diferentes, a senha deve ser a mesma."
        Toast.fire({
            icon: 'error',
            title: 'Os 2 campos de senha estão diferentes, a senha deve ser a mesma.'
          })       
        return false;
    }
    
    sendUsuario = obj[0].value;
    sendSenha   = obj[1].value;
    sendContraSenha = obj[2].value;
    
    SiteEnvioDados = "/blitz/Cadastrar/";
    
    
    var Dados = new JSController(Padrao.getHostServer() + SiteEnvioDados), Result = "";
    Dados.DadosEnvio.sendUsuario    = sendUsuario;
    Dados.DadosEnvio.sendSenha      = sendSenha;
    Dados.DadosEnvio.sendContraSenha = sendContraSenha
    Dados.DadosEnvio.sendDispositivo = "pc";

    Result = await Dados.Atualizar();   
    if(Result.Error != false){
        switch (Result.Codigo) {
            case 14001:
                Result.Mensagem = "Banco de dados não encontrado. Favor entrar em contato com o administrador."
                break;
                
            case 6005:
                Result.Mensagem = "Usuário definido não possui privilégios nessa tabela para essa operação: Insert"
                break;

            case 8005:
                Result.Mensagem = "Usuário já cadastrado, favor escolha outro nome de usuário!";
                obj[0].focus();
                obj[0].value = "";
                break;

            case 14006:            
            case 14004:

                Result.Mensagem = "O usuário não existe ou não está habilitado no sistema. Favor entrar em contato com o administrador.";
                
                break;

            case 14005:
                break;

            case 14006:
                break;

            case 14004:
                break;

            case 14003:
                Result.Mensagem = "O dispositivo utilidado não é válido para esse sistema.";
                break;

            case 15005:
                break;

            case 14007:
                break;

            case 23000:
                Result.Mensagem = "Usuário já existe no sistema.";
                break;
                
            case 8002:
                Result.Mensagem = "Senhas estão diferentes.";
                break;
            
            default:
                Result.Mensagem = "Error não tratado ou inesperado. Favor entrar em contato com o administrador."
                break;
        }
        
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: Result.Mensagem,
                //footer: '<a href="">Why do I have this issue?</a>'
              });
        
    }else{
        if(Result.Modo == "Login")
            window.location = Result.Header;
        else if(Result.Modo == "Cadastro"){
            Swal.fire({
                icon: 'error',
                title: 'Oops...',
                text: Result.Mensagem,
                //footer: '<a href="">Why do I have this issue?</a>'
              });           

        }
    }
    
}
