<?php
namespace Dfe\Sift\API;
use Dfe\Sift\Settings as S;
// 2020-01-25 https://sift.com/developers/docs/curl
final class Client extends \Df\API\Client {
	/**
	 * 2020-01-25
	 * @override
	 * @see \Df\API\Client::_construct()
	 * @used-by \Df\API\Client::__construct()
	 */
	protected function _construct() {
		parent::_construct();
		// 2020-01-26 https://sift.com/developers/docs/curl/events-api/fields
		$this->addFilterReq(function(array $p) {return [
			// 2020-01-25 «Your Sift REST API key». Required, string.
			'api_key' => S::s()->backendKey()
		   /**
			* 2020-01-26
			* Optional, string.
			* «IP address of the request made by the user.
			* Recommended for historical backfills and customers with mobile apps.»
			*/
			,'ip' => df_visitor_ip()
			/**
			 * 2020-01-25
			 * «The user's current session ID,
			 * used to tie a user's action before and after log in or account creation.»
			 * Required if no user is provided, string.
			 */
			,'session_id' => \Dfe\Sift\Session::get()
		   /**
			* 2020-01-26
			* Optional, integer.
			* «Represents the time the event occurred in your system.
			* Send as a UNIX timestamp in milliseconds as shown in the historical backfill tutorial.»
			* https://sift.com/resources/tutorials/sending-historical-data
			*/
			,'time' =>  time()
			/**
			 * 2020-01-26
			 * Required, string.
			 * «The user’s internal account ID.
			 * This field is required on all events performed by the user while logged in.
			 * Users without an assigned $user_id will not show up in the console.
			 * Note: User IDs are case sensitive.
			 * You may need to normalize the capitalization of your user IDs.
			 * Only the following characters may be used:a-z,A-Z,0-9,=, ., -, _, +, @, :, &, ^, %, !, $»
			 * https://sift.com/developers/docs/curl/events-api/fields
			 */
			,'user_id' => df_customer_id()
		] + $p;});
		$f = function(array $p) {
						
		};
		$this->addFilterReq(function(array $p) {return df_map_kr($p, function($k, $v) {return ["$$k", $v];});});
		$this->reqJson();
		$this->resJson();
	}

	/**
	 * 2020-01-25
	 * @override
	 * @see \Df\API\Client::responseValidatorC()
	 * @used-by \Df\API\Client::p()
	 * @return string
	 */
	protected function responseValidatorC() {return \Dfe\Sift\API\Validator::class;}

	/**
	 * 2020-01-25
	 * @override
	 * @see \Df\API\Client::urlBase()
	 * @used-by \Df\API\Client::__construct()
	 * @used-by \Df\API\Client::url()
	 * @return string
	 */
	protected function urlBase() {return 'https://api.sift.com/v205';}
}