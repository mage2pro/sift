<?php
namespace Dfe\Sift\API\Validator;
# 2020-01-25 https://sift.com/developers/docs/curl/events-api/error-codes
/** @used-by \Dfe\Sift\API\Facade\Event::responseValidatorC() */
final class Event extends \Df\API\Response\Validator {
	/**
	 * 2020-01-25
	 * 2020-01-30 If the request is successful, then `error_message` is «OK».
	 * @override
	 * @see \Df\API\Exception::long()
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