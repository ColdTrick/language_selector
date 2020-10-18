<?php

namespace ColdTrick\LanguageSelector;

use Elgg\DefaultPluginBootstrap;

class Bootstrap extends DefaultPluginBootstrap {
	
	/**
	 * {@inheritdoc}
	 */
	public function boot() {
		$this->setLoggedOutUserLanguages();
		
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function init() {
		$this->registerViews();
		$this->registerEvents();
		$this->registerHooks();
	}
	
	/**
	 * {@inheritdoc}
	 */
	public function upgrade() {
		elgg_unset_plugin_setting('allowed_languages', 'language_selector');
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function registerViews() {
		elgg_extend_view('elgg.css', 'language_selector/site.css');
		
		if ((bool)elgg_get_plugin_setting('show_in_header', 'language_selector')) {
			elgg_extend_view('page/elements/topbar', 'language_selector/dropdown');
		}
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function registerEvents() {
		$event = $this->elgg()->events;
		
		$event->registerHandler('language:merge', 'translation_editor', __NAMESPACE__ . '\Settings::invalidateSetting');
		$event->registerHandler('all', 'plugin', __NAMESPACE__ . '\Settings::invalidateSetting');
	}
	
	protected function registerHooks() {
		$hooks = $this->elgg()->hooks;
		
		$hooks->registerHandler('all', 'plugin', __NAMESPACE__ . '\Settings::invalidateSetting');
	}
	
	/**
	 * {@inheritdoc}
	 */
	protected function setLoggedOutUserLanguages() {
		if (elgg_is_logged_in()) {
			return;
		}

		if (!empty($_COOKIE['client_language'])) {
			// switched with language selector
			$new_lang = $_COOKIE['client_language'];
		} else {
			$browserlang = substr($_SERVER['HTTP_ACCEPT_LANGUAGE'], 0, 2);

			if (!empty($browserlang)) {
				// autodetect language

				if ((bool)elgg_get_plugin_setting('autodetect', 'language_selector')) {
					$new_lang = $browserlang;
				}
			}
		}

		$current_language = elgg()->translator->getCurrentLanguage();
		if (!empty($new_lang) && ($new_lang !== $current_language)) {
			$allowed = language_selector_get_allowed_translations();
			if (in_array($new_lang, $allowed)) {
				// set new language
				elgg()->translator->setCurrentLanguage($new_lang);

				// language has been change; reload language keys
				if (elgg_is_active_plugin('translation_editor')) {
					translation_editor_load_translations();
				} else {
					elgg()->translator->reloadAllTranslations();
				}
			}
		}
	}
}
