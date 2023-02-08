<?php
namespace Dfe\Sift\Payload\Payment;
use Magento\Sales\Model\Order\Payment as P;
# 2020-02-03
# It handles `paypal_*` fields of https://sift.com/developers/docs/curl/events-api/complex-field-types/payment-method
final class PayPal {
	/**
	 * 2020-02-03
	 * @used-by \Dfe\Sift\Payload\Payment::p()
	 * @return array(string => mixed)
	 */
	static function p(P $p) {return array_map('df_nts', dfp_iia($p,
		/**
		 * 2020-02-03 String. «Payer address status returned by Paypal.»
		 * @see \Magento\Paypal\Model\Info::PAYPAL_ADDRESS_STATUS
		 */
		'paypal_address_status'
		/**
		 * 2020-02-03 String. «Payer email address returned by Paypal.»
		 * @see \Magento\Paypal\Model\Info::PAYPAL_PAYER_EMAIL
		 * An example: «test-buyer@dmitry-fedyuk.com».
		 */
		,'paypal_payer_email'
		/**
		 * 2020-02-03 String. «Payer ID returned by Paypal.»
		 * An example: «UES9EX5HHA8ZJ».
		 * @see \Magento\Paypal\Model\Info::PAYPAL_PAYER_ID
		 */
		,'paypal_payer_id'
		/**
		 * 2020-02-03 String. «Payer status returned by Paypal.»
		 * An example: «verified».
		 * @see \Magento\Paypal\Model\Info::PAYPAL_PAYER_STATUS
		 */
		,'paypal_payer_status'
		/**
		 * 2020-02-03 String. «Payment status returned by Paypal.»
		 * An example: «completed».
		 * @see \Magento\Paypal\Model\Info::PAYMENT_STATUS_GLOBAL
		 */
		,'paypal_payment_status'
		/**
		 * 2020-02-03 String. «Seller protection eligibility returned by Paypal.»
		 * An example: «Ineligible».
		 * @see \Magento\Paypal\Model\Info::PAYPAL_PROTECTION_ELIGIBILITY
		 */
		,'paypal_protection_eligibility'
	)) /** @uses df_nts() */;}
}