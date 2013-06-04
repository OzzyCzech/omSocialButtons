<?php
namespace omSocialButtons;

use om\Options;
use omSocialButtons\facebook\Facebook;
use omSocialButtons\flatter\Flatter;
use omSocialButtons\google\GooglePlus;
use omSocialButtons\kindle\Kindle;
use omSocialButtons\twitter\Twitter;

/**
 * Plugin Name: omSocialButtons
 * Version: v2.0.0
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
define('SB', 'sb');

require_once __DIR__ . '/vendor/autoload.php';

/**
 * Simple social buttons generator
 *
 * @method null initButton()
 * @method null setOptionsData()
 * @method null getOptionsForm()
 * @method null getButtonHtml()
 *
 * @method \omSocialButtons\facebook\Facebook facebook();
 * @method \omSocialButtons\twitter\Twitter twitter();
 * @method \omSocialButtons\google\GooglePlus googleplus();
 * @method \omSocialButtons\flatter\Flatter flatter();
 *
 * @author Roman Ozana <ozana@omdesign.cz>
 */
class Buttons {

	public $buttons = array();

	/** @var CommonOptions */
	public $options;

	public function __construct() {
		$this->options = new CommonOptions('omSocialButtons');
		add_action('admin_menu', array($this, 'admin_menu'));
		add_filter('the_content', array($this, 'the_content'), 999);
		add_action('init', array($this, 'init'));
	}

	public function init() {
		load_plugin_textdomain(SB, false, basename(__DIR__) . '/languages/');
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

			$this->setOptionsData(); // update all button options

			// save common options
			$this->options->setByArray($_POST);
			$this->options->saveOptions();

			echo '<div class="updated"><p><strong>' . __('SocialButtons setting was saved', SB) . '</strong></p></div>';
		}

		$action = 'options-general.php?page=' . plugin_basename(__FILE__);
		$post_types = get_post_types(array('public' => true, 'show_ui' => true), 'objects');
		require __DIR__ . '/buttons/settings.phtml'; // render settings
	}


	/**
	 * Modify content automatically
	 *
	 * @param string $content
	 * @return string
	 */
	public function the_content($content) {
		if (!$content) return $content;

		// Ensure the correct page type and place
		if (
			(!in_array(get_post_type(), (array)$this->options->insert_to)) ||
			(is_home() && !$this->options->on_home) ||
			(is_archive() && !$this->options->on_archive) ||
			(is_single() && !$this->options->on_single)
		) {
			return $content;
		}

		// prepare buttons HTMl
		ob_start();
		$this->getButtonHtml();
		$social = '<div class="social-buttons"><div class="wrapper">' .
			apply_filters('omSocialButtonsContent', ob_get_contents()) .
			'</div></div>';
		ob_end_clean();

		//return '<pre>' . htmlentities($social) . '</pre>';

		switch ($this->options->add_button) {
			case 'both':
				return $social . $content . $social;
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
	 * @return IButton|null
	 */
	public function __call($name, $args) {
		if (array_key_exists($name, $this->buttons)) {
			return $this->buttons[$name]; // return button if exists
		}

		$results = array();
		foreach ($this->buttons as $key => $button) {
			/** @var IButton $button */
			do_action($x = sprintf('before_%s_%s', $key, $name), $args);
			$results[$key] = call_user_func_array(array($button, $name), $args); // call selected function on all buttons
			do_action(sprintf('after_%s_%s', $key, $name), $args);
		}
		return $results;
	}
}

class Html {
	/**
	 * Create HTML attribute
	 *
	 * @param $attr
	 * @param $value
	 * @param bool $allowempty
	 */
	public static function attr($attr, $value, $allowempty = false) {
		if ($value || $allowempty) {
			echo ' ' . $attr . '="' . esc_attr($value) . '"';
		}
	}

}

/**
 *
 * @property string $add_button
 * @property array $insert_to
 * @property bool $on_home
 * @property bool $on_single
 * @property bool $on_archive
 *
 * @author Roman Ožana <ozana@omdesign.cz>
 */
class CommonOptions extends Options {
	protected $options = array(
		'add_button' => 'after',
		'insert_to' => array('page', 'post'),
		'on_single' => true,
		'on_home' => false,
		'on_archive' => false,
	);
}

$omSocialButtons = new Buttons();
$omSocialButtons->buttons['facebook'] = new Facebook();
$omSocialButtons->buttons['twitter'] = new Twitter();
$omSocialButtons->buttons['googleplus'] = new GooglePlus();
$omSocialButtons->buttons['kindle'] = new Kindle();
$omSocialButtons->buttons['flatter'] = new Flatter();
$omSocialButtons->initButton(); // init all buttons

