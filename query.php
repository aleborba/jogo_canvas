<?php 

include 'bd.php';

function abre_pergunta($_POST){
	
	$id = $_POST['id'];
	
	$sql = "SELECT p.descricao, c.descricao as cat FROM perguntas as p INNER JOIN categoria as c ON (c.id = p.categoria) WHERE p.id = '{$id}'";
	
	$resultado = mysql_query($sql);
	
	while($row = mysql_fetch_array($resultado)){
		echo "<p><center><b>".$row['cat']."</b></center></p>".utf8_encode($row['descricao']);
	}
	
}

function salva_resposta($_POST){

	extract($_POST, EXTR_OVERWRITE);
	
	$resultado = mysql_query("INSERT INTO respostas (descricao, pergunta_id) VALUES ('{$resposta}', '{$id}')");

	if($resultado){
		mysql_query("UPDATE perguntas SET status = 2 WHERE id = '{$id}'");
	}
}

function salva_projeto($_POST){

	extract($_POST, EXTR_OVERWRITE);
	
	$resultado = mysql_query("UPDATE projeto SET nome='{$nome}', empreendedor='{$empreendedor}' WHERE id = 1");

}

function carregar_resposta($_POST){

	extract($_POST, EXTR_OVERWRITE);
	
	$sql = "SELECT p.id FROM perguntas as p WHERE p.status = '2'";
	
	$resultado = mysql_query($sql);
	
	$cont = mysql_num_rows($resultado);
	$i=1;
	$arr = "";
	while($row = mysql_fetch_array($resultado)){
		if($i==$cont){
			$arr .= $row['id'];		
		}else{
			$arr .= $row['id'].',';
		}
		$i++;	
	}

	echo $arr;
}

function verificar_fim(){

	$sql = "SELECT p.id FROM perguntas as p WHERE p.status = '1'";
	
	$resultado = mysql_query($sql);
	
	$cont = mysql_num_rows($resultado);	

	echo $cont;
}			

function reseta_projeto(){
	$sql = "UPDATE perguntas SET status = 1 WHERE status = 2";
	
	$resultado = mysql_query($sql);

	$sql_limpar = "TRUNCATE respostas";
	
	$resultado_limpar = mysql_query($sql_limpar);

	if($resultado_limpar){
		alert("Jogo reiniciado!");
	}
}

if(isset($_POST['query'])){
	switch($_POST['query']){
		case "pergunta":
			abre_pergunta($_POST);
			break;
		case "salvar-resposta":
			salva_resposta($_POST);
			break;
		case "carregar-resposta":
			carregar_resposta($_POST);
			break;
		case "verifica-fim":
			verificar_fim();
			break;
		case "salvar-projeto":
			salva_projeto($_POST);
			break;
		case "reseta-projeto":
			reseta_projeto();
			break;
			
	}
}



?>
