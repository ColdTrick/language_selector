= Language selector =

Provides a language_selector view to use in your theme's.
If you are using a default theme, there is an admin option to extend the header with the language selector
Check the admin settings of the plugin for things to configure

== Contents ==

1. Features
2. ToDo
3. Version history

== 1. Features ==

- language_selector/default view to use in theme's
- handles translation preferences for logged in (user preferences) AND non logged in users (cookies)
- incorporated autodetection of browser language (only for non logged in users)	
-- this replaces the automagictranslation plugin and requires NO core hack
-- http://community.elgg.org/pg/plugins/gabrielinux/read/99711/automagic_translation
- language selector display country codes or flags
-- flags borrowed from translation browser plugin
-- http://community.elgg.org/pg/plugins/mariuszekpl/read/49559/elgg-translation-browser-create-edit-translation-files-in-elgg-online

== 2. ToDo ==

- fixed order of languages (now it sometimes switches)

== 3. Version History ==

1.1 (2011-11-29):

- fixed: language completeness is now aware of translation_editor
- fixed: some plugin settings were not loaded correctly is some situations
- changed: moved some functions out of start.php
- changed: moved header extension to pagesetup
- changed: available languages are now cached (saving a lot of performance)

1.0.6 (2011-09-29):

- fixed: conflict with translation editor, causing custom translation not being loaded when loggedout

1.0.5:

- added: triggering an event when a loggedin user changes the language
	
1.0.4:

- fixed: secured action url for changing language (needed for Elgg 1.7)
	
1.0.3:

- added: flag for denmark (da)
- changed: flag for sweden (sv)
- fixed: cookie now set for correct path (/)
- fixed: issue with selecting languages for non logged in users (again)

1.0.2:

- fixed: issue with selecting languages for non logged in users
- added: flag for zh (chinese) language

1.0.1:

- added: flag for hebrew
- fixed: current language onclick action incorrect 
- fixed: dutch translations

1.0:
- first release