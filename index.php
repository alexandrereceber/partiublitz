<!DOCTYPE html>
<!--
To change this license header, choose License Headers in Project Properties.
To change this template file, choose Tools | Templates
and open the template in the editor.
-->
<html>
    <head>
        <meta charset="UTF-8">
        <title></title>
        <link rel="manifest" href="./app.webmanifest.json?5">
        
    </head>
    <body>
        <a href="https://www.google.com.br">teset</a>
        <button onclick="mensagem()">teste</button>
    </body>
    <script>
        if('serviceWorker' in navigator) {
          navigator.serviceWorker.register('/blitz/sw.js?1', { scope: '/blitz/' });
      }
    </script>
    <script src="./enviar.js?10" ></script>
</html>
