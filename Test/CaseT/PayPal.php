<?php
namespace Dfe\Sift\Test\CaseT;
use Magento\Sales\Model\Order\Payment as P;
final class PayPal extends \Dfe\Sift\Test\CaseT {
	/** 2020-02-03 */
	function t00() {echo __METHOD__;}

	/**
	 * @test 2020-02-03
	 */
	function t01() {
		$p = dfp(10); /** @var P $p */
		print_r(dfp_iia($p));
		print_r(dfp_iia($p, 'paypal_payer_id'));
	}
}