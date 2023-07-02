<?php
echo "Iniciando... - " . time();
$myfile = fopen("/home/u363389093/domains/partiublitz.com.br/public_html/blitz/Recursos/Aniversariantes/Chamadas.txt", "w");
$Hrs = date_create();
$Hrs = $Hrs->format("d/m/Y");
$Text = "Endereço ip: ${_SERVER["REMOTE_ADDR"]} - hora da última chamada: ${Hrs}\n";
fwrite($myfile, $Text);


/**
 * cron responsável por selecionar todos os aniversariantes da semana que antecedem o próximo evento.
 * 
 */
$data = ["sendModoOperacao"=>"ab58b01839a6d92154c615db22ea4b8f","sendTabelas"=>"6fa996b30e72b07d1a84794ba2437a26"];
$postdata = http_build_query($data);
$SERVER = "partiublitz.com.br";

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);


$context = stream_context_create($opts);
$LOCAL = "https://".$SERVER."/blitz/ControladorTabelas/";
$Execucao = file_get_contents($LOCAL, false, $context);

fwrite($myfile, $Execucao . " - " . $LOCAL);

echo "Terminou!";
fclose($myfile);