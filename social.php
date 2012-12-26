<?php
/*
Plugin Name: omSocialButtons
Version: 1.1
Plugin URI: http://www.omdesign.cz/
Description: Add Twitter, Facebook and Google Plus to all posts
Author: <a href="http://www.omdesign.cz/kontakt">Roman Ožana</a>
Author URI: http://www.omdesign.cz/
*/

// secure check
if (!class_exists('WP')) {
	header('Status: 403 Forbidden');
	header('HTTP/1.1 403 Forbidden');
	exit;
}

/**
 * Simple social buttons generator
 *
 * @property string $twitter_enable
 * @property string $twitter_via
 * @property string $twitter_related
 * @property string $twitter_lang
 * @property string $twitter_text
 * @property string $twitter_size
 * @property string $twitter_count
 * @property string $twitter_hashtags
 *
 * @property string $google_enable
 * @property string $google_width
 * @property string $google_size
 * @property string $google_lang
 * @property string $google_annotation
 *
 * @property string $facebook_enable
 * @property string $facebook_width
 * @property string $facebook_show_faces
 * @property string $facebook_send
 * @property string $facebook_layout
 * @property string $facebook_action
 * @property string $facebook_colorscheme
 * @property string $facebook_font
 *
 * @property string $soc_add_buttons
 * @property array $soc_insert_to
 *
 * @author Roman Ozana <ozana@omdesign.cz>
 */
class SocialButtons {

	/** @var SocialButtons|null */
	private static $instance = null;

	/** @var array */
	private $options = array(
		// Twitter
		'twitter_enable' => '1',
		'twitter_via' => '',
		'twitter_related' => '',
		'twitter_lang' => '', // cs
		'twitter_text' => '',
		'twitter_size' => '',
		'twitter_count' => '', // none, horizontal, vertical
		'twitter_hashtags' => '',
		// Google plus

		'google_enable' => '1',
		'google_width' => 300,
		'google_size' => '',
		'google_lang' => '',
		'google_annotation' => '',

		// Facebook
		'facebook_enable' => '1',
		'facebook_width' => 450,
		'facebook_show_faces' => '',
		'facebook_send' => '', // send button
		'facebook_layout' => '', // standard, button_count, box_count
		'facebook_action' => '', // like or recommend
		'facebook_colorscheme' => '', // light or dark
		'facebook_font' => '', // font

		// common
		'soc_add_buttons' => 'after',
		'soc_insert_to' => array(),
	);

	/**
	 * Singelton instance init
	 *
	 * @return SocialButtons
	 */
	public static function instance() {
		if (self::$instance === null) self::$instance = new self;
		return self::$instance;
	}

	public function __construct() {
		add_action('admin_menu', array($this, 'admin_menu'));
		add_action('wp_head', array($this, 'header'));
		add_filter('loop_start', array($this, 'loop_start'));
		add_filter('the_content', array($this, 'the_content'));

		if ($options = get_option(__CLASS__, null)) {
			$this->options = array_merge($this->options, $options);
		}
	}

	/**
	 * Add SocialButtons to admin menu
	 */
	public function admin_menu() {
		add_options_page('Social Buttons', 'Social Buttons', 'manage_options', __FILE__, array($this, 'settings_page'));
	}

	/**
	 * Start loop of posts
	 */
	public function loop_start() {
		extract($this->options);
		require dirname(__FILE__) . '/facebook/header.phtml';
	}

	/**
	 * Add to header
	 */
	public function header() {
		extract($this->options);
		require dirname(__FILE__) . '/google/header.phtml';
	}

	/**
	 * Settings of plugin
	 */
	public function settings_page() {
		if (isset($_POST['submit'])) {
			foreach ($this->options as $name => $value) {
				$this->options[$name] = array_key_exists($name, $_POST) ? $_POST[$name] : null;
			}
			update_option(__CLASS__, $this->options);
			echo '<div class="updated"><p><strong>' . __('SocialButtons setting save') . '</strong></p></div>';
		}

		extract($this->options);
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

		echo '<div class="social-buttons"><div class="wrapper">';
		SocialButtons::twitter();
		SocialButtons::facebook();
		SocialButtons::googleplus();
		echo '</div></div>';

		$social = ob_get_contents();
		ob_end_clean();

		//return '<pre>' . htmlentities($social) . '</pre>';

		if (!in_array(get_post_type(), $this->options['soc_insert_to'])) return $content;

		switch ($this->options['soc_add_buttons']) {
			case 'before':
				return $social . $content;
			case 'after':
				return $content . $social;
			default:
				return $content;
		}
	}

	/**
	 * Show some button template
	 *
	 * @param string $name
	 */
	private static function show($name) {
		$permalink = get_permalink();
		extract(self::instance()->options);
		if (SocialButtons::instance()->{$name . '_enable'}) {
			require dirname(__FILE__) . '/' . $name . '/button.phtml';
		}
	}


	/**
	 * Return settings option
	 *
	 * @param string $name
	 * @return mixed|null
	 */
	public function __get($name) {
		return array_key_exists($name, $this->options) ? $this->options[$name] : null;
	}

	/**
	 * Show google plus button
	 */
	public static function googleplus() {
		SocialButtons::show('google');
	}

	/**
	 * Show twitter button
	 */
	public static function twitter() {
		SocialButtons::show('twitter');
	}

	/**
	 * Show facebook button
	 */
	public static function facebook() {
		SocialButtons::show('facebook');
	}


	public static function attr($attr, $value) {
		if ($value) {
			echo ' ' . $attr . '="' . esc_attr($value) . '"';
		}
	}

}

SocialButtons::instance();