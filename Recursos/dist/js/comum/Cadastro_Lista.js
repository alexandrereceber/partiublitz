'strict mode';

/* 
 * Implementação personalizada do módulo usuário.
 */

let CADASTRAR_EM_UMA_LISTA = null;

Swal.fire({
  title: 'Você não está cadastrado em nenhuma lista desse evento, podemos cadastrar-lo?',
  showCancelButton: true,
  confirmButtonText: 'Aceitar'
}).then((result) => {
  /* Read more about isConfirmed, isDenied below */
  if (result.isConfirmed) {
    //Swal.fire('Saved!', '', 'success');
    Registrar_Lista();
  } else if (result.isDenied) {
    //Swal.fire('Changes are not saved', '', 'info');
  }
})

async function Registrar_Lista(){
    if(CADASTRAR_EM_UMA_LISTA === null){
        CADASTRAR_EM_UMA_LISTA = new JSController(Padrao.getHostServer() +"/blitz/ControladorTabelas/");
    }
    CADASTRAR_EM_UMA_LISTA.DadosEnvio.sendModoOperacao = "5a59ffc82a16fc2b17daa935c1aed3e9";
    CADASTRAR_EM_UMA_LISTA.DadosEnvio.sendTabelas = "6afc6a962eb3b39b1b14cf3436c3d23f";
    
    CADASTRAR_EM_UMA_LISTA.DadosEnvio.sendCamposAndValores = [
                                                                {name:'PIDE', value:IDE},
                                                                {name:'PIDTL', value:IDTL}
                                                            ];
    let RESULT = await CADASTRAR_EM_UMA_LISTA.Atualizar();
    if(RESULT.Error === true){
        Swal.fire("Error, favor procurar o administrador do sistema.", '', 'error');
    }else{
        
    }
}
