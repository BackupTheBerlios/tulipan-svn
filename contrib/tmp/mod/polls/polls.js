// Global message counter
var polls_selected = 0;

/**
* Function that check the conditions for send the messages action form
*
* @param object select The select object
* @param object actionformpoll the form object
* @param string msg Message used for the delete confirmation question.
 * @author Johan Eduardo Quijano Garcia <gerencia@treszero.com>
 * @copyright Tres Zero - 2007
 * @author Diego Andrés Ramírez Aragón <diego@somosmas.org>
 * @copyright Corporación Somos Más - 2007
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

}

function mark(check){
  if(check.checked){
    polls_selected++;
  }
  else{
    polls_selected--;
  }
}