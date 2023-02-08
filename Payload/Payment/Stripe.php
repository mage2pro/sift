<?php
namespace Dfe\Sift\Payload\Payment;
use Magento\Sales\Model\Order\Payment as P;
/**
 * 2020-02-03
 * 1) It handles `stripe_*` fields of https://sift.com/developers/docs/curl/events-api/complex-field-types/payment-method
 * 2) @todo Magento does not have a built-in Stripe module,
 * so I recommend implement specific adapters for popular third-party ones:
 * https://github.com/mage2pro/sift/issues/2
 */
final class Stripe {
	/**
	 * 2020-02-03
	 * @used-by \Dfe\Sift\Payload\Payment::p()
	 * @return array(string => mixed)
	 */
	static function p(P $p) {return [
		# 2020-02-03 String. «Address line 1 verification result returned by Stripe.»
		'stripe_address_line1_check' => ''
		# 2020-02-03 String. «Address line 2 verification result returned by Stripe.»
		,'stripe_address_line2_check' => ''
		# 2020-02-03 String. «Address zip code verification result returned by Stripe.»
		,'stripe_address_zip_check' => ''
		# 2020-02-03 String. «Card brand returned by Stripe.»
		,'stripe_brand' => ''			
		# 2020-02-03 String. «CVC verification result returned by Stripe.»
		,'stripe_cvc_check' => ''
		# 2020-02-03 String. «Funding source returned by Stripe.»
		,'stripe_funding' => ''
	];}
}