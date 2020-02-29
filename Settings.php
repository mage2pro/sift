<?php
namespace Dfe\Sift;
use Dfe\Sift\PM\Entity as PM;
// 2020-01-23
/** @method static Settings s() */
final class Settings extends \Df\API\Settings {
	/**
	 * 2020-01-25
	 * Where is a «Sandbox REST API Key» located? https://mage2.pro/t/6092
	 * Where is a «Production REST API Key» located? https://mage2.pro/t/6093
	 * @used-by \Dfe\Sift\API\B\Event::p()
	 * @used-by \Dfe\Sift\API\Facade\Account::adjustClient()
	 * @return string
	 */
	function backendKey() {return $this->testableP();}

	/**
	 * 2020-01-24
	 * Where is a «Sandbox Beacon Key» located? https://mage2.pro/t/6089
	 * Where is a «Production Beacon Key» located? https://mage2.pro/t/6091
	 * @used-by \Dfe\Sift\Js::_toHtml()
	 * @return string
	 */
	function frontendKey() {return $this->testableP();}

	/**
	 * 2020-02-03
	 * @param string $id
	 * @return PM|null
	 */
	function pm($id) {return $this->_a(PM::class)->get($id);}

	/**
	 * 2020-02-24 Where is a «Signature Key» located? https://mage2.pro/t/6099
	 * @used-by \Dfe\Sift\Controller\Index\Index::checkSignature()
	 * @return string
	 */
	function signatureKey() {return $this->p();}

	/**
	 * 2020-01-23
	 * @override
	 * @see \Df\Config\Settings::prefix()
	 * @used-by \Df\Config\Settings::v()
	 * @return string
	 */
	protected function prefix() {return 'fraud_protection/sift';}
}