<?php
namespace Dfe\Sift\API\Validator;
/**
 * 2020-02-29
 * The Decision API responds with the following (undocumented) message structure on an error:
 * 		{"description": "The credentials supplied are not valid", "error": "invalid_credentials"}
 * https://sift.com/developers/docs/curl/decisions-api
 * @used-by \Dfe\Sift\API\Facade\GetDecisions::responseValidatorC()
 */
final class GetDecisions extends \Df\API\Response\Validator {
	/**
	 * 2020-02-29
	 * @override
	 * @see \Df\API\Exception::long()
	 * @used-by \Df\API\Client::_p()
	 * @used-by \Df\API\Exception::message()
	 */
	function long():string {return df_nts($this->r('description'));}

	/**
	 * 2020-02-29
	 * @override
	 * @see \Df\API\Exception::short()
	 * @used-by self::valid()
	 * @used-by \Df\API\Client::_p()
	 */
	function short():string {return df_nts($this->r('error'));}

	/**
	 * 2020-02-29
	 * @override
	 * @see \Df\API\Response\Validator::valid()
	 * @used-by \Df\API\Client::_p()
	 */
	function valid():bool {return !$this->r('error');}
}