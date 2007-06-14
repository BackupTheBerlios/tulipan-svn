<?php

    /*
        Elgg blog categories plugin
    
        Ben Werdmuller, October 2006
        ben@curverider.co.uk
        
        Released under the GPL v2
    */

    // Before using, add this .htaccess rule:
    // RewriteRule ^([A-Za-z0-9]+)\/weblog\/category\/(.+)\/?$ mod/category/category_view.php?weblog_name=$1&category=$2

    function category_pagesetup() {
    
        global $CFG, $PAGE, $function, $page_owner;
        
        // Add category management to the account settings
        if (defined("context") && context == "weblog" && run("permissions:check","profile")) {
            $PAGE->menu_sub[] = array('name' => 'blog:category',
                                      'html' => a_href("{$CFG->wwwroot}mod/category/category_manage.php?owner=$page_owner",
                                                   __gettext("Manage blog categories")));
        }

    }

    function category_init() {
        global $function, $CFG, $page_owner, $PAGE;
        
        // Add weblog categories to the sidebar
        // TODO fix display order, categories should probably be somewhere near archive
        //if (context == 'weblog') {
            
            $inserted = 0;
            
            foreach($function['display:sidebar'] as $key => $sidebar) {
                if ($sidebar == $CFG->dirroot . "units/weblogs/weblogs_user_info_menu.php") {
                    $inserted++;
                    $array1 = array_slice($function['display:sidebar'], 0, $key+ 1);
                    $array2 = array_slice($function['display:sidebar'], $key + 1, sizeof($function['display:sidebar']) - $key);
                    $array1[] = $CFG->dirroot . 'mod/category/category_sidebar.php';
                    $function['display:sidebar'] = array_merge($array1, $array2);
                }
            }
            if (!$inserted) {
                $function['display:sidebar'][] = $CFG->dirroot . 'mod/category/category_sidebar.php';
            }
        
    }
    
?>
