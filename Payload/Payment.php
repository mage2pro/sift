<?php
namespace Dfe\Sift\Payload;
use Dfe\Sift\Payload\Payment\BankCard as pBankCard;
use Dfe\Sift\Payload\Payment\PayPal as pPayPal;
use Dfe\Sift\Payload\Payment\Stripe as pStripe;
use Dfe\Sift\PM\Entity as PM;
use Dfe\Sift\Settings as S;
use Magento\Sales\Model\Order as O;
use Magento\Sales\Model\Order\Payment as P;
/**
 * 2020-02-02 https://sift.com/developers/docs/curl/events-api/complex-field-types/payment-method
 * «The payment_method field type represents information about the payment methods provided by the user.
 * The value must be a nested object with the appropriate item subfields for the given payment method.
 * Generally used with the `create_order` or `transaction` events.»
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
		return pBankCard::p($p) + pPayPal::p($p) + pStripe::p($p) + [
			/**
			 * 2020-02-03 String.
			 * 1) «In case of a declined payment,
			 * response code received from the payment processor indicating the reason for the decline.»
			 * 2) @todo There is no a generic way to extract such information from a Magento payment module.
			 * I recommend to implement specific adapters to built-in Magento modules and most popular third-party ones:
			 * https://github.com/dmitry-fedyuk/sift/issues/2
			 */
			'decline_reason_code' => ''
			// 2020-02-02 String. «The specific gateway, company, product, etc. being used to process payment.»
			,'payment_gateway' => !$pm ? '' : sift_prefix($pm->sGateway())
			// 2020-02-02 String. «The general type of payment being used.»
			,'payment_type' => !$pm ? '' : sift_prefix($pm->sType())
			/**
			 * 2020-02-03 String.
			 * 1) «This is the ABA routing number or SWIFT code used.»
			 * 2) @todo There is no a generic way to extract such information from a Magento payment module.
			 * I recommend to implement specific adapters to built-in Magento modules and most popular third-party ones:
			 * https://github.com/dmitry-fedyuk/sift/issues/2
			 */
			,'routing_number' => ''
			/**
			 * 2020-02-03 String.
			 * «Use `verification_status` to indicate the payment method has been verified.
			 * The value can be `success`, `failure` or `pending`.
			 * For instance, if you request payment method verification from a payment processor
			 * and receive a failure set the value to `failure`.»
			 */
			,'verification_status' => O::STATE_CANCELED === ($st = $o->getState()) ? '$failure' : (
				in_array($st, [O::STATE_COMPLETE, O::STATE_PROCESSING]) ? '$success' : '$pending'
			)
		];
	}
}