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
	 * @return string|null
	 */
	function long() {return $this->r('description');}

	/**
	 * 2020-02-29
	 * @override
	 * @see \Df\API\Exception::short()
	 * @used-by valid()
	 * @used-by \Df\API\Client::_p()
	 * @return string|null
	 */
	function short() {return $this->r('error');}

	/**
	 * 2020-02-29
	 * @override
	 * @see \Df\API\Response\Validator::valid()
	 * @used-by \Df\API\Client::_p()
	 * @return bool
	 */
	function valid() {return !$this->r('error');}
}