<?php

//SETUP THE FORUM DEFAULT FOR YOUR ELGG SYSTEM
//0=All community blogs become forum UNLESS the community owner sets a flag to go back to being a community blog
//1=All community blogs remain community blogs UNLESS the community owner sets a flag to turn them into a forum
//this flag is set in the "Edit Community details" area
$forum_default = 0;

//SETUP THE FORUM SORTING ATTRIBUTES FOR YOUR ELGG SYSTEM
//0=Forum discussions are sorted by the date of the original post (newest thread goes at top)
//1=Forum discussions are sorted by the "last updated" attribute of the thread so that active discussions rise to the top of the forum...
//NOTE: THIS REQUIRES THE ADDITION OF A NEW FIELD IN THE weblog_posts table ("last_updated  int(11)      NULL ")
//THIS SHOULD HAPPEN AUTOMATICALLY WHEN YOU LOG IN AS "NEWS" after installing this plugin
//NOTE: YOU WON'T SEE ANY EFFECT OF THIS CHANGE UNTIL A THREAD IS UPDATED (weblog_post is edited, or a comment added/deleted)

$forum_sort = 1;

?>
