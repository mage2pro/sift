<?php
namespace Dfe\Sift\API\Facade;
/**
 * 2020-01-25
 * @method static Event s()
 */
final class Event extends \Dfe\Sift\API\Facade {
	/**
	 * 2020-02-11
	 * 2020-02-12
	 * A response with `score_response`:
	 *	{
	 *		"status": 0,
	 *		"error_message": "OK",
	 *		"time": 1581443232,
	 *		"request": "...",
	 *		"score_response": {
	 *			"status": 0,
	 *			"error_message": "OK",
	 *			"scores": {
	 *				"payment_abuse": {
	 *					"score": 0.017345397550705105,
	 *					"reasons": [
	 *						{"name": "Estimated email domain age", "value": "2937.95 days"},
	 *						{"name": "Network", "value": "N92.243"},
	 *						{"name": "Latest order amount in USD", "value": "460.00 USD"},
	 *						{"name": "Latest status", "value": "$pending"},
	 *						{"name": "Browser/OS", "value": "WINDOWS_7-CHROME8"}
	 *					]
	 *				}
	 *			},
	 *			"user_id": "1",
	 *			"latest_labels": {},
	 *			"workflow_statuses": []
	 *		}
	 *	}
	 * @override
	 * @see \Df\API\Facade::path()
	 * @used-by \Df\API\Facade::p()
	 * @param int|string|null $id
	 * @param string|null $s
	 * @return string
	 */
	protected function path($id, $s) {return df_cc('?', parent::path($id, $s), http_build_query(array_fill_keys([
		/**
		 * 2020-02-11
		 * 1) "Integrate the module with the Score API": https://github.com/mage2pro/sift/issues/11
		 * 2) «To get scores back when sending an event,
		 * just append the query parameter return_score=true to your API request.»
		 * https://sift.com/developers/docs/php/score-api/overview
		 */
		'return_score'
		/**
		 * 2020-02-12
		 * 1) "Implement decision webhooks ": https://github.com/mage2pro/sift/issues/12
		 * 2) «If you want to receive the Workflow Decision synchronously,
		 * you simply need to add return_workflow_status=true to the URL parameters
		 * when you are sending Sift a Reserved or Custom event.»
		 * https://sift.com/developers/docs/php/workflows-api/running-workflows/synchronous
		 * 3) «If a Workflow is not running on the event you send this with,
		 * it will just return a score synchronously with an empty workflow_statuses block.»
		 * https://sift.com/developers/docs/php/workflows-api/running-workflows/synchronous
		 */
		,'return_workflow_status'
	/**
	 * 2020-02-12
	 * `true` should be a string,
	 * otherwise @uses http_build_query() will return "events?return_score=1&return_workflow_status=1",
	 * and Sift will ignore the `return_score` and `return_workflow_status` parameters.
	 */
	], 'true')));}

	/**
	 * 2020-02-27 https://sift.com/developers/docs/curl/events-api/overview
	 * @override
	 * @see \Dfe\Sift\API\Facade::ver()
	 * @used-by \Dfe\Sift\API\Facade::prefix()
	 * @return int
	 */
	protected function ver() {return 205;}
}