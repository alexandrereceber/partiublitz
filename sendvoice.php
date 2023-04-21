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
    </head>
    <body>
        <?php
        echo "oi";// initialise variables here

 $botToken="5034399308:AAHXD_KbZ9h-cjf3ZWNkCAy1yksebhDBGNY";

  $website="https://api.telegram.org/bot".$botToken;
  $chatId=922127207;  //** ===>>>NOTE: this chatId MUST be the chat_id of a person, NOT another bot chatId !!!**
  $params=[
      'chat_id'=>$chatId, 
      'text'=>'This is my message !!!',
      'reply_markup' => json_encode(array('inline_keyboard' => array(
                                                     //linha 1
                                                     array(
                                                         array('text'=>'Mega-Sena','url'=>'http://g1.globo.com/loterias/megasena.html'), //botão 1
                                                         array('text'=>'Quina','url'=>'http://g1.globo.com/loterias/quina.html')//botão 2
                                                      ),
                                                      //linha 2
                                                     array(
                                                         array('text'=>'Lotofácil','url'=>'http://g1.globo.com/loterias/lotofacil.html'), //botão 3
                                                         array('text'=>'Lotomania','url'=>'http://g1.globo.com/loterias/lotomania.html')//botão 4
                                                      )

                                        )
                                ))
  ];
  $ch = curl_init($website . '/sendMessage');
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($ch);
  curl_close($ch);

        ?>
    </body>
</html>
