// Global message counter
var polls_selected = 0;

/**
* Function that check the conditions for send the messages action form
*
* @param object select The select object
* @param object actionForm the form object
* @param string msg Message used for the delete confirmation question.
* @author Diego Andr�s Ram�rez Arag�n <diego@somosmas.org>
* @copyright Corporaci�n Somos m�s - 2007
*/
function submitPollsAction(select,actionformpoll,msg){

  if(select.options[select.selectedIndex].value!=-1 && select.options[select.selectedIndex].value=='finish'){
	  actionformpoll.submit();
  }  //else if(select.options[select.selectedIndex].value=='delete' && polls_selected>0){
  else if(select.options[select.selectedIndex].value=='delete' && select.options[select.selectedIndex].value!=-1){
    	if(confirm(msg)){
  	  actionformpoll.submit();
  	}
  }
//else if(select.options[select.selectedIndex].value=='Finish the Poll'){
    	//if(confirm(msg)){
  	  //.submit();
  	//}
  //}
}
//
/**
* Modify the 'messages_select' global variable acording to the check status
* 
* @param object check The checkbox object
* @author Diego Andr�s Ram�rez Arag�n <diego@somosmas.org>
* @copyright Corporaci�n Somos m�s - 2007
*/
function mark(check){
  if(check.checked){
    polls_selected++;
  }
  else{
    polls_selected--;
  }
}