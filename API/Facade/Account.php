<?php
namespace Dfe\Sift\API\Facade;
/**
 * 2020-02-27
 * 1) "Retrieve decisions configuration from Sift": https://github.com/mage2pro/sift/issues/19
 * 2) https://sift.com/developers/docs/curl/decisions-api/decisions-list
 * @method static Event s()
 */
final class Account extends \Dfe\Sift\API\Facade {
	/**
	 * 2020-02-29
	 * @override
	 * @see \Dfe\Sift\API\IClientConfiguration::responseValidatorC()
	 * @used-by \Dfe\Sift\API\Client::responseValidatorC()
	 * @return string
	 */
	function responseValidatorC() {return \Dfe\Sift\API\Validator\Account::class;}

	/**
	 * 2020-02-27
	 * @override
	 * @see \Df\API\Facade::path()
	 * @used-by \Df\API\Facade::p()
	 * @param int|string|null $id
	 * @param string|null $s
	 * @return string
	 */
	protected function path($id, $s) {return df_cc('?', parent::path($id, $s), http_build_query([
	   /**
		* 2020-02-27
		* Optional, string.
		* «Return only decisions applicable to the specified entity_type.
		* Allowed values:
		* 		CONTENT: this Decision should be applied to content.
		* 		ORDER: this Decision should be applied to orders.
		* 		SESSION: this Decision should be applied to sessions.
		* 		USER: this Decision should be applied to users.
		* »
		*/
		'entity_type' => 'ORDER'
	]));}

	/**
	 * 2020-02-27 https://sift.com/developers/docs/curl/decisions-api/decisions-list
	 * @override
	 * @see \Dfe\Sift\API\Facade::ver()
	 * @used-by \Dfe\Sift\API\Facade::prefix()
	 * @return int
	 */
	protected function ver() {return 3;}
}