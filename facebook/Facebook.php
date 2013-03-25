<?php
namespace omSocialButtons\facebook;

use omSocialButtons\Button;

/**
 *
 * @author Roman Ozana <ozana@omdesign.cz>
 */
class Facebook extends Options implements Button {

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
		extract($this->getOptions());
		include __DIR__ . '/header.phtml';
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
		add_action('wp_footer', array($this, 'wp_footer'));
		add_action('wp_head', array($this, 'wp_head'));
	}


	/**
	 * Nastavi settings
	 *
	 * @return mixed
	 */
	public function updateSettingsForm() {
		require_once __DIR__ . '/settings.phtml';
	}

	/**
	 * Return button HTML
	 *
	 * @return null
	 */
	public function getButtonHtml() {
		// TODO: Implement getButtonHtml() method.
	}


	// -------------------------------------------------------------------------------------------------------------------

	public function wp_footer() {
		echo '<!-- Facebook --><div id="fb-root"></div><!-- Facebook -->';
	}

	public function wp_head() {
		extract($this->getOptions());
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
		'layout' => '', // standard, button_count, box_count
		'action' => '', // like or recommend
		'colorscheme' => '', // light or dark
		'font' => '', // font
	);
}