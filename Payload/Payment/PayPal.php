<?php
namespace Dfe\Sift\Payload\Payment;
use Magento\Sales\Model\Order\Payment as P;
// 2020-02-03
// It handles `$paypal_*` fields of https://sift.com/developers/docs/curl/events-api/complex-field-types/payment-method
final class PayPal {
	/**
	 * 2020-02-03
	 * @used-by \Dfe\Sift\Payload\Payment::p()
	 * @param P $p
	 * @return array(string => mixed)
	 */
	static function p(P $p) {
		return [
			// 2020-02-03 String. «Payer email address returned by Paypal.»
			'paypal_payer_id' => dfp_iia($p, 'paypal_payer_id')
		];
	}
}