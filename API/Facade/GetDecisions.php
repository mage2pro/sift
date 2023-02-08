<?php
namespace Dfe\Sift\API\Facade;
use Df\API\Client as ClientBase;
use Dfe\Sift\API\Client;
use Dfe\Sift\Settings as S;
/**
 * 2020-02-27
 * 1) "Retrieve decisions configuration from Sift": https://github.com/mage2pro/sift/issues/19
 * 2) https://sift.com/developers/docs/curl/decisions-api/decisions-list
 * @method static Event s()
 */
final class GetDecisions extends \Dfe\Sift\API\Facade {
	/**
	 * 2020-02-29
	 * @override
	 * @see \Dfe\Sift\API\IClientConfiguration::responseValidatorC()
	 * @used-by \Dfe\Sift\API\Client::responseValidatorC()
	 */
	function responseValidatorC():string {return \Dfe\Sift\API\Validator\GetDecisions::class;}

	/**
	 * 2020-02-29
	 * @override
	 * @see \Dfe\Sift\API\Facade::adjustClient()
	 * @used-by \Df\API\Facade::p()
	 * @param Client|ClientBase $c
	 */
	protected function adjustClient(ClientBase $c) {
		parent::adjustClient($c);
		/**
		 * 2020-02-29
		 * It is undocumented, but the Decisions API uses a totally different way of authentication from the Events API.
		 * https://github.com/SiftScience/sift-php/blob/v4.0.0/lib/SiftClient.php#L552-L554
		 * https://github.com/SiftScience/sift-php/blob/v4.0.0/lib/SiftRequest.php#L78-L80
		 * https://sift.com/developers/docs/curl/decisions-api/decisions-list
		 */
		$c->c()->setAuth(S::s()->backendKey());
	}

	/**
	 * 2020-02-27
	 * @override
	 * @see \Df\API\Facade::path()
	 * @used-by \Df\API\Facade::p()
	 * @param int|string|null $id
	 * @param string|null $s
	 * @return string
	 */
	protected function path($id, $s) {return df_cc('?',
		df_cc_path($this->prefix(), 'accounts', S::s()->merchantID(), 'decisions'), http_build_query([
		   /**
			* 2020-02-27
			* Optional, string.
			* «Return only decisions applicable to the specified entity_type.
			* Allowed values:
			* 		`content`: this Decision should be applied to content.
			* 		`order`: this Decision should be applied to orders.
			* 		`session`: this Decision should be applied to sessions.
			* 		`user`: this Decision should be applied to users.
			* »
			*/
			'entity_type' => 'order'
		])
	);}

	/**
	 * 2020-02-27 https://sift.com/developers/docs/curl/decisions-api/decisions-list
	 * @override
	 * @see \Dfe\Sift\API\Facade::ver()
	 * @used-by \Dfe\Sift\API\Facade::prefix()
	 */
	protected function ver():int {return 3;}
}