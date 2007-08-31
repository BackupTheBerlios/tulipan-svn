<?php

/*
 * This script loads and append to $run_result the data for the specified poll

 * @uses $profile_id
 * @uses $CFG
 *
 * @author Johan Eduardo Quijano Garcia <gerencia@treszero.com>
 * @copyright Tres Zero - 2007
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


//Show the poll if this has finished

$current_poll = get_record('polls','ident',$poll->ident);
//Updating the actual date of Poll
$actualDate = date("Y-n-j");
$current_poll->actual_date = $actualDate;
$update = update_record('polls',$current_poll);
$current_poll = get_record('polls','ident',$poll->ident);
$daysforendPoll = get_record('polls','ident',$poll->ident,null,null,null,null,'DAY(date_end)-DAY(actual_date) AS days');

//If the poll ends manually
if($current_poll->date_end == '0000-00-00')
{
     $date = "Unlimited";
     $Poll = "<h2>This Poll will end Automatically</h2><br>";

     $vote = get_record('poll_vote','id_poll',$poll->ident,null,null,null,null,'id_poll');
     $already_vote = get_record('poll_vote','id_poll',$poll->ident,null,null,null,null,'id_user');

  if($vote->id_poll)
  {
    $Poll .="<h3>You already have voted in this poll</h3><br><h2>Thanks for your vote !! </h2>";
  }
  else
  { 
    if ($answersPoll= get_record('poll_answer', 'id_poll',$poll->ident)) {
    //$InfocurrentPoll= get_record('poll_answer', 'id_poll',$poll->ident,);
    $inicialNumber = $answersPoll->ident;
    $numberofanswers = count_records('poll_answer','id_poll',$poll->ident);
    $cantidadFinal = $numberofanswers + $inicialNumber;
    $creatorPoll = $poll->owner;
    $answerID = $fullInfo->ident;

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
      <input type="hidden" name="user" value=$profile_id></td>		
		
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
$arrayOptions = "";
    for($i; $i<$cantidadFinal;$i++)
	{
        $answerInfo= get_record('poll_answer', 'ident',$i,null,null,null,null,'answer');
        $answerforshow = $answerInfo->answer;
        $nameOption = "opcion" . $numberForOption;
        $arrayOptions .= $nameOption;
        $numberForOption++;

$Poll .=<<<END
      <input type="hidden" name="array_options" value=$arrayOptions>
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
      <td>This poll ends: Automatically</td>
   
  	</table>
	</form>

END;
	} //End ELSE If the user already have voted
//End ELSE -- If the Poll have finished
}
else{
/////////////////////////////
if($daysforendPoll->days==0 || $daysforendPoll->days<0)
{
  $Poll = "<h3>This Poll has finished</h3><br><br><h2>Thanks for your Vote !! </h2>";
  $current_poll->state = "closed";
  $updateState = update_record('polls',$current_poll);

  
}
else
{


  $Poll = "<h2>This Poll will end in:   " . $current_poll->date_end . "</h2><br>";


  $vote = get_record('poll_vote','id_poll',$poll->ident,null,null,null,null,'id_poll');
  if($vote->id_poll)
  {
    $Poll .="<h3>You already have voted in this poll</h3><br><h2>Thanks for your vote !! </h2>";
  }
  else
  { 
  


if ($answersPoll= get_record('poll_answer', 'id_poll',$poll->ident)) {
    //$InfocurrentPoll= get_record('poll_answer', 'id_poll',$poll->ident,);
    $inicialNumber = $answersPoll->ident;
    $numberofanswers = count_records('poll_answer','id_poll',$poll->ident);
    $cantidadFinal = $numberofanswers + $inicialNumber;
    $creatorPoll = $poll->owner;
    $answerID = $fullInfo->ident;

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
      <td>This poll ends: <?php echo date('d-m-y',$date); ?></td>
   
  	</table>
	</form>

END;
	} //End ELSE If the user already have voted
//End ELSE -- If the Poll have finished
    }

}

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