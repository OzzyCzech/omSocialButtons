<?php
namespace omSocialButtons\google;
use omSocialButtons\IButton;

/**
 * @author Roman Ožana <ozana@omdesign.cz>
 */
class GooglePlus implements IButton {

	/** @var \omSocialButtons\google\Options */
	public $options;

	public function __construct() {
		$this->options = new Options('omSocialButtons-GooglePlus');
	}

	/**
	 * Register all hooks
	 *
	 * @return null
	 */
	public function initButton() {
		if (!$this->isEnable()) return;
		add_action('wp_head', array($this, 'head'));
	}

	public function head() {
		require_once __DIR__ . '/header.phtml';
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
		require_once __DIR__ . '/header.phtml';
		require_once __DIR__ . '/settings.phtml';
	}

	/**
	 * Nastavi settings
	 *
	 * @return mixed
	 */
	public function setOptionsData() {
		$this->options->setByArray($_POST, 'googleplus_%s');
		$this->options->saveOptions();
	}

	/**
	 * Return button HTML
	 *
	 * @return null
	 */
	public function getButtonHtml() {
		if ($this->isEnable()) require_once __DIR__ . '/button.phtml';
	}

	public $lang = array(
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
}

/**
 * @property string $enable
 * @property string $width
 * @property string $size
 * @property string $lang
 * @property string $annotation
 *
 * @author Roman Ožana <ozana@omdesign.cz>
 */
class Options extends \om\Options {

	/**
	 * @var array
	 */
	protected $options = array(
		'enable' => '1',
		'width' => 300,
		'size' => 'medium',
		'lang' => '',
		'annotation' => '',
	);
}
