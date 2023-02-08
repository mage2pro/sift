<?php
namespace Dfe\Sift\API;
# 2020-02-29
/** @see \Dfe\Sift\API\Facade */
interface IClientConfiguration {
	/**
	 * 2020-02-29
	 * @see \Dfe\Sift\API\Facade\GetDecisions::responseValidatorC()
	 * @see \Dfe\Sift\API\Facade\Event::responseValidatorC()
	 * @used-by \Dfe\Sift\API\Client::responseValidatorC()
	 */
	function responseValidatorC():string;
}