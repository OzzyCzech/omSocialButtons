<?php
namespace omSocialButtons\google;
use omSocialButtons\Button;

/**
 * @author Roman Ožana <ozana@omdesign.cz>
 */
class GooglePlus implements Button {

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
	public function init() {
		if (!$this->isEnable()) return;
		add_action('wp_head', array($this, 'wp_head'));
	}

	public function wp_head() {
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
	public function getSettingsFormHtml() {
		require_once __DIR__ . '/header.phtml';
		require_once __DIR__ . '/settings.phtml';
	}

	/**
	 * Nastavi settings
	 *
	 * @return mixed
	 */
	public function updateSettingsForm() {
		$this->options->enable = (bool)$_POST['googleplus_enable'];
		$this->options->width = $_POST['googleplus_width'];
		$this->options->size = (int)$_POST['googleplus_size'];
		$this->options->annotation = $_POST['googleplus_annotation'];
		$this->options->lang = $_POST['googleplus_lang'];
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
 * @property string $width
 * @property string $size
 * @property string $lang
 * @property string $annotation
 *
 * @author Roman Ožana <ozana@omdesign.cz>
 */
class Options extends \omSocialButtons\Options {

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
