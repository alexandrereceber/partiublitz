<?php
$Hoje = date_create();
$Aniversario = date_create("2023-05-09");

$Intervalo = date_diff($Hoje, $Aniversario );
echo $Intervalo->format("%r%d");