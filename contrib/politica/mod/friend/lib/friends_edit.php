<?php
global $CFG;
// Given a user ID as a parameter, will display a list of friends

if (isset($parameter[0])) {

    $user_id = (int) $parameter[0];
    $friends = null;
	$friends1 = null;

    $result = get_records_sql('SELECT u.*,f.ident AS friendident FROM '.$CFG->prefix.'friends f
                              JOIN '.$CFG->prefix.'users u ON u.ident = f.friend
                              WHERE f.owner = ? AND u.user_type = ? order by u.last_action desc',array($user_id,'person'));


	$result1 = get_records_sql('SELECT u.* FROM '.$CFG->prefix.'friends f
                               JOIN '.$CFG->prefix.'users u ON u.ident = f.owner
                               WHERE friend = ? AND u.user_type = ? order by u.last_action desc',array($user_id,'person'));

    $i = 1;
	$j = 1;
    if (!empty($result) || !empty($result1)) {

        foreach($result as $key => $info) {
            $link = $CFG->wwwroot.$info->username."/";
            $friends_name = run("profile:display:name", $info->ident);
			$friends_lastname = $info->lastname;
            $info->icon = run("icons:get",$info->ident);
            $friends_menu = run("users:infobox:menu",array($info->ident));
			$friends_menu = run("users:infobox:delete",array($info->ident));
            $friends_icon = user_icon_html($info->ident,FRIENDS_ICON_SIZE);
            $friends .= templates_draw(array(
                                        'context' => 'friends_friend',
                                        'name' => $friends_name . " " . $friends_lastname,
                                        'icon' => $friends_icon,
                                        'link' => $link,
                                        'friend_menu' => $friends_menu
                                      )
                        );


            if ($i % FRIENDS_PER_ROW == 0) {
                $friends .= "</tr><tr>";
            }
            $i++;
        }
		foreach($result1 as $key => $info) {
            $link = $CFG->wwwroot.$info->username."/";
            $friends_name = run("profile:display:name", $info->ident);
			$friends_lastname = $info->lastname;
            $info->icon = run("icons:get",$info->ident);
            $friends_menu = run("users:infobox:menu",array($info->ident));
            $friends_menu = run("users:infobox:delete",array($info->ident));
            $friends_icon = user_icon_html($info->ident,FRIENDS_ICON_SIZE);
            $friends1 .= templates_draw(array(
                                        'context' => 'friends_friend',
                                        'name' => $friends_name . " " .$friends_lastname,
                                        'icon' => $friends_icon,
                                        'link' => $link,
                                        'friend_menu' => $friends_menu
                                      )
                        );

			if ($j % FRIENDS_PER_ROW == 0) {
                $friends1 .= "</tr><tr>";
            }
            $j++;
		}

    } else {
        if ($user_id == $_SESSION['userid']) {
            $friends .= "<td><p>" . __gettext("You don't have any friends listed! To add a user as a friend, click the 'friend' button underneath a user's icon.") . "</p></td>";
        } else {
            $friends .= "<td><p>" . __gettext("This user doesn't currently have any friends listed. Maybe if you list them as a friend, it'll start the ball rolling ..?") . "</p></td>";
        }
    }

    $run_result = templates_draw(array(
                        'context' => 'friends_friends',
                        'friends' => $friends . $friends1
                        )
                  );
}

?>