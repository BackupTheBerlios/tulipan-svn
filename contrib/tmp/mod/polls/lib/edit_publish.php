<?php
/*
 * This script loads and append to $run_result the data for the specified poll
 *
 * @uses $profile_id
 * @uses $CFG
 *
 * @author Johan Eduardo Quijano Garcia <gerencia@treszero.com>
 * @copyright Corporación Somos Más - 2007
*/
if (isset ($parameter)) {

global $CFG, $profile_id,$metatags;

$poll= $parameter;

$creator_poll_id = optional_param('from', $profile_id, PARAM_INT);
$creator_poll_name = (isset ($creator_poll_id)) ? user_info('name', $creator_poll_id) : "";
$action = optional_param('action');
$redirect = url . "mod/polls/polls_actions.php?action=create";
$poll_ident = $poll->ident;
// Initializing the label messages
$addPoll = __gettext("New Poll");
$creator = __gettext("Created by:");
$namepoll = __gettext("Name of Poll");
$kindpoll = __gettext("What kind of poll Do you want create?");
$question = __gettext("Question:");
$answers = __gettext("Answers:");
$answer = __gettext("Answer");
$endpoll = __gettext("When you want end the Poll?");
$date_polls = __gettext("Date for end the Poll");
$accessRes = __gettext("Access restrictions:"); // gettext variable

$submitButton = __gettext("Publish");
$submitButtonSave = __gettext("Save");


//******************************************************************************************
//Begin of Form Poll

//New Poll
$run_result =<<< END
<form method="post" name="elggform" action="$redirect" onsubmit="return submitForm();">
    <input type="hidden" name="new_poll" value="$creator_poll_id"/>
    <input type="hidden" name="poll_ident" value="$poll_ident"/>
    <h2>$addPoll</h2>
END;

//Create by
$run_result .= templates_draw(array (
  'context' => 'databoxvertical',
  'name' => $creator,
  'contents' => $creator_poll_name
));

//*********************************************************************************************
//Name of Poll
$run_result .= templates_draw(array (
  'context' => 'databoxvertical',
  'name' => $namepoll,
  'contents' => display_input_field(array (
    "new_poll_name",
    $poll->title,
    "text"
  )
)));

//*********************************************************************************************
//Kind of Poll

$run_result .= templates_draw(array (
  'context' => 'databox1',
  'name' => $kindpoll,
));

if($poll->kind == "only")
{
$run_result .=<<< END
<input type=radio name=new_kind_poll checked value=only>Only one asnwer<br>
<input type=radio name=new_kind_poll value=multiple>Multiple Answer<br>
<br>
END;
}
else
{
$run_result .=<<< END
<input type=radio name=new_kind_poll value=only>Only one asnwer<br>
<input type=radio name=new_kind_poll checked value=multiple>Multiple Answer<br>
<br>
END;

}



//*********************************************************************************************
//Question 
$run_result .= templates_draw(array (
  'context' => 'databoxvertical',
  'name' => $question,
  'contents' => display_input_field(array (
    "new_poll_question",
    $poll->question,
    "text"
  )
)));



//*********************************************************************************************
//Answer Options
$run_result .= templates_draw(array (
  'context' => 'databox1',
  'name' => $answers,
));


$url = $CFG->wwwroot;
$run_result .=<<< END
<script type='text/javascript' src="$url/mod/polls/js/xDisplay.js" language=JavaScript></script>
<script>
function add_answers_fiels(){
if (document.elggform.poll_answers.value == "2"){
    xDisplay('answerfield2', 'block')
    xDisplay('answerfield3', 'none')
    xDisplay('answerfield4', 'none')
    xDisplay('answerfield5', 'none')
    xDisplay('answerfield6', 'none')
    xDisplay('answerfield7', 'none')
    xDisplay('answerfield8', 'none')
    xDisplay('answerfield9', 'none')
    xDisplay('answerfield10', 'none')

}
if (document.elggform.poll_answers.value == "3"){
    xDisplay('answerfield2', 'block')
    xDisplay('answerfield3', 'block')
    xDisplay('answerfield4', 'none')
    xDisplay('answerfield5', 'none')
    xDisplay('answerfield6', 'none')
    xDisplay('answerfield7', 'none')
    xDisplay('answerfield8', 'none')
    xDisplay('answerfield9', 'none')
    xDisplay('answerfield10', 'none')
}
if (document.elggform.poll_answers.value == "4"){
    xDisplay('answerfield2', 'block')
    xDisplay('answerfield3', 'block')
    xDisplay('answerfield4', 'block')
    xDisplay('answerfield5', 'none')
    xDisplay('answerfield6', 'none')
    xDisplay('answerfield7', 'none')
    xDisplay('answerfield8', 'none')
    xDisplay('answerfield9', 'none')
    xDisplay('answerfield10', 'none')
}
if (document.elggform.poll_answers.value == "5"){
    xDisplay('answerfield2', 'block')
    xDisplay('answerfield3', 'block')
    xDisplay('answerfield4', 'block')
    xDisplay('answerfield5', 'block')
    xDisplay('answerfield6', 'none')
    xDisplay('answerfield7', 'none')
    xDisplay('answerfield8', 'none')
    xDisplay('answerfield9', 'none')
    xDisplay('answerfield10', 'none')
}
if (document.elggform.poll_answers.value == "6"){
    xDisplay('answerfield2', 'block')
    xDisplay('answerfield3', 'block')
    xDisplay('answerfield4', 'block')
    xDisplay('answerfield5', 'block')
    xDisplay('answerfield6', 'block')
    xDisplay('answerfield7', 'none')
    xDisplay('answerfield8', 'none')
    xDisplay('answerfield9', 'none')
    xDisplay('answerfield10', 'none')
}
if (document.elggform.poll_answers.value == "7"){
    xDisplay('answerfield1', 'block')
    xDisplay('answerfield2', 'block')
    xDisplay('answerfield3', 'block')
    xDisplay('answerfield4', 'block')
    xDisplay('answerfield5', 'block')
    xDisplay('answerfield6', 'block')
    xDisplay('answerfield7', 'block')
    xDisplay('answerfield8', 'none')
    xDisplay('answerfield9', 'none')
    xDisplay('answerfield10', 'none')
}
if (document.elggform.poll_answers.value == "8"){
    xDisplay('answerfield1', 'block')
    xDisplay('answerfield2', 'block')
    xDisplay('answerfield3', 'block')
    xDisplay('answerfield4', 'block')
    xDisplay('answerfield5', 'block')
    xDisplay('answerfield6', 'block')
    xDisplay('answerfield7', 'block')
    xDisplay('answerfield8', 'block')
    xDisplay('answerfield9', 'none')
    xDisplay('answerfield10', 'none')
}
if (document.elggform.poll_answers.value == "9"){
    xDisplay('answerfield1', 'block')
    xDisplay('answerfield2', 'block')
    xDisplay('answerfield3', 'block')
    xDisplay('answerfield4', 'block')
    xDisplay('answerfield5', 'block')
    xDisplay('answerfield6', 'block')
    xDisplay('answerfield7', 'block')
    xDisplay('answerfield8', 'block')
    xDisplay('answerfield9', 'block')
    xDisplay('answerfield10', 'none')
}
if (document.elggform.poll_answers.value == "10"){
    xDisplay('answerfield1', 'block')
    xDisplay('answerfield2', 'block')
    xDisplay('answerfield3', 'block')
    xDisplay('answerfield4', 'block')
    xDisplay('answerfield5', 'block')
    xDisplay('answerfield6', 'block')
    xDisplay('answerfield7', 'block')
    xDisplay('answerfield8', 'block')
    xDisplay('answerfield9', 'block')
    xDisplay('answerfield10', 'block')
}
}
END;

$run_result .=<<< END

</script>
<style type="text/css">

END;

//Quantity of Answers
$answer_poll  = get_record('poll_answer', 'id_poll',$poll->ident);
$inicialNumber = $answer_poll->ident;
$numberofanswers = count_records('poll_answer','id_poll',$poll->ident);
$cantidadFinal = $numberofanswers + $inicialNumber;
$i = $inicialNumber;
    for($i; $i<$cantidadFinal;$i++)
	{
        	$answerInfo= get_record('poll_answer', 'ident',$i,null,null,null,null,'answer');
        	$answerPoll = $answerInfo->answer;
		//$imagePoll .='<li>' . $answer . '</li>';
	}


$run_result .=<<< END
#answerfield1{
position:relative;}
#answerfield2{
position:relative;}
#answerfield3{
position:relative;}
#answerfield4{
position:relative;}
#answerfield5{
position:relative;}
#answerfield6{
position:relative;}
#answerfield7{
position:relative;}
#answerfield8{
position:relative;}
#answerfield9{
position:relative;}
#answerfield10{
position:relative;}
</style>

