Forum Plugin for Elgg
GPL, yada yada yada...

To install:
-copy the forum folder to your <elgg directory>/mod/ folder
-login as "news" (executes a minor database upgrade)
-edit mod/forum/config.php to chnage config (optional)
-visit a community blog that has a few posts and comments to those posts
-on the community blog, find the link that says "View as Forum"
-thats it.

To do:
-harden it a bit (addslashes on tooltip text)
-test for potential conflicts with other plugins



Big thanks to Ben and Dave for some guidance on this, as well as "going for it" by installing on elgg.net/elgg.org

History:

v0.2 (March 10, 2007)
-added sorting based on last updated threads
-added better handling of default behaviour (forum vs. community blog)


v0.1 (Feb 8, 2007)
-finally usable!
-now has a more master/detail view
-moved to tables for layout rather than pure CSS
-uses post_icon to display image for each thread
-uses list_for_event API to return to approapriate view after adding, editing, deleting a post or comment




v0.000000000001 (Jan, 2007)
-actually getting a bit useful!
-added linking/posting new comments
-fixed bug where sidebar showed current user rather than the community profile
-now displays posters name, tooltip of comment content