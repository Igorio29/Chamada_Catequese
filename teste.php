<?php

require_once "conect.php";
require_once "repositories/TurmaRepository.php";

$repo = new TurmaRepository($conn);

$turmas = $repo->listar();

foreach($turmas as $t){
    echo $t->getEtapa() . "ºEtapa - " . $t->getAno() . "<br>";
}