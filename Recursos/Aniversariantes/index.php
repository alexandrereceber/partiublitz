<?php
$myfile = fopen("Chamadas.txt", "a");
$Hrs = date_create();
$Hrs = $Hrs->format("d/m/Y");
$Text = `Endereço ip: ${_SERVER["REMOTE_ADDR"]} - hora da última chamada: ${Hrs}`;
fwrite($myfile, $Text);
fclose($myfile);

/**
 * cron responsável por selecionar todos os aniversariantes da semana que antecedem o próximo evento.
 * 
 */
$data = ["sendModoOperacao"=>"ab58b01839a6d92154c615db22ea4b8f","sendTabelas"=>"e1f550bec98a7e0f4a256579fbe333ee"];
$postdata = http_build_query($data);

$opts = array('http' =>
    array(
        'method'  => 'POST',
        'header'  => 'Content-type: application/x-www-form-urlencoded',
        'content' => $postdata
    )
);


$context = stream_context_create($opts);
echo file_get_contents("http://192.168.15.10/blitz/ControladorTabelas/", false, $context);

