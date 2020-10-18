<?php

namespace ColdTrick\LanguageSelector;

class Settings {
	
	/**
	 * Unset the plugin setting so it will be reset when used the next time
	 *
	 * @return void
	 */
	public static function invalidateSetting() {
		elgg_unset_plugin_setting('allowed_languages', 'language_selector');
	}
	
}