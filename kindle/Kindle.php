<?php
namespace omSocialButtons\kindle;
/**
 * @author Roman Ozana <ozana@omdesign.cz>
 * @see http://www.amazon.com/gp/sendtokindle/developers/button
 */
class Kindle implements \omSocialButtons\IButton {

	/** @var \omSocialButtons\kindle\Options */
	public $options;

	public function __construct() {
		$this->options = new Options('omSocialButtons-kindle');
	}

	/**
	 * Register all hooks
	 *
	 * @return null
	 */
	public function initButton() {

	}

	/**
	 * @return bool
	 */
	public function isEnable() {
		return (bool)$this->options->enable;
	}

	/**
	 * Return setting HTML
	 *
	 * @return null
	 */
	public function getOptionsForm() {
		require_once __DIR__ . '/settings.phtml';
	}

	/**
	 * Nastavi settings
	 *
	 * @return mixed
	 */
	public function setOptionsData() {
		$this->options->setByArray($_POST, 'kindle_%s');
		$this->options->saveOptions();
	}

	/**
	 * Return button HTML
	 *
	 * @return null
	 */
	public function getButtonHtml() {
		// TODO: Implement getButtonHtml() method.
	}
}


/**
 * @property bool $enable
 * @author Roman Ožana <ozana@omdesign.cz>
 */
class Options extends \omSocialButtons\Options {
	protected $options = array(
		'enable' => true,
	);
}