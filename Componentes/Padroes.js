/* 
 * 11/07/20223
 */

var Padroes = function(){
    var Operacao= {readyState: 0}; //Armazena o status da operação de XMLRequest. Verifica se o sistema já esta realizando outra tarefa.
    return{
        addload: function(Recipente = "body", Descricao = ""){
//            var Scroll = window.scrollY,
//                Description = Descricao || "";
//                
//                $(Recipente).append('<center><div \n\
//                                        class="" \n\
//                                        id="myLoader" \n\
//                                        style="z-index: 9999;top:'+ Scroll +'px;background-color: #efeef2b3;text-align: -webkit-center;position: absolute;left: 0px;width: 100%;height: 100%;"><div style="display: table-cell;vertical-align: middle;height: 50vw;"> \n\
//                                        <div style="height: 40vw;display: table-cell;vertical-align: middle;">\n\
//                                            <figure><img src="'+ this.getHostServer() +'/blitz/Imagens/loads/loaders.gif" style="width: 50%;"><figcaption>'+ Description +'</figcaption></figure>\n\
//                                        </div>\n\
//                                    </div></center>\n\
//                                </div>').addClass("modal-open");
//            $(".fecharAjax").unbind();
//            $(".fecharAjax").click(function(){
//                Operacao.abort();
//            });
            $(Recipente).append(`<div id='sidebar-load'><figure style='display: flow-root; margin: auto'><img src='/blitz/Imagens/loads/loaders.gif' style='width: 10vw'><figcaption style='text-align: center'> ${Descricao} </figcaption></figure></div>`);
            $("#sidebar-load").css("display","flex").css("z-index: 9999");
            
        },
        removeLoad: function(){
            $("#sidebar-load").remove();
        },
        
        setAjax: function(obj){
            Operacao = obj;
        },
        getAjax: function(){
            return Operacao.readyState;
        }
        ,
        getHostServer: function(){
            let host = window.location.origin;
            return host;
        },
        addJanela: function(){
            let Janelas = `
                            <div class="modal fade" id="myJanelas">
                               <div class="modal-dialog">
                                 <div class="modal-content">

                                   <!-- Modal Header -->
                                   <div class="modal-header">
                                     <h4 class="modal-title">Título</h4>
                                     <button type="button" class="close" data-dismiss="modal">&times;</button>
                                   </div>

                                   <!-- Modal body -->
                                   <div class="modal-body">

                                   </div>
                                   <div class="modal-footer status-footer">

                                   </div>        
                                   <!-- Modal footer -->
                                   <div class="modal-footer">
                                     <button type="button" class="btn  cancelar" data-dismiss="modal"></button><button type="button" class="btn  ok" data-dismiss="modal"></button>
                                   </div>

                                 </div>
                               </div>
                             </div>
                `;
            $("body").append(Janelas);
        }
    };
}();

export default Padroes;
