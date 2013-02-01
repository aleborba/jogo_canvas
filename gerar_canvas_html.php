<?php

include 'bd.php';

class Canvas{

	public function imprime_canvas(){

		$sql = "SELECT * FROM respostas";

		$resultado = mysql_query($sql);

		echo "<TABLE BORDER=1>";

		while($row = mysql_fetch_array($resultado)){

			echo "<TR>
			<TD ROWSPAN=2><b>Principais Parcerias</b> - ".(($row['pergunta_id']=='13')?" {$row['descricao']} ":"")."</TD>
			<TD><b>Atividades Principais</b> - ".(($row['pergunta_id']=='12')?" {$row['descricao']} ":"")."</TD>
			<TD ROWSPAN=2><b>Proposta de Valor</b> - ".(($row['pergunta_id']=='3')?" {$row['descricao']} ":"")." - ".(($row['pergunta_id']=='4')?" {$row['descricao']} ":"")."</TD>
			<TD><b>Relacionamento com Clientes</b> - ".(($row['pergunta_id']=='7')?" {$row['descricao']} ":"")." - ".(($row['pergunta_id']=='8')?" {$row['descricao']} ":"")."</TD>
			<TD ROWSPAN=2><b>Segmento de Clientes</b> - ".(($row['pergunta_id']=='1')?" {$row['descricao']} ":"")." - ".(($row['pergunta_id']=='2')?" {$row['descricao']} ":"")."</TD>
			</TR>
			<TR>
			<TD><b>Recursos Principais</b> - ".(($row['pergunta_id']=='10')?" {$row['descricao']} ":"")." - ".(($row['pergunta_id']=='11')?" {$row['descricao']} ":"")."</TD>
			<TD><b>Canais</b> - ".(($row['pergunta_id']=='5')?" {$row['descricao']} ":"")." - ".(($row['pergunta_id']=='6')?" {$row['descricao']} ":"")."</TD>
			<TR>
			<TR>
			<TD COLSPAN=3><b>Estrutura de Custos</b> - ".(($row['pergunta_id']=='14')?" {$row['descricao']} ":"")."</TD>
			<TD COLSPAN=2><b>Receitas</b> - ".(($row['pergunta_id']=='9')?" {$row['descricao']} ":"")."</TD>";
		}
		echo "</TABLE>";

	}
}

$c = new Canvas();
$c->imprime_canvas();

?>
