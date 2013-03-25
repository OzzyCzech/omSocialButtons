<?php
namespace omSocialButtons;

use omSocialButtons\facebook\Facebook;
use omSocialButtons\google\GooglePlus;
use omSocialButtons\twitter\Twitter;

/**
 * Plugin Name: omSocialButtons
 * Version: v1.1.1
 * Plugin URI: http://www.omdesign.cz/
 * Description: Add Twitter, Facebook and Google Plus to all posts
 * Author: <a href = "http://www.omdesign.cz/kontakt" > Roman Ožana </a >
 * Author URI: http://www.omdesign.cz/
 */
if (!class_exists('WP')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit;
}

require_once 'Options.php';
require_once 'Button.php';
require_once 'facebook/Facebook.php';
require_once 'google/GooglePlus.php';
require_once 'twitter/Twitter.php';

/**
 * Simple social buttons generator
 *
 * @method null init()
 * @method null updateSettingsForm()
 * @method null getSettingsFormHtml()
 * @method null getButtonHtml()
 *
 * @method \omSocialButtons\facebook\Facebook facebook();
 * @method \omSocialButtons\twitter\Twitter twitter();
 * @method \omSocialButtons\google\GooglePlus googleplus();
 *
 * @author Roman Ozana <ozana@omdesign.cz>
 */
class Buttons {

	public static $langs = array(
		"" => 'Select language',
		"en" => 'English',
		"de" => 'German - Deutsch',
		"it" => 'Italian - Italiano',
		"pt" => 'Portuguese - Portugu?s',
		"ru" => 'Russian',
		"nl" => 'Dutch - Nederlands',
		"no" => 'Norwegian - Norsk',
		"sv" => 'Swedish - Svenska',
		"fi" => 'Finnish - Suomi',
		"da" => 'Danish - Dansk',
		"pl" => 'Polish - Polski',
		"hu" => 'Hungarian - Magyar',
		"cs" => 'Czech - Čeština'
	);

	public $buttons = array();

	/** @var CommonOptions */
	public $options;

	public function __construct() {
		$this->buttons['facebook'] = new Facebook();
		$this->buttons['googleplus'] = new GooglePlus();
		$this->buttons['twitter'] = new Twitter();

		$this->options = new CommonOptions('omSocialButtons');

		$this->init(); // init buttons

		add_action('admin_menu', array($this, 'admin_menu'));
		add_filter('the_content', array($this, 'the_content'));
	}

	/**
	 * Add SocialButtons to admin menu
	 */
	public function admin_menu() {
		add_options_page('Social Buttons', 'Social Buttons', 'manage_options', __FILE__, array($this, 'settings_page'));
	}

	/**
	 * Settings of plugin
	 */
	public function settings_page() {
		if (isset($_POST['submit'])) {

			$this->updateSettingsForm(); // update settings

			$this->options->add_button = $_POST['add_button'];
			$this->options->insert_to = (array)$_POST['insert_to'];
			$this->options->saveOptions();

			echo '<div class="updated"><p><strong>' . __('SocialButtons setting save') . '</strong></p></div>';
		}

		$action = 'options-general.php?page=' . plugin_basename(__FILE__);
		$post_types = get_post_types(array('public' => true, 'show_ui' => true), 'objects');
		require dirname(__FILE__) . '/settings.phtml';
	}


	/**
	 * Modify content automatically
	 *
	 * @param string $content
	 * @return string
	 */
	public function the_content($content) {
		ob_start();
		$this->getButtonHtml();
		$social = '<div class="social-buttons"><div class="wrapper">' . ob_get_contents() . '</div></div>';
		ob_end_clean();

		//return '<pre>' . htmlentities($social) . '</pre>';

		if (!in_array(get_post_type(), (array)$this->options->insert_to)) return $content;

		switch ($this->options->add_button) {
			case 'before':
				return $social . $content;
			case 'after':
				return $content . $social;
			default:
				return $content;
		}
	}

	/**
	 * Call buttons function or return button object
	 *
	 * @param $name
	 * @param $args
	 * @return Button|null
	 */
	public function __call($name, $args) {
		if (array_keys($this->buttons, $name)) {
			return $this->buttons[$name]; // return button if exists
		}

		foreach ($this->buttons as $button) {
			/** @var Button $button */
			call_user_func_array(array($button, $name), $args); // call selected function on all buttons
		}
	}
}

class Html {
	/**
	 * Create HTML attribute
	 *
	 * @param $attr
	 * @param $value
	 */
	public static function attr($attr, $value) {
		if ($value) {
			echo ' ' . $attr . '="' . esc_attr($value) . '"';
		}
	}

}

/**
 *
 * @property string $add_button
 * @property array $insert_to
 *
 * @author Roman Ožana <ozana@omdesign.cz>
 */
class CommonOptions extends Options {
	protected $options = array('add_button' => 'after', 'insert_to' => array('page', 'post'));
}

$omSocialButtons = new Buttons();