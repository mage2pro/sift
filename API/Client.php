<?php
namespace Dfe\Sift\API;
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