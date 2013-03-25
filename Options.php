<?php
namespace omSocialButtons;

/**
 * Wordpress options class
 *
 * @author Roman Ožana <ozana@omdesign.cz>
 */
class Options {

	/** @var array */
	protected $options = array();
	/** @var null */
	private $name = null;

	/**
	 * Extract settings
	 */
	public function __construct($name = null, array $default = array()) {
		if ($name === null && __CLASS__ !== get_class($this)) {
			throw new \Exception('Invalid Options name');
		}

		$this->name = ($name) ? : get_class($this);
		if ($options = get_option($this->name, null)) {
			$this->options = array_merge($this->options, $options);
		}
	}

	/**
	 * Return all options
	 *
	 * @return array
	 */
	public function getOptions() {
		return $this->options;
	}

	/**
	 * Update options
	 *
	 * @return false
	 */
	public function saveOptions() {
		return update_option($this->name, $this->options);
	}

	/**
	 * Return settings option
	 *
	 * @param string $name
	 * @return mixed|null
	 */
	public function __get($name) {
		return array_key_exists($name, $this->options) ? $this->options[$name] : null;
	}

	/**
	 * Set option value
	 *
	 * @param $name
	 * @param $value
	 * @throws \Exception
	 */
	public function __set($name, $value) {
		if (array_key_exists($name, $this->options)) {
			$this->options[$name] = $value;
		} else {
			throw new \Exception(sprintf('Uknown option key "%s"', $name));
		}
	}

}