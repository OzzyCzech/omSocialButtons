<?php
namespace omSocialButtons\facebook;

use omSocialButtons\Button;

/**
 *
 * @author Roman Ozana <ozana@omdesign.cz>
 */
class Facebook implements Button {

	/** @var Options */
	public $options;

	public function __construct() {
		$this->options = new Options('omSocialButtons-Facebook');
	}


	/**
	 * Return setting HTML
	 *
	 * @return mixed
	 */
	public function getSettingsFormHtml() {
		include __DIR__ . '/header.phtml';
		include __DIR__ . '/settings.phtml';
	}


	/**
	 * Nastavi settings
	 *
	 * @return mixed
	 */
	public function updateSettingsForm() {

	}

	/**
	 * @return bool
	 */
	public function isEnable() {
		return (bool)$this->options->enable;
	}

	/**
	 * Register all hooks
	 *
	 * @return mixed
	 */
	public function init() {
		if (!$this->isEnable()) return;
		add_action('wp_footer', array($this, 'wp_footer'));
		add_action('wp_head', array($this, 'wp_head'));
	}


	/**
	 * Return button HTML
	 *
	 * @return null
	 */
	public function getButtonHtml() {
		if ($this->isEnable()) require_once __DIR__ . '/button.phtml';
	}

	public function wp_footer() {
		echo '<!-- Facebook --><div id="fb-root"></div><!-- Facebook -->';
	}

	public function wp_head() {
		require_once __DIR__ . '/header.phtml';
	}

}

/**
 *
 * @property string $enable
 * @property string $width
 * @property string $show_faces
 * @property string $send
 * @property string $layout
 * @property string $action
 * @property string $colorscheme
 * @property string $font
 * @property string $test
 *
 * @author Roman Ožana <ozana@omdesign.cz>
 */
class Options extends \omSocialButtons\Options {

	protected $options = array(
		'enable' => '1',
		'width' => 450,
		'show_faces' => '',
		'send' => '', // send button
		'layout' => 'button_count', // standard, button_count, box_count
		'action' => '', // like or recommend
		'colorscheme' => '', // light or dark
		'font' => '', // font
	);
}