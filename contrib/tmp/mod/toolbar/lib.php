<?php

    function toolbar_pagesetup() {
        /*
        global $CFG, $metatags;
        require_once($CFG->dirroot.'lib/filelib.php'); // to ensure file_get_contents()
        $css = file_get_contents($CFG->dirroot . "mod/toolbar/css");
        $css = str_replace("{{url}}", $CFG->wwwroot, $css);
        $metatags .= $css;
        */
    }
    
    function toolbar_init() {
        global $CFG, $template;
        $CFG->templates->variables_substitute['toolbar'][] = "toolbar_mainbody";
        $CFG->templates->variables_substitute['searchbox'][] = "toolbar_searchbox";
    }
    
    function toolbar_mainbody($vars) {
        
        global $CFG;
        require_once($CFG->dirroot.'lib/filelib.php'); // to ensure file_get_contents()
        if (isloggedin()) {
            $toolbar = file_get_contents($CFG->dirroot . "mod/toolbar/toolbar.inc");
        } else {
            //$toolbar = file_get_contents($CFG->dirroot . "mod/toolbar/toolbarloggedout.inc");
        }
        
        if (isset($vars[1]) && $vars[1] == 'box') {
        	$css = file_get_contents($CFG->dirroot . "mod/toolbar/css-box");
        } else {
        	$css = file_get_contents($CFG->dirroot . "mod/toolbar/css");
        }
        $css = str_replace("{{url}}", $CFG->wwwroot, $css);
        $toolbar .= "{$css}";
        
        $toolbar = str_replace("{{url}}", $CFG->wwwroot, $toolbar);
        $toolbar = str_replace("{{menu}}", templates_variables_substitute(array(array(),"menu")), $toolbar);
        $toolbar = str_replace("{{topmenu}}", templates_variables_substitute(array(array(),"topmenu")), $toolbar);
        $toolbar = str_replace("{{logon}}", __gettext("Log on:"), $toolbar);
        $toolbar = str_replace("{{username}}", __gettext("Username"), $toolbar);
        $toolbar = str_replace("{{password}}", __gettext("Password"), $toolbar);
        $toolbar = str_replace("{{poweredby}}", __gettext("Powered by Elgg"), $toolbar);
        $toolbar = str_replace("{{remember}}", __gettext("Remember me"), $toolbar);
        if (isloggedin()) {
            $toolbar =  str_replace("{{usericon}}", "<a href=\"{$CFG->wwwroot}{$_SESSION['username']}\">" . user_icon_html($_SESSION['userid'], 50) . "</a>", $toolbar);
        } else {
            $toolbar = str_replace("{{usericon}}", user_icon_html(-1, 50), $toolbar);
        }
        
        return $toolbar;
        
    }
    
    function toolbar_searchbox($vars) {
        
        global $CFG;
        $all = __gettext("all");
        $people = __gettext("People");
        $communities = __gettext("Communities");
        $tagcloud = __gettext("Tag cloud");
        $browse = __gettext("Browse");
        $searchdefault = __gettext("Search");
        
        $searchbox = <<< END
        
        <div id="search-header"><!-- open search-header div -->
        <form id="searchform" action="{$CFG->wwwroot}search/index.php" method="get">
            <p><input type="text" size="20" name="tag" value="{$searchdefault}" onclick="if (this.value=='{$searchdefault}') { this.value='' }" />

            <input type="submit" value="Go" />
        </form>
        </div><!-- close search-header div -->
        
END;

        return $searchbox;
        
    }

?>