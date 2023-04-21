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
      'description'=>'This is my message !!!',
      'title' => 'ola',
      'payload'=>'trtrtr',
       'start_parameter' => "pay",      
      'provider_token'=>'284685063:TEST:OTE1Mjg3NDk1NTUw',
      'currency'=>'EUR',
      'prices'=>  json_encode(array(array('label' => "33", 'amount' => 11000)))
  ];
  $ch = curl_init($website . '/sendInvoice');
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, ($params));
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
  $result = curl_exec($ch);
  echo $result;
  curl_close($ch);

        ?>
    </body>
</html>
