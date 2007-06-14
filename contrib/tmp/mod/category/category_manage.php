<?php

    /*
    
        Elgg weblog categories
        http://elgg.org/
    
    */
    
    // Load Elgg framework
        @require_once("../../includes.php");

    // Define context
        define("context","weblog");
        
    // Make sure we're logged in; otherwise spew out to front page
        if (!isloggedin()) {
            header("Location: " . $CFG->wwwroot);
            exit;
        }
        
        // Load global variables
        global $CFG, $PAGE, $page_owner, $messages, $profile_id;
        
        $page_owner = optional_param("owner",0,PARAM_INT);
        if (empty($page_owner)) {
            $page_owner = $_SESSION['userid'];
        }
        $PAGE->owner = $page_owner;
        $profile_id = $page_owner;
        
        $action = optional_param("action");
        $cats = trim(optional_param("edit_weblog_categories"));
        
        templates_page_setup();
        
    if (run("permissions:check","profile")) {
        
    // Action handling
        if (logged_on && run("permissions:check", "profile") && !empty($action) && !empty($cats)) {
            
            delete_records('tags','tagtype','weblogcat','ref',$page_owner);
            insert_tags_from_string ($cats, 'weblogcat', $page_owner, "PUBLIC", $page_owner);
            $messages[] = __gettext("Your weblog categories were updated.");
            $_SESSION['messages'] = $messages;
            header("Location: " . $CFG->wwwroot . "mod/category/category_manage.php?owner=$page_owner");
            exit;
            
        }
    
    // Some introductory text
    
        $body = "<form action=\"\" method=\"post\">";
    
        $body .= "<p>" . __gettext("Categories allow you to highlight particular tags that represent important weblog content and display them in your sidebar.") . "</p>";
        $body .= "<p>" . __gettext("For example, if you wanted to draw attention to all blog posts tagged with 'science', you could add that tag below, and users would know that 'science' represents an important category of content. They could then click on 'science' in your sidebar and see all content relating to science.") . "</p>";
        $body .= "<p>" . __gettext("To set up categories, type the tags you'd like to highlight separated by commas below:") . "</p>";
        
        $body .= templates_draw(array(
                                'context' => 'databoxvertical',
                                'name' => __gettext("Highlighted categories"),
                                'contents' =>  display_input_field(array("edit_weblog_categories",'',"keywords",'weblogcat',$PAGE->owner,$PAGE->owner))
                            )
                            );
                            
        $postButton = __gettext("Save");
                            
        $body .= <<< END
    <p>
        <input type="hidden" name="action" value="weblog:categories:edit" />
        <input type="submit" value="$postButton" />
    </p>

</form>
END;

    }
                                                       
    // Output to the screen
        $title = __gettext("Manage blog categories");
        $body = templates_draw(array(
                        'context' => 'contentholder',
                        'title' => $title,
                        'body' => $body
                    )
                    );
        
        echo templates_page_draw( array(
                        $title, $body
                    )
                    );

?>