END;



$run_result .=<<< END

<select size="1" name="poll_answers" onchange="add_answers_fiels()" >
<option value="4">-- Select the quantity of answers -- </option>
<option value="2">2</option>
<option value="3">3</option>
<option value="4">4</option>
<option value="5">5</option>
<option value="6">6</option>
<option value="7">7</option>
<option value="8">8</option>
<option value="9">9</option>
<option value="10">10</option>
</select>
<br>
<br>
END;

/////
$answer_poll  = get_record('poll_answer', 'id_poll',$poll->ident);
$inicialNumber = $answer_poll->ident;
$numberofanswers = count_records('poll_answer','id_poll',$poll->ident);
$cantidadFinal = $numberofanswers + $inicialNumber;
$i = $inicialNumber;
$value = 1;

    for($i; $i<$cantidadFinal;$i++)
	{
        	$answerInfo= get_record('poll_answer', 'ident',$i,null,null,null,null,'answer');
        	$answerPoll = $answerInfo->answer;
		//$imagePoll .='<li>' . $answer . '</li>';
$run_result .=<<< END

<!-- Answers Fields-->
<!-- Field 1-->
<div id=answerfield$value>
<table cellspacing="2" cellpadding="2" border="0">
<tr>
    <td width=140>$answer $value :</td>
    <td><input type="text" name="answer$value" value="$answerPoll" size="25"></td>
</tr>
</table>
</div>
END;

$value++;


	}

  for($value;$value <=10;$value++)
	{
$run_result .=<<< END
<!-- Answers Fields-->
<!-- Field 1-->
<div id=answerfield$value>
<table cellspacing="2" cellpadding="2" border="0">
<tr>
    <td width=140>$answer $value :</td>
    <td><input type="text" name="answer" . $value size="25"></td>
</tr>
</table>
</div>
END;

	}



