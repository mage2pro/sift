<?php
namespace Dfe\Sift\Test\CaseT\API\Account;
use Dfe\Sift\API\B\Account as B;
use Exception as E;
/**
 * 2020-02-27
 * 1) "Retrieve decisions configuration from Sift": https://github.com/mage2pro/sift/issues/19
 * 2) https://sift.com/developers/docs/curl/decisions-api/decisions-list
 */
final class Decisions extends \Dfe\Sift\Test\CaseT {
	/** 2020-02-27 */
	function t00() {echo __METHOD__;}

	/** @test 2020-02-27 */
	function t01() {
		try {
			echo B::decisions()->j();
		}
		catch (E $e) {
			echo df_cc_n(df_ets($e), df_bt_s($e));
		}
	}
}