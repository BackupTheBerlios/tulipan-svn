Add the following lines to the .htacess file:

# Polls Module
##################
RewriteRule ^([A-Za-z0-9]+)\/polls/$ mod/polls/index.php?profile_name=$1
RewriteRule ^([A-Za-z0-9]+)\/polls\/msg_offset/([0-9]+)$ mod/polls/index.php?profile_name=$1&msg_offset=$2
RewriteRule ^([A-Za-z0-9]+)\/polls\/sent$ mod/polls/index.php?profile_name=$1&sent=1
RewriteRule ^([A-Za-z0-9]+)\/polls\/sent\/msg_offset/([0-9]+)$ mod/polls/index.php?profile_name=$1&sent=1&msg_offset=$2
RewriteRule ^([A-Za-z0-9]+)\/polls\/compose$ mod/polls/compose.php?profile_name=$1
RewriteRule ^([A-Za-z0-9]+)\/polls\/view\/([0-9]+)\/([0-1])$ mod/polls/view.php?profile_name=$1&message=$2&sent=$3



Configuration Options
=====================

By default the plugin disables the 'Send Message' sidebar link for communities where
you are not member. 

If you want to change this behavior you must change the value of MESSAGES_SIDEBAR_NO_MEMBER_LINK
in the 'messages/lib/messages_config.php' file.