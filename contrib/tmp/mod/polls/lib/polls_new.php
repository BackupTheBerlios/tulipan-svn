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
global $CFG, $profile_id;

$cretor_poll_id = optional_param('from', $profile_id, PARAM_INT);
$creator_poll_name = (isset ($cretor_poll_id)) ? user_info('name', $cretor_poll_id) : "";

/*
Diego: Segun veo... esta funcion la podria convertir en lo siguiente: Una vez creado el nuevo Poll entonces en VER POLLS Aparecera el listado de encuestas donde se mostrara el creador y un resumen del mismo... Correcto?
Diego: Si las encuestas solo pueden ser creadas por un administrador entonces la variable CREATED BY sobraria... lo mismo que esta funcion ????


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
    <input type="hidden" name="new_poll" value="$cretor_poll_id"/>
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
<input type=radio name=new_kind_poll value=open>Open Answer*<br>
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

//<input Type="Text" name=new_answer_poll size="80"><br><br>
//<input Type="Text" name=new_answer_poll size="80"><br><br>
//<input Type="Text" name=new_answer_poll size="80"><br><br>
$run_result .=<<< END
<input Type="Text" name=new_answer_poll size="80"><br><br>

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

$run_result .=<<< END
<input type=radio name=new_date_poll value=manual>Manual end<br>
<input type=radio name=new_date_poll value=auto>Automatically<br>
END;


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