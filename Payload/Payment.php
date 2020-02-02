<?php
namespace Dfe\Sift\Payload;
use Magento\Sales\Model\Order\Payment as P;
/**
 * 2020-02-02 https://sift.com/developers/docs/curl/events-api/complex-field-types/payment-method
 * «The payment_method field type represents information about the payment methods provided by the user.
 * The value must be a nested object with the appropriate item subfields for the given payment method.
 * Generally used with the `$create_order` or `$transaction` events.»
 */
final class Payment {
	/**
	 * 2020-02-01
	 * @used-by \Dfe\Sift\Observer\Sales\OrderPlaceAfter::execute()
	 * @param P $p
	 * @return array(string => mixed)
	 */
	static function p(P $p) {return [
		// 2020-02-02 String.
		// «The specific gateway, company, product, etc. being used to process payment.»
		'payment_gateway' => 'STUB'
		// 2020-02-02 String.
		// «The general type of payment being used.»
		,'payment_type' => 'STUB'
		// 2020-02-02 String.
		// «STUB»
		,'STUB' => 'STUB'
		// 2020-02-02 String.
		// «STUB»
		,'STUB' => 'STUB'
		// 2020-02-02 String.
		// «STUB»
		,'STUB' => 'STUB'
		,'STUB' => 'STUB'
		// 2020-02-02 String.
		// «STUB»
		,'STUB' => 'STUB'
		// 2020-02-02 String.
		// «STUB»
		,'STUB' => 'STUB'
		// 2020-02-02 String.
		// «STUB»
		,'STUB' => 'STUB'
		,'STUB' => 'STUB'
		// 2020-02-02 String.
		// «STUB»
		,'STUB' => 'STUB'
		// 2020-02-02 String.
		// «STUB»
		,'STUB' => 'STUB'
		// 2020-02-02 String.
		// «STUB»
		,'STUB' => 'STUB'
	];}
}