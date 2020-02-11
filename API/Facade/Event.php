<?php
namespace Dfe\Sift\API\Facade;
/**
 * 2020-01-25
 * @method static Event s()
 */
final class Event extends \Df\API\Facade {
	/**
	 * 2020-02-11
	 * 1) «To get scores back when sending an event,
	 * just append the query parameter return_score=true to your API request.»
	 * https://sift.com/developers/docs/php/score-api/overview
	 * 2) "Integrate the module with the Score API": https://github.com/dmitry-fedyuk/sift/issues/11
	 * @override
	 * @see \Df\API\Facade::path()
	 * @used-by \Df\API\Facade::p()
	 * @param int|string|null $id
	 * @param string|null $suffix
	 * @return string
	 */
	protected function path($id, $suffix) {return parent::path($id, $suffix) . '?return_score=true';}
}