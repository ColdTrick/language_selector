<?php

	function language_selector_get_allowed_translations(){
		
		$configured_allowed = get_plugin_setting("allowed_languages", "language_selector");
		
		if(empty($configured_allowed)){
			$allowed = array("en");
			
			$installed_languages = get_installed_translations();
		
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
				
				foreach($installed_languages as $lang_id => $lang_description){
		
					if($lang_id != "en"){
						if(($completeness = $completeness_function($lang_id)) >= $min_completeness){
							$allowed[] = $lang_id;
						}
					}
				}
			}
			
			set_plugin_setting("allowed_languages", implode(",", $allowed), "language_selector");
			
		} else {
			$allowed = string_to_tag_array($configured_allowed);
		}

		return $allowed;
	}
	