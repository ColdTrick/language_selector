Language selector
=================

Provides a language_selector view to use in your themes.
If you are using a default theme, there is an admin option to extend the header with the language selector.
Check the admin settings of the plugin for things to configure.

Features
--------

- language_selector/default view to use in themes
- handles translation preferences for logged in (user preferences) AND non logged in users (cookies)
- incorporated autodetection of browser language (only for non logged in users)	
- language selector display country codes or flags

Notes
-----

* To add a language selector in a custom position, use ``elgg_view('language_selector/default')``
* To add a custom language icon or replace an existing one, add an image file (svg, jpg, png, gif) in your plugin
under `/views/default/language_selector/flags/$language_code.$ext`.