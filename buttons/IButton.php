<?php
namespace omSocialButtons;
/**
 * @author Roman Ozana <roman@ozana.cz>
 */
interface IButton {
	/**
	 * Register all hooks
	 *
	 * @return null
	 */
	public function initButton();

	/**
	 * @return bool
	 */
	public function isEnable();

	/**
	 * Return setting HTML
	 *
	 * @return null
	 */
	public function getOptionsForm();

	/**
	 * Nastavi settings
	 *
	 * @return mixed
	 */
	public function setOptionsData();

	/**
	 * Return button HTML
	 *
	 * @return null
	 */
	public function getButtonHtml();

}