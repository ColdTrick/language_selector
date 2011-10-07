<?php

	function language_selector_get_allowed_translations(){
		$allowed = get_installed_translations();
	
		$min_completeness = (int) get_plugin_setting("min_completeness", "language_selector");
		
		if($min_completeness > 0){
			$update_completeness = false;
			
			if(is_plugin_enabled("translation_editor")){
				if(isadminloggedin()){
					$update_completeness = true;
				}
				$completeness_function = "translation_editor_get_language_completeness";
			} else {
				$completeness_function = "get_language_completeness";
			}
			
			foreach($allowed as $lang_id => $lang_description){
	
				if($lang_id != "en"){
					if(($completeness = $completeness_function($lang_id)) < $min_completeness){
						unset($allowed[$lang_id]);
					} elseif($update_completeness){
						$allowed[$lang_id] = elgg_echo($lang_id) . " (" . $completeness . "% " . elgg_echo("complete") . ")";
					}
				}
			}
		}
	
		return $allowed;
	}
	