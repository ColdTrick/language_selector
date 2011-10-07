<?php

	require_once(dirname(__FILE__) . "/lib/functions.php");

	function language_selector_plugins_boot(){
		global $CONFIG;
		
		if(!isloggedin()){
			$new_lang_id = $_COOKIE['client_language'];
			
			if(!empty($new_lang_id)){
				$CONFIG->language = $new_lang_id; 
			} else {
				
				$browserlang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
				
				if(!empty($browserlang)){
					if(get_plugin_setting("autodetect", "language_selector") == "yes"){
						$CONFIG->language = $browserlang;
					}
				}
			}
			
			if(is_plugin_enabled("translation_editor")){
				translation_editor_load_translations();
			} else {
				reload_all_translations();
			}
		}
	}
	
	function language_selector_init(){
		if(get_plugin_setting("show_in_header", "language_selector") == "yes"){
			elgg_extend_view("page_elements/header_contents", "language_selector/default");
		}
	}
	
	// Default event handlers for plugin functionality
	register_elgg_event_handler('plugins_boot', 'system', 'language_selector_plugins_boot');
	register_elgg_event_handler('init', 'system', 'language_selector_init');
	
	// actions
	register_action('language_selector/change', false, dirname(__FILE__) . '/actions/change.php');
