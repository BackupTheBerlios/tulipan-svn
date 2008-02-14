<?php

global $CFG;

if (!empty($CFG->disable_passwordchanging)) {

    $nope = __gettext('The site administrator has disabled password changing.');
    $run_result .= '<p>' . $nope . '</p>';

} else {

    // Join
    $sitename = sitename;
    $desc = sprintf(__gettext("Please, enter your email address:"), $sitename); // gettext variable
    $thismethod = __gettext("This method reduces the chance of a mistakenly reset password.");

    $run_result .= <<< END

    <p>
        $desc
    </p>
    <!--p>
        $thismethod
    </p-->
    <form action="" method="post">

END;

    $run_result .= templates_draw(array(
                                    'context' => 'databoxvertical',
                                    'name' => __gettext("Your email"),
                                    'contents' => display_input_field(array("password_request_email","","text"))
        )
        );
    $request = __gettext("Request new password"); // gettext variable
    $run_result .= <<< END
            <p align="center">
                <input type="hidden" name="action" value="invite_password_request" />
                <input type="submit" value=$request />
            </p>
        </form>

END;

}

?>