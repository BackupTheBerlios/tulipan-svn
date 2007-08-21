<?php
/*
 * This script loads and append to $run_result the data for the specified message
 *
 * @param int $from The sender Id
 * @param int $to The recipient Id
 * @param int $msg_id The messge id (optional, used if the new message its a reply)
 * @param int $action If the message is a reply (optional)
 *
 * @uses $profile_id
 * @uses $CFG
 *
 * @author Johan Eduardo Quijano Garcia <gerencia@treszero.com>
 * @copyright Tres Zero - 2007
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos Más - 2007
*/
global $CFG, $profile_id,$metatags;

$creator_poll_id = optional_param('from', $profile_id, PARAM_INT);
$creator_poll_name = (isset ($creator_poll_id)) ? user_info('name', $creator_poll_id) : "";
/*
//Analizando msg_param
 
$msg_param = optional_param('msg_id', -1, PARAM_INT);
$msg = "";
$subject_param = "";

if ($msg_param != -1) {
  function prepend($string) {
    return "> $string";
  }
  $msg = get_record("messages", "ident", $msg_param);
  $subject_param = "Re: " . $msg->title;
  $msg_array = explode("\n", $msg->body);
  $msg_array = array_map("prepend", $msg_array);
  $msg = implode("\n<br>", $msg_array);
}
*/
$action = optional_param('action');
$redirect = url . "mod/polls/polls_actions.php?action=create";

// Initializing the label messages
$addPoll = __gettext("New Poll");
$creator = __gettext("Created by:");
$namepoll = __gettext("Name of Poll");
$kindpoll = __gettext("What kind of poll Do you want create?");
$question = __gettext("Question:");
$answers = __gettext("Answers:");
$endpoll = __gettext("When you want end the Poll?");
$date_polls = __gettext("Date for end the Poll");
$submitButton = ($action == "reply") ? "Reply" : "Create";


//******************************************************************************************
//Begin of Form Poll

//New Poll
$run_result =<<< END
<form method="post" name="elggform" action="$redirect" onsubmit="return submitForm();">
    <input type="hidden" name="new_poll" value="$creator_poll_id"/>
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
    $nameofpoll,
    "text"
  )
)));

//*********************************************************************************************
//Kind of Poll

$run_result .= templates_draw(array (
  'context' => 'databox1',
  'name' => $kindpoll,
));


$run_result .=<<< END
<input type=radio name=new_kind_poll value=only>Only one asnwer<br>
<input type=radio name=new_kind_poll value=multiple>Multiple Answer<br>
<br>
END;


//*********************************************************************************************
//Question 
$run_result .= templates_draw(array (
  'context' => 'databoxvertical',
  'name' => $question,
  'contents' => display_input_field(array (
    "new_poll_question",
    "",
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
<script type='text/javascript' src="$url/mod/polls/lib/xDisplay.js" language=JavaScript></script>
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
    xDisplay('answerfield', 'block')
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
    xDisplay('answerfield', 'block')
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
    xDisplay('answerfield', 'block')
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
    xDisplay('answerfield', 'block')
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

</script>
<style type="text/css">
#answerfield{
position:relative;}
#answerfield2{
position:relative;}
#answerfield3{
position:relative;}
#answerfield4{
position:relative;}
#answerfield5{
position:relative;
display:none;}
#answerfield6{
position:relative;
display:none;}
#answerfield7{
position:relative;
display:none;}
#answerfield8{
position:relative;
display:none;}
#answerfield9{
position:relative;
display:none;}
#answerfield10{
position:relative;
display:none;}
</style>


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

<!-- Answers Fields-->
<!-- Field 1-->
<div id=answerfield>
<table cellspacing="2" cellpadding="2" border="0">
<tr>
    <td width=140>Answer 1:</td>
    <td><input type="text" name="answer1" size="25"></td>
</tr>
</table>
</div>

<!-- Field 2-->
<div id=answerfield2>
<table cellspacing="2" cellpadding="2" border="0">
<tr>
    <td width=140>Answer 2:</td>
    <td><input type="text" name="answer2" size="25"></td>
</tr>
</table>

</div>
<!-- Field 3-->
<div id=answerfield3>
<table cellspacing="2" cellpadding="2" border="0">
<tr>
    <td width=140>Answer 3:</td>
    <td><input type="text" name="answer3" size="25"></td>
</tr>
</table>
</div>

<!-- Field 4-->
<div id=answerfield4>
<table cellspacing="2" cellpadding="2" border="0">
<tr>
    <td width=140>Answer 4:</td>
    <td><input type="text" name="answer4" size="25"></td>
