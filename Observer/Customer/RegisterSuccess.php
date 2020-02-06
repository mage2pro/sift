<?php
namespace Dfe\Sift\Observer\Customer;
use Dfe\Sift\API\B\Event;
use Dfe\Sift\Observer as _P;
use Magento\Customer\Model\Customer as C;
use Magento\Framework\Event\Observer as O;
use Magento\Framework\Event\ObserverInterface;
/**
 * 2020-02-06 `customer_register_success`
 * @used-by \Magento\Customer\Controller\Account\CreatePost::execute():
 * 		$this->_eventManager->dispatch('customer_register_success', [
 * 			'account_controller' => $this, 'customer' => $customer
 * 		]);
 * https://github.com/magento/magento2/blob/2.0.0/app/code/Magento/Customer/Controller/Account/CreatePost.php#L239-L242
 * https://github.com/magento/magento2/blob/2.3.4/app/code/Magento/Customer/Controller/Account/CreatePost.php#L367-L371
 * https://sift.com/developers/docs/curl/events-api/reserved-events/create-account
 */
final class RegisterSuccess implements ObserverInterface {
	/**
	 * 2020-02-06                                           I
	 * @override
	 * @see ObserverInterface::execute()
	 * @used-by \Magento\Framework\Event\Invoker\InvokerDefault::_callObserverMethod()
	 * @param O $o
	 */
	function execute(O $o) {_P::f(function() use($o) {
		$c = $o['customer']; /** @var C $c */
		// 2020-02-06 https://sift.com/developers/docs/curl/events-api/reserved-events/create-account
		Event::p('create_account', [
			// 2020-02-06 Array Of Strings.
			// «Capture the type(s) of the account: "merchant" or "shopper", "regular" or "premium", etc.
			// The array supports multiple types for a single account, e.g. ["merchant", "premium"].»
			'account_types' => []
			// 2020-02-06 String.
			// «The billing address associated with this user»
			// https://sift.com/developers/docs/curl/events-api/complex-field-types/address
			,'billing_address' => 'STUB'
			// 2020-02-06 String.
			// «The user agent of the browser that is used to create the account.
			// Represented by the `browser` object.
			// Use this field if the client is a browser.
			// Note: cannot be used in conjunction with `app`.»
			// https://sift.com/developers/docs/curl/events-api/complex-field-types/browser
			,'browser' => 'STUB'
			// 2020-02-06 String. «The full name of the user»
			,'name' => 'STUB'
			// 2020-02-06 String.
			// «The payment method(s) associated with this account»
			// https://sift.com/developers/docs/curl/events-api/complex-field-types/payment-method
			,'payment_methods' => []
			// 2020-02-06
			// «The primary phone number of the user associated with this account.
			// Provide the phone number as a string starting with the country code.
			// Use E.164 format or send in the standard national format of number's origin.
			// For example: "+14155556041" or "1-415-555-6041" for a U.S. number.
			// If you collect other phone numbers for the account,
			// provide them as additional custom fields, e.g `work_phone`»
			,'phone' => 'STUB'
			// 2020-02-06 String.
			// «The list of promotions that apply to this account.
			// You can add one or more promotions when creating or updating the account.
			// It is particularly useful to add the promotion with this event
			// if the account is receiving some referral incentive.
			// You can also separately add promotions to the account via the `add_promotion` event.»
			// https://sift.com/developers/docs/curl/events-api/complex-field-types/promotion
			,'promotions' => 'STUB'
			// 2020-02-06 String.
			// «The ID of the user that referred the current user to your business.
			// This field is required for detecting referral fraud.
			// Note: User IDs are case sensitive.
			// You may need to normalize the capitalization of your user IDs.
			// Follow our guidelines for `user_id` values.»
			,'referrer_user_id' => 'STUB'
			// 2020-02-06 String.
			// «The shipping address associated with this user»
			// https://sift.com/developers/docs/curl/events-api/complex-field-types/address
			,'shipping_address' => 'STUB'
			/**
			 * 2020-02-06 String.
			 * «If the user logged in with a social identify provider, give the name here.
			 * Allowed values: $amazon, $facebook, $google, $linkedin, $microsoft, $other, $twitter, $yahoo».
			 */
			,'social_sign_on_type' => 'STUB'
			// 2020-02-06 String.
			// «Email of the user creating this order.
			// Note: If the user's email is also their account ID in your system,
			// set both the `user_id` and `user_email` fields to their email address.»
			,'user_email' => 'STUB'
		]);
	});}
}