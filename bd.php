<?

$link = mysql_connect('mysql.anapaulagomes.com', 'anapaulagomes05', 'cp2013');

if (!$link) {
    die('Não conseguiu conectar: ' . mysql_error());
}

$db_selected = mysql_select_db('anapaulagomes05', $link);

if (!$db_selected) {
    die ('Não pode selecionar o banco anapaulagomes05 : ' . mysql_error());
}

?>

