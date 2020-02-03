<?php
namespace Dfe\Sift\Payload;
use Dfe\Sift\PM\Entity as PM;
use Dfe\Sift\Settings as S;
use Magento\Sales\Model\Order as O;
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
	static function p(P $p) {
		$pm = S::s()->pm($p->getMethod()); /** @var PM|null $pm */
		$o = $p->getOrder(); /** @var O $o */
		return [
			/**
			 * 2020-02-03 String.
			 * 1) «Response code from the AVS address verification system. Used in payments involving credit cards.»
			 * 2) @todo There is no a generic way to extract such information from a Magento payment module.
			 * I recommend to implement specific adapters to built-in Magento modules and most popular third-party ones:
			 * https://github.com/dmitry-fedyuk/sift/issues/2
			 */
			'avs_result_code' => ''
			/**
			 * 2020-02-03 String.
			 * 1) «The first six digits of the credit card number.
			 * These numbers contain information about the card issuer, the geography and other card details.»
			 * 2) @todo There is no a generic way to extract such information from a Magento payment module.
			 * I recommend to implement specific adapters to built-in Magento modules and most popular third-party ones:
			 * https://github.com/dmitry-fedyuk/sift/issues/2
			 */
			,'card_bin' => ''
			/**
			 * 2020-02-03 String.
			 * 1) «The last four digits of the credit card number.»
			 * 2) @todo There is no a generic way to extract such information from a Magento payment module.
			 * I recommend to implement specific adapters to built-in Magento modules and most popular third-party ones:
			 * https://github.com/dmitry-fedyuk/sift/issues/2
			 */
			,'card_last4' => ''
			// 2020-02-02 String. «The specific gateway, company, product, etc. being used to process payment.»
			,'payment_gateway' => !$pm ? '' : $pm->sGateway()
			// 2020-02-02 String. «The general type of payment being used.»
			,'payment_type' => !$pm ? '' : $pm->sType()
			/**
			 * 2020-02-03 String.
			 * «Use `$verification_status` to indicate the payment method has been verified.
			 * The value can be `$success`, `$failure` or `$pending`.
			 * For instance, if you request payment method verification from a payment processor
			 * and receive a failure set the value to `$failure`.»
			 */
			,'verification_status' => O::STATE_CANCELED === ($st = $o->getState()) ? '$failure' : (
				in_array($st, [O::STATE_COMPLETE, O::STATE_PROCESSING]) ? '$success' : '$pending'
			)
			// 2020-02-03 String.
			// «STUB»
			,'STUB' => 'STUB'
			// 2020-02-03 String.
			// «STUB»
			,'STUB' => 'STUB'
			// 2020-02-03 String.
			// «STUB»
			,'STUB' => 'STUB'
			// 2020-02-03 String.
			// «STUB»
			,'STUB' => 'STUB'
			// 2020-02-03 String.
			// «STUB»
			,'STUB' => 'STUB'
			// 2020-02-03 String.
			// «STUB»
			,'STUB' => 'STUB'
			// 2020-02-03 String.
			// «STUB»
			,'STUB' => 'STUB'
		];
	}
}