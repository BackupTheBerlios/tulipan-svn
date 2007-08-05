<?php

mysql_connect('localhost','root','')or die('ERROR EN LA CONEXION :'.mysql_error());
mysql_select_db('pymera')or die('ERROR AL ESCOJER LA BD :'.mysql_error());

function show_encuesta($id_ENCUESTA,$proteccion_IP){
// COLOCO TODAS MIS PREGUNTAS Y OPCIONES
$encuesta[1]=array('¿Que Tecnologia utilizas?',array('Php','Asp','ColdFusion','Cgi','Perl','Jsp','Otra'));
//END
if (!array_key_exists($id_ENCUESTA,$encuesta)) return ('El id de la encuesta no se encuentra disponible');
else
$pregunta_de_la_encuesta = array_shift($encuesta[$id_ENCUESTA]);
$opciones_de_la_encuesta = array_pop ($encuesta[$id_ENCUESTA]);
if(isset($_POST[opcion])){
$ssqls=mysql_query('SELECT * FROM encuesta_blt WHERE ip="'.$REMOTE_ADDR.'"')or die(mysql_error());
if($proteccion_IP && mysql_num_rows($ssqls)>=1){
$html_encuesta='<font color="#FF0000" face="tahoma" size="2"><strong>Ya usted tiene un voto registrad</strong>o </font>';
}
else {mysql_query('INSERT INTO encuesta_blt VALUES("'.$id_ENCUESTA.'","'.$_POST[opcion].'","'.$REMOTE_ADDR.'")')or die(mysql_error()); }
}

$ssql=mysql_query('SELECT * FROM encuesta_blt WHERE id_encuesta="'.$id_ENCUESTA.'"')or die(mysql_error());
$total_votos=mysql_num_rows($ssql);

// IMPRIMIR LOS RESULTADOS.
$html_encuesta.='<form action="'.$_SERVER[REQUEST_URI].'" method="POST">';
$html_encuesta.= '<strong>'.$pregunta_de_la_encuesta.'</strong>';
$html_encuesta.='<br>';
foreach($opciones_de_la_encuesta as $KEY => $OPCION){
$ssql=mysql_query('SELECT * FROM encuesta_blt WHERE id_encuesta="'.$id_ENCUESTA.'" and id_opcion="'.$KEY.'"')or die(mysql_error());
$votos_x_opcion=mysql_num_rows($ssql);
$estimar_porcentaje= @round($votos_x_opcion*100/$total_votos,1);
$html_encuesta.= '<input name="opcion" type="radio" value="'.$KEY.'"';
if($_POST[opcion]==$KEY && isset($_POST[opcion])){$html_encuesta.='checked'; }

$html_encuesta.= '>'.$OPCION.' '.$estimar_porcentaje.'% <strong>Votos: '.$votos_x_opcion.'</strong> <br>';
}

$html_encuesta.='<br><input type="submit" value="Votar">';
$html_encuesta.='</form>';
return $html_encuesta;
}
?>