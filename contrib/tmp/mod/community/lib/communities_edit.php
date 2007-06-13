<?php
global $CFG;
// Given a user ID as a parameter, will display a list of communities

if (isset($parameter[0])) {

    $user_id = (int) $parameter[0];

    $result = get_records_sql('SELECT u.*, f.ident AS friendident FROM '.$CFG->prefix.'friends f
                               JOIN '.$CFG->prefix.'users u ON u.ident = f.friend
                               WHERE f.owner = ? AND u.user_type = ?', array($user_id,'community'));

END;
    $i = 1;
    if (!empty($result)) {
        $owned = array();
        $member = array();
        foreach($result as $key => $info) {
            $friends_name = user_name($info->ident);
            $info->icon = run("icons:get",$info->ident);
            $friends_menu = run("users:infobox:menu",array($info->ident));
            $friends_icon = user_icon_html($info->ident,COMMUNITY_ICON_SIZE);
            $link = $CFG->wwwroot.$info->username."/";
            $functions = array();
            $members = get_records("friends","friend",$info->ident);
            $membercount = count($members);
            $functions[] = "<a href=\"".$CFG->wwwroot.$info->username."/community/members\">".__gettext("Members")."&nbsp;(".$membercount.")</a>";
            if($info->owner == $_SESSION['userid']){
                $_body = &$owned;
                $functions[] = "<a href=\"".$CFG->wwwroot.$info->username."/profile\">".__gettext("Administrate")."</a>";
                $msg= "onclick=\"return confirm('". addslashes(__gettext("Are you sure you want to delete this community?")) ."')\"";
                $functions[] = "<a href=\"".$CFG->wwwroot.$info->username."/community/delete\" $msg>".__gettext("Delete")."</a>";
                if ($user_id != $_SESSION['userid']) {
                    $_body = &$member;
                    $msg= "onclick=\"return confirm('". addslashes(__gettext("Are you sure you want to separate this user from the community?")) ."')\"";
                    $functions[] = "<a href=\"".$CFG->wwwroot.$info->username."/community/separate/".$user_id."\" $msg>".__gettext("Separate")."</a>";
                }
            }
            $functions = implode("\n",array_map(create_function('$entry',"return \"<li>\$entry</li>\";"),$functions));
            $_body[] = templates_draw(array(
                                        'context' => 'community_member',
                                        'name' => $friends_name,
                                        'icon' => $friends_icon,
                                        'link' => $link,
                                        'functions' => $functions
                                      )
                        );
        }
        $separator_function = "if ((\$i+1) % COMMUNITY_MEMBERS_PER_ROW == 0) {\$body .= \"</tr><tr>\";}";
        $colspan = "colspan=\"".COMMUNITY_MEMBERS_PER_ROW."\"";
        if(COMMUNITY_COMPACT_VIEW){
          array_walk($owned,create_function('&$body,$i',$separator_function));
          array_walk($member,create_function('&$body,$i',$separator_function));
          $separator="<td $colspan>$memberlabel</td></tr><tr>";
          $memberlabel = "<h2>".__gettext("Communities to which I belong")."</h2>";
          if(!empty($owned)){
            $body="<td $colspan><h2>".__gettext("Owned Communities")."</h2></td></tr><tr>";
            $body.= implode("\n",$owned);
            $separator="<td $colspan><hr>$memberlabel</td></tr><tr>";
          }
          if(!empty($member)){
            $body.= (strrpos($body,"<tr>")==(strlen($body)-4))?$separator:"</tr><tr>$separator";
            $body.= implode("\n",$member);
          }
        }
        else{
          $member = array_merge($owned,$member);
          array_walk($member,create_function('&$body,$i',$separator_function));
          $body = implode("\n",$member);
        }

    } else {
        if ($user_id == $_SESSION['userid']) {
            $body .= "<td><p>". __gettext("You don't have any communities listed! To join a community, click the 'join' button underneath a community's icon. You can find communities you're interested in by using the search function.") ."</p></td>";
        } else {
            $body .= "<td><p>". __gettext("This user is not currently a member of any communities.") ."</p></td>";
        }
    }


    $run_result = templates_draw(array(
                        'context' => 'community_members',
                        'members' => $body
                        )
                  );

}

?>