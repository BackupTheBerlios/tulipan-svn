<?php

/*
 * This script loads and append to $run_result the data for the specified message
 *
 * @param object $msg ($parameter) The message to be showed
 * @param int $sent If the list must to show the sent messages (optional)
 *
 * @uses $profile_id
 * @uses $CFG
 *
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos Más - 2007
*/
if (isset ($parameter)) {
  global $CFG, $profile_id;
  $poll= $parameter;

  $sent= optional_param('sent');
  $creator= new StdClass;
  $answers= new StdClass;
  $title_poll=$poll->question;
  $creatorid= $poll->owner_id;
  $createdby= "Created by :   " . $poll->owner;

$submitButton = optional_param('vote');
$submitButton = "vote";
//$redirect = url . "mod/polls/lib/votation.php?action=vote";
$redirect = url . "mod/polls/lib/votation.php";



  if ($creatorInfo= get_record('users', 'ident', $creatorid)) {
    $creator->username= $creatorInfo->username;
    $creator->fullname= htmlspecialchars($creatorInfo->name, ENT_COMPAT, 'utf-8');
    $creator->ident  = $creatorInfo->ident;
  } else {
    $creator->username= "";
    $creator->fullname= "";
    $creator->ident= -1;
  }
  $creator->icon= '<a href="' . url . $creator->username . '/">' .user_icon_html($creator->ident)."</a>";

  //$date= strftime("%d %b %Y, %H:%M", $creator->username);


  //$imagePoll = '<img src="/mod/polls/jpgraph/src/elgg_polls/graph_poll.php" alt="" border="0">';
//Poll Votation
if ($answersPoll= get_record('poll_answer', 'id_poll',$poll->ident)) {
    //$InfocurrentPoll= get_record('poll_answer', 'id_poll',$poll->ident,);
    $inicialNumber = $answersPoll->ident;
    $numberofanswers = count_records('poll_answer','id_poll',$poll->ident);
    $cantidadFinal = $numberofanswers + $inicialNumber;
    $creatorPoll = $poll->owner;
    $answerID = $fullInfo->ident;
//echo "POLL !!!! IDENT !!! ::::: " . $poll->ident;
//echo "ANSWER !!!! ID EN EL FORMULARIO !!! ::::: " . $answerID;
//<form name="form1" method="post" action="/mod/polls/jpgraph/src/elgg_polls/graph_poll.php">


// POLLS !!!!
// Checking if the poll is with only One answer or Multiple answers

$Poll .=<<<END
<form name="form1" method="post" action="$redirect">
  <table width="350" border="1">
    <tr> 
      <td colspan="2"><strong>$title_poll</strong>
      <input type="hidden" name="creator_id" value=$creatorid>
      <input type="hidden" name="creatorname" value=$creatorPoll>
      <input type="hidden" name="answer_id" value=$answerID></td>		
    </tr>

    <tr> 
END;

$kindPoll = get_record('polls', 'ident',$poll->ident,null,null,null,null,'kind');

if($kindPoll->kind == "only")
{

$i = $inicialNumber;
    for($i; $i<$cantidadFinal;$i++)
	{
        $answerInfo= get_record('poll_answer', 'ident',$i,null,null,null,null,'answer');
	//echo "Variable i::::" . $i;
        $answerforshow = $answerInfo->answer;
	//echo "Mostrando las Respuestas::::" . $answerforshow;
	$Poll .=<<<END
      <td width="51"><input type="radio" name="opcion" value="$i"></td>
      <td width="283">$answerforshow</td>
    </tr>
    <?php } ?>
END;
  	

	}


//
// End Poll Votation With ONLY one answer
//
}
else
	{
$i = $inicialNumber;
$numberForOption = 1;
    for($i; $i<$cantidadFinal;$i++)
	{
        $answerInfo= get_record('poll_answer', 'ident',$i,null,null,null,null,'answer');
	//echo "Variable i::::" . $i;
        $answerforshow = $answerInfo->answer;
	//echo "Mostrando las Respuestas::::" . $answerforshow;
        $nameOption = "opcion" . $numberForOption;
        $numberForOption++;

$Poll .=<<<END
      <td width="51"><input type="checkbox" name="$nameOption" value="$i"></td>
      <td width="283">$answerforshow</td>
    </tr>
    <?php } ?>
END;
  	}
	// End poll with Multiple Answers
    }

}
	  
$Poll .=<<<END
    <tr>
      <td><input type="submit" name="submitpoll" value="vote"></td>
      <td>This poll ends: <?php echo date('d-m-y',$fecha); ?></td>
   
  	</table>
	</form>

END;

  $run_result .= templates_draw(array (
    'context' => 'plug_detailedpoll',
    'date' => $date,
    'title' => $title,
    'from_username' => $creator->username,
    'from_name' => $from_msg . ' <a href="' . url . $creator->username . '/">' . $creator->fullname . "</a>",
    'from_icon' => $creator->icon,
    'body' => $Poll,
    'links' => $createdby
  ));
}
?>