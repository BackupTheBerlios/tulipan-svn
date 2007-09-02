<?php

/*
 * This script loads and append to $run_result the data for the specified poll

 * @uses $profile_id
 * @uses $CFG
 *
 * @author Johan Eduardo Quijano Garcia <gerencia@treszero.com>
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
  $createdby= __gettext("Created by :   ") . $poll->owner;

$submitButton = optional_param('vote');
$submitButton = __gettext("vote");
$redirect = url . "mod/polls/polls_actions.php?action=votation&user=$profile_id";


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
$poll_auto = __gettext("This Poll will end Automatically");
$poll_already = __gettext("You already have voted in this poll");
$thanks = __gettext("Thanks for your vote !! ");
$finish_poll =__gettext("This Poll has finished");
$poll_will_finish =__gettext("This Poll will end in:   ");
//If the poll ends manually
if($current_poll->date_end == '0000-00-00')
{

     $date = __gettext("Unlimited");
     $Poll = "<h2>$poll_anto</h2><br>";

     $vote = get_record('poll_vote','id_poll',$poll->ident,null,null,null,null,'id_poll');
     $already_vote = get_record('poll_vote','id_poll',$poll->ident,'id_user',$profile_id);

     if($already_vote)
     {
        $Poll .="<h3>$poll_already</h3><br><h2>$thanks</h2>";
     }
     else
     { 
        if ($answersPoll= get_record('poll_answer', 'id_poll',$poll->ident)) {
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
        	$answerforshow = $answerInfo->answer;
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

 // The Poll will finish Automatically


//Check the Day for end the  Poll
//Years
$yearsforendPoll = get_record('polls','ident',$poll->ident,null,null,null,null,'YEAR(date_end)-YEAR(actual_date) AS years');
  //Months
$monthsforendPoll = get_record('polls','ident',$poll->ident,null,null,null,null,'MONTH(date_end)-MONTH(actual_date) AS months');
//Days
$daysforendPoll = get_record('polls','ident',$poll->ident,null,null,null,null,'DAY(date_end)-DAY(actual_date) AS days');

if($yearsforendPoll->years == 0)
{

    if($monthsforendPoll->months == 0)
    {
       $daysforendPoll->days = $daysforendPoll->days;

    }
    else
    {
       $daysforendPoll->days = $monthsforendPoll->months + $daysforendPoll->days;
    }

}
else
{

    if($monthsforendPoll->months == 0 || $monthsforendPoll->months > 0)
    {
          if($daysforendPoll->days == 0 || $daysforendPoll->days > 0)
          {$daysforendPoll->days = $yearsforendPoll->years * 365 + $monthsforendPoll->months + $daysforendPoll->days;
          }
          else
          {
           $daysforendPoll->days = $yearsforendPoll->years * 365 + $monthsforendPoll->months + (30 + $daysforendPoll->days); 

          } 

    }
    else
    {
          
          if($daysforendPoll->days == 0 || $daysforendPoll->days > 0)
          {$daysforendPoll->days = $yearsforendPoll->years * 365 + (12 + $monthsforendPoll->months) + $daysforendPoll->days;
          }
          else
          {
           $daysforendPoll->days = $yearsforendPoll->years * 365 + (12 + $monthsforendPoll->months) + (30 + $daysforendPoll->days); 

          } 

    }

}


///////////
if($daysforendPoll->days==0 || $daysforendPoll->days<0)
{
  $Poll = "<h3>$finish_poll</h3><br><br><h2>$thanks</h2>";
  $current_poll->state = "closed";
  $updateState = update_record('polls',$current_poll);

  
}
else
{



////
  $Poll = "<h2>$poll_will_finish   " . $current_poll->date_end . "</h2><br>";


  $vote = get_record('poll_vote','id_poll',$poll->ident,null,null,null,null,'id_poll');
  if($vote->id_poll)
  {
    $Poll .="<h3>$poll_already</h3><br><h2>$thanks</h2>";
  }
  else
  { 
  


if ($answersPoll= get_record('poll_answer', 'id_poll',$poll->ident)) {
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
        $answerforshow = $answerInfo->answer;
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
        $answerforshow = $answerInfo->answer;
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