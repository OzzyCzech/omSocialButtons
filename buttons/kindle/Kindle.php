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
		$this->options = new Options('omSocialButtons-Kindle');
	}

	/**
	 * Register all hooks
	 *
	 * @return null
	 */
	public function initButton() {
		add_action('wp_enqueue_scripts', array($this, 'enqueue_script'));
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
		if ($this->isEnable()) require_once __DIR__ . '/button.phtml';
	}

	public function enqueue_script() {

		if ($this->options->embed_js) {
			$js = '(function k(){window.$SendToKindle&&window.$SendToKindle.Widget?$SendToKindle.Widget.init(' .
				json_encode($this->options->selectors) . '):setTimeout(k,500);})();';

			wp_enqueue_script(
				'kindle_script', (is_ssl() ? 'https' : 'http') .
				'://d1xnn692s7u6t6.cloudfront.net/widget.js', false, null, true
			);

			global $wp_scripts;
			$wp_scripts->add_data('kindle_script', 'data', $js);
		}

		if ($this->options->embed_css) {
			wp_register_style('kindle-css', plugins_url('kindle.css', __FILE__));
			wp_enqueue_style('kindle-css');
		}

	}
}


/**
 * @property bool $enable
 * @property bool $embed_css
 * @property bool $embed_js
 * @property array $selectors
 *
 * @author Roman Ožana <ozana@omdesign.cz>
 */
class Options extends \om\Options {
	protected $options = array(
		'enable' => true,
		'embed_css' => true,
		'embed_js' => true,
		'selectors' => array(
			'title' => '.entry-title',
			'published' => '.entry-date',
			'content' => '.post',
			'exclude' => '.no-kindle',
		)
	);
}