//*********************************************************************************************
//Date Options


$run_result .= templates_draw(array (
  'context' => 'databox1',
  'name' => $endpoll,
));

$metatags .= "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"$url/mod/polls/css/calendar-brown.css\" title=\"win2k-cold-1\" />"; 


if($poll->finish == "manual")
{

$run_result .=<<< END
<script type='text/javascript' src="$url/mod/polls/js/calendar.js" language=JavaScript></script>
<script type='text/javascript' src="$url/mod/polls/js/calendar-en.js" language=JavaScript></script>
<script type='text/javascript' src="$url/mod/polls/js/calendar-setup.js" language=JavaScript></script>
<script>
function show_calendar(){

	xDisplay('calendar', 'block');
}
</script>
<script>
function hide_calendar(){

	xDisplay('calendar', 'none');
}
</script>
<style type="text/css">
#calendar{
position:relative;
display:none;
}
</style>
<input type=radio name=new_date_poll checked value=manual onClick="hide_calendar()">Manual end<br>
<input type=radio name=new_date_poll value=auto onClick="show_calendar()">Automatically<br><br>
<br>
<div id=calendar>
<table cellspacing="2" cellpadding="2" border="0">
<tr>
    <td width=140>Select your end date:</td>
    <td><input type="text" name="date_poll" id="date_field" />
        <input type="button" id="launcher" value="..." />
    </td>
</tr>
</table>
</div>
END;
}
else
{

$run_result .=<<< END
<script type='text/javascript' src="$url/mod/polls/js/calendar.js" language=JavaScript></script>
<script type='text/javascript' src="$url/mod/polls/js/calendar-en.js" language=JavaScript></script>
<script type='text/javascript' src="$url/mod/polls/js/calendar-setup.js" language=JavaScript></script>
<script>
function show_calendar(){

	xDisplay('calendar', 'block');
}
</script>
<script>
function hide_calendar(){

	xDisplay('calendar', 'none');
}
</script>
<style type="text/css">
#calendar{
position:relative;
}
</style>
<input type=radio name=new_date_poll value=manual onClick="hide_calendar()">Manual end<br>
<input type=radio name=new_date_poll checked value=auto onClick="show_calendar()">Automatically<br><br>
<br>
<div id=calendar>
<table cellspacing="2" cellpadding="2" border="0">
<tr>
    <td width=140>Select your end date:</td>
    <td><input type="text" name="date_poll" value=$poll->date_end id="date_field" />
        <input type="button" id="launcher" value="date" />
    </td>
</tr>
</table>
</div>
END;
}

////////////////////////
$run_result .=<<< END
<!-- script that configure the calendar-->
<script type="text/javascript">
   Calendar.setup({
    inputField     :    "date_field",     
     ifFormat     :     "%Y/%m/%d",     
     button     :    "launcher"     
});
</script>
END;
////////////////////////

$run_result .= templates_draw(array(
                                'context' => 'databoxvertical',
                                'name' => $accessRes,
                                'contents' => run("display:access_level_select",array("new_poll_access",default_access))
                            )
                            );

//*********************************************************************************************

$run_result .=<<< END
    <p>
<style type="text/css">
  .boton{
        font-size:10px;
        font-family:Verdana,Helvetica;
        font-weight:bold;
        color:white;
        background:#638cb5;
        border:0px;
        width:80px;
        height:19px;
       }
</style>

<div align="center">
    <input type="submit" name="button" value="$submitButtonSave" class="boton">        
    <input type="submit" name="button" value="$submitButton" class="boton">
</div>

    <br>




    </p>
</form>


END;

//End of Form poll
}
?>