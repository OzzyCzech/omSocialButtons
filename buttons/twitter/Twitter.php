<?php
namespace omSocialButtons\twitter;

use omSocialButtons\IButton;
use omSocialButtons\Buttons;

/**
 * @author Roman Ožana <roman@ozana.cz>
 */
class Twitter implements IButton {

	/** @var Options */
	public $options;

	public function __construct() {
		$this->options = new Options('omSocialButtons-Twitter');
	}

	/**
	 * Register all hooks
	 *
	 * @return null
	 */
	public function initButton() {
		// nothing to init
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
		$this->options->setByArray($_POST, 'twitter_%s');
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
 * @property string $via
 * @property string $related
 * @property string $lang
 * @property string $text
 * @property string $size
 * @property string $count
 * @property string $hashtags
 *
 * @author Roman Ožana <roman@ozana.cz>
 */
class Options extends \om\Options {
	protected $options = array(
		'enable' => true,
		'via' => '',
		'related' => '',
		'lang' => 'en',
		'text' => '',
		'size' => '',
		'count' => '',
		'hashtags' => '',
	);
}