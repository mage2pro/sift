<?php
namespace Dfe\Sift\API;
/**
 * 2020-02-27
 * @see \Dfe\Sift\API\Facade\Account
 * @see \Dfe\Sift\API\Facade\Event
 */
abstract class Facade extends \Df\API\Facade {
	/**
	 * 2020-02-27
	 * @used-by prefix()
	 * @see \Dfe\Sift\API\Facade\Account::ver()
	 * @see \Dfe\Sift\API\Facade\Event::ver()
	 * @return int
	 */
	abstract protected function ver();

	/**
	 * 2020-02-27
	 * @override
	 * @see \Df\API\Facade::prefix()
	 * @used-by \Df\API\Facade::path()
	 * @return string
	 */
	final protected function prefix() {return "v{$this->ver()}";}
}