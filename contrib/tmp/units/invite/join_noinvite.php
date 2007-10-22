<?php

    global $CFG;
    // Join
        
        if ($CFG->publicreg == true) {
            
            $sitename = sitename;
            $partOne = sprintf(__gettext("Please enter your dates:"),$sitename); // gettext variable
            $terms = __gettext("terms and conditions"); // gettext variable
            $privacy = __gettext("Privacy policy"); // gettext variable
	    $termsandconditions = __gettext("You must be read the");
	    $and = __gettext("and");
	    $checkterms = __gettext("Yes, I accept the Terms and Conditions and the Privacy Policy");
                            
                $run_result .= <<< END
                
    <p>
        $partOne
    </p>
    <form action="" method="post">
                
END;
                
                $run_result .= templates_draw(array(
                                                'context' => 'databoxvertical',
                                                'name' => __gettext("Your first name"),
                                                'contents' => display_input_field(array("join_name","","text"))
                    )
                    );
<<<<<<< .mine

=======
                $run_result .= templates_draw(array(
                                                'context' => 'databoxvertical',
                                                'name' => __gettext("Your last name"),
                                                'contents' => display_input_field(array("join_lname","","text"))
                    )
                    );
>>>>>>> .r93
		$run_result .= templates_draw(array(
                                                'context' => 'databoxvertical',
                                                'name' => __gettext("Your email address"),
                                                'contents' => display_input_field(array("invite_email","","text"))
                    )
                    );

            	$run_result .= <<< END
<br>
END;

		$run_result .= templates_draw(array(
                                            'context' => 'databoxvertical',
                                            'name' => __gettext("Your username"),
                                            'contents' => display_input_field(array("join_username",$username,"text"))
                                            )
                                      );
                
		$run_result .= templates_draw(array(
                                            'context' => 'databoxvertical',
                                            'name' => __gettext("Enter a password"),
                                            'contents' => display_input_field(array("join_password1","","password"))
                                            )
                                      );
        	$run_result .= templates_draw(array(
                                            'context' => 'databoxvertical',
                                            'name' => __gettext("Your password again for verification purposes"),
                                            'contents' => display_input_field(array("join_password2","","password"))
                                            )
                                      );
            $buttonValue = __gettext("Register");
            $run_result .= <<< END
            
	<ul>
        <li> $termsandconditions <a href="{$CFG->wwwroot}content/terms.php" target="_blank"> $terms</a> $and <a href="{$CFG->wwwroot}content/privacy.php" target="_blank">$privacy</a></li>
    	</ul>
	<p align="center">
                <label for="acceptcheckbox"><input type="checkbox" id="acceptcheckbox" name="accept" value="yes" /> <strong>$checkterms</strong></label>
        </p>
	<p align="center">
                <input type="hidden" name="action" value="invite_join" />
                <input type="submit" value=$buttonValue />
        </p>
    	</form>
    
                
END;
        } else {
            $nope = __gettext("Self-registration is currently disabled."); // gettext variable
            $run_result .= <<< END
    <p>
        $nope
    </p>
END;
        }

?>