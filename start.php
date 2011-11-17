<?php

	require_once(dirname(__FILE__) . "/lib/functions.php");

	function language_selector_plugins_boot(){
		global $CONFIG;
		
		if(!isloggedin()){
			
			if(!empty($_COOKIE['client_language'])){
				// switched with language selector
				$new_lang = $_COOKIE['client_language']; 
			} else {
				
				$browserlang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);
				
				if(!empty($browserlang)){
					// autodetect language
					
					if(get_plugin_setting("autodetect", "language_selector") == "yes"){
						$new_lang = $browserlang;
					}
				}
			}
			
			if(!empty($new_lang) && ($new_lang !== $CONFIG->language)){
				// set new language
				$CONFIG->language = $new_lang;
				
				// language has been change; reload language keys
				if(is_plugin_enabled("translation_editor")){
					translation_editor_load_translations();
				} else {
					reload_all_translations();
				}
			}
		}
	}
	
	function language_selector_actions_hook($hook_name, $entity_type, $return_value, $parameters){
		clear_plugin_setting("allowed_languages", "language_selector");
	}
	
	function language_selector_language_merge_event($event, $object_type, $object){
		clear_plugin_setting("allowed_languages", "language_selector");
	}
	
	function language_selector_init(){	
		if(defined("upgrading") && (upgrading == "upgrading")){
			language_selector_actions_hook();
		}
	}
	
	function language_selector_pagesetup(){
		if(get_plugin_setting("show_in_header", "language_selector") == "yes"){
			elgg_extend_view("page_elements/header_contents", "language_selector/default");
		}
	}
	
	// register hooks
	register_plugin_hook("action", "admin/plugins/enable", "language_selector_actions_hook");
	register_plugin_hook("action", "admin/plugins/disable", "language_selector_actions_hook");
	register_plugin_hook("action", "admin/plugins/enableall", "language_selector_actions_hook");
	register_plugin_hook("action", "admin/plugins/disableall", "language_selector_actions_hook");
	register_plugin_hook("action", "plugins/settings/save", "language_selector_actions_hook");
	
	// register events
	register_elgg_event_handler("language:merge", "translation_editor", "language_selector_language_merge_event");
	
	// Default event handlers for plugin functionality
	register_elgg_event_handler('plugins_boot', 'system', 'language_selector_plugins_boot');
	register_elgg_event_handler('pagesetup', 'system', 'language_selector_pagesetup');
	register_elgg_event_handler('init', 'system', 'language_selector_init');
	
	// actions
	register_action('language_selector/change', false, dirname(__FILE__) . '/actions/change.php');
