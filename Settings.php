<?php
namespace Dfe\Sift;
// 2020-01-23
/** @method static Settings s() */
final class Settings extends \Df\Config\Settings {
	/**
	 * 2020-01-23
	 * @override
	 * @see \Df\Config\Settings::prefix()
	 * @used-by \Df\Config\Settings::v()
	 * @return string
	 */
	protected function prefix() {return 'fraud_protection/sift';}
}