</tr>
</table>
</div>

<!-- Field 5-->
<div id=answerfield5>
<table cellspacing="2" cellpadding="2" border="0">
<tr>
    <td width=140>Answer 5:</td>
    <td><input type="text" name="answer5" size="25"></td>
</tr>
</table>
</div>

<!-- Field 6-->
<div id=answerfield6>
<table cellspacing="2" cellpadding="2" border="0">
<tr>
    <td width=140>Answer 6:</td>
    <td><input type="text" name="answer6" size="25"></td>
</tr>
</table>
</div>

<!-- Field 7-->
<div id=answerfield7>
<table cellspacing="2" cellpadding="2" border="0">
<tr>
    <td width=140>Answer 7:</td>
    <td><input type="text" name="answer7" size="25"></td>
</tr>
</table>
</div>

<!-- Field 8-->
<div id=answerfield8>
<table cellspacing="2" cellpadding="2" border="0">
<tr>
    <td width=140>Answer 8:</td>
    <td><input type="text" name="answer8" size="25"></td>
</tr>
</table>
</div>

<!-- Field 9-->
<div id=answerfield9>
<table cellspacing="2" cellpadding="2" border="0">
<tr>
    <td width=140>Answer 9:</td>
    <td><input type="text" name="answer9" size="25"></td>
</tr>
</table>
</div>

<!-- Field 10-->
<div id=answerfield10>
<table cellspacing="2" cellpadding="2" border="0">
<tr>
    <td width=140>Answer 10:</td>
    <td><input type="text" name="answer10" size="25"></td>
</tr>
</table>
</div>
<BR>

END;


/*
$run_result .= templates_draw(array (
  'context' => 'databoxvertical',
  'name' => $answers,
  'contents' => display_input_field(array (
    "new_msg_subject",
    $subject_param,
    "text"
  )
)));*/

//*********************************************************************************************
//Date Options


$run_result .= templates_draw(array (
  'context' => 'databox1',
  'name' => $endpoll,
));
//$url .= "mod/polls/lib/calendar.js";
//$script_calendar= "/popcalendar.js";
//$metatags .= "<script language=\"javascript\" type=\"text/javascript\" src=\"$url\"></script>";
//$metatags .= "<script language=\"javascript\" type=\"text/javascript\" src=\"$url\"></script>";

// JS Calendar 
//$metatags .= "<style type="text/css" src="css/calendar-estilo.css" />";
//$metatags .= "<script type=\"text/javascript\" src=\"$url\"></script>";
//$metatags .= "<script type=\"text/javascript\" src=\"calendar-es.js\"></script>";
//$metatags .= "<script type=\"text/javascript\" src=\"calendar-setup.js\"></script>";

//$metatags .= "<style type=\"text/css\" src=\"$url/mod/polls/lib/calendar-green.css\" />";
$metatags .= "<link rel=\"stylesheet\" type=\"text/css\" media=\"all\" href=\"$url/mod/polls/lib/calendar-brown.css\" title=\"win2k-cold-1\" />"; 

//   alert("No me pises, que llevo chanclas");
       // return true;     


$run_result .=<<< END
<script type='text/javascript' src="$url/mod/polls/lib/calendar.js" language=JavaScript></script>
<script type='text/javascript' src="$url/mod/polls/lib/calendar-en.js" language=JavaScript></script>
<script type='text/javascript' src="$url/mod/polls/lib/calendar-setup.js" language=JavaScript></script>
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

<input type=radio name=new_date_poll value=manual onClick="hide_calendar()">Manual end<br>
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


<!-- script que define y configura el calendario-->
<script type="text/javascript">
   Calendar.setup({
    inputField     :    "date_field",     // id del campo de texto
     ifFormat     :     "%Y/%m/%d",     
     button     :    "launcher"     // el id del botón que lanzará el calendario
});
</script>

END;
/*
$run_result .=<<< END
<script type='text/javascript' src="$url/mod/polls/lib/popcalendar.js" language=JavaScript></script>


<input type=radio name=new_date_poll value=manual>Manual end<br>
<input type=radio name=new_date_poll value=auto>Automatically<br>
Select your end date:
<input name="date_poll" type="text"  id="dateArrival" onClick="popUpCalendar(this,elggform.dateArrival,'mm/dd/yyyy');" size="10">


END;
*/

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
    <input type="submit" value="$submitButton" class="boton">
  </form>
</div>



</BODY>
</HTML>  
    </p>
</form>


END;

//End of Form poll
?>