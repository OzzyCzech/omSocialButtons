<?php
namespace omSocialButtons\flatter;

use omSocialButtons\IButton;

/**
 *
 * @author Roman Ozana <roman@ozana.cz>
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

	public function head() {
		require_once __DIR__ . '/header.phtml';
	}


	/**
	 * Return setting HTML
	 *
	 * @return mixed
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

	/**
	 * Getting post tags
	 *
	 * @return string
	 */
	public function getPostTags() {
		if ($posttags = get_the_tags()) {
			$tags = array();
			foreach ($posttags as $tag) {
				$tags[] = $tag->name;
			}
			return join(',', $tags) . ',wordpress';
		} else {
			return 'wordpress';
		}
	}

	/** @var array */
	public $categories = array(
		'text' => 'Text',
		'images' => 'Images',
		'video' => 'Video',
		'audio' => 'Audio',
		'software' => 'Software',
		'people' => 'People',
		'rest' => 'Other',
	);
	/** @var array */
	public $lang = array(
		'en_GB' => 'English',
		'sq_AL' => 'Albanian',
		'ar_DZ' => 'Arabic',
		'be_BY' => 'Belarusian',
		'bg_BG' => 'Bulgarian',
		'ca_ES' => 'Catalan',
		'zh_CN' => 'Chinese',
		'hr_HR' => 'Croatian',
		'cs_CZ' => 'Czech',
		'da_DK' => 'Danish',
		'nl_NL' => 'Dutch',
		'eo_EO' => 'Esperanto',
		'et_EE' => 'Estonian',
		'fi_FI' => 'Finnish',
		'fr_FR' => 'French',
		'es_GL' => 'Galician',
		'de_DE' => 'German',
		'el_GR' => 'Greek',
		'iw_IL' => 'Hebrew',
		'hi_IN' => 'Hindi',
		'hu_HU' => 'Hungarian',
		'is_IS' => 'Icelandic',
		'in_ID' => 'Indonesian',
		'ga_IE' => 'Irish',
		'it_IT' => 'Italian',
		'ja_JP' => 'Japanese',
		'ko_KR' => 'Korean',
		'lv_LV' => 'Latvian',
		'lt_LT' => 'Lithuanian',
		'mk_MK' => 'Macedonian',
		'ms_MY' => 'Malay',
		'mt_MT' => 'Maltese',
		'no_NO' => 'Norwegian',
		'nn_NO' => 'Nynorsk',
		'fa_FA' => 'Persian',
		'pl_PL' => 'Polish',
		'pt_PT' => 'Portuguese',
		'ro_RO' => 'Romanian',
		'ru_RU' => 'Russian',
		'sr_RS' => 'Serbian',
		'sk_SK' => 'Slovak',
		'sl_SI' => 'Slovenian',
		'es_ES' => 'Spanish',
		'sv_SE' => 'Swedish',
		'th_TH' => 'Thai',
		'tr_TR' => 'Turkish',
		'uk_UA' => 'Ukrainian',
		'vi_VN' => 'Vietnamese',
	);

}

/**
 *
 * @property string $enable
 * @property string $mode
 * @property int $https
 * @property int $popout
 * @property string $uid
 * @property string $button
 * @property string $lang
 * @property string $category
 * @property string $tags
 * @property string $description
 *
 * @author Roman Ožana <roman@ozana.cz>
 */
class Options extends \om\Options {

	protected $options = array(
		'enable' => true,
		'mode' => 'manual',
		'https' => 0,
		'popout' => 1,
		'uid' => null,
		'button' => null,
		'lang' => 'en_GB',
		'category' => 'text',
		'description' => '',
		'tags' => '',
	);
}