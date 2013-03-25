<?php
namespace omSocialButtons;
/**
 * @author Roman Ozana <ozana@omdesign.cz>
 */
interface Button {
	/**
	 * Register all hooks
	 *
	 * @return null
	 */
	public function init();

	/**
	 * @return bool
	 */
	public function isEnable();

	/**
	 * Return setting HTML
	 *
	 * @return null
	 */
	public function getSettingsFormHtml();

	/**
	 * Nastavi settings
	 *
	 * @return mixed
	 */
	public function updateSettingsForm();

	/**
	 * Return button HTML
	 *
	 * @return null
	 */
	public function getButtonHtml();
}