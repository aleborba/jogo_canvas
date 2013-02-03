<?php

require_once "Query.class.php";

$query = new Query;

if(isset($_POST['query'])){
    switch($_POST['query']){
        case "pergunta":
            $query->abrePergunta();
            break;
        case "salvar-resposta":
            $query->salvaResposta();
            break;
        case "carregar-resposta":
            $query->carregarResposta();
            break;
        case "verifica-fim":
            $query->verificarFim();
            break;
        case "salvar-projeto":
            $query->salvaProjeto();
            break;
        case "reseta-projeto":
            $query->resetaProjeto();
            break;
            
    }
}