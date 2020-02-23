<?php
namespace Dfe\Sift\Payload\Payment;
use Magento\Sales\Model\Order\Payment as P;
/**
 * 2020-02-03
 * 1) It handles bank card fields of https://sift.com/developers/docs/curl/events-api/complex-field-types/payment-method
 * 2) @todo There is no a generic way to extract such information from a Magento payment module.
 * I recommend to implement specific adapters to built-in Magento modules and most popular third-party ones:
 * https://github.com/mage2pro/sift/issues/2
 */
final class BankCard {
	/**
	 * 2020-02-03
	 * @used-by \Dfe\Sift\Payload\Payment::p()
	 * @param P $p
	 * @return array(string => mixed)
	 */
	static function p(P $p) {return [
		// 2020-02-03 String.
		// «Response code from the AVS address verification system. Used in payments involving credit cards.»
		'avs_result_code' => ''
		// 2020-02-03 String.
		// «The first six digits of the credit card number.
		// These numbers contain information about the card issuer, the geography and other card details.»
		,'card_bin' => ''
		// 2020-02-03 String. «The last four digits of the credit card number.»
		,'card_last4' => ''
	];}
}