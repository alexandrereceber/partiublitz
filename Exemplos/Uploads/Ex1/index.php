<?php  

echo '<script>var Chave = "eyJBY3RpdmUiOnRydWUsIkNsaWVudGVfUmVtb3RvIjoiMTkyLjE2OC4xNS4xMCIsIklEVXNlcm5hbWUiOiIyIiwiVXNlcm5hbWUiOiJhbGV4YW5kcmVyZWNlYmVyQGdtYWlsLmNvbSIsIlBhc3N3b3JkIjoiY2RiNTU5MDE2MjNlZGI5MTA5YmRkM2U5ODBlYTQwNTQiLCJUdXN1YXJpbyI6IkFkbWluaXN0cmFkb3IiLCJUZW1wbyI6MTY4MjE2OTE0MywiVGVudGF0aXZhcyI6IjAiLCJJRCI6IjllNDhlYTgxNmVhMWZjOTQ1NjNiMzM2OWUyMjMxYWI4In0="</script>'

?>
<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <title>TODO supply a title</title>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="../../../CSS/Componentes/TabelaHTML.css?d2s1">
        <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
        
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>
        <link rel="stylesheet" href="/blitz/Recursos/plugins/select2/css/select2.css"><!-- Tem que vir primeiro -->
        <link rel="stylesheet" href="/blitz/Recursos/dist/css/adminlte.min.css">      <!-- Tem que vir segundo por causa do select -->
       
        <link rel="stylesheet" href="/blitz/Recursos/plugins/fontawesome-free/css/all.min.css">
        
        <script src="/blitz/Recursos/plugins/jquery/jquery.min.js" defer="defer"></script>

        <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js" defer="defer"></script>
  
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11" defer="defer"></script>
        <script src="/blitz/Recursos/plugins/select2/js/select2.min.js" defer="defer"></script>

        <script  src="../../../Scripts/jsControlador/jsConstroller.js?s=s2" defer="defer"></script>  
        <script src="/blitz/Recursos/plugins/bs-custom-file-input/bs-custom-file-input.js" defer ></script>
        <script  src="../../../Componentes/Formularios.js?q=1w22s" defer="defer"></script>  
        
        <script  src="index.js?q=<?php echo time() ?>" defer="defer"></script> 
        
    </head>
    <body>


<!-- The Modal -->
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
        
        <!-- Modal footer -->
        <div class="modal-footer">
          <button type="button" class="btn  cancelar" data-dismiss="modal"></button><button type="button" class="btn  ok" data-dismiss="modal"></button>
        </div>
        
      </div>
    </div>
  </div>
<div id="dados" onload=""></div>
</body>
         
</html>
