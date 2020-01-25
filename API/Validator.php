<?php
namespace Dfe\Sift\API;
// 2020-01-25 https://sift.com/developers/docs/curl/events-api/error-codes
final class Validator extends \Df\API\Response\Validator {
	/**
	 * 2020-01-25
	 * @override
	 * @see \Df\API\Exception::long()
	 * @used-by valid()
	 * @used-by \Df\API\Client::_p()
	 * @return string|null
	 */
	function long() {return $this->r('error_message');}

	/**
	 * 2020-01-25 «Any non-zero status indicates an error»
	 * @override
	 * @see \Df\API\Response\Validator::valid()
	 * @used-by \Df\API\Client::_p()
	 * @return bool
	 */
	function valid() {return !$this->r('status');}
}