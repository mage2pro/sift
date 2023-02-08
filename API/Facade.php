<?php
namespace Dfe\Sift\API;
use Df\API\Client as ClientBase;
/**
 * 2020-02-27
 * @see \Dfe\Sift\API\Facade\GetDecisions
 * @see \Dfe\Sift\API\Facade\Event
 */
abstract class Facade extends \Df\API\Facade implements IClientConfiguration {
	/**
	 * 2020-02-27
	 * @used-by self::prefix()
	 * @see \Dfe\Sift\API\Facade\GetDecisions::ver()
	 * @see \Dfe\Sift\API\Facade\Event::ver()
	 */
	abstract protected function ver():int;

	/**
	 * 2020-02-29
	 * @override
	 * @see \Df\API\Facade::adjustClient()
	 * @used-by \Df\API\Facade::p()
	 * @used-by \Dfe\Sift\API\Facade\GetDecisions::adjustClient()
	 * @see \Dfe\Sift\API\Facade\GetDecisions::adjustClient()
	 * @param Client|ClientBase $c
	 */
	protected function adjustClient(ClientBase $c):void {$c->cfg($this);}

	/**
	 * 2020-02-27
	 * @override
	 * @see \Df\API\Facade::prefix()
	 * @used-by \Df\API\Facade::path()
	 * @used-by \Dfe\Sift\API\Facade\GetDecisions::path()
	 */
	final protected function prefix():string {return "v{$this->ver()}";}
}