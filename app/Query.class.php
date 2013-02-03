<?php 

include 'bd.php';

class Query
{
	protected $id;
	protected $resposta;
	protected $nome;
	protected $empreendedor;

	public function __construct()
	{
		$this->id 			= isset($_POST['id']) ? $_POST['id'] : null;
		$this->resposta 	= isset($_POST['resposta']) ? $_POST['resposta'] : null;
		$this->nome 		= isset($_POST['nome']) ? $_POST['nome'] : null;
		$this->empreendedor = isset($_POST['empreendedor']) ? $_POST['empreendedor'] : null;
	}

	public function abrePergunta()
	{
		$sql = "SELECT p.descricao, c.descricao as cat 
		FROM perguntas as p 
		INNER JOIN categoria as c 
		ON (c.id = p.categoria) 
		WHERE p.id = '{$this->id}'"; 

		$resultado = mysql_query($sql);

		while($row = mysql_fetch_array($resultado))
		{
			$retorno += "<p><center><b>".$row['cat']."</b></center></p>".utf8_encode($row['descricao']);
		}

		return $retorno;
	}

	public function salvaResposta()
	{
		$sql = "INSERT INTO respostas (descricao, pergunta_id) 
		VALUES ('{$this->resposta}', '{$this->id}')";
		
		$resultado = mysql_query($sql);

		if($resultado){
			mysql_query("UPDATE perguntas SET status = 2 WHERE id = '{$this->id}'");
		}
	}

	public function salvaProjeto()
	{
		$sql 		= "UPDATE projeto SET nome='{$this->nome}', empreendedor='{$this->empreendedor}' WHERE id = 1";
		$resultado 	= mysql_query($sql);
	}

	public function carregarResposta()
	{
		$sql = "SELECT p.id FROM perguntas as p
		 WHERE p.status = '2'";
	
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

		return $arr;	
	}

	public function verificarFim()
	{
		$sql = "SELECT p.id FROM perguntas as p WHERE p.status = '1'";
	
		$resultado = mysql_query($sql);
		
		$cont = mysql_num_rows($resultado);	

		return $cont;	
	}

	public function reseta_projeto()
	{
		$sql = "UPDATE perguntas SET status = 1 WHERE status = 2";
		
		$resultado = mysql_query($sql);

		$sql_limpar = "TRUNCATE respostas";
		
		$resultado_limpar = mysql_query($sql_limpar);
	}

}