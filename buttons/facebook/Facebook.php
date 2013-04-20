<?php
namespace omSocialButtons\facebook;

use omSocialButtons\IButton;

/**
 *
 * @author Roman Ozana <ozana@omdesign.cz>
 */
class Facebook implements IButton {
	/** @var Options */
	public $options;

	/** @var bool */
	public $root = true;

	public function __construct() {
		$this->options = new Options('omSocialButtons-Facebook');
	}

	/**
	 * Register all hooks
	 *
	 * @return mixed
	 */
	public function initButton() {
		// nothing to init
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
		$this->options->setByArray($_POST, 'facebook_%s');
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

	// all facebook languages
	public $lang = array(
		'af_ZA' => 'Afrikaans',
		'ar_AR' => 'Arabic',
		'ay_BO' => 'Aymara',
		'az_AZ' => 'Azeri',
		'be_BY' => 'Belarusian',
		'bg_BG' => 'Bulgarian',
		'bn_IN' => 'Bengali',
		'bs_BA' => 'Bosnian',
		'ca_ES' => 'Catalan',
		'ck_US' => 'Cherokee',
		'cs_CZ' => 'Czech',
		'cy_GB' => 'Welsh',
		'da_DK' => 'Danish',
		'de_DE' => 'German',
		'el_GR' => 'Greek',
		'en_GB' => 'English (UK)',
		'en_PI' => 'English (Pirate)',
		'en_UD' => 'English (Upside Down)',
		'en_US' => 'English (US)',
		'eo_EO' => 'Esperanto',
		'es_CL' => 'Spanish (Chile)',
		'es_CO' => 'Spanish (Colombia)',
		'es_ES' => 'Spanish (Spain)',
		'es_LA' => 'Spanish',
		'es_MX' => 'Spanish (Mexico)',
		'es_VE' => 'Spanish (Venezuela)',
		'et_EE' => 'Estonian',
		'eu_ES' => 'Basque',
		'fa_IR' => 'Persian',
		'fb_FI' => 'Finnish (test)',
		'fb_LT' => 'Leet Speak',
		'fi_FI' => 'Finnish',
		'fo_FO' => 'Faroese',
		'fr_CA' => 'French (Canada)',
		'fr_FR' => 'French (France)',
		'ga_IE' => 'Irish',
		'gl_ES' => 'Galician',
		'gn_PY' => 'Guaraní',
		'gu_IN' => 'Gujarati',
		'he_IL' => 'Hebrew',
		'hi_IN' => 'Hindi',
		'hr_HR' => 'Croatian',
		'hu_HU' => 'Hungarian',
		'hy_AM' => 'Armenian',
		'id_ID' => 'Indonesian',
		'is_IS' => 'Icelandic',
		'it_IT' => 'Italian',
		'ja_JP' => 'Japanese',
		'jv_ID' => 'Javanese',
		'ka_GE' => 'Georgian',
		'kk_KZ' => 'Kazakh',
		'km_KH' => 'Khmer',
		'kn_IN' => 'Kannada',
		'ko_KR' => 'Korean',
		'ku_TR' => 'Kurdish',
		'la_VA' => 'Latin',
		'li_NL' => 'Limburgish',
		'lt_LT' => 'Lithuanian',
		'lv_LV' => 'Latvian',
		'mg_MG' => 'Malagasy',
		'mk_MK' => 'Macedonian',
		'ml_IN' => 'Malayalam',
		'mn_MN' => 'Mongolian',
		'mr_IN' => 'Marathi',
		'ms_MY' => 'Malay',
		'mt_MT' => 'Maltese',
		'nb_NO' => 'Norwegian (bokmal)',
		'ne_NP' => 'Nepali',
		'nl_BE' => 'Dutch (België)',
		'nl_NL' => 'Dutch',
		'nn_NO' => 'Norwegian (nynorsk)',
		'pa_IN' => 'Punjabi',
		'pl_PL' => 'Polish',
		'ps_AF' => 'Pashto',
		'pt_BR' => 'Portuguese (Brazil)',
		'pt_PT' => 'Portuguese (Portugal)',
		'qu_PE' => 'Quechua',
		'rm_CH' => 'Romansh',
		'ro_RO' => 'Romanian',
		'ru_RU' => 'Russian',
		'sa_IN' => 'Sanskrit',
		'se_NO' => 'Northern Sámi',
		'sk_SK' => 'Slovak',
		'sl_SI' => 'Slovenian',
		'so_SO' => 'Somali',
		'sq_AL' => 'Albanian',
		'sr_RS' => 'Serbian',
		'sv_SE' => 'Swedish',
		'sw_KE' => 'Swahili',
		'sy_SY' => 'Syriac',
		'ta_IN' => 'Tamil',
		'te_IN' => 'Telugu',
		'tg_TJ' => 'Tajik',
		'th_TH' => 'Thai',
		'tl_PH' => 'Filipino',
		'tl_ST' => 'Klingon',
		'tr_TR' => 'Turkish',
		'tt_RU' => 'Tatar',
		'uk_UA' => 'Ukrainian',
		'ur_PK' => 'Urdu',
		'uz_UZ' => 'Uzbek',
		'vi_VN' => 'Vietnamese',
		'xh_ZA' => 'Xhosa',
		'yi_DE' => 'Yiddish',
		'zh_CN' => 'Simplified Chinese (China)',
		'zh_HK' => 'Traditional Chinese (Hong Kong)',
		'zh_TW' => 'Traditional Chinese (Taiwan)',
		'zu_ZA' => 'Zulu',
	);
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