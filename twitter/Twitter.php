<?php
namespace omSocialButtons\twitter;

use omSocialButtons\Button;
use omSocialButtons\Buttons;

/**
 * @author Roman Ožana <ozana@omdesign.cz>
 */
class Twitter implements Button {

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
	public function init() {
		// nothing
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
	public function getSettingsFormHtml() {
		require_once __DIR__ . '/settings.phtml';
	}

	/**
	 * Nastavi settings
	 *
	 * @return mixed
	 */
	public function updateSettingsForm() {
		$this->options->enable = array_key_exists('twitter_enable', $_POST) ? '1' : '0';
		$this->options->via = $_POST['twitter_via'];
		$this->options->related = $_POST['twitter_related'];
		$this->options->lang = in_array($_POST['twitter_lang'], Buttons::$langs) ? $_POST['twitter_lang'] : 'en';
		$this->options->text = $_POST['twitter_text'];
		$this->options->size = $_POST['twitter_size'];
		$this->options->count = $_POST['twitter_count'];
		$this->options->hashtags = $_POST['twitter_hashtags'];
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
 * @author Roman Ožana <ozana@omdesign.cz>
 */
class Options extends \omSocialButtons\Options {
	protected $options = array(
		'enable' => '1',
		'via' => '',
		'related' => '',
		'lang' => '',
		'text' => '',
		'size' => '',
		'count' => '',
		'hashtags' => '',
	);
}