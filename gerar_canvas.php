<?php

$link = mysql_connect('mysql.anapaulagomes.com', 'anapaulagomes05', 'cp2013');

if (!$link) {
    die('Não conseguiu conectar: ' . mysql_error());
}

$db_selected = mysql_select_db('anapaulagomes05', $link);

if (!$db_selected) {
    die ('Não pode selecionar o banco anapaulagomes05 : ' . mysql_error());
}

include_once('mpdf/mpdf.php');

class Canvas{

	public function imprime_canvas(){

		$sql = "SELECT * FROM respostas";

		$resultado = mysql_query($sql);

		$sql_projeto = "SELECT * FROM projeto";

		$resultado_projeto = mysql_query($sql_projeto);

$html.= "<img src='img/logo.png' height='62' width='62'>";

$nome = "";
$empreendedor = "";

while($row = mysql_fetch_array($resultado_projeto)){
	$nome = $row['nome'];
	$empreendedor = $row['empreendedor'];
}

$html.= "<p><b>Nome do Projeto: $nome</p></b>";
$html.= "<p><b>Empreendedor: $empreendedor</p></b>";

$r1 = "";
$r2 = "";
$r3 = "";
$r4 = "";
$r5 = "";
$r6 = "";
$r7 = "";
$r8 = "";
$r9 = "";
$r10 = "";
$r11 = "";
$r12 = "";
$r13 = "";
$r14 = "";
		while($row = mysql_fetch_array($resultado)){
			if($row['pergunta_id'] == 1){ $r1 = $row['descricao']; } 
			if($row['pergunta_id'] == 2){ $r2 = $row['descricao']; }
			if($row['pergunta_id'] == 3){ $r3 = $row['descricao']; }
			if($row['pergunta_id'] == 4){ $r4 = $row['descricao']; }
			if($row['pergunta_id'] == 5){ $r5 = $row['descricao']; }
			if($row['pergunta_id'] == 6){ $r6 = $row['descricao']; }
			if($row['pergunta_id'] == 7){ $r7 = $row['descricao']; }
			if($row['pergunta_id'] == 8){ $r8 = $row['descricao']; }
			if($row['pergunta_id'] == 9){ $r9 = $row['descricao']; }
			if($row['pergunta_id'] == 10){ $r10 = $row['descricao']; }
			if($row['pergunta_id'] == 11){ $r11 = $row['descricao']; }
			if($row['pergunta_id'] == 12){ $r12 = $row['descricao']; }
			if($row['pergunta_id'] == 13){ $r13 = $row['descricao']; }
			if($row['pergunta_id'] == 14){ $r14 = $row['descricao']; }
		}

$html.= "<TABLE BORDER=1>";

$html.= "<TR>
			<TD ROWSPAN=2><b>Principais Parcerias</b> - {$r13}</TD>
			<TD><b>Atividades Principais</b> - {$r12}</TD>
			<TD ROWSPAN=2><b>Proposta de Valor</b> - {$r3} - {$r4}</TD>
			<TD><b>Relacionamento com Clientes</b> - {$r7} - {$r8}</TD>
			<TD ROWSPAN=2><b>Segmento de Clientes</b> - {$r1} - {$r2}</TD>
			</TR>
			<TR>
			<TD><b>Recursos Principais</b> - {$r10} - {$r11}</TD>
			<TD><b>Canais</b> - {$r5} - {$r6}</TD>
			<TR>
			<TR>
			<TD COLSPAN=3><b>Estrutura de Custos</b> - {$r14}</TD>
			<TD COLSPAN=2><b>Receitas</b> - {$r9}</TD>";
	
$html.= "</TABLE>";

		
		$mpdf = new mPDF('pt','A4',9);
		$mpdf->WriteHTML($html);
		$mpdf->Output('canvas.pdf','I');
	}
}

$c = new Canvas();
$c->imprime_canvas();

?>
