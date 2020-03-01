<?php
namespace Dfe\Sift\Test\CaseT\API\Account;
use Dfe\Sift\API\B\GetDecisions as B;
use Exception as E;
/**
 * 2020-02-27
 * 1) "Retrieve decisions configuration from Sift": https://github.com/mage2pro/sift/issues/19
 * 2) https://sift.com/developers/docs/curl/decisions-api/decisions-list
 */
final class Decisions extends \Dfe\Sift\Test\CaseT {
	/** 2020-02-27 */
	function t00() {echo __METHOD__;}

	/**
	 * @test 2020-02-27
	 * 2020-02-29
	 * A response:
	 *	{
	 *		"data": [
	 *			{
	 *				"abuse_type": "payment_abuse",
	 *				"category": "block",
	 *				"created_at": 1576745200538,
	 *				"description": "Order looks risky for payment abuse",
	 *				"entity_type": "order",
	 *				"id": "order_looks_bad_payment_abuse",
	 *				"name": "[Order] Reject",
	 *				"updated_at": 1582496542795,
	 *				"webhook_url": "http://sift.mage2.pro/store/sift"
	 *			},
	 *			{
	 *				"abuse_type": "payment_abuse",
	 *				"category": "accept",
	 *				"created_at": 1576745200538,
	 *				"description": "Order doesn't look risky for payment abuse",
	 *				"entity_type": "order",
	 *				"id": "order_looks_ok_payment_abuse",
	 *				"name": "[Order] Approve",
	 *				"updated_at": 1582496565091,
	 *				"webhook_url": "http://sift.mage2.pro/store/sift"
	 *			},
	 *			{
	 *				"abuse_type": "payment_abuse",
	 *				"category": "watch",
	 *				"created_at": 1581709471408,
	 *				"description": "Test",
	 *				"entity_type": "order",
	 *				"id": "watch_payment_abuse",
	 *				"name": "[Order] Watch",
	 *				"updated_at": 1582496555378,
	 *				"webhook_url": "http://sift.mage2.pro/store/sift"
	 *			}
	 *		],
	 *		"has_more": false,
	 *		"schema": "decision_public.json",
	 *		"total_results": 3
	 *	}
	 */
	function t01() {
		try {
			echo B::decisions()->j();
		}
		catch (E $e) {
			echo df_cc_n(df_ets($e), df_bt_s($e));
		}
	}
}