<? 

//require_once (dirname(dirname(__FILE__)) . "/../includes.php");


//run("polls:init");


global $USER;
global $CFG;
global $messages;
global $profile_id;

//include ("../jpgraph.php");
//include ("../jpgraph_bar.php");

//echo $_POST['opcion'];
//echo $_POST['creatorname'];
//echo $_POST['creator_id'];

$action = optional_param('action');

if ($action == "vote")
{

echo "ESTAMOS EN VOTATION !!!!!!!! ";

    $redirect_url = url . user_info('username', $_SESSION['userid']) . "/polls/";

$poll_vote = new StdClass;
$poll_vote->id_answer = trim($_POST['opcion']);
$poll_vote->id_user = trim($_POST['creator_id']);
$idpoll_vote = insert_record('poll_vote', $poll_vote);
		
}
else
{
  echo "Nada de Nada";
}
/*		
//Obtenemos el numero actual de votos para la opción elegida
//Comprobamos si $opcion no está vacío porque posteriormente este mismo 
//fichero lo utilizaremos para ver resultados sin tener que votar necesariamente
if(!empty($opcion)) {
	$consulta = "SELECT votos FROM respuestas WHERE id=$opcion"; 
	$consulta = mysql_query($consulta,$enlace); 
	$lado=mysql_num_rows($consulta);
	while($row = mysql_fetch_array($consulta)){ 
		$votos= $row['votos'];
	}
		
//Incrementamos en uno los votos totales
	$votos = $votos + 1;
//Y actualizamos la base de datos
	$consulta = "UPDATE respuestas SET votos = $votos WHERE id=$opcion";
	mysql_query($consulta,$enlace);
}*/


if (defined('redirect_url')) {
  $_SESSION['messages'] = $messages;
  header("Location: " . redirect_url);
  exit;
}
?>