<?php

    global $page_owner, $CFG, $PAGE;

    if (!empty($page_owner) && $page_owner != -1) {
    
        if ($categories = get_records_sql("select * from ".$CFG->prefix."tags where tagtype = 'weblogcat' and owner = $page_owner order by tag asc")) {
        
            $title = __gettext('Blog categories');
            $body  = '<ul>';
            
            // TODO insert tags where tag_type = category
            
            foreach($categories as $category) {
                $body .= '<li><a href="' . $CFG->wwwroot . user_info("username",$page_owner) . '/weblog/category/'. urlencode($category->tag) .'">'. $category->tag .'</a></li>';
            }
            
            $body .= '</ul>';
        
            $run_result .= '<li id="weblog_category">';
            $run_result .= templates_draw(array('context' => 'sidebarholder',
                                                'title'   => $title,
                                                'body'    => $body));
            $run_result .= '</li>';
        
        }
    
    }
?>
