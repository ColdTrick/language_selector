<?php

	require_once(dirname(__FILE__) . "/lib/functions.php");

	function language_selector_plugins_boot(){
		global $CONFIG;
		
		if(!elgg_is_logged_in()){
			
			if(!empty($_COOKIE['client_language'])){
				// switched with language selector
				$new_lang = $_COOKIE['client_language']; 
			} else {
				
				$browserlang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
				
				if(!empty($browserlang)){
					// autodetect language
					
					if(elgg_get_plugin_setting("autodetect", "language_selector") == "yes"){
						$new_lang = $browserlang;
					}
				}
			}
			
			if(!empty($new_lang) && ($new_lang !== $CONFIG->language)){
				// set new language
				$CONFIG->language = $new_lang;
				
				// language has been change; reload language keys
				if(elgg_is_active_plugin("translation_editor")){
					translation_editor_load_translations();
				} else {
					reload_all_translations();
				}
			}
		}
		
		elgg_extend_view("css/elgg", "language_selector/css/site");
	}
	
	function language_selector_invalidate_setting(){
		elgg_unset_plugin_setting("allowed_languages", "language_selector");
	}
	
	function language_selector_pagesetup(){
		if(elgg_get_plugin_setting("show_in_header", "language_selector") == "yes"){
			elgg_extend_view("page/elements/header", "language_selector/default");
		}
	}
	
	// register hooks
	elgg_register_plugin_hook_handler("all", "plugin", "language_selector_invalidate_setting");
	
	// register events
	elgg_register_event_handler("language:merge", "translation_editor", "language_selector_invalidate_setting");
	elgg_register_event_handler("all", "plugin", "language_selector_invalidate_setting");
	
	// Default event handlers for plugin functionality
	elgg_register_event_handler('plugins_boot', 'system', 'language_selector_plugins_boot');
	elgg_register_event_handler('pagesetup', 'system', 'language_selector_pagesetup');
	elgg_register_event_handler('init', 'system', 'language_selector_init');
	elgg_register_event_handler('upgrade', 'system', 'language_selector_invalidate_setting');
	
	// actions
	elgg_register_action('language_selector/change', dirname(__FILE__) . '/actions/change.php', "logged_in");
