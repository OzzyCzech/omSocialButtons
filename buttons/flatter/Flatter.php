<?php
namespace omSocialButtons\flatter;

use omSocialButtons\IButton;

/**
 *
 * @author Roman Ozana <ozana@omdesign.cz>
 */
class Flatter implements IButton {
	/** @var Options */
	public $options;

	/** @var bool */
	public $root = true;

	public function __construct() {
		$this->options = new Options('omSocialButtons-Flatter');
	}

	/**
	 * Register all hooks
	 *
	 * @return mixed
	 */
	public function initButton() {
		if (!$this->isEnable()) return;
		add_action('wp_head', array($this, 'head'));
	}

	/**
	 * Return setting HTML
	 *
	 * @return mixed
	 */
	public function getOptionsForm() {
		include __DIR__ . '/settings.phtml';
	}

	/**
	 * Nastavi settings
	 *
	 * @return mixed
	 */
	public function setOptionsData() {
		$this->options->setByArray($_POST, 'flatter_%s');
		$this->options->saveOptions();
	}

	/**
	 * @return bool
	 */
	public function isEnable() {
		return (bool)$this->options->enable;
	}


	/**
	 * Return button HTML
	 *
	 * @return null
	 */
	public function getButtonHtml() {
		if ($this->isEnable()) require_once __DIR__ . '/button.phtml';
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
 * @property string $lang
 *
 * @author Roman Ožana <ozana@omdesign.cz>
 */
class Options extends \om\Options {

	protected $options = array(
		'enable' => true,
		'width' => 450,
		'show_faces' => false,
		'send' => false, // send button
		'layout' => 'button_count', // standard, button_count, box_count
		'action' => '', // like or recommend
		'colorscheme' => '', // light or dark
		'lang' => 'en_US',
		'font' => '', // font
	);
}